<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    protected  $table = 'invoice_items';

    protected $fillable = [
        'invoice_id',
        'description',
        'unit_price',
        'quantity',
        'discount_percentage',
        'discount_amount',
        'total_subtotal_items',
        'subtotal',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
