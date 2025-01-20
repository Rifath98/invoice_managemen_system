<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'invoice_number' => 'required|string|unique:invoices,invoice_number,'. $this->id,
            'items.*.subtotal' => 'required|numeric|min:0',

            'items.*.total_subtotal_items' => 'required|numeric|min:0',
            'items.*.discount_percentage' => 'required|numeric|min:0',
            'items.*.discount_amount' => 'required|numeric|min:0',
            'total_discount' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'date' => 'required|date',
            //'customer_name' => 'required|string|max:255',
            'customer_id' => 'required|numeric|min:0',
        ];
    }
}
