<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="refresh" content="30" > -->
	<title>diskusCiC</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-theme.min.css')?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/jquery.js')?>"></script>
<!-- 	<script type="text/javascript">
		$(document).ready(function(){
			var id_diskus = 54;
			//muncul berdasarkan waktu
			setInterval(function(){
				$("#komenan").load("komen.php", {
					id_diskusi: id_diskus
				});
			},2000);
		});

		// $(document).ready(function(){
		// 	$('#komenan').load('komen.php');
		 	// refresh();
		// });

		// function refresh(){
		// 	setTimeout(function(){
		// 		$('#komenan').fadeOut('slow').load('komen.php').fadeIn('slow');
		// 		refresh();
		// 	}, 5000);
		// }

		// $(document).ready(function () {
		// setInterval(function() {
		//     $.get("/Main/komen", function (result) {
		//         $('#komenan').html(result);
		//     });
		// }, 5000);
	</script> -->

	<script type="text/javascript">
		var id_diskusi = <?php echo $this->uri->segment(3) ?>;
		function sendMail() {
             xmlhttp = new XMLHttpRequest();
             xmlhttp.open("GET","<?php echo site_url('Main/komentest/'); ?>" + id_diskusi,false);
             xmlhttp.send(null);
//                 console.log(xmlhttp.responseText);
//                document.getElementById("getdata").innerHTML = Date();
            document.getElementById("result").innerHTML = xmlhttp.responseText;
        }
        setInterval(function () {
            sendMail();
        }, 5000);
	</script>

