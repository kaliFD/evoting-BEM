<?php 
	//	include "./conf/connect.php";
	$crud = new crud("localhost","root","","evoting");
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Data Kandidat</h3>
			</div>
			<div class="row">
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=data_kandidat&aksi" method="post"><button type="submit" name="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table class="table table-striped table-bordered data datatable-sms ">
				  <thead>
				    <tr>
				    	<th>No</th>
				    	<th>No Urut Kandidat</th>
				    	<th>Nama Ketua Kandidat</th>
				    	<th>Nama Sekretaris</th>
				    	<th>Tahun Jabatan</th>
				    	<th>Nama Foto Kandidat</th>
				    	<th>Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
			<?php
			$data=$crud->num("tb_calon");
			if($data>0){
				$no=1;
				$row=$crud->select("tb_calon");
				foreach ($row as $list) {
					?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$list['no_urut']?></td>
						<td><?=$list['calon_ketua']?></td>
						<td><?=$list['calon_sek']?></td>
						<td><?=$list['tahun_jab']?></td>
						<td><?=$list['foto_kandidat']?></td>
						<td style="text-align:center" width="15%">
							<form action="?hal=data_kandidat&aksi" method="post">
								<input type="hidden" value="<?=$list['id_pemilu']?>" name="kode">
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
		$list=$crud->select("tb_calon","no_urut=".$no_urut);
		?>
			<form action="?hal=data_kandidat&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Ubah Data Kandidat</h3>
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
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:47px;">Nomor Urut Calon</span>
						</div>
						<div class="col-md-9">
						  	<input type="number" class="form-control" value="<?=$list[0]['no_urut']?>" readonly required pattern="^[0-9]{5,18}$" placeholder="Nomor Urut Kandidat" aria-describedby="sizing-addon3">
						  	<input type="hidden" name="nip" value="<?=$list[0]['no_urut']?>">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Nama Calon Ketua</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="calon_ketua" class="form-control" value="<?=$list[0]['calon_ketua']?>" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Calon Ketua" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Nama Calon Sekertaris</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="calon_sek" class="form-control" value="<?=$list[0]['calon_sek']?>" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Calon Sekertaris" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">							 
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:115px">Tahun Jabatan</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="calon_ketua" class="form-control" value="<?=$list[0]['calon_ketua']?>" required  placeholder="Nama Calon Ketua" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">							 
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:115px">Upload Foto</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="foto_kandidat" class="form-control"  aria-describedby="sizing-addon3">
						</div>
					</div>
				</div>
			</div>
			</form>
	<?php
	}elseif (isset($_POST['hapus'])) {
		$id_pemilu=$_POST['kode'];
		$crud->delete("tb_calon","id_pemilu='$id_pemilu'");
		echo '
			<script type="text/javascript">
				document.location="?hal=data_kandidat";
			</script>';
	}elseif (isset($_POST['tambah'])) {
		?>
			<form action="?hal=data_kandidat&aksi" method="post" enctype="multipart/form-data">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i> Halaman Tambah Data Kandidat</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-8">
						</div>
						<div class="col-md-4" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success col-md-6 pull-right" id="simpan" name="simpan" value="Simpan">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" style="padding-right:47px;">Nomor Urut Kandidat</span>
						</div>
						<div class="col-md-9">
						  	<input type="number" class="form-control" name="no_urut" required pattern="^[0-9]{5,18}$" placeholder="Nomor Urut Kandidat" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Nama Calon Ketua</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="calon_ketua" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama calon ketua" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Nama Calon Sekertaris</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="calon_sek" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama calon sekertaris" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:87px">Tahun Jabatan</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="tahun_jab" class="form-control" placeholder="Taun Jabatan" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="margin-top: 5px">							 
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:115px">Upload Foto</span>
						</div>
						<div class="col-md-9">
							<input type="file" name="foto_kandidat" class="form-control"  aria-describedby="sizing-addon3">
						</div>
				</div>
			</div>
			</form>
	<?php
		
	}elseif(isset($_POST['simpan'])){
		$no_urut = $_POST['no_urut'];
		$calon_ketua = $_POST['calon_ketua'];
		$calon_sek = $_POST['calon_sek'];
		$tahun_jab = $_POST['tahun_jab'];
		$nama_gambar = $_FILES['foto_kandidat']['name'];
		$error = $_FILES['foto_kandidat']['error'];
		$tmp_gambar = $_FILES['foto_kandidat']['tmp_name'];
		$ekstensi_valid = ['jpg','jpeg','png'];
		$ekstensi_gambar = explode(".",$nama_gambar);
		$ekstensi_gambar = strtolower(end($ekstensi_gambar));
		if ($error === 4){
			?>
			<script> document.localhost.href='../?menu=foto_kandidat&aksi=tambah': alert('pilih gambar terlebih dahulu !);</script>
			<?php
		}elseif(!in_array($ekstensi_gambar, $ekstensi_valid)){
			?>
			<script> document.localhost.href='../?menu=foto_kandidat&aksi=tambah': alert('File yang Anda Upload bukan gambar !);</script>
			<?php
		}else{
			$nama_baru = uniqid();
			$nama_baru .=".";
			$nama_baru .= $ekstensi_gambar;
			move_uploaded_file($tmp_gambar,"img/data/".$nama_baru);
			$data= array('no_urut'=>$no_urut,
					'calon_ketua'=> $calon_ketua, 
					'calon_sek'=> $calon_sek, 
					'tahun_jab'=>$tahun_jab,
					'foto_kandidat'=>$nama_baru);
			$simpan=$crud->insert("tb_calon",$data);
			echo '
				<script type="text/javascript">
					document.location="?hal=data_kandidat";
					alert("berhasil menyimpan!!");
				</script>
			';
		} 
	}elseif(isset($_POST['update'])){
		$no_urut=$_POST['no_urut'];
		$calon_ketua=$_POST['calon_ketua'];
		$calon_sek=$_POST['calon_sek'];
		$tahun_jab=$_POST['tahun_jab'];
		$id_pemilu=$_POST['id_pemilu'];
		$data= array('no_urut'=>$no_urut,
					'calon_ketua'=> $calon_ketua, 
					'calon_sek'=> $calon_sek, 
					'tahun_jab'=>$tahun_jab,
					'id_pemilu'=> $id_pemilu,);
		$simpan=$crud->update("tb_calon",$data,"no_urut='$no_urut'");
			echo '
				<script type="text/javascript">
					document.location="?hal=pengguna";
					alert("berhasil mengupdate!!");
				</script>
			';
	}

}
?>