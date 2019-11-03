<?php
	class crud {
		public $connection;

		public function __construct() {
			$this->connection = new mysqli("localhost","root","","evoting");
		}
		public function num($tabel, $where=null) {
			$sql = "SELECT * FROM $tabel";
			if($where != null) {
				$sql .= " WHERE $where";
			}
			$query = $this->connection->query($sql);
			return $query->num_rows;
		}
		public function numDistinct($distinct,$tabel, $where=null) {
			$sql = "SELECT DISTINCT $distinct FROM $tabel";
			if($where != null) {
				$sql .= " WHERE $where";
			}
			$query = $this->connection->query($sql);
			return $query->num_rows;
		}
		public function insert($table, $rows = null) {
			$sql = "INSERT INTO $table";
			$row = null;
			$value = null;
			foreach ($rows as $key => $isi) {
				$row .= ",".$key;
				$value .= ",'".$isi."'";
			}
			$sql .= "(".substr($row, 1).")";
			$sql .= " VALUES(".substr($value, 1).")";
			$query = $this->connection->prepare($sql) or die($this->connection->error);
			$query->execute();
		}
		public function insertSingel($table, $rows = null) {
			$sql = "INSERT INTO $table";
			$sql .= "VALUES $rows";
			$query = $this->connection->prepare($sql) or die($this->connection->error);
			$query->execute();
		}
		public function select($tabel, $where=null, $sort=null) {
			$sql = "SELECT * FROM $tabel";
			if($where != null) {
				$sql .= " WHERE $where $sort";
			}
			$query = $this->connection->query($sql) or die($this->connection->error);
			return $query->fetch_all(MYSQLI_BOTH);
		}
		public function selectDistinct($distinct,$tabel, $where=null, $sort=null) {
			$sql = "SELECT DISTINCT $distinct FROM $tabel";
			if($where != null) {
				$sql .= " WHERE $where $sort";
			}
			$query = $this->connection->query($sql) or die($this->connection->error);
			return $query->fetch_all(MYSQLI_BOTH);
		}
		public function updateSingel($tabel, $fiel=null, $where=null) {
			$sql = "UPDATE $tabel SET";
			$sql .= " $fiel WHERE $where";
			$query = $this->connection->prepare($sql)or die($this->connection->error);
			return $query->execute();
		}
		public function update($tabel, $fiel=null, $where=null) {
			$sql = "UPDATE $tabel SET";
			$set = null;
			foreach ($fiel as $key => $values) {
				$set .= ", ".$key." = '".$values."'";
			}
			$sql .= substr($set, 1)." WHERE $where";
			$query = $this->connection->prepare($sql)or die($this->connection->error);
			$query->execute();
		}
		public function delete($tabel, $where) {
			$sql = "DELETE FROM $tabel WHERE $where";
			$this->connection->query($sql);
		}	
		public function truncate($tabel) {
			$sql = "TRUNCATE TABLE $tabel";
			$this->connection->query($sql);
		}	
		public function __destruct() {
			$this->connection->close();
		}
	}
?>