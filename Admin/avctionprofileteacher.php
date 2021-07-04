<?php
include('../teacher/Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');

?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>

    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-download fa-sm text-white-50"></i>Update Profile</a>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter1"><i class="fas fa-download fa-sm text-white-50"></i>Delete Profile</a>
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
                        Patel Aayush
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
                            <p>Patel Aayush</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>aayush90@gmail.com</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>90909 09090</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Date of Birth</label>
                        </div>
                        <div class="col-md-6">
                            <p>1996-02-18</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Experince</label>
                        </div>
                        <div class="col-md-6">
                            <p>3<span>year</span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address</label>
                        </div>
                        <div class="col-md-6">
                            <p>happy coloney, 201 appartmnet, ahmedabad-360002</p>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Update Teacher Profile</h5>
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
                        </div>
                        <div class="col">
                            <label>Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col">
                            <label for="phone no">Phone Number</label>
                            <input type="tel" class="form-control" id="Lname" placeholder="Phone Number" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                        </div>
                        <div class="form-group-col col-md-6">
                            <label for="input" required>Experience</label>
                            <select id="input" class="form-control">
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
                        <!--Date picker -->
                        <div class=" col">
                            <label for="FormControlTextarea1">Birth Date:</label>
                            <input type="date" class="form-control" id="Lname" placeholder="Last name" required>
                            <!-- Date End -->
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
                    <div class="modal-footer">
                        <center>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="update_tea" class="btn btn-primary" data-success="modal">Submit</button>
                            <script>
                                $("#update_tea").click(function() {
                                    alert("Profile updated successfully");

                                });
                            </script>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Teacher Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="profile.php" method="POST">
                    <div class="row py-2">
                        <div class="col">
                            <label for="Fname">ID</label>
                            <input type="number" class="form-control" id="id" placeholder="Enter Student ID " required="Fname">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" id="deleteprofile" name="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
                <script>
                    $("#deleteprofile").click(function() {
                        alert("Profile updated successfully");

                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php
include('Panel/script.php');
?>