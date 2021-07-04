<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"></h1>
  <a href="../datasms/rlogin.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Generate Report</a>
</div>


<div class="row">
  <div class="col">
    <p>
      <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample1">
        Admin 
      </a>
    </p>
    <!-- Page Heading -->
    <div class="collapse multi-collapse" id="collapseExample">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Profile</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Admin@gmail.com</td>
            <td><a href="">Profile</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

<?php
include('Panel/script.php');
?>