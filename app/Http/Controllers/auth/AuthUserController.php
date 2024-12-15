<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;

class AuthUserController extends Controller
{
    public function showLoginForm(): Response
    {
        return response(view('auth.login'));

    }
    public function login(Request $request): RedirectResponse
    {
        $username = $request->input('username');
        $password = $request->input('password');

        try {

            $customer = Customer::where('username', $username)->first();

            if (!$customer || !Hash::check($password, $customer->password)) {
                throw new \Exception('Username and Password do not match.');
            }

            // Store user ID, role, and name in the session
            $request->session()->put('user_id', $customer->id);
            $request->session()->put('user_username', $customer->username);
            $request->session()->put('user_role', $customer->role);
            $request->session()->put('user_name', $customer->name);

            if ($customer->role === 'admin') {
                return redirect()->route('admin.index')->with('success', 'Success login.');
            } else {
                return redirect()->route('landing.index')->with('success', 'Success login.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', '' . $e->getMessage());
        }
    }
    /**
     * Handle user registration.
     */
    public function storeregister(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:customer',
            'password' => 'required|string|max:50',
            'role' => 'required|string|max:50',
            'name' => 'required|string|max:50|regex:/^[\p{L}\s]+$/u',
        ]);
        $customer = Customer::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')), // Hashing the password
            'role' => $request->input('role'),
            'name' => $request->input('name'),
        ]);
        return redirect()->route('login')->with('success', 'Register successfully.');
    }
    /**
     * Handle user logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('user_id');
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }

}
