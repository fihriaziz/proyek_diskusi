<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>diskusCiC</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-theme.min.css')?>">
	<script type="text/javascript">
		function cek_notif() {
             xmlhttp = new XMLHttpRequest();
             xmlhttp.open("GET","<?php echo site_url('Main/notif_cek'); ?>",false);
             xmlhttp.send(null);
//                 console.log(xmlhttp.responseText);
//                document.getElementById("getdata").innerHTML = Date();
            document.getElementById("notif").innerHTML = xmlhttp.responseText;
        }
        setInterval(function () {
            cek_notif();
        }, 5000);
	</script>
</head>
<body>
<div class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo base_url('Main')?>" class="navbar-brand"><img src="<?php echo base_url('assets/pic_sys/logo.png')?>" style="width: 100px; height: 30px;"></a>
		</div>

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_url('Main')?>">Home</a></li>
				<li class="dropdown" id="notif">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Notification<span class="label label-pill label-danger" id="count"></span></a>

					<ul class="dropdown-menu"></ul>
				</li>
				<li class="active"><a href="<?php echo base_url('Main/profile')?>">Profile</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url('Main/all_diskusi')?>">Semua Diskusi</a></li>
						<li><a href="<?php echo base_url('Main/logout')?>">Logout</a></li>
					</ul>
				</li>
			</ul>
			
			<form class="navbar-form navbar-right" method="get" action="<?php echo site_url('Main/cari')?>">
				<div class="form-group">
					<input type="text" name="cari" class="form-control" placeholder="Cari Diskusi..">
				</div>
				<button type="submit" class="btn btn-default">Cari</button>
			</form>
		</div>
		
	</div>
	
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">PROFILE USER</div>
				<div class="panel-body">
					<div class="col-md-7 col-sm-12 col-xs-12">
						<div class="panel-body">
							<div class="jumbotron" style="background-color: powderblue">
								<div class="container" style="padding: 2px;">
									<?php $row = $data_mhs->result(); ?>
									<h2>DATA USER</h2>
									<table class="table table-hover col-sm-12 col-xs-12" >
										<?php
										if($data_mhs->num_rows()>0){
											foreach($data_mhs->result() as $row){
												$id1 = $this->session->userdata('id_user');
												$id2 = $row->id_user;
												?>
												<?php $foto = $row->foto; ?>
											<tr class="active">
												<td><pre>NIM			:<?php echo $row->nim; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Nama			:<?php echo $row->nama; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Jenis Kelamin		:<?php echo $row->jk; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Status			:<?php echo $row->status; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Prodi			:<?php echo $row->prodi; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Semester		:<?php echo $row->semester; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>E-mail			:<?php echo $row->email; ?> <?php if($id1==$id2){ ?><a href="" data-toggle="modal" data-target="#modal-email" style="float: right;">Edit</a><?php } ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre style="word-wrap: break-word;">Alamat			:<?php echo $row->alamat; ?></pre></td>
											</tr>
											<?php
											}
										}else if($data_dsn->num_rows()>0){
											foreach($data_dsn->result() as $row){
												$id1 = $this->session->userdata('id_user');
												$id2 = $row->id_user;
												?>
												<?php $foto = $row->foto; ?>
											<tr class="active">
												<td><pre>NIP		:<?php echo $row->nip; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Nama		:<?php echo $row->nama; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Jenis Kelamin		:<?php echo $row->jk; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Status			:<?php echo $row->status; ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>E-mail		:<?php echo $row->email; ?> <?php if($id1==$id2){ ?><a href="" data-toggle="modal" data-target="#modal-email" style="float: right;">Edit</a><?php } ?></pre></td>
											</tr>
											<tr class="active">
												<td><pre>Alamat		:<?php echo $row->alamat; ?></pre></td>
											</tr>
											<?php
											}
										}else{
										?>
											<tr>
												<td colspan="3">No Data Found</td>
											</tr>
										<?php
										}
										?>
									</table>
									<div class="modal fade" id="modal-email">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<?php echo form_open_multipart('Main/ganti_email');?>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-tittle"><center>Ubah Alamat Email</center></h3>
													</div>
													<div class="modal-body">
														<?php foreach($data_user->result() as $u){?>
														<input type="hidden" name="id_user" value="<?php echo $u->id_user;?>">
														<div class="form-group">
															<label>Email Baru</label>
															<input type="text" name="email" class="form-control" required>
														</div>
														<?php } ?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
														<button type="submit" class="btn btn-primary">Submit</button>
													</div>
													<?php echo form_close();?>
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="panel-body">
							<div class="jumbotron" style="background-color: powderblue">
								<div class="container">
									<!-- foto profile -->
									<div class="form-group">
										<a href="#" class="thumbnail">
											<img src="<?php echo base_url('./assets/profile/'.$foto)?>" style="height: 200px; width: 250px;">
										</a>
									<!-- end of foto profile -->

										<?php foreach($data_user->result() as $m){
										$id_profil = $m->id_user;
										$my_id = $this->session->userdata('id_user');
										if($id_profil==$my_id){?>

										<!-- tombol ganti foto -->
										<div class="form-group">
											<center><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal-foto">Ganti Foto</button></center>
											<center><span><?php echo '<label class="text-danger">' .$this->session->flashdata('error');?></span></center>
											<div class="modal fade" id="modal-foto">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<?php echo form_open_multipart('Main/ganti_foto');?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h3 class="modal-tittle">Ganti Foto Profile</h3>
														</div>
														<div class="modal-body">
															<!-- <?php echo form_upload('userfile'); ?> -->
															<input type="file" name="userfile" required>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
															<button type="submit" class="btn btn-primary">Submit</button>
														</div>
														<?php echo form_close();?>
													</div>
												</div>
											</div>
										</div>
										<?php } } ?>
										<!-- end of ganti foto -->

									</div>
									<!-- informasi user -->
									<div class="form-group">
										<table class="table table-hover">
											<tr>
												<td>Diskusi yang Dibuat</td>
												<td>: <?php echo $diskusi; ?></td>
											</tr>
											<tr>
												<td>Komentar Yang Dibuat</td>
												<td>: <?php echo $komen; ?></td>
											</tr>
										</table>
									</div>
									<!-- end of informasi user -->

									<!-- tombol lihat diskusi yang dibuat user -->
									<div class="form-group">
										<?php foreach($data_user->result() as $m){?>
										<a href="<?php echo base_url('Main/diskusiku/'.$m->id_user)?>"><button type="submit" class="btn btn-info form-control">Lihat Diskusi Yang Dibuat</button></a>
									</div>
									<!-- end of tombol lihat diskusi -->

									<!-- tombol yang muncul bila melihat profile user yang login -->
									<?php if($id_profil==$my_id){ ?>
									<!-- ganti username dan password -->
									<div class="form-group">
										<button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#modal-pass">Ganti Username & Password</button>
										<div class="modal fade" id="modal-pass">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<?php echo form_open_multipart('Main/ganti_userpass');?>
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-tittle"><center>Ganti Username & Password</center></h3>
													</div>
													<div class="modal-body">
														<?php foreach($data_user->result() as $u){?>
														<input type="hidden" name="id_user" value="<?php echo $my_id;?>">
														<div class="form-group">
															<label>Username</label>
															<input type="text" name="username" class="form-control" value="<?php echo $u->username;?>" required>
														</div>
														<div class="form-group">
															<label>Password</label>
															<input type="password" name="pass" class="form-control" value="<?php echo $u->password;?>" required>
														</div>
														<?php } ?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
														<button type="submit" class="btn btn-primary">Submit</button>
													</div>
													<?php echo form_close();?>
												</div>
											</div>
										</div>
											<center><span><?php echo '<label class="text-info">' .$this->session->flashdata('notif');?></span></center>
									</div>
									<!-- end of tombol ganti username dan password -->

									<!-- tombol logout -->
									<div class="form-group">
										<a href="<?php echo base_url('Main/logout')?>"><button type="submit" class="btn btn-warning form-control">Logout</button></a>
									</div>
									<!-- end of tombol logout -->
									<?php } } ?>
									<!-- end tombol yang muncul bila melihat profile user yang login -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<footer>
	<p style="text-align: right">Copyright &copy2017 STMIK CIC</p>
</footer>

</div>



<script src="<?php echo base_url('assets/bootstrap/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>