@extends('layouts.app')
@section('title', 'Add Employee')
@section('content')

<h2>Add Employee</h2>

<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Department</label>
            <input type="text" name="department" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Position</label>
            <input type="text" name="position" class="form-control">
        </div>
    </div>
    <button class="btn btn-success">Save</button>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
