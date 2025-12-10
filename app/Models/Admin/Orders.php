<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Orders",
 *      required={"user_id","total_amount","status"},
 *      @OA\Property(
 *          property="total_amount",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="status",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="payment_method",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
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
 */class Orders extends Model
{
    public $table = 'orders';

    public $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_method'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'status' => 'string',
        'payment_method' => 'string'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'total_amount' => 'required|numeric',
        'status' => 'required|string|max:255',
        'payment_method' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\User::class, 'user_id');
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Admin\Payment::class, 'order_id');
    }

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Admin\OrderItem::class, 'order_id');
    }
}
