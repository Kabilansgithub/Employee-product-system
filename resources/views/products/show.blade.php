@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <h4 class="fw-bold">{{ $product->code }} :  {{ $product->name }}</h4>
        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">← Back to Products</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
        @if($product->employees->count())
            <div class="table-responsive">
                <table class="table table-bordered align-middle mt-2">
                    <tbody>
                        @foreach($product->employees as $index => $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted mb-0">No employees added yet.</p>
        @endif
            </div>
        </div>
    </div>

    {{-- <div class="card mb-2">
        <div class="card-body">

    </div> --}}
</div>


    {{-- <!-- Search and Add Section -->
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
    </div> --}}

</div>
@endsection
