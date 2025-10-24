<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Product System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a href="{{ route('products.index') }}" class="navbar-brand">Employee Product System</a>
    <div>
      <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm me-2">Products</a>
      <a href="{{ route('employees.index') }}" class="btn btn-outline-light btn-sm">Employees</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
