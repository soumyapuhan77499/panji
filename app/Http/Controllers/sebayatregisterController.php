<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bankdetail;
use App\Models\Childrendetail;
use App\Models\Addressdetail;
use App\Models\IdcardDetail;
use Illuminate\Support\Facades\Hash;


class sebayatregisterController extends Controller
{
    //
    public function sebayatregister(){
        return view('sebayatregister');
    }
    public function saveregister(Request $request){
        $userdata = new User();
        if($request->hasFile('userphoto')){

            $path = 'assets/uploads/userphoto/'.$userdata->userphoto;
           
           
            $file = $request->file('userphoto');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/userphoto/',$filename);
            $userdata->userphoto=$filename;
          }

        $userdata->userid = $request->userid;
        $userdata->name = $request->first_name;
        $userdata->first_name = $request->first_name;
        $userdata->last_name = $request->last_name;
        $userdata->email  = $request->email ;
        $userdata->phonenumber = $request->phonenumber;
        $userdata->dob = $request->dob;

        $userdata->password = Hash::make($request->password);
        $userdata->role = 'user';
        $userdata->bloodgrp = $request->bloodgrp;
        $userdata->qualification  = $request->qualification ;
        $userdata->fathername = $request->fathername;
        $userdata->mothername = $request->mothername;

        $userdata->marital = $request->marital;
        $userdata->spouse  = $request->spouse ;
        $userdata->datejoin = $request->datejoin;
        $userdata->seba = $request->seba;
        $userdata->templeid  = $request->templeid ;
        $userdata->bedhaseba = $request->bedhaseba;
        $userdata->status = $request->status;
        $userdata->save();

        // $childrennames = $request->childrenname;

        foreach ($request->childrenname as $childrenname) {
            // Childrendetail::create(['childrenname' => $childrenname]);
            
            $childata = new Childrendetail();
            $childata->userid = $request->userid;
            $childata->childrenname =  $childrenname;
            $childata->save();
        }

        foreach ($request->idproof as $key => $idproof) {
            $idnumber = $request->idnumber[$key];
            $file = $request->file('uploadoc')[$key];
            
            // Handle file upload
            $filePath = $file->storeAs('assets/uploads/uploadocument/', $file->getClientOriginalName());
    
            // Save form data to the database
            $iddata = new IdcardDetail();
            $iddata->userid = $request->userid;
            $iddata->idproof =  $idproof;
            $iddata->idnumber =  $idnumber;
            $iddata->uploadoc = $filePath; // Save file path in the database
            $iddata->save();
        }

       
        
        $addressdata = new Addressdetail();
        $addressdata->userid = $request->userid;
        $addressdata->preaddress = $request->preaddress;
        $addressdata->prepost = $request->prepost;
        $addressdata->predistrict = $request->predistrict;
        $addressdata->prestate = $request->prestate;
        $addressdata->precountry = $request->precountry;
        $addressdata->prepincode = $request->prepincode;
        $addressdata->prelandmark = $request->prelandmark;

        $addressdata->peraddress = $request->peraddress;
        $addressdata->perpost = $request->perpost;
        $addressdata->perdistri = $request->perdistri;
        $addressdata->perstate = $request->perstate;
        $addressdata->percountry = $request->percountry;
        $addressdata->perpincode = $request->perpincode;
        $addressdata->perlandmark = $request->perlandmark;
        $addressdata->save();

        $bankdata = new Bankdetail();
        $bankdata->userid = $request->userid;
        $bankdata->bankname = $request->bankname;
        $bankdata->branchname = $request->branchname;
        $bankdata->ifsccode = $request->ifsccode;
        $bankdata->accname = $request->accname;
        $bankdata->accnumber = $request->accnumber;
        $bankdata->save();


        return redirect()->back()->with('success', 'Data saved successfully.');
    }
}
