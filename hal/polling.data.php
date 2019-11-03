<?php 
	//	include "./conf/connect.php";
	$crud = new crud("localhost","root","","evoting");
	include "./bootstrap/costum/costum.css";
if (!isset($_GET['aksi'])) {
	?>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="glyphicon glyphicon-hdd"></i>Polling</h3>
			</div>
			<div class="row">
			<div class="panel-body">
				<div class="col-md-12 pull-right" style="margin-bottom: 10px">
				<form action="?hal=polling&aksi" method="post"><button type="submit" name="reset" class="btn btn-success pull-right" onclick="confirm('Apakah anda yakin ingin mereset data ini')"><span class="glyphicon glyphicon-refresh"> </span> RESET </button></form>
				</div>
				<div class="col-md-12">
				  <!-- Table -->
				  <table class="table table-striped table-bordered data datatable-sms ">
				  <thead>
				    <tr>
				    	<th>Nomor Urut</th>
				    	<th>Pasangan</th>
				    	<th>Jumlah Suara</th>
				    	<th>Persen</th>
				    </tr>
				  </thead>
				  <tbody>
			<?php
			$data=$crud->num("tb_calon");
			if($data>0){
				$no=1;
				$row=$crud->selectDistinct("tb_polling.id_pemilu","tb_polling, tb_calon", "tb_calon.id_pemilu = tb_polling.id_pemilu", "ORDER BY tb_calon.no_urut ASC");
				foreach ($row as $list) {
					$result=$crud->select("tb_calon", "id_pemilu = '$list[id_pemilu]'", "ORDER BY no_urut ASC");
					$jum =$crud->num("tb_polling","id_pemilu = '$list[id_pemilu]'");
					$jum_swr = $crud->num("tb_polling");
					foreach ($result as $key) {
						?>
						<tr>
							<td><?=$key['no_urut']?></td>
							<td><?=$key['calon_ketua']?> & <?=$key['calon_sek']?></td>
							<td><?=$jum?></td>
							<td><?=($jum/$jum_swr)*100?> %</td>
						</tr>
						<?php
					}
					
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
	if(isset($_POST['reset'])) {
		$reset = $crud->truncate('tb_polling');
			?>
			<script>
				alert('data berhasil direset');
				window.history.back();
			</script>
			<?php
		
	}
}
?>