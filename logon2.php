<?php

	require_once('../shisetsu/connectvars.php');
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	mysqli_set_charset( $dbc, "UTF8");
	define('MYSELF', basename($_SERVER['SCRIPT_NAME']));
	$myself = MYSELF;
	global $dbc;

	$x = (empty($_POST['x'])) ? "x":$_POST['x'];
	$y = (empty($_POST['y'])) ? 0:$_POST['y'];

	function readInfo($x, $y){
		global $dbc;
		$sql = "SELECT * FROM emp_permit WHERE ep_id_name = '$x' AND ep_pass = '$y'";
		$res = mysqli_query($dbc, $sql);
		while( $row = mysqli_fetch_array($res) ) {
			$shainid = $row['ep_shain_id'];
		}
		$sql = "SELECT * FROM emp_tbl WHERE shain_id = $shainid AND s_zaishoku < 9";
		$res = mysqli_query($dbc, $sql);
		while( $row = mysqli_fetch_array($res) ) {
			$sname = $row['s_name'];
			$slevel = $row['s_level'];
		}
	return array($shainid, $sname, $slevel);
	}
	LIST($shainid, $sname, $slevel) = readInfo($x, $y);
	
	// HTML文字列で計算結果を返す。

	if ($shainid > 0){
		echo "<table border='1'><tbody>";
		echo "<tr><td>{$shainid}</td><td>{$slevel}</td><td>{$sname}</td></tr>";
		echo "</tbody></table>";
	}
?>