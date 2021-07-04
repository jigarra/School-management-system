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
        <form>
          <div class="form-group">
            <label for="exampleFormControlFile1">Uplode Time Table</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="exam" class="btn btn-primary" data-success="modal">Uplode</button>
        <script>
                                $("#exam").click(function() {
                                    alert("Exam time-table uploaded successfully");

                                });
                            </script>
      </div>
    </div>
  </div>
</div>

<?php
include('Panel/script.php');
?>