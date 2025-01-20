@extends('admin.layouts.app')

@section('content')




<div class="container mt-5">
    <h1 class="text-center mb-4">Customer List</h1>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('customers.index_filter') }}" class="row g-3 mb-4 align-items-end">
        <!-- Date Filter -->
        <div class="col-md-3">
            <label for="filter_date" class="form-label">Filter by Date:</label>
            <input type="date" name="filter_date" id="filter_date" class="form-control" value="{{ request('filter_date') }}">
        </div>
        <!-- Search Input -->
        <div class="col-md-4">
            <label for="search" class="form-label">Search by any field:</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
        </div>
        <!-- Search Button -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
        <!-- Clear Filters -->
        <div class="col-md-2">
            <a href="{{ route('customers.index_filter') }}" class="btn btn-secondary w-100">Clear Filters</a>
        </div>
    </form>

    <!-- Customer Table -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->address }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No customers found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $customers->links('pagination::bootstrap-5') }}
    </div>
</div>


@endsection
