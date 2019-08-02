<?php
// upFileTest.php
// 2019/08/02
// ryo tajiri
// 

		if ($_FILES['upfile']){
			$dt = date("YmdHis");
			$newname = "img".$dt.".jpg"; // ここの拡張子次第でファイルの種類が変わってる？
		  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "upDir/" . $_FILES["upfile"]["name"])) {
			$upmado = $_FILES["upfile"]["name"] . "をアップロードしました。";
			rename("upDir/".$_FILES["upfile"]["name"],"upDir/".$newname);
		  } else {
			$upmado = "ファイルをアップロードできません。";
		  }
		} else {
			$upmado = "ファイルが選択されていません。";
			$newname = "";
		}

$c = <<< EOD
<form enctype="multipart/form-data" method="post" action=""> 
<input type="file" name="upfile"><br><br>
<input type="submit" name="upfiletest" value="ファイルをアップロードする" onclick='return kakunin();'/>
</form>
EOD;

$HtmlHeader =<<< EOD

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">

<title>title</title>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/table4.css" />
  
  	<style type="text/css">
		a { text-decoration: none;
			color: black;}
	</style>
  
  </head>
<body>
<div id=''> <!-- wrapper -->
EOD;
// ---
$HtmlFooter =<<< EOD
  <div class='nopri'>
  <hr />
  <p class="footer">&copy;2019 kets Co.Ltd. & RyoTajiri (since 2014)</p>
  </div>
</div> <!-- end of wrapper -->

</body>
</html>
EOD;
//------------------------------------------------------------------
echo $HtmlHeader;
echo $c;
echo $upmado;
?>

	<script language="JavaScript">
	<!--
	function kakunin(){
	  ret = confirm("アップロードしてよろしいですか？");
	  if (ret == true){
	  this.upfiletest.submit(); 
	  } else {
		return false;
		}
	}
	// --></script>
<?php
echo $htmlFooter;	
