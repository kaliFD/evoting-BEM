<?php
	require __DIR__ . '/connect.php';
 	$crud = new crud();
	session_start();

 	if (isset($_POST['login'])) {
 		$user = $_POST['username'];
 		$pass = $_POST['password'];
 		$cek = $crud->num("tb_user", "(`user_id` = '$user' OR `nim` = '$user') AND password = '$pass' ");
 		if ($cek > 0) {
 			$data = $crud->select("tb_user", "(`user_id` = '$user' OR `nim` = '$user') AND password = '$pass' ");
 			$_SESSION['level'] = $data[0]['level'];
			 $_SESSION['nim'] = $data[0]['nim'];
			 $mhs = $crud->select("tb_mhs","nim = '$_SESSION[nim]'");
			 if($mhs){
			 $_SESSION['nomor'] = $mhs[0]['no_hp'];
			 }
 			?>
 			<script type="text/javascript">
 				window.location = "../";
 			</script>
 			<?php
 		} else {
 			?>
 			<script type="text/javascript">
 				alert("Maaf, username atau password yang anda masukkan salah !");
 				document.location = "../";
 			</script>
 			<?php
 		}
 	} elseif (isset($_GET['logout'])){
 		session_destroy();
 		?>
		<script type="text/javascript">
			window.location = "../";
		</script>
		<?php
 	}

?>