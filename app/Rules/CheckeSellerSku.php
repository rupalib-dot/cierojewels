<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Admin\Product;
use Auth;
class CheckeSellerSku implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
       
        $sku = Product::where('product_sku',$value)->where('seller_id',Auth::user()->id)->first();
        if(!empty($sku)){
            return false;
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
        return "Product SKU can't be same";
    }
}
