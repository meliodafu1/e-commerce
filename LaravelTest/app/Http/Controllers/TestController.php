<?php

namespace App\Http\Controllers;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\user_login;
use Illuminate\Support\Facades\Auth;
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
    public function store() {
        $get_all = DB::table('product_info')
        ->join ('product_images','product_info.id','=','product_images.product_id')
        ->select('product_info.*','product_images.*')
        ->get();
        return view('user.store',['data'=>$get_all]);
    }
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
        $product_price = 150;
        foreach ($product as $prod) {
        $cart_value = array(
            'id' => $val,
            'price'=>$prod->product_price,
            'quantity'=>$quantity,
            'name'=>$prod->product_name,
            'attributes'=>array('image'=>$prod->product_image)
        );
    }
        \Cart::session('user')->add($cart_value);
        $cartCollection = \Cart::getContent();
        $cnt = $cartCollection->count();
        return response()->json(['count'=> $cnt]);
    }
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
    \Cart::session('user')->update($get_id,array('quantity'=>array(
        'relative'=>false,
        'value' =>$quantity
    ))
    );
    \Cart::session('user')->getContent()->sort();
    
     return back();
    }
    public function focusout(Request $request) {
        $prod_id = $request->input("prod_id");
        $quantity = $request->input("qtty");
        \Cart::session('user')->update($prod_id,array('quantity'=>array(
        'relative'=>false,
        'value' =>$quantity
        ))
        );
        \Cart::session('user');
        $get_product = \Cart::getContent();
        $sort = $get_product->sort();
        return view('user.cart_products',['products'=>$sort]);
    }
    public function login() {
      
        return view('user.login-register');
    }
    public function register(Request $request) {
        $signUp = request()->validate([
            'username'=>'required',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|max:255',
            'password_confirmation' => 'required'
        ]);
        if ($signUp) {
            DB::insert('insert into user_account (Username,Email,Password) values (?, ?,?)', [$request->username,$request->email,Hash::make($request->password)]);
        }
      return redirect('/login')->with('message','You have successfully registered your account');
    }
    public function login_user(Request $request) {
        $signIn = request()->validate([
            'user'=>'required',
            'pass' => 'required'
        ]);
        
      $get_user =user_login::where('Username','=',$request->user)->first();
        if($get_user && Hash::check($request->pass,$get_user->Password)) {
           Auth::login($get_user);
           $cart_count = \Cart::session('user')->getContent()->count();
           if ($cart_count!=0) {
            $getCart = \Cart::session('user')->getContent()->toArray();
            $userId = Auth::user()->id;
            \Cart::session($userId)->add($getCart);
            \Cart::session('user')->clear();
           }
           return redirect('/');
        }else {
            return redirect('/login')->with('invalid','Invalid Username Or Password');
        }
    }
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
    public function removeCart(Request $request) {
        if (isset($request->remove)) {
            \Cart::session('user')->remove($request->remove);
            return back();
        }else if (isset($request->buy)) {
           
        }
    }
    
}   
