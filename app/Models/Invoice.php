<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Invoice extends Model
{
    use HasFactory;

    protected  $table = 'invoices';

    protected $fillable = [
        //'customer_name',
        'invoice_number',
        'date',
        'total_discount',
        'total_subtotal',
        'total',
        'customer_id'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public static function generateInvoiceNumber(){
        $lastInvoice = self::orderBy('id', 'desc')->first();

        if ($lastInvoice && $lastInvoice->invoice_number){
            $lastNumber = intval(substr($lastInvoice->invoice_number, -4));
            $newNumber = $lastNumber + 1;
        }else{
            $newNumber = 1;
        }
        return 'INV-' . str_pad($newNumber, 4 , '0', STR_PAD_LEFT);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
