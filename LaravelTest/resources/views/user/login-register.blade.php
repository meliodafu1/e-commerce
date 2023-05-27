  
  <!DOCTYPE html>
  <html lang="en">
  <head>
  @include('user.link')
  <link rel="stylesheet" href="{{asset('css/login-register.css')}}">
    <title>Login</title>
  </head>
  <body>
  @include('user.header')
 
 <div class="form-cont"  id="sign-in-form">
   
        <div class="frm-header">
            <h4>Sign In</h4>
        </div>
        @if(Session::has('invalid'))
        <div class="alert alert-danger alert-dismissible fade show alert-error" role="alert">
          {{Session::get('invalid')}}
         
         </div>
        @endif
        <div class="login">
        <div class="bdy">
        <form method="GET" action="/login-attempt">
            @csrf
                <div class="rgster-form1">
                <input type="text" name="user"class="form-control" id="email" aria-describedby="emailHelp" placeholder="Username">
                <span>{{$errors->first('user')}}</span>
                </div>
                <div class="rgster-form1">
                <input type="password" class="form-control" name="pass" id="password" placeholder="Password">
                <span>{{$errors->first('pass')}}</span>
                </div>
                <div class="">
                <button type="submit" class="btn btn-dark">Login</button>
                </div>
                <div class="sign-up">
                    <span>Not Registered Yet? </span><span id="sign-up" onClick="sign_up()">Sign Up</span>
                </div>
            </form>
        </div>
    </div>
 </div>
 <div class="form-cont-r"  id="sign-up-form">
        <div class="frm-header">
            <h4>Sign Up</h4>
        </div>
        @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show alert-error" role="alert">
            {{Session::get('message')}}
         </div>
    @endif
        <!-- @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show alert-error" role="alert">
            @foreach($errors->all() as $error)
             {{$error}}
            @endforeach
         </div>
    @endif -->
 <div class="sign-up">
        <div class="bdy">
        <form action="/register" method="get">
            @csrf
                <div class="rgster-form">
                <input type="text" name="username" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Username">
                <span>{{$errors->first('username')}}</span>
                </div>
                <div class="rgster-form">
                <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                <span>{{$errors->first('email')}}</span>
                </div>
                <div class="rgster-form">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <span>{{$errors->first('password')}}</span>
                </div>
                <div class="rgster-form">
                <input type="password" name="password_confirmation" class="form-control" id="password" placeholder="Confirm Password">
                </div>
                <div class="rgster-form">
                <button type="submit" class="btn btn-dark">Register</button>
                </div>
                <div class="register">
                    <span>Already Registered? </span><span id="sign-in" onClick="sign_in()">Sign In</span>
                </div>
            </form>
        </div>
    </div>
</div>
  @include('user.footer')
  @include('user.script') 
  <script>
    function sign_in() {
       localStorage.setItem("show","sign-in");
        document.getElementById("sign-up-form").style.display = "none";
        document.getElementById("sign-in-form").style.display = "block";
        localStorage.setItem("show","sign-in");
    }
    function sign_up() {
        localStorage.setItem("show","sign-up");
        document.getElementById("sign-in-form").style.display = "none";
        document.getElementById("sign-up-form").style.display = "block";
       
    }
if (localStorage.getItem("show")=='sign-up') {
    document.getElementById("sign-in-form").style.display = "none";
    document.getElementById("sign-up-form").style.display = "block";
}else {
    document.getElementById("sign-up-form").style.display = "none";
    document.getElementById("sign-in-form").style.display = "block";
}

  </script>   
  </body>
  </html>
  
