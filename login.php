<?php
$menu="login";
include_once './php/include/header.html';
if (isset($_GET["LOGOUT"])) {
	session_destroy();
	session_unset();
}
if (isset( $_SESSION['USER'])) {
	header("Location:Admin/");
}
?>
<!-- END nav -->


<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6 text-center mb-1">
				<h2 class="heading-section">Welcome to Animals</h2>
			</div>
		</div>
		<div class="row justify-content-center">

			<div class="col-md-6">
				<div class="wrapper">

					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-3">Login</h3>
								<?php
									if (isset($_POST["login"])) {
										$username=(isset($_POST["username"]))?$_POST["username"]:null;
										$password=(isset($_POST["password"]))?$_POST["password"]:null;
										if ($username!=null && $password!=null) {
											$auth=$app->login($username, $password);
											// User or password Incorrect
											if ($auth==true) {
												header("Location:Admin/");
											}
											else {
											echo '<p class="text-danger">User or password Incorrect</p>';
											}
										}
										
									}
									
									

								?>
								<form method="POST" action="#" id="contactForm" name="contactForm" class="contactForm">
									<div class="row">
										
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="email">Username</label>
												<input type="text" class="form-control" name="username" id="email"
													placeholder="Username" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="password">Password</label>
												<input type="password" class="form-control" name="password" id="password"
													placeholder="Password" required>
											</div>
										</div>


										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" value="Log In" name="login" class="btn btn-primary ">
												<div class="submitting"></div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<a href="register.php">Register</a>
											</div>
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
</section>


<?php
	require_once './php/include/footer.html';
?>