<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Add Subject</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download fa-sm text-white-50"></i>Add Subject</a>

</div>

<!-- Modal -->
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Subject Code</th>
      <th scope="col">Subject Name</th>
      <th scope="col">Subject Standard</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>101</td>
      <td>Maths</td>
      <td>8th</td>
      <td><a href="" data-toggle="modal" data-target="#exampleModalCenterupdate">Update</a></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>102</td>
      <td>Science</td>
      <td>8th</td>
      <td><a href="" data-toggle="modal" data-target="#exampleModalCenterupdate">Update</a></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>202</td>
      <td>English</td>
      <td>9th</td>
      <td><a href="" data-toggle="modal" data-target="#exampleModalCenterupdate">Update</a></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td>203</td>
      <td>Gujarati</td>
      <td>9th</td>
      <td><a href="" data-toggle="modal" data-target="#exampleModalCenterupdate">Update</a></td>
    </tr>
  </tbody>
</table>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="form-group">
            <label> Enter Subject Name</label>
            <input type="text" class="form-control" id="SubName" placeholder="Enter Subject  Name" required>
          </div>
          <div class="form-group">
            <label>Enter Subject Code</label>
            <input type="text" class="form-control" id="SubCode" placeholder="Enter Subject Code" required>
          </div>
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
              <option>11</option>
              <option>12</option>
            </select>
          </div>
      </div>
      <script>
      </script>
      <div class="modal-footer">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
          <label class="form-check-label" for="exampleCheck1" required>Check me out</label>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_sub" class="btn btn-primary" data-success="modal">Submit</button>
        <script>
          $("#add_sub").click(function() {
            alert("Subject updated successfully");
          });
        </script>
        </form>
      </div>
    </div>
  </div>
</div>
<!--And-->

<div class="modal fade" id="exampleModalCenterupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="form-group">
            <label> Enter Subject Name</label>
            <input type="text" class="form-control" id="SubName" placeholder="Enter Subject  Name" required>
          </div>
          <div class="form-group">
            <label>Enter Subject Code</label>
            <input type="text" class="form-control" id="SubCode" placeholder="Enter Subject Code" required>
          </div>
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
              <option>11</option>
              <option>12</option>
            </select>
          </div>
      </div>
      <script>
      </script>
      <div class="modal-footer">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
          <label class="form-check-label" for="exampleCheck1" required>Check me out</label>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_sub" class="btn btn-primary" data-success="modal">Submit</button>
        <script>
          $("#add_sub").click(function() {
            alert("Subject updated successfully");
          });
        </script>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include('Panel/script.php');

?>