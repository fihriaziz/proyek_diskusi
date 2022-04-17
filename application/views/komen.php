<?php
	include 'dbh.php';
	$id_diskusi = $_POST['id_diskusi'];

	$sql = "SELECT * FROM komentar WHERE id_diskusi = $id_diskusi";
	$result =mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<p>";
			echo $row['isi_komentar'];
			echo "<br>";
			echo $row['id_user'];
			echo "<p>";
		}
	}else{
		echo "Tidak Ada Komen";
	}
?>