<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');

?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Assignments </h1>
     <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i -->
     <!-- class="fas fa-download fa-sm text-white-50"></i></a> -->
</div>

<form action="profile.php" method="POST">
     <div class="row py-2">
          <div class="col">
               <label for="number">Student Roll No.</label>
               <input type="number" class="form-control" id="rollno" placeholder="Roll NO." required="">
          </div>
          <div class="col">
               <label for="subject">Subject</label>
               <input type="text" class="form-control" id="Lname" placeholder="Subject" required>
          </div>
          <div class="col">
               <div class="form-group-col col-md-6">
                    <div class="form-group">
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
                              <option>11com.</option>
                              <option>12com.</option>
                         </select>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal-footer">
          <button type="submit" id="update_stu" name="submit" class="btn btn-primary">View </button>
          
     </div>
</form>

<!-- Home Work Table -->
<table class="table">
  <thead>
    <tr>
      <th scope="col">Student Rollno</th>
      <th scope="col">Student Name</th>
      <th scope="col">Assignments</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">801</th>
      <td>jay Shah</td>
      <td><a href="">English</a></td>
      <td>11.23</td>
    </tr>
  </tbody>
</table>
<?php
include('Panel/script.php');
?>