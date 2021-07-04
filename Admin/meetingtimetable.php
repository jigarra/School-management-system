<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');

?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Event Time-table</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download fa-sm text-white-50"></i>Event Time-table</a>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>1.</span> <br>Teacher's day<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For Teacher's day</h5>
    <p class="card-text">all students are invited in teacher's day celebration.</p>
  </div>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>2.</span> <br>National sports day<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For National sports day</h5>
    <p class="card-text">all students are invited in National sports day celebration.</p>
  </div>
</div>


<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>3.</span> <br>National Education Day<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For National Education Day</h5>
    <p class="card-text">all students are invited in National Education Day celebration.</p>
  </div>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>4.</span> <br>International Conference<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For International Conference</h5>
    <p class="card-text">all students are invited in International Conference celebration.</p>
  </div>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>5.</span> <br>International Conference<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For International Conference</h5>
    <p class="card-text">all students are invited in International Conference celebration.</p>
  </div>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>6.</span> <br>Cricket Tournament<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For Cricket Tournament</h5>
    <p class="card-text">all students are invited in Cricket Tournament celebration.</p>
  </div>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>7.</span> <br>volley ball tournament<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For volley ball tournament</h5>
    <p class="card-text">all students are invited in volley ball tournament celebration.</p>
  </div>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>8.</span> <br>Running Event<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For National Running Event</h5>
    <p class="card-text">all students are invited in Running Event celebration.</p>
  </div>
</div>

<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>9.</span> <br>Sport festival<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For Sport festival  Event</h5>
    <p class="card-text">all students are invited in Sport festival celebration.</p>
  </div>
</div>


<!-- Notice  -->
<div class="card">
  <div class="card-header bg-success text-white">
   <span>10.</span> <br>Holi festival<br><span>24/10/2020</span>
  </div>
  <div class="card-body">
    <h5 class="card-title text-success">Meeting For National Running Event</h5>
    <p class="card-text">all students are invited in Holi festival celebration.</p>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Event Time-table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <form action="profile.php" method="POST">
            <div class="row py-2">
              <div class="col">
                <label for="Eventname">Event Name</label>
                <input type="text" class="form-control" id="title" placeholder="Enter Event Name" required="">
              </div>
              <div class="col">
                <label for="Fname">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter Event title" required="">
              </div>
            </div>
            <div class="row py-2">
              <div class="form-group-col col-md-6">
                <label for="input">Day</label>
                <select id="input" class="form-control" required>
                  <option selected>choose..</option>
                  <option>Sunday</option>
                  <option>Monday</option>
                  <option>Tuesday</option>
                  <option>Wednesday</option>
                  <option>Thursday</option>
                  <option>Friday</option>
                  <option>Saturay</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="FormControlTextarea1">Description</label>
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
          <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="teacher_notice" class="btn btn-primary" data-success="modal">Submit</button>
        <script>
          $("#teacher_notice").click(function() {
            alert("Event time-table Uploaded successfully");

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