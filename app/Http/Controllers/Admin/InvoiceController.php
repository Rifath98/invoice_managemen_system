<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Requests\SaveInvoiceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Traits\InvoiceTrait;

class InvoiceController extends Controller
{
    use InvoiceTrait;
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }
    public function index()
    {
        $invoices = Invoice::paginate(10);
        return view('admin.invoice.index', compact('invoices'));
    }
    public function create(){
        $lastInvoice = Invoice::latest('id')->first();
        $nextNumber = $lastInvoice ? intval(substr($lastInvoice->invoice_number, 4)) + 1 : 1001;
        $invoiceNumber = 'INV-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $customers = Customer::all();

        return view('admin.invoice.create', compact('invoiceNumber','customers'));
    }

    public function saveOrUpdate(SaveInvoiceRequest $request, $id=null)
    {
        $validatedData = $request->validated();

        $response = $this-> createOrUpdateInvoice($validatedData, $id);

        $result = $response->getData();

        if ($result->success) {
            return response()->json(['message' => $result->message], $id ? 200 : 201);
        }

        return response()->json(['error' => $result->message, 'details' => $result->error], 500);

    }

    public function destroy($id){
        $invoice =  Invoice::findOrfail($id);
        $invoice->delete();

            return redirect()->route('invoice.list')->with('message', 'Invoice has been deleted !!');
    }

    public function edit($id)
    {
        $customers = Customer::all();
        $invoice =  Invoice::with('items', 'customer')->findOrFail($id);
        return view('admin.invoice.edit', compact('invoice','customers'));
    }

    // To generate PDF
    public function generatePdf($id)
    {
        $invoice =  Invoice::with('items')->findOrFail($id);
        $pdf =Pdf::loadView('admin.invoice.pdf', compact('invoice'));

        return $pdf->stream('invoice-'.$invoice->invoice_number.'.pdf');
    }

    public function generateInvoiceNumber()
    {
        $invoiceNumber = Invoice::generateInvoiceNumber();
        return response()->json(['invoice_number' => $invoiceNumber]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $sortField = $request->input('sort_field', 'invoice_number'); // Default sort field
        $sortOrder = $request->input('sort_order', 'asc'); // Default sort order
        $startDate = $request->input('start_date', null);
        $endDate = $request->input('end_date', null);

        $invoices = Invoice::where(function ($q) use ($query) {
            $q->where('invoice_number', 'like', "%{$query}%")
                ->orWhereHas('customer', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->orWhere('total', 'like', "%{$query}%");
        });

        if ($startDate && $endDate) {
            $invoices->whereBetween('date', [$startDate, $endDate]);
        }

        // Validate and sort by the requested field and order
        $validSortFields = ['invoice_number', 'date', 'total', 'customer_name'];
        if (in_array($sortField, $validSortFields)) {
            if ($sortField === 'customer_name') {
                $invoices = $invoices->join('customers', 'invoices.customer_id', '=', 'customers.id')
                    ->select('invoices.*', 'customers.name as customer_name')
                    ->orderBy('customers.name', $sortOrder);
            } else {
                $invoices = $invoices->orderBy($sortField, $sortOrder);
            }
        }

        $invoices = $invoices->get();

        return response()->json(
            $invoices->map(function ($invoice) {
                return [
                    'invoice_number' => $invoice->invoice_number,
                    'customer_name' => $invoice->customer->name ?? 'N/A',
                    'date' => $invoice->date,
                    'total' => $invoice->total,
                    'actions' => view('admin.invoice.components.action-buttons', ['invoice' => $invoice])->render(),
                ];
            })
        );
    }

    public function getCustomerDetails(Request $request)
    {
        $customer = Customer::find($request->customer_id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'address' => $customer->address,
        ]);
    }

}

