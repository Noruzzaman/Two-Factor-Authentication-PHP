<?php  

require "functions.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = login($_POST);

	if(count($errors) == 0)
	{
		header("Location: profile.php");
		die;
	}
}

?>


	<?php include('includes/header.php');
	include('includes/navbar.php');
	
	?>

	<div>
		<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div>




				<div class="py-5">
				<div class="container">
					<div class="row justify-content-center">
					<div class="col-md-6">
							<div class="card shadow">
							<div class="card-header">
								<h5> Login</h5>
							</div>
							<div class="card-body">
								<form method="post">
									
									<div class="form-group md-3">
										<label for="" >Email</label>						
										<input name="email" type="text"  class="form-control">                       
									</div>

									<div class="form-group md-3">
										<label for="" >Password</label>						
										<input name="password" type="text"  class="form-control">                       
									</div>

								
									<div class="form-group">
										<br/>
									<input type="submit" class="btn btn-primary" value="Login">
									</div>
								</form>
							</div>
					</div>
					</div>
				</div>
			</div>
	</div>
