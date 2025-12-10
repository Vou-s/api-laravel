<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Payments",
 *      required={"order_id","amount","method","status"},
 *      @OA\Property(
 *          property="amount",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="number",
 *          format="number"
 *      ),
 *      @OA\Property(
 *          property="method",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="status",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
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
 */class Payments extends Model
{
    public $table = 'payments';

    public $fillable = [
        'order_id',
        'amount',
        'method',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'method' => 'string',
        'status' => 'string'
    ];

    public static array $rules = [
        'order_id' => 'required',
        'amount' => 'required|numeric',
        'method' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\Order::class, 'order_id');
    }
}
