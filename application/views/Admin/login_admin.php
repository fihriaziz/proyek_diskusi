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
	<div class="row">
		<div class="col-lg-4 col-sm-3 col-xs-1"></div>
		<div class="col-lg-4 col-md-5 col-sm-6 col-xs-10">
			<form action="<?php echo base_url('');?>Admin/validasi" method="post">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<center>Form Login Admin</center>
					</div>
					<div class="panel-body">
						
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
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-primary form-control">Login</button>
					<div class="col-sm-2"></div>
					<div class="container-fluid">
						<?php echo '<label class="text-danger">' .$this->session->flashdata('error');?>
					</div>
						
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>