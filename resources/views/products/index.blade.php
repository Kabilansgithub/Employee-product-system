@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
            <span onclick="window.location='{{ route('products.index') }}'"
                style="cursor:pointer; font-weight:bold; color:inherit;">
                <h3 class="fw-bold">Products Table</h3>
            </span>
            <div class="d-flex gap-2 flex-column flex-md-row">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm"
                        placeholder="Search products...">
                    <button class="btn btn-sm btn-primary">Search</button>
                </form>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">+ Add Product</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr onclick="window.location='{{ route('products.show', $product->id) }}'" style="cursor:pointer;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning mb-1 ">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger mb-1"
                                        onclick="return confirm('Delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No products found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection