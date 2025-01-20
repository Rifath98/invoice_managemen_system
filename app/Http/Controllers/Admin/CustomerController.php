<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    // Show all customers
    public function showCustomers()
    {
        $customers = Customer::all();
        return view('admin.customers.index_customers', ['customers' => $customers]);
    }

    // Show a specific customer for editing
    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit_customer', ['customer' => $customer]);
    }

    // Update customer details
    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|max:15|unique:customers,phone,' . $id,
            'address' => 'required|string|max:500|unique:customers,address,' . $id,
        ], [
            // Custom error messages
            'email.unique' => 'The email has already been entered.',
            'phone.unique' => 'The phone number has already been entered.',
            'address.unique' => 'The address has already been entered.',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect('/customers')->with('success', 'Customer updated successfully!');
    }

    // Delete a customer
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('/customers')->with('success', 'Customer deleted successfully!');
    }

    public function createCustomer()
    {
        return view('admin.customers.add_customer');
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:customers,name',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|digits:10|unique:customers,phone',
            'address' => 'required|string|max:500|unique:customers,address',
        ], [
            // Custom error messages
            'name.unique' => 'The name has already been entered.',
            'email.unique' => 'The email has already been entered.',
            'phone.unique' => 'The phone number has already been entered.',
            'address.unique' => 'The address has already been entered.',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect('/customers')->with('success', 'Customer added successfully!');
    }

    public function index(Request $request)
    {
        // Initialize query
        $query = Customer::query();

        // Check if 'search' is filled
        if ($request->filled('search')) {
            $search = $request->search;

            // Apply search across multiple fields
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('filter_date')) {
            $query->whereDate('created_at', $request->filter_date);
        }

        // Fetch the filtered results with pagination
        $customers = $query->paginate(10);

        // Return to view
        return view('admin.customers.index_filter', compact('customers'));
    }



}
