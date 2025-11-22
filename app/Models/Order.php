<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'user_id',
        'restaurant_id',
        'subtotal',
        'delivery_cost',
        'total',
        'status',
        'payment_mode',
        'payment_status',
        'items',
        'delivery_address',
        'order_type',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'items' => 'array',
        'status' => 'string',
        'payment_mode' => 'string',
        'payment_status' => 'string',
        'order_type' => 'string',
        'subtotal' => 'float',
        'delivery_cost' => 'float',
        'total' => 'float',
    ];

    /**
     * Get the user that placed the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the restaurant associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Get the payments associated with the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Generate a unique order number based on the current year.
     *
     * @return string
     */
    public static function generateOrderNumber()
    {
        $year = date('Y');
        $prefix = "ORD-$year-";
        $lastOrder = self::where('order_number', 'like', "$prefix%")
            ->orderBy('order_number', 'desc')
            ->first();
        $number = $lastOrder ? (int) substr($lastOrder->order_number, strlen($prefix)) + 1 : 1;
        return $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
?>
