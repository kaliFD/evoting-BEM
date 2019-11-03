<?php
	if(isset($_GET['hal'])){
		if($_GET['hal'] == "inbox"){
			include "hal/inbox.php";
		}elseif ($_GET['hal'] == "mahasiswa") {
			include "hal/mahasiswa.data.php";
		}elseif ($_GET['hal'] == "pengguna") {
			include "hal/pengguna.php";
		}elseif ($_GET['hal'] == "data_kandidat") {
			include "hal/kandidat.data.php";
		}elseif ($_GET['hal'] == "polling") {
			include "hal/polling.data.php";
		}elseif ($_GET['hal'] == "voting") {
			include "hal/voting.data.php";
		}elseif ($_GET['hal'] == "profile") {
			include "hal/profile.data.php";
		}else{
			include "hal/utama.php";
		}
	}else{
		include "hal/utama.php";
	}

?>
