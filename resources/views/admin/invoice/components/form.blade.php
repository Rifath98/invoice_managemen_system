<input type="hidden" name="id" id="invoiceId" value="{{ $invoice->id ?? '' }}">
<div class="row">
    <div class="col-12">
        <h4>
            <i class="fas fa-globe"></i> Parizlab
            <small class="float-right">Date: <input type="date" name="date" value="{{ $invoice->date ?? now()->toDateString() }}" required></small>
        </h4>
    </div>
    <!-- /.col -->
</div>
<!-- info row -->
<div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
        From
        <address>
            <strong>Parizlab</strong><br>
            Lore ipsum<br>
            San Francisco, CA 94107<br>
            Phone: (011) 123-456<br>
            Email: info@parizlab.com
        </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
        To
        <select name="customer_id" id="customer_id" class="form-control" data-fetch-url="{{ route('customers.details') }}" data-csrf="{{ csrf_token() }}">
            <option value="">Select a Customer</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}</option>
            @endforeach
        </select>
        <address>
            <div id="customerDetails" style="margin-top: 10px; display: none;">
                <p style="line-height: 5px"><strong>Name:</strong> <span id="customerName"></span></p>
                <p style="line-height: 5px"><strong>Email:</strong> <span id="customerEmail"></span></p>
                <p style="line-height: 5px"><strong>Phone:</strong> <span id="customerPhone"></span></p>
                <p style="line-height: 5px"><strong>Address:</strong> <span id="customerAddress"></span></p>
            </div>
        </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
        <b>Invoice No#<input type="text" name="invoice_number" id="invoice_number" style="border:none;" value="{{ $invoice->invoice_number ?? $invoiceNumber }}" required readonly></b>
        <!--<b><p>Invoice No# <span id="invoice_display"></span></p></b> -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped" id="invoiceTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Unit Price (Rs.)</th>
                <th>Quantity</th>
                <th>Disc(%)</th>
                <th>Disc(Rs.)</th>
                <th>Subtotal (Rs.)</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($invoice) && $invoice->items->count() > 0)
            @foreach($invoice->items as $index => $item)

            <tr data-index="{{ $index }}">
                <td>{{ $loop->iteration }}</td>
                <td><input type="text" name="items[{{ $index }}][description]" class="description" value="{{ $item->description }}"></td>
                <td><input type="text" name="items[{{ $index }}][unit_price]" class="unit_price" style="width: 70%" value="{{ $item->unit_price }}"></td>
                <td><input type="number" name="items[{{ $index }}][quantity]" class="quantity"  style="width: 30%" value="{{ $item->quantity }}"></td>
                <td><input type="number" name="items[{{ $index }}][discount_percentage]" class="discount_percentage" min="0" max="100" step="0.01" value="{{ $item->discount_percentage ?? '0'}}" style="width: 70%"></td>
                <td><input type="number" name="items[{{ $index }}][discount_amount]" class="discount_amount" value="{{ $item->discount_amount ?? '0'}}" style="width: 70%"></td>
                <td>Rs.
                    <output class="subtotal">{{ $item->subtotal ?? '0.00'}}</output>
                    <input type="hidden" name="items[{{ $index }}][subtotal]" class="subtotal-hidden" value="{{ $item->subtotal}}">

                    <input type="hidden" name="items[{{ $index }}][total_subtotal_items]" class="totalSubtotal-hidden" value="{{ $item->total_subtotal_items}}">
                </td>
                <td>
                    <button type="button" class="btn btn-block btn-danger btn-sm deleteRow"><i class="fas fa-trash deleteRow"></i></button>
                    <button type="button" class="btn btn-block btn-success btn-sm cloneRow" id="cloneRow" ><i class="fas fa-plus cloneRow"></i></button>
                </td>
            </tr>
            </tbody>
            @endforeach
            @else
                <tr data-index="0">
                    <td>1</td>
                    <td><input type="text" name="items[0][description]" class="description"></td>
                    <td><input type="text" name="items[0][unit_price]" class="unit_price" value="0" style="width: 70%"></td>
                    <td><input type="number" name="items[0][quantity]" class="quantity" value="1" style="width: 30%" ></td>
                    <td><input type="number" name="items[0][discount_percentage]" class="discount_percentage" value="0.00" min="0" max="100" step="0.01" style="width: 70%"></td>
                    <td><input type="number" name="items[0][discount_amount]" class="discount_amount"  value="0.00" step="0.01" style="width: 70%"></td>
                    <td>Rs.
                        <output class="subtotal">0.00</output>
                        <input type="hidden" name="items[0][subtotal]" class="subtotal-hidden">
                        <input type="hidden" name="items[0][total_subtotal_items]" class="totalSubtotal-hidden">
                    </td>
                    <td>
                        <button type="button" class="btn btn-block btn-danger btn-sm deleteRow"><i class="fas fa-trash deleteRow"></i></button>
                        <button type="button" class="btn btn-block btn-success btn-sm cloneRow" id="cloneRow" ><i class="fas fa-plus cloneRow"></i></button>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <!-- accepted payments column -->
    <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="{{ asset('admin//dist/img/credit/visa.png')}}" alt="Visa">
        <img src="{{ asset('admin//dist/img/credit/mastercard.png')}}" alt="Mastercard">
        <img src="{{ asset('admin//dist/img/credit/american-express.png')}}" alt="American Express">
        <img src="{{ asset('admin//dist/img/credit/paypal2.png')}}" alt="Paypal">

    </div>
    <!-- /.col -->
    <div class="col-6">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Subtotal:</th>
                    <td>Rs.
                        <output id="totalSubtotal" >{{ $invoice->total_subtotal ?? '0.00'}}</output>
                        <input type="hidden" name="total_Subtotal"  id="totalSubtotal-hidden" value="{{ $invoice->total_subtotal ?? '' }}">
                    </td>
                </tr>
                <tr>
                    <th>Total Discount:</th>
                    <td>(Rs.
                        <output id="totalDiscount" >{{ $invoice->total_discount ?? '0.00' }}</output>)
                        <input type="hidden" name="total_discount"  id="discount-hidden" value="{{ $invoice->total_discount ?? '' }}">
                    </td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td >Rs.
                        <output id="totalAmount" >{{ $invoice->total ?? '0.00' }}</output>
                        <input type="hidden" name="total"  id="total-hidden" value="{{ $invoice->total ?? '' }}">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /.col -->
</div>

