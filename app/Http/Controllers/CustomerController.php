<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        $customers->pages = new \stdClass();
        $customers->pages->start = $customers->perPage() * $customers->currentPage() - $customers->perPage();

        return view('home.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('home.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|numeric',
            'provine' => 'required|string',
        ]);

        Customer::create($request->all());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('home.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|numeric',
            'provine' => 'required|string',
        ]);

        $customer->update($request->all());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Request $request, Customer $customer)
    {
        // dd($request->all(), $customer);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
