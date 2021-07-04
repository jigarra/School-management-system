<?php
include('Panel/header.php');
include('Panel/navbar.php');
include('Panel/topbar.php');
?>


<div class="container ">
    <div class="card">
        <div class="card-header bg-success text-white">
            Assignment Submission
        </div>
        <div class="card-body">
            <h5 class="card-title">English</h5>
            <p class="card-text">Available till 29/3/2020</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">submit</a>
        </div>
    </div>
</div>

<!-- work -->
<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-success text-white">
            Home work Submission
        </div>
        <div class="card-body">
            <h5 class="card-title">English</h5>
            <p class="card-text">Available till 29/3/2020</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">submit</a>
        </div>
    </div>
</div>

<!-- Assignment Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">You can Upload pdf , doc , img etc</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" required>
                    </div>
                    <div class="modal-footer">
                        <div class="form-check align-items-left">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="assign" class="btn btn-primary" data-success="modal">Submit</button>
                        <script>
                            $("#assign").click(function() {
                                alert("Your homework submitted successfully.");

                            });
                        </script>
                </form>
            </div>
            <!--And-->

            <!-- homework Modal -->
            <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Upload file</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">You can Upload pdf , doc , img etc</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" required>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-check align-items-left">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="assign" class="btn btn-primary" data-success="modal">Submit</button>
                                    <script>
                                        $("#assign").click(function() {
                                            alert("Your assignment submitted successfully.");
                                        });
                                    </script>
                            </form>
                        </div>
                        <!--And-->

                        <?php
                        include('Panel/script.php');
                        ?>