<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Student Notice</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download fa-sm text-white-50"></i>Student Notice</a>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Student Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <form action="profile.php" method="POST">
            <div class="row py-2">
              <div class="col">
                <label for="Fname">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter Notice Title" required="Fname">
              </div>
              <div class="col">
                <label for="  Lname">Notice Subject </label>
                <input type="text" class="form-control" id="subject" placeholder="Enter Notice Subject" required>
              </div>
            </div>
            <div class="form-group">
              <label for="FormControlTextarea1">Type Here</label>
              <textarea class="form-control" id="FormControlTextarea1" rows="3" required></textarea>
            </div>
            <div class=" form-group">
              <label for="FormControlTextarea1">Notice Date</label>
              <input type="date" class="form-control" id="notice_date" placeholder="Notice Datee" required>
              <!-- Date End -->
            </div>
      </div>

      <div class="modal-footer">
        <div class="form-check align-items-left">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="teacher_notice" class="btn btn-primary" data-success="modal">Submit</button>
        <script>
          $("#teacher_notice").click(function() {
            alert("Notice updated successfully");

          });
        </script>
        </form>
      </div>
    </div>
  </div>
</div>

<!--And-->


<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>1.<br></span>regarding attendence<span>17/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Student Notice</h5>
    <p class="card-text">all students are required to attend all lectures.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>2.<br></span>regarding playground<span>18/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Student Notice</h5>
    <p class="card-text">all students are required to attend all lectures.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>3.<br></span>regarding exams<span>19/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Exam notice</h5>
    <p class="card-text">be prepare for exams. exams will be taken offline.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>4.<br></span>regarding attendence<span>20/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">attendence notice</h5>
    <p class="card-text">all students are required to attend all lectures.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>5.<br></span>regarding playground<span>20/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Student notice</h5>
    <p class="card-text">all students are strictly warned to play very carefully at school play groung.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>6.<br></span>regarding exams<span>20/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">exam notice</h5>
    <p class="card-text">be prepare for exams. exams will be taken offline.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>7.<br></span>regarding attendence<span>20/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">attendence notice</h5>
    <p class="card-text">all students are required to attend all lectures.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>8.<br></span>regarding exams<span>20/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">exams notice</h5>
    <p class="card-text">be prepare for exams. exams will be taken offline.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>9.<br></span>regarding playground<span>20/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">playground notice</h5>
    <p class="card-text">all students are strictly warned to play very carefully at school play ground.</p>
  </div>
</div>

<!-- NOtice data  -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">
    <span>10.<br></span>regarding attendence<span>20/3/2021</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">attendence notice</h5>
    <p class="card-text">all students are required to attend all lectures.</p>
  </div>
</div>

<?php
include('Panel/script.php');
?>