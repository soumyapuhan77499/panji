<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Nitilogin; // Make sure this model maps to your table
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class NitiloginController extends Controller
{
    private $apiUrl;
    private $clientId;
    private $clientSecret;

    public function __construct()
    {
        $this->apiUrl = 'https://auth.otpless.app';
        $this->clientId = 'Q9Z0F0NXFT3KG3IHUMA4U4LADMILH1CB';
        $this->clientSecret = '5rjidx7nav2mkrz9jo7f56bmj8zuc1r2';
    }

    public function sendOtp(Request $request)
    {
        $fullPhoneNumber = $request->input('phone');
        Log::info("Sending OTP to: " . $fullPhoneNumber);

        $client = new Client();
        $url = rtrim($this->apiUrl, '/') . '/auth/otp/v1/send';

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'clientId'      => $this->clientId,
                    'clientSecret'  => $this->clientSecret,
                ],
                'json' => [
                    'phoneNumber' => $fullPhoneNumber,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info("Response Body: " . print_r($body, true));

            if (isset($body['orderId'])) {
                $orderId = $body['orderId'];

                session(['otp_order_id' => $orderId]);
                session(['otp_phone' => $fullPhoneNumber]);

                return response()->json(['message' => 'OTP sent successfully', 'order_id' => $orderId, 'phone' => $fullPhoneNumber], 200);
            } else {
                return response()->json(['message' => 'Failed to send OTP. Please try again.'], 400);
            }
        } catch (RequestException $e) {
            Log::error("Request Exception: " . $e->getMessage());
            return response()->json(['message' => 'Failed to send OTP due to an error.'], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $orderId = $request->input('orderId');
        $otp = $request->input('otp');
        $phoneNumber = $request->input('phoneNumber');
        $platform = $request->input('platform'); // 'web', 'android', or 'ios'

        Log::info("Verifying OTP for Order ID: " . $orderId . ", Phone Number: " . $phoneNumber . ", OTP: " . $otp);

        $client = new Client();
        $url = rtrim($this->apiUrl, '/') . '/auth/otp/v1/verify';

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'clientId'      => $this->clientId,
                    'clientSecret'  => $this->clientSecret,
                ],
                'json' => [
                    'orderId' => $orderId,
                    'otp' => $otp,
                    'phoneNumber' => $phoneNumber,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info("Response Body: " . print_r($body, true));

            if (isset($body['isOTPVerified']) && $body['isOTPVerified']) {
                // Check if user exists by mobile_no
                $user = Nitilogin::where('mobile_no', $phoneNumber)->first();

                if (!$user) {
                    // Create a new user if it doesn't exist
                    $user = Nitilogin::create([
                        'user_id' => 'USER' . rand(10000, 99999),
                        'mobile_no' => $phoneNumber,
                        'order_id' => $orderId,
                        'client_id' => $this->clientId,
                        'client_secret' => Hash::make($this->clientSecret), // hash for security
                        'otp_length' => strlen($otp),
                        'channel' => $platform,
                        'expiry' => now()->addMinutes(10), // Assuming OTP expires in 10 minutes
                        'hash' => Hash::make($otp), // Hash the OTP
                    ]);
                } else {
                    // If the user exists, update the details (optional)
                    $user->order_id = $orderId;
                    $user->client_id = $this->clientId;
                    $user->client_secret = Hash::make($this->clientSecret);
                    $user->otp_length = strlen($otp);
                    $user->channel = $platform;
                    $user->expiry = now()->addMinutes(10);
                    $user->hash = Hash::make($otp);
                    $user->save();
                }

                // Generate token
                $token = $user->createToken('API Token')->plainTextToken;

                return response()->json([
                    'message' => 'User authenticated successfully.',
                    'user' => $user,
                    'token' => $token,
                    'token_type' => 'Bearer'
                ], 200);
            } else {
                $message = $body['message'] ?? 'Invalid OTP';
                return response()->json(['message' => $message], 400);
            }
        } catch (RequestException $e) {
            Log::error("Request Exception: " . $e->getMessage());
            return response()->json(['message' => 'Failed to verify OTP due to an error.'], 500);
        }
    }
}
