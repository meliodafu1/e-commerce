<!DOCTYPE html>
<html lang="en">
<head>
  @include('user.link')
  <title>E-Commerce Website</title>
</head>
<body>
@include('user.header')
<div class="body-cont">
   <img src="{{URL::asset('/uploads/main-pic.jpeg')}}" alt="" width="100%" height="100%">
   <div class="headline">
   </div>
      <div class="texts">
        <span>FUR YOUR ONLY</span>
<span id="tagline">THE PERFECT RANGE FOR PET PRODUCTS</span>
<p>WE OFFER AN ENORMOUS SELECTION OF HIGH
FOR DOGS OF ALL SHAPES AND SIZE, QUALITY DOG BEDS, CAGES, AND CRATES.
FURTHERMORE, BUILT TO KEEP OUR PET SAFE AND SECURED. </p>
     </div>
     <div class="buttons">
      <button type="button" id="login-button1" style="border:2px solid red;color:red;" class="btn btn-primary o-btn1">Order Now</button>
      <a href="{{ route('store') }}"><button type="button" id="login-button1" class="btn btn-primary o-btn">View Products</button></a>
      </div>
   
</div>
<section>
<div class="second-cont">
  <h4>Featured Products</h4>
  <div class="images">
      <div class="image-cont">
         <img src="{{URL::asset('/uploads/cats.jpg')}}" alt="" >
      </div>
      <div class="image-cont">
          <img src="{{URL::asset('/uploads/fish.jpg')}}" alt="" >
      </div>
      <div class="image-cont">
         <img src="{{URL::asset('/uploads/hamster.jpg')}}" alt="" >
      </div>
      <div class="image-cont">
          <img src="{{URL::asset('/uploads/dog.jpg')}}" alt="" >
      </div>
  </div>
  <button type="button" id="view-all" class="btn btn-primary">View All</button>
  </div>
</section>
<hr>
<section>
  <div class="third-cont">
    <h4>About Us</h4>
    <p>WE SELL A HIGH QUALITY PRODUCT THAT MATCHES YOUR BESTFRIENDS NEEDS.
      WE HAVE MOSTLY ALL OF YOUR PETS NEEDS AND IS VERY AFFORDABLE. BE ASSURED THAT YOUR PET IS 
      SAFE WHEN USING ONE OF OUR PRODUCTS.<br>
    </p>
    <div class="third-images">
        <div class="img-cont" id="first-img">
              <img src="{{URL::asset('/uploads/authentic.png')}}" alt="" >
        </div>
        <div class="img-cont">
              <img src="{{URL::asset('/uploads/product.png')}}" alt="" >
        </div>
        <div class="img-cont">
              <img src="{{URL::asset('/uploads/trusted.png')}}" alt="" >
        </div>
    </div>
  </div>
</section>
@include('user.footer')
@include('user.script')
</body>
</html>