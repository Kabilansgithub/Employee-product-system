@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
            <span onclick="window.location='{{ route('employees.index') }}'"
                style="cursor:pointer; font-weight:bold; color:inherit;">
                <h3 class="fw-bold">Employees Table</h3>
            </span>
            <div class="d-flex gap-2 flex-column flex-md-row">
                <form action="{{ route('employees.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm"
                        placeholder="Search employees...">
                    <button class="btn btn-sm btn-primary">Search</button>
                </form>
                <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">+ Add Employee</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        {{-- <th>Email</th> --}}
                        <th>Position</th>
                        <th>Department</th>
                        {{-- <th>Phone</th> --}}
                        {{-- <th>Products</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr onclick="window.location='{{ route('employees.show', $employee->id) }}'" style="cursor:pointer;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employee->name }}</td>
                            {{-- <td>{{ $employee->email }}</td> --}}
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->department }}</td>
                            {{-- <td>{{ $employee->phone }}</td> --}}
                            {{-- <td>
                                @foreach($employee->products as $product)
                                    <span class="badge bg-primary">{{ $product->name }}</span>
                                @endforeach
                            </td> --}}
                            <td class="text-center">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger mb-1"
                                        onclick="return confirm('Delete this employee?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No employees found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $employees->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection