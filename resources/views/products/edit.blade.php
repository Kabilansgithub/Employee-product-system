@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')

<h2>Edit Product</h2>

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Code</label>
        <input type="text" name="code" class="form-control" value="{{ $product->code }}" required>
    </div>
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
