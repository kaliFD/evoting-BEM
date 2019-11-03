<?php 
	//	include "./conf/connect.php";
	$crud = new crud("localhost","root","","evoting");
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Data Pengguna 
				pemilih</h3>
			</div>
			<div class="row">
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=pengguna&aksi" method="post"><button type="submit" name="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"> </span> Tambah Data Pemilih</button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table class="table table-striped table-bordered data datatable-sms ">
				  <thead>
				    <tr>
				    	<th>No</th>
				    	<th>User Id</th>
				    	<th>Password</th>
				    	<th>NIM</th>
				    	<th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
			<?php
			$data=$crud->num("tb_user");
			if($data>0){
				$no=1;
				$row=$crud->select("tb_user");
				foreach ($row as $list) {
					?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$list['user_id']?></td>
						<td><?=$list['password']?></td>
						<td><?=$list['nim']?></td>
						<td style="text-align:center" width="15%">
							<form action="?hal=pengguna&aksi" method="post">
								<input type="hidden" value="<?=$list['user_id']?>" name="kode">
								<button type="submit" name="edit" class="btn btn-warning radius"><span class="glyphicon glyphicon-pencil"> </span></button> 
								<button type="submit" name="hapus" onClick="return confirm('Yakin ingin menghapus data ini?');" class="btn btn-danger radius"><span class="glyphicon glyphicon-trash"> </span></button>
							</form>
						</td>
					</tr>
					<?php
				}
			}
			?>
				  </tbody>
				  </table>
				</div>
			</div>
		</div>
	</div>
<?php
} else {
	if(isset($_POST['edit'])) {
		$no_urut=$_POST['kode'];
		$list=$crud->select("tb_user","user_id=".$no_urut);
		?>
			<form action="?hal=pengguna&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Ubah Data Pemilih</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-8">
						</div>
						<div class="col-md-4" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success col-lg-6" style="padding-left: 5px" id="reset" name="reset" value="Reset PIN"> 
							<input type="submit" class="btn btn-success col-md-6 pull-right" id="update" name="update" value="Update">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:47px;">User Id</span>
						</div>
						<div class="col-md-9">
						  	<input type="number" class="form-control" value="<?=$list[0]['user_id']?>" readonly required pattern="^[0-9]{5,18}$" placeholder="Nomor Urut Kandidat" aria-describedby="sizing-addon3">
						  	<input type="hidden" name="user_id" value="<?=$list[0]['no_urut']?>">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Password</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="password" class="form-control" value="<?=$list[0]['password']?>" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="password" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">NIM</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nim" class="form-control" value="<?=$list[0]['nim']?>" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="NIM" aria-describedby="sizing-addon3">
						</div>
					</div>
				</div>
			</div>
			</form>
	<?php
	}elseif (isset($_POST['hapus'])) {
		$user_id=$_POST['kode'];
		$crud->delete("tb_user","user_id='$user_id'");
		echo '
			<script type="text/javascript">
				document.location="?hal=pengguna";
			</script>';
	}elseif (isset($_POST['tambah'])) {
		?>
			<form action="?hal=pengguna&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i> Halaman Tambah Data Pemilih</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-8">
						</div>
						<div class="col-md-4" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success col-md-6 pull-right" id="simpan" name="simpan" value="Simpan">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:47px;">User ID</span>
						</div>
						<div class="col-md-9">
						  	<input type="number" class="form-control" name="user_id" required pattern="^[0-9]{5,18}$" placeholder="User Id" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Password</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="password" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="password" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">NIM</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nim" class="form-control" required placeholder="nim" aria-describedby="sizing-addon3">
						</div>
				</div>
			</div>
			</form>
	<?php
		
	}elseif(isset($_POST['simpan'])){
		$user_id=$_POST['user_id'];
		$password=$_POST['password'];
		$nim=$_POST['nim'];
		if ($cek<1){
			$data= array('user_id'=>$user_id,
						'password'=> $password, 
						'nim'=> $nim, );
			$cek=$crud->num("tb_user","user_id='$user_id'");
			if($cek<1){
				$simpan=$crud->insert("tb_user",$data);
					echo '
						<script type="text/javascript">
							document.location="?hal=pengguna";
							alert("berhasil menyimpan!!");
						</script>
					';
				
			}else{
				echo '
					<script type="text/javascript">
						alert("username yang anda masukkan sudah ada!!");
					</script>
				';
			}
		} else {
			?>
			<script type="text/javascript">
				alert("Nomor telepon sudah terdaftar!");
			</script>
			<?php
		}
	}elseif(isset($_POST['update'])){
		$user_id=$_POST['user_id'];
		$password=$_POST['password'];
		$nim=$_POST['nim'];
		$data= array('user_id'=>$user_id,
					'password'=> $password, 
					'nim'=> $nim, );
		$simpan=$crud->update("tb_user",$data,"user_id='$user_id'");
			echo '
				<script type="text/javascript">
					document.location="?hal=pengguna";
					alert("berhasil mengupdate!!");
				</script>
			';
	}

}
?>