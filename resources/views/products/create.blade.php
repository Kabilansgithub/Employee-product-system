@extends('layouts.app')
@section('title', 'Add Product')
@section('content')

<h2>Add Product</h2>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Code</label>
        <input type="text" name="code" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <button class="btn btn-success">Save</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
