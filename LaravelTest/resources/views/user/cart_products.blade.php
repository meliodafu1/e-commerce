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
              <span>Total Price:&emsp;&emsp;&emsp;&emsp;</span><span>P{{number_format(Cart::session('user')->getSubTotal(),2)}}</span>
                <button type="button"  class="btn btn-dark">Proceed to Checkout</button>  
            </div>
        </div>
    </div>
    @include('user.footer')
    @include('user.script')
    <script>
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