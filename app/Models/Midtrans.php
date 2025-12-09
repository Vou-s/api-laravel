<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Midtrans",
 *      required={},
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
 */class Midtrans extends Model
{
    public $table = 'midtrans';

    public $fillable = [
        
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
