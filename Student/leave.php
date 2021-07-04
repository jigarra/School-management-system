<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Leave Application</h1>
</div>
<form class="form-horizontal">
  <fieldset>

    <!-- Text input-->

    <div class="form-group">
      <label class="col-md-4 control-label" for="Name">Roll no</label>
      <div class="col-md-4">
        <input id="rollno" name="roll no" type="number" placeholder="Enter Roll No." class="form-control input-md" required>

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="Name">Name</label>
      <div class="col-md-4">
        <input id="Name" name="Name" type="text" placeholder="Enater Name" class="form-control input-md" required>

      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="Totalleaverequired">Total leave required</label>
      <div class="col-md-4">
        <input id="Totalleaverequired" name="Totalleaverequired" type="text" placeholder="Enter day" class="form-control input-md" required="">

      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="Pleaseselectthetypeofleave.">Please select the type of leave.</label>
      <div class="col-md-4">
        <select id="Pleaseselectthetypeofleave." name="Pleaseselectthetypeofleave." class="form-control">
          <option value="1">Sick Leave (Illness or Injury)</option>
          <option value="2">Personal Leave</option>
          <option value="3">Emergency Leave</option>
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="Leaverequiredfrom">Leave required from (Date)</label>
      <div class="col-md-4">
        <input id="Leaverequiredfrom" name="Leaverequiredfrom" type="text" placeholder="Enater Date" class="form-control input-md">
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="Leaverequiredfrom"> To from (Date)</label>
        <div class="col-md-4">
          <input id="Leaverequiredfrom" name="Leaverequiredfrom" type="text" placeholder="Enater Date" class="form-control input-md">

        </div>
      </div>
      <!-- Textarea -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="ReasonforLeave">Reason for Leave</label>
        <div class="col-md-4">
          <textarea class="form-control" id="ReasonforLeave" name="ReasonforLeave"></textarea>
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-4">
          <button type="submit" id="sub_leave" name="submit" class="btn btn-primary">Submit</button>
        </div>
        <script>
          $("#sub_leave").click(function() {
            alert("apply Successfully."); 
          });
        </script>
      </div>

  </fieldset>
</form>


<?php
include('Panel/script.php');
?>