@extends('layouts.app')
@section('title', 'Edit Employee')
@section('content')

<h2>Edit Employee</h2>

<form action="{{ route('employees.update', $employee) }}" method="POST">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Department</label>
            <input type="text" name="department" class="form-control" value="{{ $employee->department }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control" value="{{ $employee->position }}">
        </div>
    </div>

    <h5 class="mt-4">Add Products</h5>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[]" value="{{ $product->id }}"
                        {{ $employee->products->contains($product->id) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $product->name }}</label>
                </div>
            </div>
        @endforeach
    </div>

    <button class="btn btn-primary mt-3">Update</button>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Cancel</a>
</form>
@endsection
