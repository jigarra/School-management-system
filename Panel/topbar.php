<!-- Start header -->
<header class="top-navbar">
	<nav class="navbar navbar-expand-lg navbar-light bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">
				<h2>S M S</h2>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbars-host">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
					<!-- <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Course </a>
							<div class="dropdown-menu" aria-labelledby="dropdown-a">
								<a class="dropdown-item" href="course-grid-2.html">Secondary </a>
								<a class="dropdown-item" href="course-grid-3.html"> Higher Secondary </a>
							</div>
						</li> -->
					<li class="nav-item"><a class="nav-link" href="teachers.php">Teachers</a></li>
					<li class="nav-item"><a class="nav-link" href="contactas.php">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a class="hover-btn-new log orange" href="#" data-toggle="modal" data-target="#login"><span>Login</span></a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<!-- End header -->

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header tit-up">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Login</h4>
			</div>
			<div class="modal-body customer-box">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li><a class="active" href="#Slogin" data-toggle="tab">Student Login</a></li>
					<li><a href="#Tlogin" data-toggle="tab">Teacher Login</a></li>
					<li><a href="#Alogin" data-toggle="tab">Admin Login</a></li>
				</ul>
				<!-- Student form -->
				<div class="tab-content">
					<div class="tab-pane active" id="Slogin">
						<form class="form-horizontal" action="student/index.php" method="POST">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="email" class="form-control" name="Studentlogin" id="email1" placeholder="Email" type="text" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" type="password" required="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-10">
									<button type="submit" id="sub_stu" name="submitstudent" class="btn btn-light btn-radius btn-brd grd1" id="Slogin">
										Login
									</button>
									<script>
										$("#sub_stu").click(function() {
											alert("Login Successfully.");

										});
									</script>
									<hr>
									<a class="for-pwd" href="student_register.php">Create Account</a>
									<a class="for-pwd" href="forgetpass.php">Forgot your password?</a>
								</div>
							</div>
						</form>
					</div>

					<!-- Teacher form -->
					<div class="tab-pane" id="Tlogin">
						<form class="form-horizontal" action="teacher/index.php" method="POST">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="email" class="form-control" id="email1" placeholder="Email" type="text" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" type="password" required="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-10">
									<button type="submit" id="sub_tea" name="submitteacher" class="btn btn-light btn-radius btn-brd grd1">
										Login
									</button>
									<script>
										$("#sub_tea").click(function() {
											alert("Login Successfully.");

										});
									</script>
									<hr>
									<a class="for-pwd" href="teacher_register.php">Create Account</a>

									<a class="for-pwd" href="forgetpass.php">Forgot your password?</a>
								</div>
							</div>
						</form>
					</div>
					<!-- Admin form -->
					<div class="tab-pane" id="Alogin">
						<form class="form-horizontal" action="Admin/index.php" method="POST">
							<div class="form-group">
								<div class="col-sm-12">
									<input type="email" class="form-control" id="email1" placeholder="Email" type="text" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" type="password" required="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-10">
									<button type="submit" id="Sunmitform" name="submitadmit" class="btn btn-light btn-radius btn-brd grd1">
										Login
									</button>
									<script>
										$("#Sunmitform").click(function() {
											alert("Login Successfully.");

										});
									</script>
									<hr>

									<a class="for-pwd" href="forgetpass.php">Forgot your password?</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- LOADER -->
<div id="preloader">
	<div class="loader-container">
		<div class="progress-br float shadow">
			<div class="progress__item"></div>
		</div>
	</div>
</div>
<!-- END LOADER -->