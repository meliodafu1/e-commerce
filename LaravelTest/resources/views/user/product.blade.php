<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Information</title>
    @include('user.link')
</head>
<body>
    @include('user.header')
    <div class="text">
        <h4>Product Information</h4>
        <hr>
    </div>
    @foreach ($product_info as $products)
    <div class="product">
        <div class="product-image">
            <img src="{{URL::asset($products->product_image)}}" alt="" >
        </div>
        <div class="information">
            <h4>{{$products->product_name}}</h4>
            <span id="price" >P{{$products->product_price}}</span><br>
            <span id="stocks">( {{$products->product_stocks}} stocks )</span>
            <div class="sizes">
                <p>Sizes :</p>
                        <button id="sizess" onClick="getVal(this)" class="size" value='{{$products->product_price}}'>S</button>
                        <button id="sizess" onClick="getVal(this)" class="size" value="1500.00">M</button>
                        <button id="sizess" onClick="getVal(this)" class="size" value="2500.00">L</button>
                    </div>
            <div class="bottom-info">
                <span id="sub-total">s</span>
                    <div class="cart-input">
                    <div class="minus" onClick="subtract()" >
                        <span>-</span>
                    </div>
                    <div class="input-text">
                        <input type="number" id="number_of_items" value='1' min='1'>
                    </div>
                    <div class="add" onClick="add()">
                        <span>+</span>
                    </div>
                </div>
                <div class="p-information-buttons">
                    <button type="submit" id="add1-cart" value="{{$products->id}}" name="addCart" class="btn btn-dark">Add to Cart</button>
                    <button type="button"  class="btn btn-dark">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="description">
        <h4>High Quality Adult Pedigree Food</h4>
        <hr>
        @foreach ($product_info as $desc)
        <article>{{$desc->product_description}}</article>
        @endforeach
      
    </div>
    <div class="suggested-product">
    <h4>Products You May Like</h4>
        <hr>
        <div class="like-products">
        @foreach ($featured_product as $featured)
            <div class="show-products" id="show-product">
                <img src="{{URL::asset($featured->product_image)}}" alt="" >
                <a href="{{url('product/'.$featured->id)}}"> <p>{{$featured->product_name}}</p></a>
                <span>Status: {{$featured->product_status}}</span>
                <p id="amount">P{{$featured->product_price}}</p>
                <button type="button" id="add-cart" class="btn btn-dark o-btn1" value="{{$featured->id}}">Add to Cart</button>
            </div>
        @endforeach
        </div>
    </div>
    @include('user.footer')
    @include('user.script')
    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        var set_value = 0;
        var price_val = 0;
       $( document ).ready(function() {
        const get_buttons1 = document.querySelectorAll('#sizess')[0];
        get_buttons1.classList.add('special');
        price_val = parseInt(get_buttons1.value);
        set_value = parseInt(get_buttons1.value);
        const set_val = document.querySelector('#sub-total');
        set_val.innerHTML="Sub Total: "+set_value;
        set_val.style.visibility="visible";
        });
        const get_buttons = document.querySelectorAll('#sizess');
        get_buttons.forEach(btnEl=>{
            btnEl.addEventListener('click',()=>{
                document.querySelector('.special')?.classList.remove('special');
                btnEl.classList.add('special');
               var val =btnEl.value;
               price_val = parseInt(val);
               set_value = parseInt(val);
               var get =document.querySelector("#sub-total");
             
               get.innerHTML ="Sub Total: "+val;
               var get_count =document.querySelector("#number_of_items");
               get_count.value = 1;
            });
        })
        function subtract(){
            var counter = document.getElementById("number_of_items");
            var get_count = counter.valueAsNumber;
            if (Number.isNaN(get_count) || get_count<1) {
               counter.value = 1;
            }else {
            if (get_count!=1) {
                counter.value = get_count-=1;
                set_value-=price_val;
                var get =document.querySelector("#sub-total");
                get.innerHTML ="Sub Total: "+set_value;
            }
        }
        }
        function add(){
            var counter1 = document.getElementById("number_of_items");
            var get_count1 = counter1.valueAsNumber;
            if (Number.isNaN(get_count1)) {
               counter1.value = 1;
            }else {
            if (get_count1>=1) {
                counter1.value = get_count1+=1;
                set_value+=price_val;
                var get =document.querySelector("#sub-total");
                get.innerHTML ="Sub Total: "+set_value;
            }
        }
        }
        document.getElementById("number_of_items").addEventListener("focusout", focusOut);
        function focusOut() {
           var get_value = document.getElementById("number_of_items");
           if (get_value.valueAsNumber<1 || Number.isNaN(get_value.valueAsNumber)) {
            get_value.value = 1;
            var get =document.querySelector("#sub-total");
            get.innerHTML = "Sub Total: "+price_val;
           }

        }
        const get_cart = document.querySelector('#add1-cart');
        get_cart.addEventListener('click',()=>{
        const get_quantity = document.querySelector('#number_of_items').value;
            var product_id = get_cart.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
            method: "GET",
            url: "/getCart",
            data: {
                "product_id":product_id,
                "quantity":get_quantity
            },
            success: function(response) {
            $('#counter').html(response.count);
                }
            });
            });
            
    </script>
</body>
</html>