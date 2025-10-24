@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div
    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <h4 class="fw-bold">{{ $product->code }} :  {{ $product->name }}</h4>

    <div class="d-flex gap-2">
        <!-- Add Employee Button -->
       <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#addEmployeeCollapse" aria-expanded="false" aria-controls="addEmployeeCollapse">
            + Add Employee
        </button>


        <!-- Back Button -->
        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
            ← Back to Products
        </a>
    </div>
</div>

<!-- List of Employees capable of handling this Product -->
@if ($product->employees->count() > 0)
    <ul class="list-group">
        @foreach ($product->employees as $employee)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $employee->name }}</strong><br>
                    <small>Capable since: {{ $employee->pivot->capable_from }}</small>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted">No employees capable of this product yet.</p>
@endif


<div class="collapse" id="addEmployeeCollapse">
    <div class="card card-body mb-3">
        <!-- Search Employees -->
        <form action="{{ route('products.show', $product->id) }}" method="GET" class="d-flex flex-column flex-md-row gap-2 mb-3">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control form-control-sm" placeholder="Search employees...">
            <button class="btn btn-sm btn-primary">Search</button>
        </form>

        @if($employees->count())
            <div class="list-group">
                @foreach($employees as $employee)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $employee->name }}</strong><br>
                        </div>
                        <form action="{{ route('products.attachEmployee', [$product->id, $employee->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success">Add</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $employees->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-muted mb-0">No employees found.</p>
        @endif
    </div>
</div>




</div>

<script>
function searchEmployee(query) {
    const select = document.getElementById("employee_select");
    const options = select.options;
    for (let i = 0; i < options.length; i++) {
        const text = options[i].text.toLowerCase();
        options[i].style.display = text.includes(query.toLowerCase()) ? "" : "none";
    }
}
</script>
@endsection
