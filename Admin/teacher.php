<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');

?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Teacher Profile</h1>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">TeacherName</th>
      <th scope="col">Standard</th>
      <th scope="col">Profile</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">501</th>
      <td>Patel Ayush</td>
      <td>1st</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">502</th>
      <td>shah kishan</td>
      <td>2nd</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">503</th>
      <td>pandya vidhi</td>
      <td>3rd</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">504</th>
      <td>parekh nidhi</td>
      <td>4th</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">505</th>
      <td>Doshi Raj</td>
      <td>5th</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">506</th>
      <td>Desai Anand</td>
      <td>6th</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">507</th>
      <td>Malani Nishesh</td>
      <td>7th</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">508</th>
      <td>Patel krupa </td>
      <td>9th</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">509</th>
      <td>Patel Jiya</td>
      <td>11th</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>
    <tr>
      <th scope="row">510</th>
      <td>Panchak Jay</td>
      <td>10th</td>
      <td><a href="../Admin/avctionprofileteacher.php">Profile</a></td>
    </tr>

  </tbody>
</table>

  
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Teacher Profile</h5>
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
              <input type="text" class="form-control" id="Fname" placeholder="First name" required="Fname">
            </div>
            <div class="col">
              <label for="  Lname"> Last Name</label>
              <input type="text" class="form-control" id="Lname" placeholder="Last name" required>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label> E-mail</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="col">
              <label>Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group-col col-md-6">
              <label for="input">Experience</label>
              <select id="input" class="form-control" required>
                <option selected>Frasher</option>
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
                <option>13</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>20</option>
              </select>
            </div>
            <div class="col">

              <!--Date picker -->
              <div class="form-group col-md-6">
                <label for="birthdaytime">Birthday:</label>
                <input type="date" id="birthdaytime" name="birthdaytime" id=" datetime-local  ">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group-col col-md-6">
              <label for="input">Degree</label>
              <select id="input" class="form-control" required>
                <option selected>Choose...</option>
                <option>B.Ed.</option>
                <option>M.Ed.</option>
                <option>B.Com</option>
                <option>M.Com</option>
                <option>B.C.A</option>
                <option>M.C.A</option>
                <option>B.Sc</option>
                <option>M.Sc</option>
                <option>Msc.IT</option>
                <option>B.B.A</option>
                <option>M.B.A</option>
                <option>B.A</option>
                <option>M.A</option>
                <option>Other..</option>
              </select>
            </div>
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
          <div class="row">
            <div class=" col">
              <label for="FormControlTextarea1">Address</label>
              <textarea class="form-control" id="FormControlTextarea1" rows="2" required></textarea>
            </div>
            <div class=" col">
              <label for="FormControlTextarea1">Discription</label>
              <textarea class="form-control" id="FormControlTextarea1" rows="2" required></textarea>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="input">Select Subject</label>
              <select id="input" class="form-control" required>
                <option selected>Choose...</option>
                <option>A</option>
                <option>B</option>
              </select>
            </div>
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
          </div>
      </div>

      <div class="modal-footer">
        <center>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" data-success="modal">Submit</button>
        </center>
        </form>
      </div>
      <!--And-->
    </div>

    <!-- jquery JS -->
    <!-- Modal 
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
<form>
   <div class="form-group">
    <label for="exampleInputEmail1"> Enter Emai</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="FormControlTextarea1">Address</label>
    <textarea class="form-control" id="FormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="input">Standard</label>
        <select id="input" class="form-control">
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
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputID">Enter ID</label>
      <input type="text" class="form-control" id="inputRollno" placeholder="Enter ID">
    </div>
       <div class="form-group">
    <label for="input">Select Subject</label>
        <select id="input" class="form-control">
        <option selected>Choose...</option>
        <option>A</option>
        <option>B</option>
    </select>
    </div>
</div>
 <div class="modal-footer">
 <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary" data-success="modal">Submit</button>
</form>
</div>
-->
    <!--  end Modal -->

    <?php
    include('Panel/script.php');

    ?>