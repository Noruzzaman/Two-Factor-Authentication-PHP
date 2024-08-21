<?php

	require "functions.php";
	check_login();
?>


	

	<?php include('includes/header.php');
	include('includes/navbar.php');
	
	?>






<div class="py-5">
				<div class="container">
					<div class="row justify-content-center">
					<div class="col-md-6">
							<div class="card shadow">
							<div class="card-header">
								<h4> Profile</h4>
							</div>
							<div class="card-body">
							<div class="row justify-content-center">
							<?php if(check_login(false)):?>
							<h5>Hi, <span style=color:blue;> <?=$_SESSION['USER']->username?> </span></h5>

							<img src="img/img_avatar2.png" style="width:310px;height:300px;" alt="Avatar" class="avatar">
							<br><br>
							<?php if(!check_verified()):?>
								<a href="verify.php">
									<button>Verify Profile</button>
								</a>
							<?php endif;?>
						<?php endif;?>

						</div>
								
						</div>
					</div>
					</div>
				</div>
			</div>


 








