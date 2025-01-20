@extends('admin.layouts.app')

@section('content')



    <div class="container mt-5">
<h1 class="mb-4">Edit Customer</h1>
<form method="POST" action="/customers/{{ $customer->id }}/update" class="border p-4 rounded">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $customer->name }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ $customer->email }}" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" id="phone" name="phone" class="form-control" value="{{ $customer->phone }}" required>
    </div>

    <div>
        <label for="address" class="form-label">Address</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $customer->address }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/customers" class="btn btn-secondary">Back</a>
</form>
    </div>
@endsection
