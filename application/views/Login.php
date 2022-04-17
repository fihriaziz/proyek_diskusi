<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login diskusCiC</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-theme.min.css')?>">
</head>
<body>
<div class="container">
	<div class="col-lg-4 col-md-3 col-sm-2"></div>
	<div class="col-lg-4 col-md-6 col-sm-8">
		<div class="jumbotron" style="margin-top: 150px">
			<h3>Login Menu</h3>
			<br>
			<form action="<?php echo base_url('');?>Login/validasi" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
					<span class="text-danger"><?php echo form_error('username');?></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
					<span class="text-danger"><?php echo form_error('password');?></span>					
				</div>
				<button type="submit" class="btn btn-primary form-control">Login</button>
				<?php
				echo '<label class="text-danger">' .$this->session->flashdata('error');
				?>
			</form>
		</div>
	</div>
	<div class="col-lg-4 col-md-3 col-sm-2"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>