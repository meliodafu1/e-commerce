<?php
namespace App\Http\Controllers;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\user_login;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe;
class TestController extends Controller

{
    public function home() {
        return view("user.user");
    }

    public function getId($id){
//    $testt = user_info::find($id)->delete();
//    $read = user_info::all();
//    return view('user.read',['data'=>$read]);
    }
    //-----------------------------------------------------//

    public function store() {
        $get_all = DB::table('product_info')
        ->join ('product_images','product_info.id','=','product_images.product_id')
        ->select('product_info.*','product_images.*')
        ->get();
        return view('user.store',['data'=>$get_all]);
    }
    //-----------------------------------------------------//

    public function product($id) {
     $get_product = DB::table('product_info')
     ->join ('product_images','product_info.id','=','product_images.product_id')
     ->select('product_info.*','product_images.*')
     ->where('product_info.id','=',$id)
     ->get();
     $get_featured = DB::table('product_info')
     ->join ('product_images','product_info.id','=','product_images.product_id')
     ->select('product_info.*','product_images.*')
     ->limit(4)
     ->get();
    return view('user.product',['product_info'=>$get_product,'featured_product'=>$get_featured]);
    }
    //-----------------------------------------------------//

    public function cCart(Request $request) {
        $arr_val = [];
        $test = "";
        $val = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = DB::table('product_info')
        ->join ('product_images','product_info.id','=','product_images.product_id')
        ->select('product_info.*','product_images.*')
        ->where('product_info.id','=',$val)
        ->get();
        foreach ($product as $prod) {
        $cart_value = array(
            'id' => $val,
            'price'=>$prod->product_price,
            'quantity'=>$quantity,
            'name'=>$prod->product_name,
            'attributes'=>array('image'=>$prod->product_image)
        );
    }
    if (Auth::user()) {
        \Cart::session(Auth::user()->id)->add($cart_value);
        $cartCollection = \Cart::getContent();
        $cnt = $cartCollection->count();
    }else {
        \Cart::session('user')->add($cart_value);
        $cartCollection = \Cart::getContent();
        $cnt = $cartCollection->count();
    }
        
        return response()->json(['count'=> $cnt]);
    }
    //-----------------------------------------------------//

    public function cart_products() {
        $sort="";
        if (Auth::user()) {
            \Cart::session(Auth::user()->id);
            $get_product = \Cart::getContent();
            $sort = $get_product->sort();
        }else {
            \Cart::session('user');
            $get_product = \Cart::getContent();
            $sort = $get_product->sort();
        }
    return view('user.cart_products',['products'=>$sort]);

    }
    //-----------------------------------------------------//

    public function edit_product(Request $request) {
    $get_id  = $request->input("add");
    $operation = "";
    if(isset($get_id)) {
       $operation ="addition";
    }else {
       $operation ="subtraction";
       $get_id = $request->input("sub");
    }
    $quantity = $request->input("quantity");
    if ($operation =="addition") {
        $quantity= $quantity+1;
    }else {
        $quantity = $quantity-1;
       
    }
    if (Auth::user()) {
        \Cart::session(Auth::user()->id)->update($get_id,array('quantity'=>array(
            'relative'=>false,
            'value' =>$quantity
        ))
        );
        \Cart::session(Auth::user()->id)->getContent()->sort();
         return back();
    }else {
        \Cart::session('user')->update($get_id,array('quantity'=>array(
            'relative'=>false,
            'value' =>$quantity
        ))
        );
        \Cart::session('user')->getContent()->sort();
         return back();
    }
   
    }
    //-----------------------------------------------------//

    public function focusout(Request $request) {
        $sort = "";
        $prod_id = $request->input("prod_id");
        $quantity = $request->input("qtty");
        if (Auth::user()) {
            \Cart::session(Auth::user()->id)->update($prod_id,array('quantity'=>array(
                'relative'=>false,
                'value' =>$quantity
                ))
                );
                \Cart::session(Auth::user()->id);
                $get_product = \Cart::getContent();
                $sort = $get_product->sort();
        }else {
            \Cart::session('user')->update($prod_id,array('quantity'=>array(
                'relative'=>false,
                'value' =>$quantity
                ))
                );
                \Cart::session('user');
                $get_product = \Cart::getContent();
                $sort = $get_product->sort();
        }
        return view('user.cart_products',['products'=>$sort]);
    }
    //-----------------------------------------------------//

    public function login() {
      
        return view('user.login-register');
    }
    //-----------------------------------------------------//

