<?php
	$idx = 100;
	function makeUpmado($idx) {
		if ($_FILES['upfile']){
			
			$filename = $_FILES['upfile']["name"];
			$fileend = end(explode('.', $filename));
			$dtt = date("YmdHms");
			echo $
			
			$newname = "imgcropn".$idx.$dtt.".docx";
		  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "temp/" . $_FILES["upfile"]["name"])) {
			$upmado = $_FILES["upfile"]["name"] . "をアップロードしました。";
			rename("temp/".$_FILES["upfile"]["name"],"temp/".$newname);
		  } else {
			$upmado = "ファイルをアップロードできません。";
		  }
		} else {
			$upmado = "ファイルが選択されていません。";
			$newname = "";
		}
	return array($upmado,$newname);
	}
	if ($_FILES['upfile']){
		list($upmado,$newname) = makeUpmado($idx);
	}
		echo $upmado;
		echo $HtmlHeader;
		echo $menu;
		
	//	echo $c;
	
	//	require_once('upld01.php');
?>
<form enctype="multipart/form-data" method="post" action=""> 
<input type="file" name="upfile"><br><br>
<input type="submit" name="rirekisho" value="ファイルをアップロードする" onclick='return kakunin();'/>
</form>