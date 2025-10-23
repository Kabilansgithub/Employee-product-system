@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
    <div class="container mt-4">
        <div class="">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                <h4 class="fw-bold">{{ $employee->name }} — Production Capability</h4>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                    ← Back to Employee List
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                        @if($employee->products->count() > 0)
                            <ul class="list-group">
                                @foreach ($employee->products as $product)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{-- <span class="badge bg-success">{{ $product->code }}</span> --}}

                                        <div>
                                            <strong> {{ $product->code }} : {{ $product->name }}</strong><br>
                                            {{-- <small class="text-muted">{{ $product->description }}</small> --}}
                                        </div>
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

        </div>
    </div>
@endsection