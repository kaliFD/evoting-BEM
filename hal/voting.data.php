<?php 
	//	include "./conf/connect.php";
	$crud = new crud("localhost","root","","evoting");
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Surat Suara</h3>
			</div>
			<div class="row">
			<div class="panel-body">
				<div class="col-md-12 col-lg-12 text-center" style="margin-bottom: 10px">
					<div class="row">
						<?php 
						$thn = date('Y');
						$data = $crud->select('tb_calon', 'tahun_jab='.$thn, 'ORDER BY no_urut ASC');
						foreach ($data as $result):
						?>
						<div class="col-lg-4">
							<div class="card" style="width: 20rem;">
								<img class="card-img-top" src="img/data/<?=$result['foto_kandidat']?>" width="200px" height="200px" alt="Card image cap">
								<div class="card-body">
									<h6 class="card-title"><?=$result['calon_ketua']." & ".$result['calon_sek']?></h6>
									<?php 
										$nim = $_SESSION['nim'];
										$cek_pilihan = $crud->num("tb_polling", "nim = $nim");
										if($cek_pilihan < 1):
									?>
									<form action="?hal=voting&aksi" method="post">
										<input type="hidden" name="pilihan" value="<?=$result['id_pemilu']?>">
										<input type="submit" class="btn btn-primary" name="pilih" value="Pilih No <?=$result['no_urut']?>">
									</form>
										<?php endif;?>
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
			</div>
			</div>
		</div>
	</div>
<?php
} else {
	if(isset($_POST['pilih'])){
		$kode_otp = '';
    for ($i=0; $i < 6; $i++) {
      $karakter_pass = "1234567890";
      $acak_pass = rand(0, strlen($karakter_pass)-1);
      $kode_otp .= $karakter_pass{$acak_pass};
		}
		$crud->updateSingel('tb_user', 'otp='.$kode_otp,'nim='.$_SESSION['nim']);
		$sms = array('DestinationNumber' => $_SESSION['nomor'], 
									'TextDecoded'=> 'KODE OTP = "'.$kode_otp.'"');
		$crud->insert('outbox', $sms);
	?>
	<div class="col-md-12 col-lg-12 text-center" style="margin-bottom: 10px">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Konfirmasi pilihan </h3>
		</div>
		<div class="row">
			<div class="panel-body">
				<form action="" method="post">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-lg-3" style="margin-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:47px;">OTP</span>
						</div>
						<div class="col-lg-3">
							<input type="text" class="form-control" name="otp" placeholder="Masukkan kode OTP" aria-describedby="sizing-addon3">
						</div>
						<div class="col-lg-3">
							<input type="submit" class="btn btn-success" id="simpan" name="konfirm" value="Konfirmasi">
						</div>
							<input type="hidden" name="id_pemilu" value="<?=$_POST['pilihan']?>">
					</div>
				
				</form>
			</div>
		</div>
	</div>
	</div>
<?php
	}elseif(isset($_POST['konfirm'])){
		$pilihan=$_POST['id_pemilu'];
		$nim = $_SESSION['nim'];
		$otp = $_POST['otp'];
		$cek_otp = $crud->num('tb_user','otp="'.$otp.'" AND nim="'.$nim.'"');
		$cek_pilihan = $crud->num("tb_polling", "nim = $nim");
		if($cek_pilihan > 0){
			?>
			<script>
				window.history.back();
			</script>
			<?php
		}else{
			if ($cek_otp > 0){
				$data = array('id_pemilu' => $pilihan,
											'nim'=> $nim );
				$simpan = $crud->insert('tb_polling',$data);
				?>
				<script>
					alert('Terimakasih atas Partisipasinya');
					document.location.href="?hal=voting";
				</script>
				<?php
			}else{
				?>
					<script>
						alert('Kode otp yang anda masukkan salah silahkan ulangi');
						window.history.back();
					</script>
					<?php
			}
		}
	}
}
?>