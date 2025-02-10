<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    //

    public function login(Request $request)
    {
        /* if (Auth::check() && session()->has('role')) {
            $role = session('role');
            if (in_array($role, ['Developer', 'Oversear', 'Kernel'])) {
                return redirect()->route('management.dashboard');
            } elseif (in_array($role, ['Author', 'Event Manager', 'State Director'])) {
                return redirect()->route('client.dashboard');
            }
        } return view('auth.login'); */
        return view("auth.login");
    }
    public function recover_password(Request $request)
    {
        return view("auth.recover-password");
    }
    public function reset_password(Request $request)
    {
        return view("auth.reset-password");
    }

    
    //TODO:  LOGOUT FUNCTION
    public function logout(Request $request) {
        session()->flush();
                Auth::logout();
                return redirect()->route('login');
       /*  try {
            // Validate incoming request data
            $data = $request->validate([
                'user_id' => 'required|numeric',
            ]);
    
            $time_out = now()->format('H:i:s');
            $dbRequest = DB::table('sessions')
                ->where('user_id', $data['user_id'])
                ->whereNull('time_out')
                ->update(['time_out' => $time_out]);
    
            // Check if the update was successful
            if ($dbRequest) {
                session()->flush();
                Auth::logout();
                return response()->json([
                    'success' => true,
                    'message' => 'Logout successful',
                ], 201);
            }
    
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        } */
    }

    //TODO:  DOING THE DATABASE LOGICS
    public function getCredential(Request $request)
    {
        try {
            $credentials = $request->only('username', 'password');

            // Step 1: Query the user by username
            $user = User::where('username', $credentials['username'])->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, your credentials have been found invalid, please try again',
                ], 401);
            }

            // Step 2: Check if the password matches
            if (!Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, your credentials have been found invalid, please try again',
                ], 401);
            }

            // Step 3: Check if the user is deleted
            if ($user->is_deleted == 'Yes') {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found or has been deleted, contact the system administrators',
                ], 404);
            }

            // Step 4: Log in the user manually
            Auth::login($user);

            // Step 5: Fetch additional user details using a raw SQL query
            $sql = "
            SELECT u.name, u.email, u.status, u.referer_id, u.username, r.role, s.programme_id as programme, s.class_id as class, l.department_id AS department, COALESCE(s.phone, l.phone) as phone, COALESCE(s.profile, l.profile) as picture, CASE WHEN r.role = 'Student' THEN NULL ELSE d.faculty_id END AS faculty FROM users as u INNER JOIN roles as r ON r.id = u.role_id LEFT JOIN students AS s ON u.referer_id = s.id AND r.role = 'Student' LEFT JOIN lecturers AS l ON u.referer_id = l.id AND r.role != 'Student' LEFT JOIN departments AS d ON l.department_id = d.id WHERE u.id = ?";
            
            $userDetails = DB::select($sql, [$user->id]);
            $userData = !empty($userDetails) ? (object)$userDetails[0] : null;

            if (!$userData) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            // Prepare the response data
            $imageUrl = asset('storage/images/' . $userData->picture);
            return response()->json([
                'success' => true,
                'message' => 'User authenticated successfully',
                'data' => [
                    'name' => $userData->name,
                    'email' => $userData->email,
                    'status' => $userData->status,
                    'referer_id' => $userData->referer_id,
                    'username' => $userData->username,
                    'role' => $userData->role,
                    'phone' => $userData->phone,
                    'picture' => $imageUrl,
                    'programme' => $userData->programme,
                    'level' => $userData->class,
                    'faculty' => $userData->faculty,
                    'department' => $userData->department,
                ]
            ], 200);

        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Error occurred in getCredential: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


    //TODO:  Sending the action request
    public function signin(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:5',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($validator->errors()),
            ], 422);
        }

        // Call the getCredential function to authenticate the user and get user data
        $credentialsResponse = $this->getCredential($request);

        // Decode the response from getCredential
        $credentialsData = json_decode($credentialsResponse->getContent(), true);

        if ($credentialsResponse->getStatusCode() === 200 && $credentialsData['success']) {
            // Get user roles and determine the dashboard route
            $roles = (string) $credentialsData['data']['role'];

            // Get batch and dashboard route
            $batch = $this->getBatchAndDashboardRoute($roles);

            // Store session data
            $this->storeSessionData($credentialsData['data'], $batch['batch']);

            return response()->json([
                'success' => true,
                'redirect' => route($batch['dashboardRoute'])
            ]);
        } else {
            return $credentialsResponse;
        }
    }


    //TODO: Reaching out to the routes based on the role
    private function getBatchAndDashboardRoute($role)
    {
        $roles = [
            'Developer' => ['batch' => 'Developer', 'dashboardRoute' => 'developer.home'],
            'Head QA' => ['batch' => 'QAD', 'dashboardRoute' => 'qa.dashboard'],
            'Administrator' => ['batch' => 'Staff', 'dashboardRoute' => 'fa.dashboard'],
            'Dean' => ['batch' => 'Staff', 'dashboardRoute' => 'fa.dashboard'],
            'HOD' => ['batch' => 'Staff', 'dashboardRoute' => 'dept.dashboard'],
            'Officer' => ['batch' => 'Staff', 'dashboardRoute' => 'dept.dashboard'],
            'Lecturer' => ['batch' => 'Staff', 'dashboardRoute' => 'lec.dashboard'],
            'Student' => ['batch' => 'Student', 'dashboardRoute' => 'student.dashboard'],
        ];

        return $roles[$role] ?? ['batch' => '', 'dashboardRoute' => ''];
    }

    //TODO:  Store the session values
    private function storeSessionData($responseData, $batch)
    {
        session([
            'referer_id' => $responseData['referer_id'],
            'batch' => $batch,
            'status' => $responseData['status'],
            'username' => $responseData['username'],
            'name' => $responseData['name'],
            'email' => $responseData['email'],
            'phone' => $responseData['phone'],
            'picture' => $responseData['picture'],
            'role' => $responseData['role'],
            'programme' => $responseData['programme'],
            'level' => $responseData['level'],
            'faculty' => $responseData['faculty'],
            'department' => $responseData['department'],
        ]);
    }

    
}
