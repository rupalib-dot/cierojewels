<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Admin\Product;
use Auth;

class IgnoreSkuCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        
        if(Auth::user()->user_type != 'admin'){
            $sku = Product::where('product_sku',$value)->where('seller_id',Auth::user()->id)->first();
            if(!empty($sku)){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'SKU Can Not Be Same';
    }
}
