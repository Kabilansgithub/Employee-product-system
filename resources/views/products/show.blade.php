@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h3 class="fw-bold">{{ $product->name }}</h3>
        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">← Back to Products</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Product Details</h5>
            <p><strong>Code:</strong> {{ $product->code }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
        </div>
    </div>

    <!-- Added Employees Section -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Employees List</h5>
        </div>
        <div class="card-body">
            @if($product->employees->count())
                <div class="d-flex flex-wrap gap-2">
                    @foreach($product->employees as $employee)
                        <div class="d-inline-flex align-items-center border rounded-pill px-3 py-1 bg-light">
                            <span>{{ $employee->name }}</span>
                            <form action="{{ route('products.detachEmployee', [$product->id, $employee->id]) }}" method="POST" class="ms-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Remove this employee?')">
                                    <strong>×</strong>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No employees Added yet.</p>
            @endif
        </div>
    </div>

    <!-- Search and Add Section -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-2">Add Employee</h5>
            <form action="{{ route('products.show', $product->id) }}" method="GET" class="d-flex flex-column flex-md-row gap-2">
                <input type="text" name="search" value="{{ $search }}" class="form-control form-control-sm" placeholder="Search employees...">
                <button class="btn btn-sm btn-primary">Search</button>
            </form>
        </div>
        <div class="card-body">
            @if($employees->count())
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->department }}</td>
                                    <td>
                                        <form action="{{ route('products.attachEmployee', [$product->id, $employee->id]) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-success">Add</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $employees->links('pagination::bootstrap-5') }}
                </div>
            @else
                <p class="text-muted mb-0">No employees found.</p>
            @endif
        </div>
    </div>

</div>
@endsection
