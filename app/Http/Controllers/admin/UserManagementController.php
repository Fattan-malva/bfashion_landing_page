<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Hash;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('admin.user-management');
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:customer,username',
            'password' => 'required|min:6',
            'role' => 'required',
            'name' => 'required',
        ]);

        $customer = new Customer([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'name' => $request->input('name'),
        ]);

        $customer->save();

        return redirect()->route('admin.user-management')->with('success', 'Customer added successfully!');
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:customer,username,' . $id,
            'role' => 'required',
            'name' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->username = $request->input('username');
        $customer->role = $request->input('role');
        $customer->name = $request->input('name');

        if ($request->input('password')) {
            $customer->password = Hash::make($request->input('password'));
        }

        $customer->save();

        return redirect()->route('admin.user-management')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.user-management')->with('success', 'Customer deleted successfully!');
    }
}
