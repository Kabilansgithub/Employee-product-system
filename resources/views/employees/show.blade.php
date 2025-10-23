@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $employee->name }} — Details</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Left Section -->
                <div class="col-md-6">
                    <h5 class="text-secondary mb-3">Basic Information</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th scope="row">Name:</th>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email:</th>
                            <td>{{ $employee->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Phone:</th>
                            <td>{{ $employee->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Department:</th>
                            <td>{{ $employee->department }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Position:</th>
                            <td>{{ $employee->position }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Role:</th>
                            <td>{{ ucfirst($employee->role) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- Right Section -->
                <div class="col-md-6">
                    <h5 class="text-secondary mb-3">Products Handled</h5>

                    @if($employee->products->count() > 0)
                        <ul class="list-group">
                            @foreach ($employee->products as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $product->name }}</strong><br>
                                        <small class="text-muted">{{ $product->description }}</small>
                                    </div>
                                    <span class="badge bg-success">{{ $product->code }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-warning mt-3">
                            This employee is not Added to any products yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                ← Back to Employee List
            </a>
        </div>
    </div>
</div>
@endsection
