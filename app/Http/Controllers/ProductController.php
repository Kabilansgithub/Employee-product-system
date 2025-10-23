<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display products with search and pagination
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $products = $query->orderBy('id', 'asc')->paginate(10);

        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $employees = Employee::all();
        return view('products.create', compact('employees'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required',
        ]);

        $product = Product::create($request->only(['code', 'name', 'description']));

        if ($request->has('employees')) {
            $product->employees()->sync($request->employees);
        }

        return redirect()->route('products.index')->with('success','Product created successfully!');
    }

    // Show single product
    public function show($id)
{
    $product = Product::with('employees')->findOrFail($id);

    // Search functionality
    $search = request('search');
    $employees = Employee::when($search, function ($query, $search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('department', 'like', "%{$search}%");
    })->paginate(10);

    return view('products.show', compact('product', 'employees', 'search'));
}


    // Show edit form
    public function edit(Product $product)
    {
        $employees = Employee::all();
        return view('products.edit', compact('product','employees'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required',
        ]);

        $product->update($request->only(['code','name','description']));

        if ($request->has('employees')) {
            $product->employees()->sync($request->employees);
        } else {
            $product->employees()->sync([]);
        }

        return redirect()->route('products.index')->with('success','Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully!');
    }

    public function attachEmployee($productId, $employeeId)
{
    $product = Product::findOrFail($productId);
    $product->employees()->syncWithoutDetaching([$employeeId]);

    return redirect()->back()->with('success', 'Employee Added successfully.');
}

public function detachEmployee($productId, $employeeId)
{
    $product = Product::findOrFail($productId);
    $product->employees()->detach($employeeId);

    return redirect()->back()->with('success', 'Employee removed successfully.');
}

}
