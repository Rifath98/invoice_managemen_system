
@extends('admin.layouts.app')

@section('content')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer Invoices</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 row">
                            <div class="col-9">
                                <a href="{{url('/invoice')}}" class="btn btn-app"><i class="fas fa-file-invoice"></i>New Invoice</a>
                            </div>
                            <div class="col-3">
                                <div class="col-4" style="float: right; display: inline-block;">
                                    <input type="date" id="start-date" placeholder="Start Date">
                                    <input type="date" id="end-date"  placeholder="End Date" style="margin-top: 5px;">
                                </div>
                                <div class="col-8" style="float: right; display: inline-block;">
                                    <button class="btn btn-app" id="filter-date" style="float: right; display: inline-block;"><i class="fas fa-filter" ></i>Filter by date</button>
                                    <button class="btn btn-app" id="reset-filter" style="float: right; display: inline-block;"><i class="fas fa-broom"></i>Clear Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invoices</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" id="search-input" placeholder="Search invoices....">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-tools" style="margin-right: 20px">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                    <select id="categoryFilter" class="form-control">
                                        <option value="">Sort Invoices</option>
                                        <option value="customer_name-asc">Customer Name (A-Z)</option>
                                        <option value="customer_name-desc">Customer Name (Z-A)</option>
                                        <option value="invoice_number-asc">Invoice Number (Ascending)</option>
                                        <option value="invoice_number-desc">Invoice Number (Descending)</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0" >
                                <table class="table table-head-fixed text-nowrap table-hover table-striped" id="invoiceTable">
                                    <thead>
                                    <tr>

                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr>

                                        <td>{{$invoice->invoice_number}}</td>
                                        <td>{{$invoice->date}}</td>
                                        <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
                                        <td><span class="tag tag-success">{{$invoice->total}}</span></td>
                                        <td>
                                            <a href="{{route('invoice.edit', $invoice->id)}}" class="btn btn-sm btn-outline-success btn-circle me-2 edit-product"><i class="fas fa-edit"></i>Edit</a>
                                            <form action="{{route('invoice.delete',$invoice->id)}}" id="deleteInvoice" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-circle me-2 delete-product" ><i class="fas fa-trash"></i>Delete</button>
                                            </form>
                                            <a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-sm btn-outline-info btn-circle"><i class="fas fa-print"></i>Print</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
