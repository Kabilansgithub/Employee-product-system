<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display employees with search and pagination
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
        }

        $employees = $query->orderBy('id', 'asc')->paginate(10);

        return view('employees.index', compact('employees'));
    }

    // Show create form
    public function create()
    {
        $products = Product::all();
        return view('employees.create', compact('products'));
    }

    // Store new employee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|min:6',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'employee',
            'position' => $request->position,
            'department' => $request->department,
            'phone' => $request->phone,
            'is_admin' => $request->is_admin ?? false,
        ]);

        if ($request->has('products')) {
            $employee->products()->sync($request->products);
        }

        return redirect()->route('employees.index')->with('success','Employee created successfully!');
    }

    // Show single employee
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    // Show edit form
    public function edit(Employee $employee)
    {
        $products = Product::all();
        return view('employees.edit', compact('employee','products'));
    }

    // Update employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
        ]);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'department' => $request->department,
            'phone' => $request->phone,
            'role' => $request->role ?? $employee->role,
            'is_admin' => $request->is_admin ?? $employee->is_admin,
        ]);

        if ($request->has('products')) {
            $employee->products()->sync($request->products);
        } else {
            $employee->products()->sync([]);
        }

        return redirect()->route('employees.index')->with('success','Employee updated successfully!');
    }

    // Delete employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee deleted successfully!');
    }
}
