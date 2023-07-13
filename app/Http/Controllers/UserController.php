<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\exportUser;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get the keyword for filtering
            $keyword = $request->input('keyword');
    
            // Get the query parameter for skip (default: 0)
            $skip = $request->input('skip', 0);
    
            // Get the query parameter for limit (default: 10)
            $limit = $request->input('limit', 10);
    
            // Create a query builder instance for the User model
            $query = User::query();
    
            // Apply filters based on the keyword
            if ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('department', 'like', '%' . $keyword . '%')
                        ->orWhere('role', 'like', '%' . $keyword . '%');
                });
            }
    
            // Skip and limit the results
            $user_count = $query->get();
            $users = $query->skip($skip)->take($limit)->get();
    
            // Return the users as a JSON response
            return response()->json(['users' => $users, 'totalCount' => count($user_count)]);
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            return response()->json(['error' => 'An error occurred while retrieving the users'], 500);
        }
    }    

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'department' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string',
                'role' => 'required|in:admin,employee'
            ]);

            // Create a new user instance with the validated data
            $user = User::create([
                'name' => $validatedData['name'],
                'department' => $validatedData['department'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role' => $validatedData['role']
            ]);

            return response()->json(['message' => 'User created successfully']);
        } catch (ValidationException $e) {
            throw new HttpResponseException(response()->json(['errors' => $e->errors()], 422));
        } catch (\Exception $e) {
            throw new HttpResponseException(response()->json(['error' => 'An error occurred while creating the user'], 500));
        }
    }

    public function show(Request $request)
    {
        try {
            // Find the user by ID
            $user_data = User::findOrFail($request->id);
    
            // Return the user details as a JSON response
            return response()->json(['user' => $user_data]);
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            return response()->json(['error' => 'An error occurred while retrieving the user details'], 500);
        }
    }
    
    public function update(Request $request, User $user)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'department' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $request->id,
                'password' => 'required|string',
                'role' => 'required|in:admin,employee'
            ]);
            // Find the user by ID
            $user = User::findOrFail($request->id);
    
            // Update the user attributes
            $user->name = $validatedData['name'];
            $user->department = $validatedData['department'];
            $user->email = $validatedData['email'];
            $user->password = bcrypt($validatedData['password']);
            $user->role = $validatedData['role'];
    
            // Save the updated user
            $user->save();
    
            return response()->json(['message' => 'User updated successfully']);
        } catch (ValidationException $e) {
            // Handle the validation exception and return a JSON response with errors
            throw new HttpResponseException(response()->json(['errors' => $e->errors()], 422));
        } catch (\Exception $e) {
            // Handle other exceptions and return an error response
            throw new HttpResponseException(response()->json($e, 500));
        }
    }

    public function destroy(Request $request, User $user)
    {
        try {
            // Find the user by ID
            $user_data = User::findOrFail($request->id);
            $user_data->delete();
            // Return the user details as a JSON response
            return response()->json(['user' => 'User deleted successfully']);
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            return response()->json(['error' => 'An error occurred while deleting the user'], 500);
        }
    }

    public function exportUsers()
    {
        return Excel::download(new exportUser, 'users.csv');
    }

    public function sendEmail(Request $request)
    {
        $emailAddresses = $request->input('email_addresses');

        Mail::to($emailAddresses)->send(new SendEmail($emailAddresses));
        // $emailAddresses = $request->email_addresses;
        // $data = 'Welcome from FB';

        // Mail::send('mail', ['data' => $data], function($message) use ($data) {
        //     $message->to('khaingyee14@gmail.com', 'Welcome')->subject('FB');
        //   });
    }


}

