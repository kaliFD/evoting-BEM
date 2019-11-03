<?php
	//include "./conf/conn.php";
	//include "./conf/connect.php";
	$crud = new crud();
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	$nim=$_SESSION['nim'];
	$list=$crud->select("tb_mhs","nim=".$nim);
	?>
		<form action="?hal=profile&aksi" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Halaman Profile Mahasiswa</h3>
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
}else{
	if(isset($_POST['update'])){
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
			document.location="?hal=profile";
			alert("berhasil mengupadate!!");
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