<!-- 	<script type="text/javascript">
		function count_notif() {
             xmlhttp = new XMLHttpRequest();
             xmlhttp.open("GET","<?php echo site_url('Main/notif_count'); ?>",false);
             xmlhttp.send(null);
//                 console.log(xmlhttp.responseText);
//                document.getElementById("getdata").innerHTML = Date();
            document.getElementById("count").innerHTML = xmlhttp.responseText;
        }
        setInterval(function () {
            count_notif();
        }, 2000);
	</script> -->

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

	<!-- <script>
		$(document).ready(function(){
			var id_diskusi = <?php echo $this->uri->segment(3) ?>;

			//pake tombol
			$("#hapus").click(function(){
				$("#result").load("<?php echo site_url('Main/hapus_komen/'); ?>" + id_diskusi);
			});
		});
	</script> -->
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
				<li><a href="<?php echo base_url('Main/profile')?>">Profile</a></li>
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
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="panel panel-primary panel-body col-sm-12 col-xs-12">
					<?php foreach($diskusi->result() as $r){?>
					<?php $id_diskusi = $r->id_diskusi; ?>
					<ul class="list-group">
						<?php 
						$id_now = $this->session->userdata('id_user');
						$user_diskusi =  $r->id_user;
						if($id_now != $user_diskusi){ ?>
						<div class="dropdown pull-right">
							<a href="" class="dropdown-toggle" data-toggle="dropdown" ><span class="glyphicon glyphicon-option-vertical"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('Main/report_diskusi/'.$id_diskusi);?>">Report Diskusi</a></li>
							</ul>
						</div>
						<?php } ?>	
						<?php echo "<a href='".base_url()."Main/diskusi/".$r->id_diskusi."'><h2 id='test'>".$r->judul."</h2></a>";?>
						<li class="list-group-item">
							<p><?php echo $r->isi;?></p>
						</li>
						<li class="list-group-item">
							<?php 
							if($r->tambahan=="Y"){
								foreach($lampir as $l){
									if($l->is_image == 0){ ?>
										<p>Lampiran : <a href="<?php echo base_url('Main/download/'.$l->id_file);?>"><?php echo $l->nama_file; ?></a></p>
									<?php 
									}else{ ?>
										<center><img src="<?php echo base_url('assets/files/') . $l->nama_file ?>" style="width: 280px; height: 280px;"></center>
										<!-- <center><a href="<?php echo base_url('Main/download/'.$l->id_file);?>">Download</a></center> -->
									<?php
									}
								}
							}else{ ?>
								<p>Lampiran : Tidak Ada Lampiran </p>
							<?php } ?>
						</li>
						<div style="float: left;">
							<?php foreach($mhs->result() as $m){ ?>
							Di Post Oleh : <a href="<?php echo base_url('Main/profil_other/'.$m->id_user); ?>"><?php echo $m->nama; ?></a> 
							<!-- <img src="<?php echo base_url('./assets/profile/'.$m->foto)?>" class="img-circle" style="width: 70px; height: 70px;">
							<a href="<?php echo base_url('Main/profil_other/'.$m->id_user); ?>" style="font-size: 24px;"><?php echo $m->nama; ?></a> -->
							<?php } ?>
						</div>
						<div style="float: right;">
							<?php echo $r->tgl_post;?>
						</div>
					</ul>
					<?php } ?>
				</div>
				<div id="result" class="form-group col-sm-12 col-xs-12 results">
					<h3>Komentar</h3>
					<?php foreach($komen->result() as $k){?>
					<ul class="list-group">
						
						<li class="list-group-item">
							<div class="row">
								<div class="col-sm-1">
									<img src="<?php echo base_url('./assets/profile/'.$k->foto)?>" class="img-circle" style="width: 70px; height: 70px;">
								</div>
								<div class="col-sm-11">
									<?php
									$id_now = $this->session->userdata('id_user');
									$id_komen = $k->id_user; 
									if($id_komen == $id_now){?>
										<div style="float: right;">
											<?php echo "<a href='".base_url()."Main/hapus_komen/".$k->id_diskusi."/".$k->id_komentar."'>Hapus</a>";?>
											<!-- <button id="hapus">Hapus</button> -->
										</div>
									<?php }else{ ?>
										<div style="float: right;">
											<?php echo "<a href='".base_url()."Main/report_komen/".$k->id_diskusi."/".$k->id_komentar."'>Report</a>";?>
											<!-- <button id="hapus">Hapus</button> -->
										</div>
									<?php } ?>
									<?php echo "<a href='".base_url()."Main/profil_other/".$k->id_user."'><h4>".$k->nama."</h4></a>";?>
									<p><?php echo $k->isi_komentar;?></p>
								</div>
							</div>
						</li>
						<?php 
						if($k->is_image == '0'){?>
							<li class="list-group-item">
								<p>Lampiran : <a href="<?php echo base_url('Main/download_lampiran/'.$k->id_komentar);?>"><?php echo $k->lampiran; ?></a></p>
							</li>
						<?php }elseif($k->is_image == '1'){ ?>
							<li class="list-group-item">
								<img src="<?php echo base_url('assets/file_komen/') . $k->lampiran ?>" style="width: 280px; height: 280px;">
							</li>
						<?php } ?>
						<div style="float: right;">
							<?php echo $k->tgl_komentar;?>
						</div>
					</ul><br>
					<?php } ?>
				<!-- <?php 
					// echo $this->pagination->create_links();
				?> -->
				</div>
				

				<form class="form-input" id="myForm" enctype="multipart/form-data">
				<?php $id_user = $this->session->userdata('id_user');?>
				<input type="hidden" name="id_diskusi" value="<?php echo $id_diskusi;?>">
				<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
				<div class="form-group col-sm-10 col-xs-12">
					<textarea class="form-control" rows="4" name="isi_komentar" id="komen"required></textarea>
					<span class='label label-info' id="upload-file-info"></span>
				</div>
				<div class="form-group col-sm-2 col-xs-3">
					<div class="form-group">
						<label class="btn btn-success btn-sm">
						    Browse <input type="file" name="file_komen" style="display: none;" onchange="$('#upload-file-info').html(this.files[0].name)">
						</label>
						
					</div>
					<div class="form-group">
					<button type="submit" class="btn btn-primary btn-sm">Kirim</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		var el = document.getElementById('result');
		el.scrollTop = el.scrollHeight;
		var socket = io('http://127.0.0.1:3000');
		var id_mhs = '<?=$this->session->userdata('id_user')?>';
		socket.emit('cek_online','<?=md5($this->uri->segment(3)*99)?>');
		socket.on('response_komentar',function(id_user,response_saya,response_user){
			if(id_user === id_mhs){
				$('.results').append(response_saya);
			}else{
				$('.results').append(response_user);
			}
		});

		// notifikasi ng kne
		// var public_key = 'rfesrgserge5ggsdr';
		// socket.emit('notifikasi',public_key);
		// socket.on('get_notifikasi',function(response_notifikasi){
		// 	// kode html go nampilaken notif
		// 	alert(response_notifikasi);
		// });

		$(".form-input").submit(function(event){
			event.preventDefault();
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url('Main/kirim_komen')?>',
				data : new FormData(this),
				processData : false,
				contentType : false, 
				success : function(response){
					el.scrollTop = el.scrollHeight;
					var json = JSON.parse(response);
					var array = [json.id_diskusi,json.id_user,json.response_saya,json.response_user];
					$('#komen').val(''); $('#upload-file-info').text('');
					socket.emit('kirim_komentar',array);
					
				}
			});
		});


		// $("#hapus").click(function(event){
		// 	event.preventDefault();
		// 	$.ajax({
		// 		type : 'POST',
		// 		url : '<?php echo site_url('Main/hapus_komen')?>',
		// 		data : new FormData(this),
		// 		processData : false,
		// 		contentType : false, 
		// 		success : function(response){
		// 			el.scrollTop = el.scrollHeight;
		// 			var json = JSON.parse(response);
		// 			var array = [json.id_diskusi,json.id_user,json.response_saya,json.response_user];
		// 			$('#komen').val(''); $('#upload-file-info').text('');
		// 			// socket.emit('hapus_komentar',array);
					
		// 		}
		// 	});
		// });

	});


</script>

<!-- <script>
	$(document).ready(function(){
		function load_unseen_notification(view = ''){
			$.ajax({
				url: '<?php echo site_url('Main/cek_notif')?>',
				metho
			});
		}
	});
</script> -->

<footer>
	<p style="text-align: right">Copyright &copy2017 STMIK CIC</p>
</footer>

</div>



<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/jquery-3.3.1.js')?>"></script>
</body>
</html>