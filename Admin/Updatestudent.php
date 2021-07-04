<?php 
		include('Panel/header.php');

		include('Panel/navbar.php');

		include('Panel/topbar.php');

?>
     <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Student</h1>
                 <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i
                class="fas fa-download fa-sm text-white-50"></i>Update Student</a>
              </div>  

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Student Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <!-- Form -->   
          <form>
   <div class="row py-2">
    <div class="col">
      <label for="Fname"> First Name</label>
      <input type="text" class="form-control" id="updateFname" placeholder="First name" required="Fname">
    </div>
    <div class="col">
      <label for="  Lname"> Last Name</label>
      <input type="text" class="form-control" id="updateLname" placeholder="Last name" required>
    </div>
  </div> 
   <div class="row">
    <div class="col">
      <label> E-mail</label>
    <input type="email" class="form-control" id="updateEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
  </div>
  <div class="col">
    <label>Password</label>
    <input type="password" class="form-control" id="updatePassword1" placeholder="Password" required>
  </div>
</div>
<div class="form-row"> 
     <div class="col">
      <label for="validationDefaultUsername">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend2">@</span>
        </div>
        <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Username" aria-describedby="inputGroupPrepend2" required>
      </div>
    </div>
  </div>
  <div class="form-row"> 
     <div class="form-group-col col-md-6">
    <label for="input">Standard</label>
        <select id="input" class="form-control" required>
        <option selected>Choose...</option>
        <option>L.K.G</option>
        <option>H.K.G</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
      </select>
  </div>
  <div class="col"> 

<!--Date picker -->
<div class="form-group col-md-6">
  <label for="birthdaytime">Birthday:</label>
<input type="date" id="birthdaytime" name="birthdaytime" id=" datetime-local  " >
</div>
</div>
</div>

    <div class="row">
    <div class=" col">
    <label for="FormControlTextarea1">Address</label>
    <textarea class="form-control" id="FormControlTextarea1" rows="2" required></textarea>
  </div>
   <div class=" col" > 
   <label for="FormControlTextarea1">Discription</label>
    <textarea class="form-control" id="FormControlTextarea1" rows="2" required></textarea>
    </div>
  </div>
</div>

 <div class="modal-footer">
  <center> 
 <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
   
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary" id="">Submit</button>
</center>
</form> 
</div>
<!--And-->
<?php 
include('Panel/script.php'); 	
?>