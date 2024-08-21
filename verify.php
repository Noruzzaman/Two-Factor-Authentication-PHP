<?php

	require "mail.php";
	require "functions.php";
	check_login();

	$errors = array();

	if($_SERVER['REQUEST_METHOD'] == "GET" && !check_verified()){

		//send email
		$vars['code'] =  rand(10000,99999);

		//save to database
		$vars['expires'] = (time() + (60 * 10));
		$vars['email'] = $_SESSION['USER']->email;

		$query = "insert into verify (code,expires,email) values (:code,:expires,:email)";
		database_run($query,$vars);

		$message = "your code is " . $vars['code'];
		$subject = "Email verification";
		$recipient = $vars['email'];
		send_mail($recipient,$subject,$message);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(!check_verified()){

			$query = "select * from verify where code = :code && email = :email";
			$vars = array();
			$vars['email'] = $_SESSION['USER']->email;
			$vars['code'] = $_POST['code'];

			$row = database_run($query,$vars);

			if(is_array($row)){
				$row = $row[0];
				$time = time();

				if($row->expires > $time){

					$id = $_SESSION['USER']->id;
					$query = "update users set email_verified = email where id = '$id' limit 1";
					
					database_run($query);

					header("Location: profile.php");
					die;
				}else{
					echo "Code expired";
				}

			}else{
				echo "wrong code";
			}
		}else{
			echo "You're already verified";
		}
	}

?>

<?php include('includes/header.php');
	include('includes/navbar.php');
	
	?>

	

	
	<br><br>



	<div class="py-5">
				<div class="container">
					<div class="row justify-content-center">
					<div class="col-md-6">
							<div class="card shadow">
							<div class="card-header">
								<h5> Verify</h5>
							</div>
							<div class="card-body">
							<div>
			<br>An email was sent to your address. paste the code from the email here<br>
		<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>	
				<?php endforeach;?>
			<?php endif;?>

		</div><br>
		<form method="post">

		<div class="form-group md-3">
																
										<input name="code" type="text"  class="form-control">                       
			</div>


		<br>
 			<br>
			 <div class="form-group">
			<input type="submit" value="Verify" class="btn btn-primary">
			</div>
		</form>
	</div>

							</div>
					</div>
					</div>
				</div>
			</div>





 	