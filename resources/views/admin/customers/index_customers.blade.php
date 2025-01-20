@extends('admin.layouts.app')

@section('content')

    <div class="container mt-5">

<a href="/customers/add" class="btn btn-primary mb-3" >Add New Customer</a>
<a href="/customers/filter" class="btn btn-primary mb-3">Customer Filter</a>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <thead class="table-dark">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->address }}</td>
            <td>
                <a href="/customers/{{ $customer->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                <a href="/customers/{{ $customer->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>

@endsection
