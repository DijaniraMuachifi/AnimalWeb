<?php
$menu="login";
include_once './php/include/header.html';
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
								<?php
								if (isset($_POST["register"])) {
									$username = (isset($_POST["username"])) ? $_POST["username"] : null;
									$password = (isset($_POST["password"])) ? $_POST["password"] : null;
									$name = (isset($_POST["name"])) ? $_POST["name"] : null;
									if ($username != null && $password != null && $name != null) {
										$auth = $app->register($name, $username, $password);
										if ($auth==true) {
											header("Location:Admin/");
										} else {
											echo '<p class="text-danger">'.$auth.'</p>';
										}
									}
								}



								?>
								<form method="POST" id="contactForm" name="contactForm" class="contactForm">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="name">Name</label>
												<input type="text" class="form-control" name="name" id="name"
													placeholder="Name" required>
											</div>
										</div>
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

										<div class="col-md-3"></div>
										<div class="col-md-6">
											<div class="form-group">
												<input type="submit" value="Register" name="register" class="btn btn-primary ">
												<div class="submitting"></div>
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