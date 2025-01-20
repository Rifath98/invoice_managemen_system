<?php

 namespace App\Traits;

 use App\Models\InvoiceItem;
 use Illuminate\Support\Facades\DB;
 use App\Models\Invoice;

 trait InvoiceTrait
 {
     public function createOrUpdateInvoice(array $data, $id = null)
     {
         DB::beginTransaction();

         try {
             $subtotal = 0;

             foreach ($data['items'] as $item) {
                 $subtotalBeforeDiscount = $item['quantity'] * $item['unit_price'];
                 $subtotal += $subtotalBeforeDiscount;
             }

             $invoice = Invoice::updateOrCreate(
                 ['id' => $id],
                 [
                     //'customer_name' => $data['customer_name'],
                     'customer_id' => $data['customer_id'],
                     'invoice_number' => $id ? $data['invoice_number'] : Invoice::generateInvoiceNumber(),
                     'date' => $data['date'],
                     'total_subtotal' => $subtotal,
                     'total_discount' => $data['total_discount'],
                     'total' => $data['total'],
                 ]
             );

             if ($id){
                 $invoice->items()->delete();
             }


             foreach ($data['items'] as $item) {
                 InvoiceItem::create([
                     'invoice_id' => $invoice->id,
                     'description' => $item['description'],
                     'unit_price' => $item['unit_price'],
                     'quantity' => $item['quantity'],
                     'discount_amount'=> $item['discount_amount'],
                     'discount_percentage' => $item['discount_percentage'],
                     'total_subtotal_items' => $item['total_subtotal_items'],
                     'subtotal' => $item['subtotal'],
                 ]);
             }

             DB::commit();

             return response()->json([
                 'success' => true,
                 'message' => $id? 'Invoice has been Updated' : 'Invoice has been created',
             ]);

         }catch (\Exception $exception){
             DB::rollBack();
             return response()->json([
                 'success' => false,
                 'message' => 'Failed to create invoice',
                 'error'=> $exception->getMessage()]);
         }

     }
 }
