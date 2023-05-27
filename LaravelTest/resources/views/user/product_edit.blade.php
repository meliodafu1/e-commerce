<!DOCTYPE html>
<html lang="en">
<head>
<title>Product Information</title>
@include('user.link')
</head>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark">Save Changes</button>
        <button type="button" class="btn btn-dark">Cancel</button>
      </div>
    </div>
  </div>
</div>
@include('user.script')
<script>
 $(document).ready(function($) {
$("#exampleModal").modal("show");
});
</script>
</body>
</html>