@extends('admin.layouts.app')

@section('content')

    <div class="container mt-5">
<h1 class="mb-4">Add New Customer</h1>
<form method="POST" action="/customers/store" class="border p-4 rounded">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="tel" minlength="10" maxlength="10" id="phone" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" name="address" id="address" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Add Customer</button>
    <a href="/customers" class="btn btn-secondary">Back</a>
</form>
    </div>

@endsection
