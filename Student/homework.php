<?php 
        include('Panel/header.php');

        include('Panel/navbar.php');

        include('Panel/topbar.php');
?>
         <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Submit HomeWork</h1>
                     <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i
                    class="fas fa-download fa-sm text-white-50"></i>Submit HomeWork</a>
                  </div> 
                  
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="img/notice.png" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">Uploaded file</p>
  </div>
</div>
  
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
  <div class="form-group">
    <label for="exampleFormControlFile1">You can Upload pdf , doc , img etc</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1"  required>
  </div>
   <div class="modal-footer">
 <div class="form-check align-items-left">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary" data-success="modal">Submit</button>
</form>
</div>
<!--And-->
 
<?php 
include('Panel/script.php');
?>