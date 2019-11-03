
<?php
	//include "./conf/conn.php";
	//include "./conf/connect.php";
	$crud = new crud();
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i> Data Mahasiswa</h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=mahasiswa&aksi" method="post"><button type="submit" name="tambah" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"> </span> Tambah Data </button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table id="dt-mahasiswa" class="table table-striped table-bordered data">
				  <thead>
				    <tr>
				    	<th></th>
				    	<th>NIM</th>
				    	<th>Nama</th>
				    	<th>Prodi</th>
				    	<th>Semester</th>
				    	<th>No HP</th>
				    	<th width="100">Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
			<?php
			$no=1;
			$row=$crud->select("tb_mhs");
			foreach ($row as $list) {
				?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$list['nim']?></td>
						<td><?=$list['nama_mhs']?></td>
						<td><?=$list['prodi']?></td>
						<td><?=$list['semester']?></td>
						<td><?=$list['no_hp']?></td>
						<td style="text-align:center"><div class="btn-group" role="group">
						  <form action="?hal=mahasiswa&aksi" method="post">
						  <input type="hidden" name="kode" value="<?=$list['nim']?>">
						  	<button type="submit" name="edit" class="btn btn-warning radius"><span class="glyphicon glyphicon-pencil"> </span></button>
						  	<button type="submit" name="hapus" class="btn btn-danger radius" onClick="return confirm('Yakin ingin menghapus data ini?');"><span class="glyphicon glyphicon-trash"> </span></button> 
						  </form>
						</td>
					</tr>

					<!--modal lihat-->
					<div class="modal fade" id="my<?=$list['nim']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document" >
					    <div class="modal-content" style="background-color: rgb(242, 253, 242)">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h5 class="modal-title" id="myModalLabel" style="color:green"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"> </span> Biodata Mahasiswa (<small>nim: <?=$list['nim']?></small>)</h5>
					      </div>
					      <div class="modal-body">
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:55px">Nama Mahasiswa</span>
							  <input size="57" type="text" value="<?=$list['nama']?>" readonly class="form-control" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
							</div>
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:78px">Prodi</span>
							  <?php
							  if( $list['kelamin'] == "l"){
							  	echo '<input size="50" type="text" value="Laki-Laki" readonly class="form-control" aria-describedby="sizing-addon3">
										';
							  }elseif($list['kelamin'] == "p"){
							  	echo '<input size="50" type="text" value="Perempuan" readonly class="form-control"aria-describedby="sizing-addon3">
										';	
							  }else{
							  	echo '<input size="50" type="text" value="-" readonly class="form-control"aria-describedby="sizing-addon3">
										';
							  }?>			
							</div>
							
					
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:69px">Nomor Telepon</span>
							  <input size="58" type="text" value="<?=$list['telepon']?>" readonly class="form-contr" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							</div>
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:114px">Jurusan</span>
							  	<?php
							  	if($list['kd_jurusan'] =="55"){
							  		echo '
							  	<input size="58" type="text" value="Teknik Informatika" readonly class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							  		';
							  	}elseif($list['kd_jurusan'] =="57"){
							  		echo '
							  	<input size="58" type="text" value="Sistem Informasi" readonly class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							  		';
							  	}else{
							  		echo '
							  	<input size="58" type="text" value="-" readonly class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
							  		';
							  	}?>
							  </select>
							</div>

							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:126px">Kelas</span>
							  <input size="67" type="text" value="<?=$list['kelas']?>" readonly class="form-control" placeholder="Alamat" aria-describedby="sizing-addon3">
							</div>		
							
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:83px">Tahun Masuk</span>
							  <input size="57" type="text" value="<?=$list['thn_masuk']?>" readonly class="form-control" placeholder="Tahun angkatan" aria-describedby="sizing-addon3">
							</div>
							<div class="input-group tabel-data">
							  <span class="input-group-addon" id="sizing-addon3" Style="padding-right:122px">Status</span>
							  <?php
							  if( $list['status'] == "aktif"){
							  	echo '<input size="50" type="text" value="aktif" readonly class="form-control" aria-describedby="sizing-addon3">
										';
							  }elseif($list['status'] == "cuti"){
							  	echo '<input size="50" type="text" value="non aktif" readonly class="form-control" aria-describedby="sizing-addon3">
										';	
							  }else{
							  	echo '<input size="50" type="text" value="-" readonly class="form-control" aria-describedby="sizing-addon3">
										';
							  }
							  ?>
					      </div>
					      <div class="modal-footer">
					      <form action="?hal=mahasiswa&aksi" method="post">
					      	<input type="hidden" name="nim" class="form-control" value="<?=$list['no_reg']?>">
					        <button type="submit" name="reset" class="btn btn-primary">Reset PIN</button>			
					        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					      </form>		        
					      </div>
					    </div>
					  </div>
					</div>
			<?php
			}
			?>
				  </tbody>
				  </table>
				</div>
			
			</div>
		</div>
		<?php
}else{
	if (isset($_POST['tambah'])) {
		?>
			<form action="?hal=mahasiswa&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-plus-sign"></i> Halaman Tambah Data Mahasiswa</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" class="btn btn-success pull-right" id="simpan" name="simpan" value="simpan">
						</div>
						<div class="col-md-3" style="padding-top: 5px;">
							<span class="input-group-addon pull-left" id="sizing-addon3">Nomor Induk Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nim" id="nim" class="form-control" required pattern="^[0-9]{5,18}$" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3" data-toggle="popover" data-trigger="focus" title="Nomor Induk Mahasiswa">
						</div>
						<div class="col-md-3" style="padding-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:57px">Nama Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nama_mhs" id="nama_mhs" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
						</div>
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Prodi</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="prodi" id="prodi" class="form-control" onchange="setData(this.value)">
							  	<option>Pilih prodi</option>
							  	<option value="sistem informasi">sistem informasi</option>
							  	<option value="teknik informatika">teknik informatika</option>
							</select>
						</div>
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Semester</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="semester" class="form-control" >
							  	<option>Pilih Semester</option>
							  	<?php
							  	for ($no=1; $no <= 14 ; $no++) { 
							  		?>
						  			<option value="<?=$no?>"><?=$no?></option>
							  		<?php
							  	}
							  	?>
							</select>
						</div>
						
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:67px">Nomor Telepon</span>	
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input size="58" type="text" name="no_hp" id="no_hp" required pattern="^[0-9]{5,18}$" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>		
					</div>
				</div>
			</div>
			</form>
		
	<?php
		
	}elseif (isset($_POST['edit'])) {
		$nim=$_POST['kode'];
		$list=$crud->select("tb_mhs","nim=".$nim);
		?>
			<form action="?hal=mahasiswa&aksi" method="post">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Ubah Data Mahasiswa</h3>
				</div>
				<div class="panel-body">
					<div class="row" style="margin-bottom: 20px">
						<div class="col-md-9">
						</div>
						<div class="col-md-3" style="margin-bottom: 10px">
							<input type="submit" name="update" class="btn btn-success pull-right" id="update" value="update">
						</div>
						<div class="col-md-3" style="padding-top: 5px;">
							<span class="input-group-addon pull-left" id="sizing-addon3">Nomor Induk Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nim" id="no_reg" readonly value="<?=$list[0]['nim']?>" class="form-control" required pattern="^[0-9]{5,18}$" placeholder="Nomor Induk Mahasiswa" aria-describedby="sizing-addon3" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="Nim ini sudah terdaftar?">
							<input type="hidden" name="nim" value="<?=$list[0]['nim']?>">
						</div>
						<div class="col-md-3" style="padding-top: 5px">
							<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:57px">Nama Mahasiswa</span>
						</div>
						<div class="col-md-9">
							<input type="text" name="nama_mhs" id="nama" value="<?=$list[0]['nama_mhs']?>" class="form-control" required pattern="^[A-Z]\.?([A-Za-z.]+|\s)[A-Z-a-z ]+[a-z.]?$" placeholder="Nama Mahasiswa" aria-describedby="sizing-addon3">
						</div>
						
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Prodi</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="prodi" id="jurusan" data-jurusan="<?=$list[0]['prodi']?>" class="form-control jurusan" onchange="<?=$list[0]['prodi']?>">
							  	<option>Pilih Prodi</option>
							  	<option value="sistem informasi">sistem informasi</option>
							  	<option value="teknik informatika">teknik informatika</option>
							</select>
						</div>
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:110px">Semester</span>
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<select name="semester" class="form-control" onchange="<?=$list[0]['semester']?>">
							  	<option>Pilih Semester</option>
							  	<?php
							  	for ($no=1; $no <= 14 ; $no++) { 
							  		?>
						  			<option value="<?=$no?>" <?=($list[0]['semester'] == $no) ? "selected" : "" ;?>><?=$no?></option>
							  		<?php
							  	}
							  	?>
							</select>
						</div>
						
						<div class="col-md-3" style="padding-top: 5px">
						  	<span class="input-group-addon pull-left" id="sizing-addon3" Style="padding-right:67px">Nomor Telepon</span>	
						</div>
						<div class="col-md-9" style="padding-top: 5px">
							<input size="58" type="text" name="no_hp" id="nomor" value="<?=$list[0]['no_hp']?>" data-nomor="<?=$list[0]['no_hp']?>" required pattern="^[0-9]{5,18}$" class="form-control" placeholder="Nomor Telepon" aria-describedby="sizing-addon3">
						</div>
					</div>
				</div>
			</div>
			</form>
			<script type="text/javascript">
				
			</script>
	<?php
	}elseif (isset($_POST['hapus'])) {
		$nim=$_POST['kode'];
		$crud->delete("tb_mhs","nim='$nim'");
		echo '
			<script type="text/javascript">
				document.location="?hal=mahasiswa";
				alert("Data berhasil terhapus!!");
			</script>';
	}elseif(isset($_POST['simpan'])){
		$nim=$_POST['nim'];
		$nama=$_POST['nama_mhs'];
		$prodi=$_POST['prodi'];
		$semester=$_POST['semester'];
		$no_hp=$_POST['no_hp'];
		$data= array('nim' => $nim, 
					'nama_mhs'=> $nama, 
					'prodi'=> $prodi, 
					'semester'=> $semester, 
					'no_hp'=> $no_hp,);
		$cek=$crud->num("tb_mhs","nim =".$nim);
		if($cek<1){
			$simpan=$crud->insert("tb_mhs",$data);
				echo '
					<script type="text/javascript">
						document.location="?hal=mahasiswa";
						alert("Data berhasil tersimpan!!");
					</script>
				';
			
		}else{
			echo '
				<script type="text/javascript">
					alert("NIM yang anda masukkan sudah ada!!");
				</script>
			';
		}
	}elseif(isset($_POST['update'])){
		$nim=$_POST['nim'];
		$nama=$_POST['nama_mhs'];
		$no_hp=$_POST['no_hp'];
		$prodi=$_POST['prodi'];
		$semester = $_POST['semester'];
		$data= array('nama_mhs'=> $nama, 
					'prodi'=> $prodi,
					'no_hp'=> $no_hp, 
					'semester'=> $semester);
		$up = $crud->update("tb_mhs",$data, "nim='$nim'");
		echo '
		<script type="text/javascript">
			document.location="?hal=mahasiswa";
			alert("berhasil mengupadate!!");
		</script>';
	}elseif (isset($_POST['reset'])) {
		$nim = $_POST['nim'];
		$crud->updateSingel("tmahasiswa","pin='1234'","nim = '$nim'");
		echo '
			<script type="text/javascript">
				document.location="?hal=mahasiswa";
				alert("PIN berhasil direset");
			</script>';
	}else{
		echo '
			<script type="text/javascript">
				document.location="?hal=mahasiswa";
			</script>';
	}
}
?>
<script type="text/javascript">
	function setData(val){
		$.ajax({
	  		type: "POST",
	  		url: "hal/simpanjadwal.php",
	  		data: "kd_jurusan="+val,
	  		success: function(data){
	  			$('#kelas').html(data);
	  		}
	  	});
	}
	var jurusan = $('#jurusan').data("jurusan");
	var tahun = $('#tahun').data("tahun");
	var kelas = $('#kelas').data("kelas");
	$('.jurusan').val(jurusan);
	$('.tahun').val(tahun);
	var val = $('#jurusan').val();
	$.ajax({
  		type: "POST",
  		url: "hal/simpanjadwal.php",
  		data: "kd_jurusan="+val,
  		success: function(data){
  			$('#kelas').html(data);
		  	if(undefined != val) $('#kelas').val(kelas);
  		}
  	});
	
	$('#nim').on('blur',function(){
		var nim = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'hal/validasi.php?v=nim',
			data: "nim="+nim,
			success: function(data){
				if(data == "ada"){
					$('#simpan').prop('disabled', true);
					$('#nomor').prop('disabled', true);
					alert("Nomor Induk Mahasiswa ini sudah terdaftar");
				}else{
					$('#simpan').prop('disabled', false);
					$('#nomor').prop('disabled', false);
				}
				
			}

		})
	})
	if($('#update').val() == 'update'){
		$('#nomor').on('blur',function(){
		var nomor = $(this).val();
		var nomorawal = $(this).data('nomor');
			$.ajax({
				type: 'POST',
				url: 'hal/validasi.php?v=nomoredit',
				data: "nomor="+nomor+"&nomorawal="+nomorawal,
				success: function(data){
					if(data == "ada"){
						$('#update').prop('disabled', true);
						alert("Nomor telepon sudah terdaftar !");
					}else{
						$('#update').prop('disabled', false);
					}
					
				}

			})
		})
	}
	if($('#simpan').val() == 'simpan'){	
		$('#nomor').on('blur',function(){
		var nomor = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'hal/validasi.php?v=nomor',
			data: "nomor="+nomor,
			success: function(data){
				if(data == "ada"){
					$('#simpan').prop('disabled', true);
					$('#nim').prop('disabled', true);
					alert("Nomor telepon sudah terdaftar");
				}else{
					$('#simpan').prop('disabled', false);
					$('#nim').prop('disabled', false);
				}
				
			}

		})
		})
	}
</script>
