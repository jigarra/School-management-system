<?php
include('../student/Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');

?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Student Profile</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download fa-sm text-white-50"></i>Update Profile</a>
</div>
<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt="" />
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        Kshiti Ghelani
                    </h5>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p>Admin1</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>admin1@gmail.com</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>63524 17896</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Date of Birth</label>
                        </div>
                        <div class="col-md-6">
                            <p> 23/01/2001</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address</label>
                        </div>
                        <div class="col-md-6">
                            <p> 207/23, happy welly Ahmedabad 380007</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</form>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Student Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../connection.php" method="POST">
                    <div class="row py-2">
                        <div class="col">
                            <label for="Fname"> First Name</label>
                            <input type="text" class="form-control" name="fname" id="Fname" placeholder="First name" required="Fname">
                        </div>
                        <div class="col">
                            <label for="  Lname"> Last Name</label>
                            <input type="text" class="form-control" name="fname" id="Lname" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FormControlTextarea1">Address</label>
                        <textarea class="form-control" name="address" id="FormControlTextarea1" placeholder="Address" rows="3" required></textarea>
                    </div>
                    <div class=" form-group">
                        <label for="FormControlTextarea1">Mobile No.</label>
                        <input type="number" class="form-control" name="mobileno" placeholder="MobileNumber" id="Lname" required>
                        <!-- Date End -->
                    </div>
                    <div class=" form-group">
                        <label for="FormControlTextarea1">Birth Date:</label>
                        <input type="date" class="form-control" name="bdate" id="Lname" required>
                        <!-- Date End -->
                    </div>
                    
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="submit" id="update_stu" name="submitprofile" class="btn btn-primary">Submit</button>
                <script>
                    $("#update_stu").click(function() {
                        alert("The Form has been Submitted.");

                    });
                </script>
            </div>
            </form>

            <?php
            include('Panel/script.php');
            ?>