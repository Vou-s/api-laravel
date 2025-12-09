<?php

namespace App\Http\Requests;

use App\Models\Order_Items;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrder_ItemsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Order_Items::$rules;
        
        return $rules;
    }
}
