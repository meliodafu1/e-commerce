<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.link')
    <title>Products</title>
</head>
<body>
    <div class="cont-text">
        <h4>Products</h4>
        <div class="filter">
            <span>Filters</span><i class='bx bx-filter'></i>
        </div>
        <hr>
    </div>

    @include('user.header')
    <div class="products-display">
    @foreach ($data as $items)
        <div class="show-products" id="show-product">
         <img src="{{URL::asset($items->product_image)}}" alt="" >
         <a href="{{url('product/'.$items->id)}}"><p id="g-p" >{{$items->product_name}}</p></a>
        <span>{{$items->product_status}}</span>
         <p id="amount">P{{$items->product_price}}</p>
         <button type="submit" id="add-cart1"  value="{{$items->id}}" onClick="addCart(this)"class="btn btn-dark o-btn1">Add to Cart</button>
        </div>
    @endforeach
    </div>
    @include('user.footer')
    @include('user.script')
    <script>
        function addCart($val) {
            var product_id = $val.value;
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
                "quantity":1
            },
            success: function(response) {
                $('#counter1').html(response.count); 
                }

            });
         
        }
   
          

    </script>
</body>
</html>