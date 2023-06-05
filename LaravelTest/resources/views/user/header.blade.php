
<div class="navbar">
  <i class='bx bxs-cat e-logo'><span>WPets</span></i>
  <ul>
    <li><a href="/" class="tgl hver">Home</a></li>
    <li><a href="#about"  class="tgl">Product</a></li>
    <li><a href="#education" class="tgl">About</a></li>
    <li><a href="#skills" class="tgl">Contact</a></li>
  </ul>
  <div class="left">
    <input type="email" class="search-bar" id="exampleInputEmail1" aria-describedby="emailHelp" 
      placeholder="Search"/> <i class='bx bx-search-alt search-logo' ></i>
   @if (Auth::user())
      <a href="{{route('cart.products')}}"><span><li><i class='bx bxs-cart crt'><span id="counter1">{{\Cart::session(Auth::user()->id)->getContent()->count()}}</span></i></li></span></a>
  @else
     <a href="{{route('cart.products')}}"><span><li><i class='bx bxs-cart crt'><span id="counter1">{{\Cart::session('user')->getContent()->count()}}</span></i></li></span></a>
  @endif
  @if (Auth::user())
  <div class="circle" id="profile-image">
    <img src="{{URL::asset('/uploads/profile-png.png')}}" alt="" >
  </div>
  @else
  <form action="/login" method="get">
    @csrf
  <button type="submit" id="login-button" class="btn btn-primary">Login</button>
  </form>
  @endif
  </div>
  @if (Auth::user())
  <div class="box">
    <div class="logout">
   <h5>{{Auth::user()->Username}}</h5>
   <div class="divide" onclick="edit()">
   <i class='bx bx-edit' ></i><p >Edit Profile</p>
  </div>
  <div class="divide" onclick="logout()">
  <i class='bx bx-log-out'></i><p>Logout</p>
  </div>
  </div>
  </div>
  @endif
</div>
@include('user.script')
<script>
 @if(Auth::check())
 var box = document.querySelector('.box');
  var image = document.querySelector('#profile-image');
  image.addEventListener("mouseover",()=>{
    box.classList.add('active');
  });
  document.addEventListener("click",()=>{
    if ($('.box').hasClass('active') && $('.box:hover').length==0) {
    box.classList.remove('active');
    }
  });
@endif
  function logout() {
    location.replace("{{ route('logout') }}");
  }


 
</script>