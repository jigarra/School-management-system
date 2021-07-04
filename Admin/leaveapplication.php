<?php
include('Panel/header.php');

include('Panel/navbar.php');

include('Panel/topbar.php');
?>


<div class="row">
    <div class="col">
    <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample1">
                TEACHER
            </a>
        </p>
        <!-- Page Heading -->
        <div class="collapse multi-collapse" id="collapseExample">
            <div class="card card-body">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Leave Application</h1>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        Name :<span>Jay Shah</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-success">Personal Leave</h5>
                        <p class="card-text">21/5/2021 to 26/5/2021</p>
                        <p class="card-text">

                            Dear (Recipient’s Name)

                            I am writing this email with reference to my remaining annual leave quota. I am planning to go on a trip to Europe with my family. Thus, I would like to avail my remaining 25 days of annual leave from (Date) to (Date)

                            I have assigned my duties to ( name of a team member) for the current project we are working on. He/She has been working with me and understands the role effectively. Also, I am looking for all the essential inputs required for the project before I leave for the vacation.

                            I request you to consider my leave request. During my absence, I can be reached at my phone number and email id (Email address and contact no).

                            Yours sincerely

                            jay</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <div class="col">
    <p>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
            STUDENT
        </button>
    </p>
        <div class="collapse multi-collapse" id="collapseExample1">
            <div class="card card-body">
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        Name :<span>Rakesh Shah</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-success">Personal Leave</h5>
                        <p class="card-text">21/5/2021 to 26/5/2021</p>
                        <p class="card-text">

                            Subject: Casual leave application

                            Dear (Recipient’s Name)

                            I am writing to request you for a five-day leave from (start date) to (end-date) as I have to urgently attend a medical emergency of a close relative and as he/she is situated in Delhi, I have to be away from the town for five days.

                            I will resume work from (date), and I shall be reachable at my email id (email address) and phone number (contact number). Besides, I have instructed (colleague name) to take care of certain responsibilities during my absence. She/He is well equipped for any emergency or in case any assistance is required.

                            Yours Sincerely,

                            (Your Name)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('Panel/script.php');
?>