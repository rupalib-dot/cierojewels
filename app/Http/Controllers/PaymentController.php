<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Cart;
use Session;
use Mail;
use App\Mail\invoiceMail;
use Softon\Indipay\Facades\Indipay;  
class PaymentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment(Request $request)
    {    
        
       
    }

     public function response(Request $request)
     {
                $response = Indipay::response($request);
                dd($response);
     }

    public function STripeCharge(Request $request)
    {
        $email=Auth::user()->email;     //-------Taking user email for Sending Email-----------
        $total=$request->total;
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_H0qtGLfjssXr1BiEL4UoEi9k00dXk3hA6f');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            //ekhane 'a non well formed numeric value entered' problem ta asteche,tai comment kore dechi
            // 'amount' => 999*100,
            'amount' => $total*100,     //--Multipling with 100 to convert Cent into Dollar.
            'currency' => 'usd',
            'description' => 'Learn Hunter details',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);
        //dd($charge);

        $data=array();
        $data['user_id']=Auth::id();
        $data['payment_id']=$charge->payment_method;
        $data['paying_amount']=$charge->amount/100;
        $data['blnc_transection']=$charge->balance_transaction;
        $data['stripe_order_id']=$charge->metadata->order_id;
        $data['shipping']=$request->shipping;
        $data['vat']=$request->vat;
        $data['total']=$request->total;
        $data['payment_type']=$request->payment_type;
        if (Session::has('coupon')) {
            $data['subtotal']=Session::get('coupon')['balance'];
        }else{
            $data['subtotal']=Cart::Subtotal() ;
        }
        $data['status']=0;
        $data['date']=date('d-m-y');
        $data['month']=date('F');
        $data['year']=date('Y');
        $data['status_code']= mt_rand(100000,999999);
        $order_id=DB::table('orders')->insertGetId($data);

        // Mail::to($email)->send(new invoiceMail($data));    //---------mail send to user-------------

        //insert shipping details table
        $shipping=array();
        $shipping['order_id']=$order_id;
        $shipping['ship_name']=$request->ship_name;
        $shipping['ship_email']=$request->ship_email;
        $shipping['ship_phone']=$request->ship_phone;
        $shipping['ship_address']=$request->ship_address;
        $shipping['ship_city']=$request->ship_city;
        DB::table('shipping')->insert($shipping);

        //insert data into orderdeatils
        $content=Cart::content();
        $details=array();
        foreach ($content as $row) {
            $details['order_id']= $order_id;
            $details['product_id']=$row->id;
            $details['product_name']=$row->name;
            $details['color']=$row->options->color;
            $details['size']=$row->options->size;
            $details['quantity']=$row->qty;
            $details['singleprice']=$row->price;
            $details['totalprice']=$row->qty * $row->price;

            DB::table('order_details')->insert($details);
        }


        Mail::to($email)->send(new invoiceMail($data));    //---------mail send to user-------------

        //destroy or removing Cart
        Cart::destroy();
            if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification=array(
                'message'=>'Successfully Done',
                'alert-type'=>'success'
            );
            return Redirect()->to('/')->with($notification);

    }

//-------not found yet--------
    // public function Checkout2callback(Request $request)
    // {
    //     Cart::destroy();
    //              if (Session::has('coupon')) {
    //              Session::forget('coupon');
    //          }
    //            $notification=array(
    //                           'messege'=>'Successfully Done',
    //                            'alert-type'=>'success'
    //                      );
    //              return Redirect()->to('/')->with($notification);
    // }


//----------------Return Order------------------
    public function SuccessList()
    {
        $order=DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->get();
        return view('pages.returnorder',compact('order'));
    }

    public function RequestReturn($id)
    {
        DB::table('orders')->where('id',$id)->update(['return_order'=>1]);
        $notification=array(
            'message'=>'Order return request done! please wait for our response',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }


    private function encrypt($plainText,$key)
    {
        $key = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
    }


    private function decrypt($encryptedText,$key)
    {
        $key = hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = hextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }

    private function hextobin($hexString) 
    { 
        $length = strlen($hexString); 
        $binString="";   
        $count=0; 
        while($count<$length) 
        {       
            $subString =substr($hexString,$count,2);           
            $packedString = pack("H*",$subString); 
            if ($count==0)
            {
                $binString=$packedString;
            } 
            
            else 
            {
                $binString.=$packedString;
            } 
            
            $count+=2; 
        } 
            return $binString; 
     } 


}


/*$parameter = [
            'transaction_no' => time(),                  
            'redirect_url' => url('user/order-list'),            
            'cancel_url' => url('user/order-list'),              
            'currency' => env('INDIPAY_CURRENCY'),                       
            'language' => env('INDIPAY_LANGUAGE'),                        
            'order_id' => 12345,                         
            'amount' => 1,                               
        ];
        $merchant_data = env('INDIPAY_MERCHANT_ID');
        foreach ($parameter as $key => $value) {
            $merchant_data.=$key.'='.$value.'&';
        }

        $encrypted_data=$this->encrypt($merchant_data,env('INDIPAY_WORKING_KEY'));
        $access_code = env('INDIPAY_ACCESS_CODE');

        $production_url='https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction&encRequest='.$encrypted_data.'&access_code='.$access_code;
       

        return view('ccavenue',compact('production_url'));*/