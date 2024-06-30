@extends('layouts.app')

    @section('styles')

		<!-- INTERNAL Select2 css -->
		<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />

		<!-- INTERNAL Data table css -->
		<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css')}}"  rel="stylesheet">
		<link href="{{asset('assets/plugins/datatable/responsive.bootstrap5.css')}}" rel="stylesheet" />

    @endsection

    @section('content')

					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="left-content">
						<span class="main-content-title mg-b-0 mg-b-lg-1">DASHBOARD</span>
						</div>
						<div class="justify-content-center mt-2">
							<ol class="breadcrumb">
								<li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Sales</li>
							</ol>
						</div>
					</div>
					<!-- /breadcrumb -->

					<!-- row -->
					<div class="row">
						<div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-xl-9 col-lg-7 col-md-6 col-sm-12">
													<div class="text-justified align-items-center">
														<h3 class="text-dark font-weight-semibold mb-2 mt-0">Hi, Welcome Back <span class="text-primary">{{ Auth::user()->name }}!</span></h3>
														<p class="text-dark tx-14 mb-3 lh-3"> You have used the 85% of free plan storage. Please upgrade your plan to get unlimited storage.</p>
														<button class="btn btn-primary shadow">Upgrade Now</button>
													</div>
												</div>
												<div class="col-xl-3 col-lg-5 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
													<div class="chart-circle float-md-end mt-4 mt-md-0" data-value="0.85" data-thickness="8" data-color=""><canvas width="100" height="100"></canvas>
														<div class="chart-circle-value circle-style"><div class="tx-18 font-weight-semibold">85%</div></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-xs-12">
									<div class="card sales-card">
										<div class="row">
											<div class="col-8">
												<div class="ps-4 pt-4 pe-3 pb-4">
													<div class="">
														<h6 class="mb-2 tx-12 ">Today Orders</h6>
													</div>
													<div class="pb-0 mt-0">
														<div class="d-flex">
															<h4 class="tx-20 font-weight-semibold mb-2">5,472</h4>
														</div>
														<p class="mb-0 tx-12 text-muted">Last week<i class="fa fa-caret-up mx-2 text-success"></i>
															<span class="text-success font-weight-semibold"> +427</span>
														</p>
													</div>
												</div>
											</div>
											<div class="col-4">
												<div class="circle-icon bg-primary-transparent text-center align-self-center overflow-hidden">
													<i class="fe fe-shopping-bag tx-16 text-primary"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-xs-12">
									<div class="card sales-card">
										<div class="row">
											<div class="col-8">
												<div class="ps-4 pt-4 pe-3 pb-4">
													<div class="">
														<h6 class="mb-2 tx-12">Today Earnings</h6>
													</div>
													<div class="pb-0 mt-0">
														<div class="d-flex">
															<h4 class="tx-20 font-weight-semibold mb-2">$47,589</h4>
														</div>
														<p class="mb-0 tx-12 text-muted">Last week<i class="fa fa-caret-down mx-2 text-danger"></i>
															<span class="font-weight-semibold text-danger"> -453</span>
														</p>
													</div>
												</div>
											</div>
											<div class="col-4">
												<div class="circle-icon bg-info-transparent text-center align-self-center overflow-hidden">
													<i class="fe fe-dollar-sign tx-16 text-info"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-xs-12">
									<div class="card sales-card">
										<div class="row">
											<div class="col-8">
												<div class="ps-4 pt-4 pe-3 pb-4">
													<div class="">
														<h6 class="mb-2 tx-12">Profit Gain</h6>
													</div>
													<div class="pb-0 mt-0">
														<div class="d-flex">
															<h4 class="tx-20 font-weight-semibold mb-2">$8,943</h4>
														</div>
														<p class="mb-0 tx-12 text-muted">Last week<i class="fa fa-caret-up mx-2 text-success"></i>
															<span class=" text-success font-weight-semibold"> +788</span>
														</p>
													</div>
												</div>
											</div>
											<div class="col-4">
												<div class="circle-icon bg-secondary-transparent text-center align-self-center overflow-hidden">
													<i class="fe fe-external-link tx-16 text-secondary"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-xs-12">
									<div class="card sales-card">
										<div class="row">
											<div class="col-8">
												<div class="ps-4 pt-4 pe-3 pb-4">
													<div class="">
														<h6 class="mb-2 tx-12">Total Earnings</h6>
													</div>
													<div class="pb-0 mt-0">
														<div class="d-flex">
															<h4 class="tx-22 font-weight-semibold mb-2">$57.12M</h4>
														</div>
														<p class="mb-0 tx-12  text-muted">Last week<i class="fa fa-caret-down mx-2 text-danger"></i>
															<span class="text-danger font-weight-semibold"> -693</span>
														</p>
													</div>
												</div>
											</div>
											<div class="col-4">
												<div class="circle-icon bg-warning-transparent text-center align-self-center overflow-hidden">
													<i class="fe fe-credit-card tx-16 text-warning"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
						
							<div class="row">
								<div class="col-sm-12 col-lg-12 col-xl-6">
									<div class="card overflow-hidden">
										<div class="card-header pb-1">
											<h3 class="card-title mb-2">Recent Customers</h3>
										</div>
										<div class="card-body p-0 customers mt-1">
											<div class="list-group list-lg-group list-group-flush">
												<a href="javascript:void(0);" class="border-0">
												<div class="list-group-item list-group-item-action border-0">
													<div class="media mt-0">
														<img class="avatar-lg rounded-circle me-3 my-auto shadow" src="{{asset('assets/img/faces/2.jpg')}}" alt="Image description">
														<div class="media-body">
															<div class="d-flex align-items-center">
																<div class="mt-0">
																	<h5 class="mb-1 tx-13 font-weight-sembold text-dark">Samantha Melon</h5>
																	<p class="mb-0 tx-12 text-muted">User ID: #1234</p>
																</div>
																<span class="ms-auto wd-45p tx-14">
																	<span class="float-end badge badge-success-transparent">
																	<span class="op-7 text-success font-weight-semibold">paid </span>
																</span>
																</span>
															</div>
														</div>
													</div>
												</div>
												</a>
												<a href="javascript:void(0);" class="border-0">
													<div class="list-group-item list-group-item-action border-0" >
														<div class="media mt-0">
															<img class="avatar-lg rounded-circle me-3 my-auto shadow" src="{{asset('assets/img/faces/1.jpg')}}" alt="Image description">
															<div class="media-body">
																<div class="d-flex align-items-center">
																	<div class="mt-1">
																		<h5 class="mb-1 tx-13 font-weight-sembold text-dark">Allie Grater</h5>
																		<p class="mb-0 tx-12 text-muted">User ID: #1234</p>
																	</div>
																	<span class="ms-auto wd-45p tx-14">
																		<span class="float-end badge badge-danger-transparent ">
																		<span class="op-7 text-danger font-weight-semibold">Pending</span>
																	</span>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</a>
												<a href="javascript:void(0);" class="border-0">
													<div class="list-group-item list-group-item-action border-0" >
														<div class="media mt-0">
															<img class="avatar-lg rounded-circle me-3 my-auto shadow" src="{{asset('assets/img/faces/5.jpg')}}" alt="Image description">
															<div class="media-body">
																<div class="d-flex align-items-center">
																	<div class="mt-1">
																		<h5 class="mb-1 tx-13 font-weight-sembold text-dark">Gabe Lackmen</h5>
																		<p class="mb-0 tx-12 text-muted">User ID: #1234</p>
																	</div>
																	<span class="ms-auto wd-45p  tx-14">
																		<span class="float-end badge badge-danger-transparent ">
																		<span class="op-7 text-danger font-weight-semibold">Pending</span>
																	</span>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</a>
												<a href="javascript:void(0);" class="border-0">
													<div class="list-group-item list-group-item-action border-0" >
														<div class="media mt-0">
															<img class="avatar-lg rounded-circle me-3 my-auto shadow" src="{{asset('assets/img/faces/7.jpg')}}" alt="Image description">
															<div class="media-body">
																<div class="d-flex align-items-center">
																	<div class="mt-1">
																		<h5 class="mb-1 tx-13 font-weight-sembold text-dark">Manuel Labor</h5>
																		<p class="mb-0 tx-12 text-muted">User ID: #1234</p>
																	</div>
																	<span class="ms-auto wd-45p tx-14">
																	<span class="float-end badge badge-success-transparent ">
																	<span class="op-7 text-success font-weight-semibold">Paid</span>
																</span>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</a>
												<a href="javascript:void(0);" class="border-0">
													<div class="list-group-item list-group-item-action border-0" >
														<div class="media mt-0">
															<img class="avatar-lg rounded-circle me-3 my-auto shadow" src="{{asset('assets/img/faces/9.jpg')}}" alt="Image description">
															<div class="media-body">
																<div class="d-flex align-items-center">
																	<div class="mt-1">
																		<h5 class="mb-1 tx-13 font-weight-sembold text-dark">Hercules Bing</h5>
																		<p class="mb-0 tx-12 text-muted">User ID: #1754</p>
																	</div>
																	<span class="ms-auto wd-45p tx-14">
																	<span class="float-end badge badge-success-transparent ">
																	<span class="op-7 text-success font-weight-semibold">Paid</span>
																</span>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</a>
												<a href="javascript:void(0);" class="border-0">
													<div class="list-group-item list-group-item-action border-0" >
														<div class="media mt-0">
															<img class="avatar-lg rounded-circle me-3 my-auto shadow" src="{{asset('assets/img/faces/11.jpg')}}" alt="Image description">
															<div class="media-body">
																<div class="d-flex align-items-center">
																	<div class="mt-1">
																		<h5 class="mb-1 tx-13 font-weight-sembold text-dark">Manuel Labor</h5>
																		<p class="mb-0 tx-12 text-muted">User ID: #1234</p>
																	</div>
																	<span class="ms-auto wd-45p tx-14">
																		<span class="float-end badge badge-danger-transparent ">
																		<span class="op-7 text-danger font-weight-semibold">Pending</span>
																	</span>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-xl-6">
										<div class="card overflow-hidden">
											<div class="card-header pb-1">
												<div class="card-title mb-2">Warehouse Operating Costs</div>
											</div>
											<div class="card-body p-0">
												<div class="list-group projects-list border-0">
													<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-0">
														<div class="d-flex w-100 justify-content-between">
															<p class="tx-13 mb-2 font-weight-semibold text-dark">Order Picking</p>
															<h4 class="text-dark mb-0 font-weight-semibold text-dark tx-18">3,876</h4>
														</div>
														<div class="d-flex w-100 justify-content-between">
															<span class="text-muted tx-12"><i class="fa fa-caret-up text-success me-1"></i> <span class="text-success">03%</span> last month</span>
															<span class="text-muted  tx-11">5 days ago</span>
														</div>
													</a>
													<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-start-0 border-end-0 border-top">
														<div class="d-flex w-100 justify-content-between">
															<p class="tx-13 mb-2 font-weight-semibold text-dark">Storage</p>
															<h4 class="text-dark mb-0 font-weight-semibold text-dark tx-18">2,178</h4>
														</div>
														<div class="d-flex w-100 justify-content-between">
															<span class="text-muted  tx-12"><i class="fa fa-caret-down text-danger me-1"></i><span class="text-danger"> 16%</span> last month</span>
															<span class="text-muted  tx-11">2 days ago</span>
														</div>
													</a>
													<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-start-0 border-end-0 border-top">
														<div class="d-flex w-100 justify-content-between">
															<p class="tx-13 mb-2 font-weight-semibold text-dark">Shipping</p>
															<h4 class="text-dark mb-0 font-weight-semibold text-dark tx-18">1,367</h4>
														</div>
														<div class="d-flex w-100 justify-content-between">
															<span class="text-muted  tx-12"><i class="fa fa-caret-up text-success me-1"></i><span class="text-success"> 06%</span> last month</span>
															<span class="text-muted  tx-11">1 days ago</span>
														</div>
													</a>
													<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-start-0 border-end-0 border-top">
														<div class="d-flex w-100 justify-content-between">
															<p class="tx-13 mb-2 font-weight-semibold text-dark">Receiving</p>
															<h4 class="text-dark mb-0 font-weight-semibold text-dark tx-18">678</h4>
														</div>
														<div class="d-flex w-100 justify-content-between">
															<span class="text-muted  tx-12"><i class="fa fa-caret-down text-danger me-1"></i><span class="text-danger"> 25%</span> last month</span>
															<span class="text-muted  tx-11">10 days ago</span>
														</div>
													</a>
													<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-start-0 border-end-0 border-top">
														<div class="d-flex w-100 justify-content-between">
															<p class="tx-13 mb-2 font-weight-semibold text-dark">Review</p>
															<h4 class="text-dark mb-0 font-weight-semibold text-dark tx-18">578</h4>
														</div>
														<div class="d-flex w-100 justify-content-between">
															<span class="text-muted  tx-12"><i class="fa fa-caret-up text-success me-1"></i><span class="text-success"> 55%</span> last month</span>
															<span class="text-muted  tx-11">11 days ago</span>
														</div>
													</a>
													<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-start-0 border-end-0 border-top mb-3">
														<div class="d-flex w-100 justify-content-between">
															<p class="tx-13 mb-2 font-weight-semibold text-dark">Profit</p>
															<h4 class="text-dark mb-0 font-weight-semibold text-dark tx-18">$27,215</h4>
														</div>
														<div class="d-flex w-100 justify-content-between">
															<span class="text-muted  tx-12"><i class="fa fa-caret-up text-success me-1"></i><span class="text-success"> 32%</span> last month</span>
															<span class="text-muted  tx-11">11 days ago</span>
														</div>
													</a>
												</div>
											</div>
										</div>
									</div>
								
							</div>
						</div>
						<!-- </div> -->
					</div>
					<!-- row closed -->

					<!-- row -->
					
					<!-- row closed -->

					<!-- row  -->
					<div class="row">
						<div class="col-12 col-sm-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Product Summary</h4>
								</div>
								<div class="card-body pt-0 example1-table">
									<div class="table-responsive">
										<table class="table  table-bordered text-nowrap mb-0" id="example1">
											<thead>
												<tr>
													<th class="text-center">Purchase Date</th>
													<th>Client Name</th>
													<th>Product ID</th>
													<th>Product</th>
													<th>Product Cost</th>
													<th>Payment Mode</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="text-center">#01</td>
													<td>Sean Black</td>
													<td>PRO12345</td>
													<td>Mi LED Smart TV 4A 80</td>
													<td>$14,500</td>
													<td>Online Payment</td>
													<td><span class="badge badge-success">Delivered</span></td>
												</tr>
												<tr>
													<td class="text-center">#02</td>
													<td>Evan Rees</td>
													<td>PRO8765</td>
													<td>Thomson R9 122cm (48 inch) Full HD LED TV </td>
													<td>$30,000</td>
													<td>Cash on delivered</td>
													<td><span class="badge badge-primary">Add Cart</span></td>
												</tr>
												<tr>
													<td class="text-center">#03</td>
													<td>David Wallace</td>
													<td>PRO54321</td>
													<td>Vu 80cm (32 inch) HD Ready LED TV</td>
													<td>$13,200</td>
													<td>Online Payment</td>
													<td><span class="badge badge-orange">Pending</span></td>
												</tr>
												<tr>
													<td class="text-center">#04</td>
													<td>Julia Bower</td>
													<td>PRO97654</td>
													<td>Micromax 81cm (32 inch) HD Ready LED TV</td>
													<td>$15,100</td>
													<td>Cash on delivered</td>
													<td><span class="badge badge-secondary">Delivering</span></td>
												</tr>
												<tr>
													<td class="text-center">#05</td>
													<td>Kevin James</td>
													<td>PRO4532</td>
													<td>HP 200 Mouse &amp; Wireless Laptop Keyboard </td>
													<td>$5,987</td>
													<td>Online Payment</td>
													<td><span class="badge badge-danger">Shipped</span></td>
												</tr>
												<tr>
													<td class="text-center">#06</td>
													<td>Theresa	Wright</td>
													<td>PRO6789</td>
													<td>Digisol DG-HR3400 Router </td>
													<td>$11,987</td>
													<td>Cash on delivered</td>
													<td><span class="badge badge-secondary">Delivering</span></td>
												</tr>
												<tr>
													<td class="text-center">#07</td>
													<td>Sebastian	Black</td>
													<td>PRO4567</td>
													<td>Dell WM118 Wireless Optical Mouse</td>
													<td>$4,700</td>
													<td>Online Payment</td>
													<td><span class="badge badge-info">Add to Cart</span></td>
												</tr>
												<tr>
													<td class="text-center">#08</td>
													<td>Kevin Glover</td>
													<td>PRO32156</td>
													<td>Dell 16 inch Laptop Backpack </td>
													<td>$678</td>
													<td>Cash On delivered</td>
													<td><span class="badge badge-pink">Delivered</span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /row closed -->

    @endsection

    @section('scripts')

		<!-- Internal Chart.Bundle js-->
		<script src="{{asset('assets/plugins/chartjs/Chart.bundle.min.js')}}"></script>

		<!-- Moment js -->
		<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>

		<!-- INTERNAL Apexchart js -->
		<script src="{{asset('assets/js/apexcharts.js')}}"></script>

		<!--Internal Sparkline js -->
		<script src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

		<!--Internal  index js -->
		<script src="{{asset('assets/js/index.js')}}"></script>

        <!-- Chart-circle js -->
		<script src="{{asset('assets/js/chart-circle.js')}}"></script>

		<!-- Internal Data tables -->
		<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
		<script src="{{asset('assets/plugins/datatable/responsive.bootstrap5.min.js')}}"></script>

		<!-- INTERNAL Select2 js -->
		<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
		<script src="{{asset('assets/js/select2.js')}}"></script>

    @endsection
