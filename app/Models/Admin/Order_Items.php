<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Order_Items",
 *      required={"order_id","product_id","quantity","price"},
 *      @OA\Property(
 *          property="price",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */class Order_Items extends Model
{
    public $table = 'order_items';

    public $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public static array $rules = [
        'order_id' => 'required',
        'product_id' => 'required',
        'quantity' => 'required',
        'price' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Order::class, 'order_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Product::class, 'product_id');
    }
}
