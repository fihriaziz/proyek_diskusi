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
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="container-fluid"><img src="<?php echo base_url('assets/pic_sys/login.png')?>" class="col-sm-12 col-xs-12"></div>
			</div>
			<div class="col-sm-12 col-xs-12" style="background-color: #BBB3F7;">
			<div class="col-lg-4 col-sm-3 col-xs-1"></div>
			<div class="col-lg-4 col-md-5 col-sm-6 col-xs-10" style="padding-top: 50px;">
				<form action="<?php echo base_url('');?>Login/validasi" method="post">
					<div class="panel-body" >
						<center>Form Login</center>							
						
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
						<div class="col-sm-2"></div>
						<div class="container-fluid">
							<?php echo '<label class="text-danger">' .$this->session->flashdata('error');?>
						</div><!-- end container fluid -->
					</div><!-- end panel body -->
				</form>
			</div><!-- end col-xs-10 -->
			</div>
		</div><!-- end panel default -->
	</div><!-- end row -->
</div><!-- end container -->


<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>