    public function register(Request $request) {
        $signUp = request()->validate([
            'username'=>'required|min:5',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|max:255',
            'password_confirmation' => 'required'
        ]);
        if ($signUp) {
            $insert = user_login::create([
             'Username'=>$request->username,
             'Name' => 'Raphael Maurin',
             'Email'=>$request->email,
             'Password'=>hash::make($request->password),
             'type'=>'user',
             'image'=>'uploads/profile-png'
            ]);
        }
      return redirect('/login')->with('message','You have successfully registered your account');
    }
    //-----------------------------------------------------//
   
    public function login_user(Request $request) {
        $signIn = request()->validate([
            'user'=>'required',
            'pass' => 'required'
        ]);
        
      $get_user =user_login::where('Username','=',$request->user)->first();
        if($get_user && Hash::check($request->pass,$get_user->Password)) {
           Auth::login($get_user);
           if (Auth::user()->type=='admin') {
            return redirect()->route('admin.dashboard');
           }else {
            $cart_count = \Cart::session('user')->getContent()->count();
            if ($cart_count!=0) {
             $getCart = \Cart::session('user')->getContent()->toArray();
             $userId = Auth::user()->id;
             \Cart::session($usemarId)->add($getCart);
             \Cart::session('user')->clear();
            }
            return redirect('/');
           }
         
        }else {
            return redirect('/login')->with('invalid','Invalid Username Or Password');
        }
    }
    //-----------------------------------------------------//

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
    //-----------------------------------------------------//

    public function removeCart(Request $request) {
        if (isset($request->remove)) {
            if (Auth::user()) {
            \Cart::session(Auth::user()->id)->remove($request->remove);
            }else {
            \Cart::session('user')->remove($request->remove);
            }
            return back();
        }else if (isset($request->buy)) {
        }
    }
    //-----------------------------------------------------//
    
    public function payment() {
        $user = Auth::user();
        return view('user.payment');
    }
    //-----------------------------------------------------//
    public function postPaymentStripe(Request $request)
    {
        $validator = request()->validate([
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
        ]);
        $input = $request->except('_token');
        if ($validator) { 
            $stripe = Stripe::setApiKey("sk_test_51NCFQlIjTpNucitYsDjwZXrQV44K0rP23G2k6x48a43DXud5EDfg6OnoCi3j8QDL5wSR1Cr3U35xeWk3UGLg0Bx100jKrn3XlX");
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    return redirect()->route('cartProducts');
                }
                 
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => 20.49,
                    'description' => 'Payment for cart',
                ]);
                if($charge['status'] == 'succeeded') {
                    return redirect()->route('cart.products')->with("success","Payment Successful");
                } else {
                    return redirect()->route('cart.products')->with('error','Money not add in wallet!');
                }
            } catch (Exception $e) {
                return redirect()->route('cart.products')->with('error',$e->getMessage());
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('cart.products')->with('error',$e->getMessage());
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('cart.products')->with('error',$e->getMessage());
            }
        }
    //-----------------------------------------------------//

    }public function adminDashboard() {
        $get_all = DB::table('product_info')
        ->join ('product_images','product_info.id','=','product_images.product_id')
        ->select('product_info.*','product_images.*')
        ->get();
        return view('user.admin-dashboard',['products'=>$get_all]);

    }
    //-----------------------------------------------------//
    public function adminUpdate(Request $request) {
        $get_all = DB::table('product_info')
        ->join ('product_images','product_info.id','=','product_images.product_id')
        ->select('product_info.*','product_images.*')
        ->get();
      $user = user_login::find(Auth::user()->id);
        $validate = request()->validate([
                'password_c'=>'required'
        ]);
        if ($validate && hash::check($request->password_c,$user->Password)) {
            if ($request->upload_file) {
                $fileName = 'uploads/'.time().'.'.$request->upload_file->extension(); 
                $request->upload_file->move(public_path('uploads'), $fileName);
                $user->image = $fileName;
           }
           if ($request->password){
            $validate_password = request()->validate([
                'password'=>'confirmed'
            ]);
            if($validate_password) {
                $user->Password = Hash::make($request->password);
            }
           }
           $user->Name = $request->fullname;
           $user->Username = $request->username;
           $user->Email = $request->email;
           $user->save();
        return redirect()->route('admin.dashboard',['products'=>$get_all])->with('success','Your credentials has been updated successfully');
        }else {
            return redirect()->route('admin.dashboard',['products'=>$get_all])->with('error','You entered a wrong password');
        }
           
    }
 
}   
