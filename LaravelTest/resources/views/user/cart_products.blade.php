<!DOCTYPE html>
<html lang="en">
<head>
<title>Cart Products</title>
    @include('user.link')
</head>
<body>
  
    @include('user.header')
    <div class="text">
   <h4>Your Cart</h4>
   <hr>
</div>  
@if (Session::has('error'))
<div class="alert alert-danger error_message">
    <span>{{ Session::get('error') }}</span>
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger error_message">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="all-cont">
    <div class="cart-container">
    @foreach ($products as $get)
    <div class="cart-cont">
        <div class="cart-image">
             <img src="{{URL::asset($get->attributes->image)}}" alt="" >
        </div>
        <div class="cart-informations">

            <h4>{{$get->name}}</h4>
            <p id="c-p" >Selling Price: P{{number_format($get->price, 2)}}</p>
            <form action="/editProduct" method="get">
            @csrf
            <div class="cart-input">
            <form action="/edit_cart" method="get">

                    <div class="minus" onClick="subtract()" >
                    <button name="sub" value="{{$get->id}}" class="minust">-</button>
                    </div>
                    <div class="input-text">
                        <input name="quantity" value="{{$get->quantity}}" type="number" id="number_items" value='1' min='1'>
                    </div>
                    <div class="add" onClick="add()">
                       <button id="btn-add" name="add" value="{{$get->id}}" class="btnt">+</button>
                    </div>
                </div>
                </form>
            <hr>
            <p>Total: {{number_format($get->price*$get->quantity,2)}}</p>
            <form action="/removeCart" method="get">
            @csrf
            <button type="submit" name="buy" value="{{$get->id}}" class="btn btn-dark">Buy Now</button>
            <button type="submit" name="remove" class="btn btn-danger" value="{{$get->id}}">Remove</button>
            </form>

        </div>
      </div>
        @endforeach
    </div>
    <div class="total-price">
            <div class="desc">
                <h4>Check Out Your Cart</h4>
                <hr>
                @if (Auth::user())
              <span>Total Price:&emsp;&emsp;&emsp;&emsp;</span><span>P{{number_format(Cart::session(Auth::user()->id)->getSubTotal(),2)}}</span>
                @else
              <span>Total Price:&emsp;&emsp;&emsp;&emsp;</span><span>P{{number_format(Cart::session('user')->getSubTotal(),2)}}</span>
                @endif
                <button type="button"  class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Proceed to Checkout</button>  
            </div>
        </div>
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Checkout Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" id="payment-form" role="form" action="{!!route('addmoney.stripe')!!}" >
        @csrf
      <div class="form-group fname">
        <input type="text" class="form-control" aria-describedby="emailHelp" id="firstname" placeholder="First Name" name="first_name">
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Last Name" name="last_name">
      </div>

      <div class="form-group f-address">
      <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Address" name="address">
      </div>
      <div class="form-group email-address">
      <input type="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Email" name="email">
      </div>
      <div class="form-group options">
        <input type="button" class="option" value="Cash On Delivery">
        <input type="button"  class="option" value="Online Payment">
      </div>
      <div class="online" id="online">
          <div class="form-group card-c ">
            <input type="text" class="form-control card-number" aria-describedby="emailHelp"  placeholder="Card Number" size='20' name="card_no" >
            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Expiry Month" name="ccExpiryMonth" >
          </div>
          <div class="form-group card-c ">
            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Expiry Year" name="ccExpiryYear">
            <input type="password" class="form-control" aria-describedby="emailHelp" placeholder="CVC" name="cvvNumber">
          </div>
          <hr>
          <div class="buy-area">
            @if(Auth::user())
            <p>Total Price : P{{number_format(\Cart::session(Auth::user()->id)->getSubTotal(),2)}}</p>
            @else
            <p>Grand Total : P{{number_format(\Cart::session('user')->getSubTotal(),2)}}</p>
            @endif
            </div>
      </div>
      <div class="cod" id="cod">
        <div class="form-group delivery-reciever">
          <input type="text" name="delivery-reciever" class="form-control" id="" aria-describedby="emailHelp" placeholder="Reciever Name" name="address">
        </div>
        <div class="form-group delivery-address">
          <input type="text" name="delivery" class="form-control" id="" aria-describedby="emailHelp" placeholder="Delivery Address" name="address">
        </div>
        <div class="form-group delivery-number">
          <input type="number" name="delivery-number" class="form-control" id="" aria-describedby="emailHelp" placeholder="Contact Number" name="address">
        </div>
        <hr>
          <div class="buy-area">
            @if(Auth::user())
            <p>Total Price : P{{number_format(\Cart::session(Auth::user()->id)->getSubTotal(),2)}}</p>
            @else
            <p>Grand Total : P{{number_format(\Cart::session('user')->getSubTotal(),2)}}</p>
            @endif
            </div>
      </div>
        <button type="submit"  name="submit" class="btn buy-button btn-dark" >Place Order Now</button>  
        
      </form>

      </div>
     
    </div>
  </div>
</div>






    @include('user.footer')
    @include('user.script')
    <script>
  payment_options = 0;
$( document ).ready(function() {
        const first_option = document.querySelectorAll('.option')[0];
        first_option.classList.add('pick_option');
        document.getElementById('online').style.display='none';
        
        });
      const get_options = document.querySelectorAll(".option");
      get_options.forEach(g_options=>{
        g_options.addEventListener('click',()=>{
          if (g_options.value=='Cash On Delivery') {
           document.getElementById('online').style.display='none';
           document.getElementById('cod').style.display='block';
          }else {
            document.getElementById('online').style.display='block';
           document.getElementById('cod').style.display='none';
          }
          document.querySelector('.pick_option')?.classList.remove('pick_option');
          g_options.classList.add('pick_option');
        });
        payment_options++;
      });
            var count = 0;
           const get_quant = document.querySelectorAll('#number_items');
          get_quant.forEach(quantVal=>{
            var get_id = document.querySelectorAll("#btn-add")[count].value;
            quantVal.addEventListener('change',()=>{
                var get_val = quantVal.value;
                if (quantVal.valueAsNumber<1 || Number.isNaN(quantVal.valueAsNumber)) {  
                    quantVal.value = 1;
                    get_val = 1;
                }
           
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
            method: "GET",
            url: "/focusout",
            data: {
                "prod_id":get_id,
                "qtty":get_val
            },
            success: function(response) {
                location.reload();
                }
            });
         
            });
          count++;
          });


    
        
    //   document.getElementById("number_of_items").addEventListener("focusout", focusOut);
    //     function focusOut() {
    //         var get_id = document.getElementById("btn-add").value;
    //        var get_value = document.getElementById("number_of_items");
    //        var get_quantity = get_value.valueAsNumber;
    //        if (get_value.valueAsNumber<1 || Number.isNaN(get_value.valueAsNumber)) {
    //         get_value.value = 1;
    //         get_quantity = 1;
    //        }
        //    $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //         });
        //     $.ajax({
        //     method: "GET",
        //     url: "/getCart",
        //     data: {
        //         "product_id":get_id,
        //         "quantity":get_quantity
        //     },
        //     success: function(response) {
        //             alert("succes");
        //         }
        //     });

        // }
        
    
    </script>
</body>
</html>