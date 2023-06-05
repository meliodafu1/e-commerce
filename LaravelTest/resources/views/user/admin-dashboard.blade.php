<!DOCTYPE html>
<html lang="en">
<head>
   @include('user.link')
</head>
<body>

@include('user.script')
<script>
</script>
<div class="admin-container">
    <div class="h-navbar">
        <div class="admin-logo">
          <i class='bx bxs-cat e-logo'><span>WPets</span></i>
        </div>
        <hr>
        <div class="navbar-contents">
            <div class="admin-profile">
                <div class="profile-pic">
                    <img src="{{URL::asset(Auth::user()->image)}}" alt="" >
                </div>
                <div class="profile-info">
                    <span>{{Auth::user()->Name}}</span>
                    <p>Administrator</p>
                </div>
            </div>
            <div class="navbar-menu" >
                <div class="navbar-menu-content" data-value='profile' id="profile">
                   <i class='bx bxs-user'></i><span>Profile</span>
                </div>
                <div class="navbar-menu-content" data-value='products' id="products">
                    <i class='bx bxs-gift'></i><span>Products</span>
                </div>
                <div class="navbar-menu-content" data-value='orders' id="orders">
                    <i class='bx bxs-cart'></i><span>Orders</span>
                </div>
                <div class="navbar-menu-content" data-value='sales' id="sales">
                    <i class='bx bxs-report'></i><span>Sales Report</span>
                </div>
                <div class="navbar-menu-content logout" data-value='logout'>
                    <i class='bx bx-log-out'></i><span>Logout</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Admin Profile------------------------------------ -->
    <div class="admin-content">
        <div class="profile">
            <h4>Admin Profile</h4>
        </div>
        <hr>
        <form action="/admin-update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-image">
                <img id="user-image" src="{{URL::asset(Auth::user()->image)}}" alt="" >
                <input type="file"  name="upload_file" id="file">
                <label for="file" id="upload"><i class='bx bxs-image-add'></i></label>
            </div>
        <div class="profile-form">
            <div class="username">
                <label for="address" class="form-label">Username</label>
                <input type="text" value="{{Auth::user()->Username}}" class="form-control" id="username" name="username"  aria-describedby="emailHelp">
                <span>{{$errors->first('username')}}</span>
            </div>
            <div class="email">
                <label for="password" class="form-label">Full Name</label>
                <input type="text" value="{{Auth::user()->Name}}" class="form-control" name="fullname" id="email"  aria-describedby="emailHelp">
                <span>{{$errors->first('fullname')}}</span>
            </div>
            <div class="email">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" value="{{Auth::user()->Email}}" class="form-control" id="email" name="email"  aria-describedby="emailHelp">
                <span>{{$errors->first('email')}}</span>
            </div>
            <div class="email">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="email" name="password" placeholder="New Password" aria-describedby="emailHelp">
                <span>{{$errors->first('new_password')}}</span>
            </div>
            <div class="email">
                <label for="email" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control"  name="password_confirmation" id="email" placeholder="Confirm Neww Password" aria-describedby="emailHelp">
            </div>
            <div class="form-text note">You can change your credentials here. Just click the update button to save the changes. <br><b>Note:</b> Password is required to update your changes</div>
            <div class="email psw">
                <label for="password" class="form-label">Password<span style="color:red">*</span></label>
                <input type="password" class="form-control" id="email" name="password_c" placeholder="Confirm your changes" aria-describedby="emailHelp">
                <span>{{$errors->first('password')}}</span>
            </div>
            <button type="submit" class="btn btn-primary"><i class='bx bx-save'></i>Update</button>
        </div>
        </form>
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show success-edit" role="alert">
     <span>{{Session::get('success')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show success-edit" role="alert">
     <span>{{Session::get('error')}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    </div>
    <!-------------------------------------------->
    <!------Admin Products Section------------------->
    <div class="admin-products">
        <div class="products">
            <h4>Products</h4>
        </div>
        <hr>

<!-- add-product---------------- -->
<button type="button"  data-bs-toggle="modal" data-bs-target="#add-product" class="btn btn-primary add-prod">Add Product<i class='bx bx-plus'></i></button>
<div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add A Product+</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
    <div class="elements-add">
        <div class="email">
            <label for="password" class="form-label"><i class='bx bx-notepad'></i>Product Name</label>
            <input type="text" class="form-control" id="email" name="password" placeholder="Product Name" aria-describedby="emailHelp">
        </div>
        <div class="email">
            <label for="password" class="form-label"><i class='bx bxs-purchase-tag-alt'></i>Price</label>
            <input type="number" class="form-control" id="email" name="password" placeholder="Price" aria-describedby="emailHelp">
        </div>
        <div class="email">
            <label for="password" class="form-label"><i class='bx bxs-cart'></i>Stocks</label>
            <input type="number" class="form-control" id="email" name="password" placeholder="Stocks" aria-describedby="emailHelp">
        </div>
        <div class="email">
            <label for="desc-area" class="form-label"><i class='bx bxs-edit-alt'></i>Description</label>
            <div id="desc-area">
                <textarea name="description" id="editor" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="file_upload">
            <label for="file">Upload Images</label>
            <input type="file" id="file_uploader" name="file" multiple />
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add Product</button>
      </div>
    </div>
  </div>
</div>
<!--------------------------------->

<table id="myTable" class="table table-bordered table-striped table_product">
<thead class="table-dark">  
  <tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Product Price</th>
    <th>Product Status</th>
    <th>Product Stocks</th>
    <th>Product Description</th>
    <th>Action</th>
  </tr>
</thead>
@foreach($products as $prod)
  <tr>
    <td>{{$prod->id}}</td>
    <td>{{$prod->product_name}}</td>
    <td>{{$prod->product_price}}</td>
    <td>{{$prod->product_status}}</td>
    <td>{{$prod->product_stocks}}</td>
    <td id="productDescription">{{$prod->product_description}}</td>
    <td><button type="button" class="btn btn-primary">Show</button>
    <button type="button" class="btn btn-danger">Disable</button></td>
  </tr>
@endforeach
</table>
    </div>
</div>
    @include('user.script')
    <script>
       ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
         
     $( document ).ready(function() {
        result ="";
        var name = 'show';
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split("; ");
        ca.forEach(element=>{
            if(element.indexOf(name)==0) {
                result = element.substring(name.length+1);
            }else {
            }
        });
        

        if (result=="") 
        {
        var menu_content = document.querySelectorAll('.navbar-menu-content')[0];
        menu_content.classList.add('active-menu');
        document.querySelector('.admin-content').style.display='block';
        document.querySelector('.admin-products').style.display='none';
        }else {
        if(result=='profile') {
           var profile_menu = document.querySelector('#profile').classList.add('active-menu');
                document.querySelector('.admin-content').style.display='block';
                document.querySelector('.admin-products').style.display='none';
                profile_menu.classList.add('active-menu');

            }else if(result=='products'){
            var products_menu = document.querySelector('#products');
            products_menu.classList.add('active-menu');
                document.querySelector('.admin-content').style.display='none';
                document.querySelector('.admin-products').style.display='block';
            }
        }
            var maxlength = 100;
            var get_length = document.querySelectorAll('#productDescription');
            get_length.forEach(get_l1=>{
            if (get_l1.innerHTML.length >100) {
                get_l1.innerHTML = get_l1.innerHTML.substring(0, 100) + '...'; }});
             $('#myTable').DataTable();
            });
       
     var get_all = document.querySelectorAll('.navbar-menu-content');
     get_all.forEach(each_menu=>{
        each_menu.addEventListener('click',()=>{
            if (each_menu.dataset.value=='profile') {
                document.cookie='show=profile';
                document.querySelector('.admin-content').style.display='block';
                document.querySelector('.admin-products').style.display='none';

            }else if (each_menu.dataset.value=='products') {
                document.cookie='show=products';
                document.querySelector('.admin-content').style.display='none';
                document.querySelector('.admin-products').style.display='block';
            }
            document.querySelector('.active-menu')?.classList.remove('active-menu');
            each_menu.classList.add('active-menu');
        })
     })

     $('#file').change(function(){
        var validation = ['png','jpg','jpeg'];
        var image = document.querySelector('#file').files[0];
           var val =image.name;
           var extension=val.lastIndexOf('.')+1;
        if ((validation.includes(val.substring(extension)))) {
        var reader = new FileReader();
        reader.onload= function(e) {
            document.querySelector('#user-image').setAttribute('src',e.target.result)
        }
        reader.readAsDataURL(image);
        }else {
            alert('The upload field must be a file of type: png, jpeg, jpg.')
        }
           
});

    </script>
</body>
</html>