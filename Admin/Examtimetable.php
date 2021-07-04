<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');

?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Exam Time-table</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download fa-sm text-white-50"></i>ExamTime-table</a>
</div>

<form action="result.php" method="POST">
  <div class="row py-2">
    <!-- <div class="col">
      <label for="number">Student Roll No.</label>
      <input type="number" class="form-control" id="rollno" placeholder="Roll NO." required="">
    </div> -->
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


<table class="table">
  <thead>
    <tr>
      <th scope="col">Moodle time-table</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><img src="../admin/img/examtable.com" class="img-fluid" alt="Responsive image"></td>
    </tr>
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Exam Time-table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate action="Examtimetable.php" method="POST">
          <div class="form-group">
            <label>Roll no.</label>
            <input type="number" class="form-control" id="exampleModalCenter" placeholder="Roll NO." aria-required="true">
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
              <option>11com.</option>
              <option>12com.</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Uplode Time Table</label>
            <input type="file" class="form-control-file" id="exampleModalCenter" aria-required="true" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" name="submitexm" id="submitexm" class="btn btn-primary" data-success="modal">Uplode</button>
      </div>
    </div>
  </div>
</div>
<script>
  $("#submitexm").click(function() {
    alert("Time-Table uploaded successfully.");
  });
</script>
<?php
include('Panel/script.php');

include('Panel/footer.php');

?>