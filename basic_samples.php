<?php
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>コード集</title>
	<script type="text/javascript" src="scripts/shCore.js"></script>
	<script type="text/javascript" src="scripts/shBrushJScript.js"></script>
	<link type="text/css" rel="stylesheet" href="styles/shCoreDefault.css"/>

	<!-- コード表示用JS -->
	<script type="text/javascript">SyntaxHighlighter.all();</script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="../shisetsu/js/jquery-1.9.1.js"></script>
	<script src="../shisetsu/js/jquery-ui.js"></script>

	<link rel="stylesheet" type="text/css" href="../shisetsu/css/style.css" />
	<style type="text/css">
		a { text-decoration: none;
			color: black;}
		p.title {
			width: 50%;
			margin: 5px;
			padding: 5px;
			background-color: silver;
		}
		button {
			margin: 5px 0px;
		}
	</style>
	  <script>

  $( function(){
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });

	$("#modoru").click(function(){
		location.href='../shisetsu/index.php';
	});
  });

  </script>

</head>
<body>
	<div id="wrapper_ww">
	<div><button id='modoru'>高住menu</button></div>
	<div id="accordion">
<!-- *************************************************************************************************** -->
	<h3>タイトル</h3>
	<div>
	<p class='title'>コード集</p>
	</div>
<!-- *************************************************************************************************** -->
	<h3>COOKIE</h3>
	<div>
	<pre class="brush: js;">
	$mirarerulevel = array(1,2,3,11,12);
	if (in_array($slevel,$mirarerulevel)){
		if (isset($_COOKIE['slctsst'])) {$genba = $_COOKIE['slctsst'];} else {$genba = $ipima;}
		if (isset($_GET['slctsst'])) {
			$genba = $_GET['slctsst'];
			setcookie('slctsst', $genba,'','/');
		}
	}
	</pre>
	</div>
<!-- *************************************************************************************************** -->
	<h3>確認</h3>
	<div>
	<pre class="brush: js;">

	<input type='submit' name='k".$key."' value='アップロード' onclick='return kakunin(\"k".$key."\");'/>";
	<script language="JavaScript">
	<!--
	function kakunin(k){
	  ret = confirm("履歴書を更新してよろしいですか？");
	  if (ret == true){
	  this.k.submit();
	  } else {
		return false;
		}
	}
	// --></script>

<!-- 		</pre>
	</div>
	<div>
	<pre class="brush: js;"> -->
		function henko(m,y){
			  ret = confirm("編集月を変更してよろしいですか？");
			  if (ret == true){
					var m;
					var y;
					location.href="kissa.php?ge2="+m+"&nen="+y;
				//this.k.submit();
			  } else {
			    return false;
		    }		    
		}
		</pre>
	</div>			
<!-- *************************************************************************************************** -->
	<h3>var_dump</h3>
	<div>
	<pre class="brush: js;">

			echo "<pre>";
			var_dump($hoge);
			echo "</pre>";
			exit();
	</pre>
	</div>
<!-- *************************************************************************************************** -->
	<h3>ファイル検索</h3>
	<div>
	<pre class="brush: js;">
	
		function getFileList($dir) {
		    $files = scandir($dir);
		    $files = array_filter($files, function ($file) { // 注(1)
		        return !in_array($file, array('.', '..'));
		    });
		 
		    $list = array();
		    foreach ($files as $file) {
		        $fullpath = rtrim($dir, '/') . '/' . $file; // 注(2)
		        if (is_file($fullpath)) {
		            $list[] = $fullpath;
		        }
		        if (is_dir($fullpath)) {
		            $list = array_merge($list, getFileList($fullpath));
		        }
		    }
		 
		    return $list;
		}
		$dir = "tmp";
		$list = getFileList($dir);
		rsort($list);
		/*echo"<pre>"; var_dump($list); echo"</pre>";*/
			$msgx = "<a href='tmp/template1.docx'>最新版</a><br>";
			$msgx .= "<p>以下バックアップ</p>";

		foreach ($list as $key => $value) {
			if (substr($value,0,20) == "tmp/template1_backup"){
				$valx = mb_ereg_replace("tmp/template1_", "", $value);
				$valx = mb_ereg_replace("\.docx", "", $valx);
				$msgx .= "<a href='".$value."'>".$valx."</a><br>";
			}
		}
		echo $msgx;
	</pre>
	</div>
<!-- *************************************************************************************************** -->
	<h3>表示非表示</h3>
	<div>
	<pre class="brush: js;">
	// 表示非表示関数部分
	$.fn.clickToggle = function(a, b) {
		return this.each(function() {
			var clicked = false;
			$(this).on('click', function() {
				clicked = !clicked;
				if (clicked) {
					return a.apply(this, arguments);
				}
				return b.apply(this, arguments);
			});
		});
	};

	// 表示非表示クリック部分
	$(".foo").hide();
	$("#fooid").clickToggle(function(){
			$(".foo").show();
		}, function(){
			$(".foo").hide();
	});
		</pre>
	</div>
<!-- *************************************************************************************************** -->
	<h3>ファイルのアップロード</h3>
	<div>
	<pre class="brush: js;">

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

	<form enctype="multipart/form-data" method="post" action="">
	<input type="file" name="upfile"><br><br>
	<input type="submit" name="rirekisho" value="ファイルをアップロードする" onclick='return kakunin();'/>
	</form>

	</pre>
	</div>

<!-- *************************************************************************************************** -->
	<h3>MySQL</h3>
	<div>
	ON DUPLICATE KEY UPDATE の使い方
	<pre class="brush: js;">
		$sql = "INSERT INTO c_table (c_id, c_no, c_billdate, c_place, c_date, c_meal1, c_meal2, c_meal3, c_meal4) VALUES ";
		$sql .= substr($b,0,-1);
		$sql .= " ON DUPLICATE KEY UPDATE c_meal1 = VALUES(c_meal1), c_meal2 = VALUES(c_meal2), c_meal3 = VALUES(c_meal3), c_meal4 = VALUES(c_meal4)";
	//	$res = mysqli_query($dbc, $sql);
	</pre>
	LEFTの使い方
	<pre class="brush: js;">
		$sql = "SELECT * FROM c_sales WHERE c_date = '$billdate' AND LEFT(c_code, 2) = '04' AND c_place = $ipc";
		$res = mysqli_query($dbc, $sql);
		while ($row = mysqli_fetch_array($res)) {
			$cid = $row['c_id'];
			$ccd = $row['c_code'];
			$cqy = $row['c_quantity'];
			$ccc[$cid][$ccd] = $cqy;
		}
		var_dump($ccc);
	</pre>
	カラム名の取得　（WHERE句を使うとNULLが返る）
	<pre class="brush: js;">
		$sql = "SHOW COLUMNS FROM c_sales";
		$res = mysqli_query($dbc, $sql);
		while ($row = mysqli_fetch_array($res)) {
			$ab[] = $row['Field'];
			$ac[] = $row['Type'];
		}
		echo "<pre>";
		var_dump($ab);
		echo "</pre>";
		echo "<pre>";
		var_dump($ac);
		echo "</pre>";
	</pre>
	一括UPDATE
	<pre class="brush: js;">
	UPDATE time_rec_tbl2 SET 
		tr_id = CASE tr_id2 
			WHEN 1234 THEN 308111 
			WHEN 5678 THEN 308122 END, 
		shift_id = CASE tr_id2 
			WHEN 1234 THEN 40 
			WHEN 5678 THEN 40 END, 
		tr_state = CASE tr_id2 
			WHEN 1234 THEN 1 
			WHEN 5678 THEN 0 END 
		WHERE tr_id2 IN (1234,5678)
	</pre>
	assoc　と最大値
	<pre class="brush: js;">
	$sql = "select max(column) as mx from hogehoge";
	$res = mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	echo $row['mx'];
	</pre>
	</div>
<!-- *************************************************************************************************** -->
	<h3>ファイルのダウンロード</h3>
	<div>
	<pre class="brush: js;">

	//ダウンロードするファイルのパス
	$fpath = '../shisetsu/cont/T10_20170123.docx';
	//出力する時のファイル名 出力用なので変えてよい
	$fname = 'T10.docx';

	$j_file   = mb_convert_encoding($j_file, "SJIS", "EUC");

	ob_end_clean(); //ファイル破損を防ぐ //出力バッファのゴミ捨て

	header('Content-Type: application/force-download');
	header('Content-Length: '.filesize($fpath));
	header('Content-disposition: attachment; filename="'.$fname.'"');
	header("Connection: close");
	// 対象ファイルを出力する。
	readfile($fpath);
	</pre>
	<a href='../test/filedownload.php'>filedownload.php</a>
	</div>

	<h3>ポップアップウィンドウ</h3>
	<div>
	<pre class="brush: js;">

	<?php
	$c1 = "abc";
	?>
	<script>
		var subWinObj1;     // サブウインドウオブジェクト

		var c1 = '<?php echo $c1; ?>';
	//	alert(c1);
	//	alert("bbc");

		$(function() {
			$(".popup").click(function(){
				var winWidth = "400";
				var winHeight = "300";
				var x = (screen.width - winWidth) / 2;
				var y = (screen.height - winHeight) / 2;
				var options = "menubar=no,resizable=no,scrollbars=no,toolbar=no,width=" + winWidth + ", \
				   height=" + winHeight + ", \
				   left="+ x + ", \
				   top=" + y;
				subWinObj1 = window.open(this.href,"WindowNameTEST",options);

				subWinObj1.blur();      // サブウインドウにフォーカスを設定する
				window.focus();         // 自画面からフォーカスを取得
				window.blur();          // 自画面からフォーカスを放す
				subWinObj1.focus();     // サブウインドウにフォーカスを設定する

				return false;
			});
		});
	</script>

	<a href="inform.php" class="popup">リンクテキスト</a>

	</pre>
	</div>
<!----------------------------------------------------------------------------------------- -->
	<h3>PHP WORD</h3>
	<div>
	<pre class="brush: js;">

	require_once 'PHPWord.php';
	$PHPWord = new PHPWord();

	require_once 'convgtjdate.php';

	//$post = "5400024";
//$ad1 = "大阪府大阪市中央区南新町一丁目二番四号";
//$ad2 = "椿本ビル八階";
//$name = "株式会社　川商　行";
$name = $sei." ".$mei."";
//$template = $PHPWord->loadTemplate('tmp/kaku2.docx');
	$sql = "SELECT * FROM s_kaishamei WHERE kaishaid = $kws";
	$res = mysqli_query($dbc, $sql);
		while( $row = mysqli_fetch_array($res) ) {
			$kaishamei = $row['kaishamei'];
			$daihyosha = $row['daihyosha'];
			$kaishapost = $row['kaishayubin'];
			$kaishajusho = $row['kaishajusho'];
			$kaishatel = $row['kaishatel'];
			$kaishafax = $row['kaishafax'];
		}
echo $shoruikubun;
	switch ($shoruikubun) {
		case 1:
			$docn = 'tmp/template1.docx'; // 採用通知
			break;
		case 2:
			$docn = 'tmp/template2.docx';
			break;
		case 3:
			$docn = 'tmp/template3.docx';
			break;
		case 4:
			$docn = 'tmp/template4.docx';
			break;
		case 11:
			$docn = "tmp/kaku2.docx"; // 封筒
			break;
		case 12:
			$docn = "tmp/naga3.docx"; // 封筒
			break;
		default:
			$docn = "tmp/template2.docx";
	}

$template = $PHPWord->loadTemplate($docn);
		echo "(15)shoruikubun=".$shoruikubun."/";
	//	exit();
$template->setValue('post',$pst);
$template->setValue('name',$name);
$template->setValue('ad1',$addr01);
$template->setValue('ad2',$addr02);
$wadate = convGtJDate($dt);
$template->setValue('today',$wadate);
$template->setValue('kaishamei1',$kaishamei);
$template->setValue('daihyosha1',$daihyosha);
$template->setValue('kaishapost',$kaishapost);
$template->setValue('kaishajusho1',$kaishajusho);
$template->setValue('kaishatel1',$kaishatel);
$template->setValue('kaishafax1',$kaishafax);
$template->setValue('shisetsupost',$shisetsu_post[$sst]);
$template->setValue('shisetsumei1',$shisetsu_name_formal[$sst]);
$template->setValue('shisetsujusho1',$shisetsu_jusho[$sst]);
$template->setValue('shisetsutel1',$shisetsu_tel[$sst]);
$template->setValue('shisetsufax1',$shisetsu_fax[$sst]);

$template->save('tmp/sample.docx');
//echo $addr1."<br>";
echo "wordファイルが作成されました.ダウンロードして使ってください";
//require_once 'download.php';
// ダウンロードさせるファイル名
$tmp_file = "tmp/sample.docx";
$j_file   = "sample.docx";
$j_file   = mb_convert_encoding($j_file, "SJIS", "EUC");
// ヘッダ

	</pre>
	</div>
<!----------------------------------------------------------------------------------------- -->
	<h3>ドロップUL</h3>
	<div>
	<pre class="brush: js;">
	/*ドロップダウンメニュー　初段目（表示されている部分）*/

@charset "utf-8";

ul  {
width:30px;
 font-size:14px;
 /*text-align: center; */
}
/*初段目*/
ul, li{
 position:relative;
 margin:0px;
 padding:0px;
  top:0px;
 left:0px;
 display:block;
 white-space: nowrap;
 }

 /*１段目ブロック（最初に出るメニュー）*/
 ul li ul {
 position:absolute;
 margin:2px;
 padding:2px;
  top:10px;
 left:-10px;
 display:block;
 background:yellow;
 white-space: nowrap;
 }

 /**/
  ul li ul li ul{
 position:absolute;
 margin:2px;
 padding:2px;
  top:10px;
 left:10px;
 display:block;
 background:#cfcfcf;
 white-space: nowrap;
 }


 ul li ul{
 display:none;
 }

  ul li ul li ul{
 display:none;
 }

  /*１段目ブロック（最初に出るメニュー）*/
 ul li:hover > ul{
 display:block;
 position:absolute;
 font-size:14px;
 top:5px;
 left:5px;
	width:60px;
 z-index: 1;
 }

  ul li ul li:hover ul{
 display:block;
 position:absolute;
 font-size:14px;
 top:0px;
 left:15px;
  width:60px;
 z-index: 1;
 }

  ul li ul li ul li:hover > ul > li {
 background:skyblue;
 }

 ul li:hover > ul > li {
 background:yellow;
 }


 ul li ul li:hover > ul > li {
 background:skyblue;
 }
	</pre>
	</div>
	<h3>style css</h3>
	<div>
	<pre class="brush: js;">
@charset "utf-8";


body{
font-family: 1.0 "ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro","メイリオ","Meiryo",arial,Osaka,"ＭＳ Ｐゴシック","MS PGothic";　
/* font-family: "ヒラギノ明朝 Pro W3","Hiragino Mincho Pro","ＭＳ Ｐ明朝","MS PMincho",serif; */
/* 16px/1.5 */
color:#000;
-webkit-text-size-adjust: none;
/*background:url(images/backimg_body.jpg) repeat-x #D7E7AF;*/
background: #fff;
/*background: #aaa;*/
}

/* レイアウト
------------------------------------------------------------*/
#wrapper{
margin:0 auto;
padding: 5px 50px 10px 50px;
width:880px;
background: #fff;
/*background:url(images/backimg_contents.jpg) repeat-x #FFF;*/
/*overflow:hidden;*/
}

#wrapper_w{
margin:0 auto;
padding: 0px 30px 0px 30px;
width:1050px;
background: #fff;
/*background:url(images/backimg_contents.jpg) repeat-x #FFF;*/
/*overflow:hidden;*/
}

#wrapper_ww{
margin:0 auto;
padding: 0px 30px 0px 30px;
width:1150px;
background: #fff;
/*background:url(images/backimg_contents.jpg) repeat-x #FFF;*/
/*overflow:hidden;*/
}

#wrapper_k{
margin:0 auto;
padding: 5px 10px 10px 10px;
width:1600px;
background: #fff;
/*background:url(images/backimg_contents.jpg) repeat-x #FFF;*/
/*overflow:hidden;*/
}

#wrapper_p{
margin:0 auto;
padding: 0px 0px 0px 0px;
width: 99%;
/*width:1980px;*/
background: #fff;
/*background:url(images/backimg_contents.jpg) repeat-x #FFF;*/

}

#wrapper_m{
width: 1800px;
margin:0 auto;
padding: 5px 10px 10px 10px;
/*width:1400px; */
background: #fff;
/*background:url(images/backimg_contents.jpg) repeat-x #FFF;*/

}
#wrapper_n{
width: 1900px;
margin:0 auto;
padding: 5px 10px 10px 10px;
/*width:1400px; */
background: #fff;
/*background:url(images/backimg_contents.jpg) repeat-x #FFF;*/
}
#wrapper_n2{
width: 2000px;
margin:0 auto;
padding: 5px 10px 10px 10px;
background: #fff;
}

#body2{
    text-align: center;
}

content{
margin: 0 auto;
}



.notes {
	font-size: 14px;
	line-height: 1.4;
	color: #666;
}

.kaipage{
page-break-after: always;
}

tr.pageblock {
   page-break-before: always;
}
.pageblock {
   page-break-before: always;
}

@media screen{
tr.printer {display: none;}
}

/*
#printer {
display: block;
} */

/* タイトル
------------------------------------------------------------*/

a:visited {
text-decoration: none;
}
a {
text-decoration: none;
color: #000;
}

.red {
color: red;
}

.gr1 {
color: green;
}

.red3 {
background-color: #ffc0cb;
}

.red2 {
background-color: #ff6666;
}

.black {
background-color: #666666;
}

.blackback {
background-color: #333333;
color: white;
}

.white {
color: white;
}


h1.ttl {
text-align: center;
}

.error {
  font-weight: bold;
  color: #FF0000;
}

.login {
  font-style: italic;
}

.right {
  text-align: right;
}

.center {
  text-align: center;
}

.right18 {
  text-align: right;
  font-size: 19px;
  line-height: 1.5;
}

.left {
  text-align: left;
}

.vtop {
  vertical-align: top;
}

.gray {
background-color: #cccccc;
}
.gry6{
background-color: darkslategray;
}

.dimgray {
background-color: dimgray;
}

.yellow {
background-color: #FFFF00;
}
.paleyellow {
background-color: #FFFFcc;
}

.moccasin {
background-color: moccasin;
}

.gold {
background-color: gold;
}

.yellow2 {
background-color: #ffffe0;
}

.yellow3 {
background-color: #ffff99;
}

.pink {
background-color: pink;
}

.pink2 {
background-color: #ff69b4;
}

.crimson {
background-color: #f08080;
}

.thistle{
background-color: #d8bfd8;
}

.orange{
background-color: #ff8c00;
}

.purple{
background-color: purple;
}

.redpurple{
background-color: #FF88FF;
}

.palevioletred{
background-color: #db7093;
}

.mediumorchid{
background-color: #ba55d3;
}

.blue {
background-color: blue;
}

.blue2 {
background-color: #00ccff;
}

.skyblue {
background-color: #87ceeb;
}

.skyblue2 {
background-color: #add8e6;
}

.cornflowerblue {
background-color: #6495ed;
}

.palegreen {
background-color: #ccffcc;
}

.msgreen {
background-color: #99ff99;
}

.brown {
background-color: #f5deb3;
}

.green {
background-color: green;
}

.greenyellow {
background-color: #adff2f;
}

.silver {
background-color: silver;
}

.babyblue {
background-color: #bbe2f1;
}

.lime {
background-color: #00ff00;
/zoom:1;
}

tr .aliceblue {
background-color: #f0f8ff;
}

.gright {
  text-align: right;
  background-color: #cccccc;
}

.gleft {
  text-align: left;
  background-color: #cccccc;
}

.gcenter {
  text-align: center;
  background-color: #cccccc;
}
.yleft {
  text-align: left;
  background-color: #FFFF00;
}
.yright {
  text-align: right;
  background-color: #FFFF00;
}

.taitoru {
	padding: 5px 10px;
	font-size: 1.4em;
	letter-spacing: 0.3em;
	line-height: 1.5;
	width: 870px;
}

.f4{
	font-size: 0.4em;
}
.f5{
	font-size: 0.5em;
}
.f6{
	font-size: 0.6em;
}
.f7{
	font-size: 0.7em;
}
.f8{
	font-size: 0.8em;
}
.f9{
	font-size: 0.9em;
}
.f10{
	font-size: 1.0em;
}
.f12{
	font-size: 1.2em;
}
.f14{
	font-size: 1.4em;
}


.redio{
position:relative;
top:10px;
}

form label {
  display: inline-block;
  font-weight: bold;
}

td.label {
  font-weight: bold;
}

img.profile {
  vertical-align: top;
}

.btnb {
	background: -moz-linear-gradient(top,#BFD9E5, #3D95B7 50%,#0080B3 50%,#0099CC);
	background: -webkit-gradient(linear, left top, left bottom, from(#BFD9E5), color-stop(0.5,#3D95B7), color-stop(0.5,#0080B3), to(#0099CC));
	color: #FFF;
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border: 1px solid #0099CC;
	-moz-box-shadow: 1px 1px 1px rgba(000,000,000,0.3),inset 0px 0px 3px rgba(255,255,255,0.5);
	-webkit-box-shadow: 1px 1px 1px rgba(000,000,000,0.3),inset 0px 0px 3px rgba(255,255,255,0.5);
	text-shadow: 0px 0px 3px rgba(0,0,0,0.5);
	width: 140px;
	padding: 10px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;

}

.btn {
	background: -moz-linear-gradient(top,#FFF 0%,#EEE);
	background: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#EEE));
	border: 1px solid #DDD;
	color:#111;
	width: 140px;
	height: 30px;
	padding: 10px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
	background-color: msgreen;
}

.btn10 {
	background: -moz-linear-gradient(top,#FFF 0%,#EEE);
	background: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#EEE));
	background-color: #98fb98;
	border: 1px solid #DDD;
	color:#111;
	width: 140px;
	padding: 2px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
}

.btn11 {
	background: -moz-linear-gradient(top,#FFF 0%,#EEE);
	background: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#EEE));
	background-color: #b0c4de;
	border: 1px solid #DDD;
	color:#111;
	width: 140px;
	padding: 2px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
}
.btn12 {
	clear:both;
/*	background: -moz-linear-gradient(top,#FFF 0%,#EEE);
	background: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#EEE));*/
	background-color: yellow;
	border: 1px solid #DDD;
	color:#111;
	width: 140px;
	padding: 2px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
	/zoom:1;
}
.btnw {

	background-color: white;
	border: 1px solid #666666;
	color:#111;
	width: 140px;
	padding: 2px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
}


.btng {
	background: -moz-linear-gradient(top,#00CC66 0%,#009966);
	background: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#EEE));
	border: 1px solid #DDD;
	color:#000;
	width: 140px;
	padding: 10px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
}

.btnb {
	background: -moz-linear-gradient(top,#999 0%,#333);
	background: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#EEE));
	border: 1px solid #DDD;
	color:#333;
	width: 140px;
	padding: 10px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
}
.btnbl {
	background: -moz-linear-gradient(top,#66CCFF 0%,#6699FF);
	background: -webkit-gradient(linear, left top, left bottom, from(#FFF), to(#EEE));
	border: 1px solid #DDD;
	color:#000;
	width: 140px;
	padding: 10px 10px;
	margin-right: 5px;
	text-align:center;
	text-decoration:none;
}
/*
.btn :hover{
background:#777777;
}
.btn10 :hover{
background:#777777;
}

a :hover {
background:#777777:
}
*/
#submit_button {
    width: 150px;
    height: 50px;
	font-size:12pt;
}
input.example, select {
width: 300px;
}
textarea {
width: 300px;
height: 7em;
font-size: 100%
}

input, select, textarea {
font-size: 100%;
}
.pri {
	font-size: 0pt;
}
@media print{
.menu {
    display:none;
	}
.btn {
    display:none;
    }
.btng {
    display:none;
    }
.btnb {
    display:none;
	}
.btnbl {
    display:none;
	}
.nopri {
    display:none;
	}
.nopri .a hover: {
background:#777777:
		}

.f5 {
	display:none;
	}
.pri {
	font-size: 12pt;
}
}


#container{display:none;}
#loading{
position:absolute;
left:50%;
top:20%;
margin-left:-30px;
}



#loader {
	width: 80px;
	height: 80px;
	display: none;
	position: fixed;
	_position: absolute; /* IE6対策 */
	top: 50%;
	left: 50%;
	margin-top: -40px; /* heightの半分のマイナス値 */
	margin-left: -40px; /* widthの半分のマイナス値 */
	z-index: 100;
}

#fade {
	width: 100%;
	height: 100%;
	display: none;
	background-color: #FFFFFF;
	position: absolute;
	top: 0px;
	left: 0px;
	z-index: 100;
}

.loadingWrap{
	width: 100%;
	height: 100%;
	background: #fff;
	position: fixed;
	top: 0;
	left: 0;
}
.loadingWrap img{
	position: absolute;
	top: 50%;
	left: 50%;
	margin-top: -50px;
	margin-left: -150px;
}

.close{
	display:none;
	background-color: #666666;
	color: #666666;
}

.open_a{
	display: inline;
}

.wt100 {
	width: 100px;
}

a.anchor{
padding-top:100px;
margin-top:-100px
}
	</pre>
	</div>
	<h3>.htaccess</h3>
	<div>
	<pre class="brush: js;">

DirectoryIndex index.html index.htm index.shtml index.php index.cgi .ht
AuthType Basic
AuthName "Web access"
Satisfy all
Order deny,allow
deny from all
allow from 219.127.9.154
	</pre>
	</div>

	<h3>セッション　＆　IPアドレス</h3>
	<div>
	<pre class="brush: js;">
		  if (isset($_SESSION['shisetsu_id'])) {
			$shisetsu_id = $_SESSION['shisetsu_id'];
			$page_title = $_SESSION['shisetsu_name_short'];
			$kanri = $_SESSION['shisetsu_id'];
			$shozoku = $_SESSION['s_shozoku'];
			$shisetsu_pid = $_SESSION['shisetsu_pid'];
			$slevel = $_SESSION['s_level'];
			$spp_shain_id = $kanri%10000;
			$spp_shozoku = $shozoku;
			$shozoku2 = $shozoku;
		  }
		  if ($spp_shain_id == 1) {$spp_shain_id = 677;}
// ---------------------------------------------------------------------------
	// ipaddress
		$ipAddress = $_SERVER["REMOTE_ADDR"];
		$ipa = $ipAddress;
		$ipa = substr($ipa, 7, 2);
		$ipa = intval($ipa);
		$ip = $ipa;
		$ipima = $ipa;
		$ipc = 0;
			$ipb = $ipAddress;
			$ipb = substr($ipb, 7, 7);
				if (($ipb == "255.227") || ($ipb == "255.228")) {$ipa = 23;} // --------- 海津対策
				if (($ipb == "255.229")) {$ipa = 0;} // kaizu3
				if ($ipAddress == "100.65.16.98") {$ipa = 15;} // ---------------------------------- 脇田対策
				if ($ipAddress == "100.65.16.99") {$ipa = 0;} // ---------------------------------- 常務対策

			if (($shisetsu_pid >= 110) && ($shisetsu_pid <= 111)) { // -----------------------------ケアマネ対策
			$ipc = 920;
			$ipa = $ipc;
			$slevel = 4;
			}

		$ipima = $ipAddress; // 手をつけない今のipアドレス
		$ipima = substr($ipima, 7, 2);
		$ipima = intval($ipima);

		// 会社名　16:川商 26:アドバンス 65:mobile 31:海津
		$ipcom = substr($ipAddress, 4, 2);
	</pre>
	</div>

	<h3>test send mail</h3>
	<div>
	<pre class="brush: js;">
	//   $mailto = $email;
	$mailto = "To:alive1kyo@gmail.com";
	//送信先メールアドレス
    $subject = "Subject:テスト受信メール/";  //メール件名
    //本文
    $content = "『ときどきweb/";
	// from
	$mailfrom = "From:tajiri@kawasho-gr.jp";

	mb_language("Ja") ;
	mb_internal_encoding("UTF-8");

	$header = "MIME-Version: 1.0\n";
//	$header .= "Content-Transfer-Encoding: 7bit\n";
	$header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
	$header .= "Message-Id: <" . md5(uniqid(microtime())) . "@kawasho-gr.jp>\n";
	$header .= "from: tajiri@kawasho-gr.jp\n";
	$header .= "Reply-To: tajiri@kawasho-gr.jp\n";
	$header .= "Return-Path:tajiri@kawasho-gr.jp\n";
	$header .= "X-Mailer: PHP/ livemail";


 //   $mailfrom="From:" .mb_encode_mimeheader($name) ."<".$email.">";


    if(mb_send_mail($mailto,$subject,$content,$header,"-f ".$mailfrom) == true){
        $managerFlag = "○";
    }else{
        $managerFlag = "×";
    }

	echo $managerFlag."<br>";
	echo $mailto.$subject.$content.$header.$mailfrom;
	</pre>
	</div>
<!--------------------------------------------------------------------------------------------------------->
	<h3>天気予報</h3>
	<div>
	<pre class="brush: js;">
	// wheather.html
	function getWeather(URL,day){
	// 引数のURLでlivedoorお天気サービスにアクセスして，指定の地域の天気
	// 情報（JSON形式）を取得し，HTMLコンテンツとして表示する。
	$.post("proxy.php",{"URL":URL},
		function(data){

			// タイトルの表示
			$("#title").text(data.location.prefecture + "・"
				+ data.location.city + "・"
				+ data.forecasts[day].dateLabel + "の天気");

			// ・・・その他もろもろの情報を表示
			$("#telop").text(data.forecasts[day].telop);

			$("#link").attr("href",data.link);

			$("#image").attr("src",data.forecasts[0].image.url);
			$("#image1").attr("src",data.forecasts[1].image.url);

			$("#description").text(data.description.text);

			// ピンポイント予報
			var listr = "";
			for(i = 0 ; i < data.pinpointLocations.length; i++){
				var str = data.pinpointLocations[i].name;
				var lnk = data.pinpointLocations[i].link;
				listr += "<li><a href='"+lnk+"'>"+str+"</a></li>";
			}
			$("#pinpointlocations").html(listr);

			// 発表日時の表示
			$("#publictime").text(data.publicTime);

			// コピーライトの表示
			$("#copyright").text(data.copyright.title);

		},"json"
	);
}
$(function(){
	$("#button").click(function(){
		// メニューで選択した地域と日の天気情報を読みに行く。
		var URL = "http://weather.livedoor.com/forecast/webservice/json/v1?city="+ $("#city option:selected").val();
		var day = $("#day option:selected").val();
		getWeather(URL,day);
	}).click();

	// ↑ページを最初に開いた時には，京都の今日の天気を表示
});
</script>
</head>
<body>
<form id="params" style="float:left">
<select id="city" name="city">
<option value="250010">大津</option>
<option value="250020">彦根</option>
<option value="260010">京都</option>
<option value="260020">舞鶴</option>
<option value="270000" selected>大阪</option>
<option value="280010">神戸</option>
<option value="280020">豊岡</option>
<option value="290010">奈良</option>
<option value="290020">風屋</option>
<option value="300010">和歌山</option>
<option value="300020">潮岬</option>
</select>
の
<select id="day" name="day">
<option value="0" selected>今日</option>
<option value="1">明日</option>
<option value="2">明後日</option>
</select>
の天気：
</form>
<button id="button">GO!</button>
<hr/>
<!--天気情報の表示エリア  -->
<h1 id="title"></h1>
<h2 id="telop"></h2>
<div><a id="link">詳細</a></div>
<div>今日：<img id="image"></img>　明日<img id="image1"></img></div>

<dl>
<dt>概況</dt>
<dd id="description"></dd>
</dl>
<h2>ピンポイント予報</h2>
<ul id="pinpointlocations">
</ul>

<hr/>
<div id="publictime"></div>
<div id="copyright"></div>
	</pre>
	</div>

	<h3>samba4</h3>
	<div>
	<pre class="brush: js;">
	<p>samba4
	http://infra.blog.shinobi.jp/Entry/91/
	https://forums.ubuntulinux.jp/viewtopic.php?id=15361
	https://www.server-world.info/query?os=Ubuntu_16.04&p=samba&f=3
	</p>
	</pre>
	</div>
<!--------------------------------------------------------------------------------------------------------->
	<h3>test_schedule php</h3>
	<div>
	<pre class="brush: js;">
	// test_schedule.php

	$date_string = date("Y-m-d");
list($year,$month,$date,$day) = explode('-', date('Y-n-j-w', strtotime($date_string)));
echo $year."/".$month."/".$date."/".$day;
/**
 *  month,week,day,dnum,date ot date to bit
 *
 *   [2008/3/10]
 *    -month: Mar => 001000000000 => 512
 *    -week:  3rd => 00100        => 4
 *    -day:   Mon => 0100000      => 32
 *    -dnum:  2nd => 01000        => 8
 *    -date:  10  => 000000000100000000000000000000 => 1048576
 *
 *  @param string $date   string of date (ex. 2008-3-10||2008/3/10)
 *
 *  @return object (ex. month=512, week=4, day=32, dnum=8, date=1048576)
 */
function date_to_bit($date_string, $week_start = 0)
{
    list($year,$month,$date,$day) = explode('-', date('Y-n-j-w', strtotime($date_string)));
    $first_day  = date('w', mktime(0,0,0,$month,1,$year));
    $week = ceil(($date+$first_day-$week_start)/7);
    $week = ($first_day<$week_start)?$week+1:$week;
    $dnum = ceil($date/7);

    $week  = bindec(substr_replace('00000', '1', $week-1, 1));
    $dnum  = bindec(substr_replace('00000', '1', $dnum-1, 1));
    $day   = bindec(substr_replace('0000000', '1', $day, 1));
    $month = bindec(substr_replace('000000000000', '1', $month-1, 1));
    $date  = bindec(substr_replace('0000000000000000000000000000000', '1', $date-1, 1));

    return (object)array('month'=>$month,'week'=>$week,'day'=>$day,'dnum'=>$dnum,'date'=>$date);
}

/**
 *  array or string to bitFlag => integer
 *
 *   -month: Jan,Feb,Dec => array(1,2,12)   => 110000000001 => 3073
 *   -week:  1st,3rd     => array(1,3)      => 10100        => 20
 *   -day:   Sun,Wed     => array(0,2)      => 1001000      => 72
 *   -dnum:  1st,3rd     => array(1,3)      => 10100        => 20
 *   -date:  11,21,31    => array(11,21,31) => 000000000010000000001000000001 => 524801
 *
 *  @param string        $type   month||week||day||dnum||date
 *  @param array||string $values array(1,3,5)||'1,3,5'
 *
 *  @return integer
 */
function array_to_bit($type, $values)
{
  if(is_string($values))
  {
    return array_to_bit($type, explode(',', $values));
  }
  elseif(is_array($values))
  {
    $values = array_map('trim',array_values($values));
    $bit = '';
    $start = $end = 1;
    switch($type)
    {
      case 'week':
      case 'dnum':  $end = 5; break;
      case 'month': $end = 12; break;
      case 'day':   $start = 0; $end = 6; break;
      case 'date':  $end = 31; break;
    }
    for($i=$start;$end>=$i;$i++){ $bit.=(in_array($i,$values))?'1':'0'; }
    return bindec($bit);
  }
  else
  {
    return 0;
  }
}

/**
 *  integer to bitFlag => array
 *
 *   -month: 3073 => 110000000001 => array(1,2,12)
 *   -week:  20   => 10100        => array(1,3)
 *   -day:   72   => 1001000      => array(0,2)
 *   -dnum:  20   => 10100        => array(1,3)
 *   -date:  524801 => 10000000001000000001 => array(11,21,31)
 *
 *  @param string  $type   month||week||day||dnum||date
 *  @param integer $int
 *
 *  @return array
 */
function bit_to_array($type, $int)
{
  $values = array();
  if(is_numeric($int))
  {
    $bit = (string)decbin((int)$int);
    $end = $num = 0;
    switch($type)
    {
      case 'week':
      case 'wnum':  $end = 5; $num = 1; break;
      case 'month': $end = 12; $num = 1; break;
      case 'wday':  $end = 7; break;
      case 'day':   $end = 31; $num = 1; break;
    }
    $bit = str_pad($bit, $end, '0', STR_PAD_LEFT);
    for($i=0;$end>$i;$i++){ if($bit[$i]=='1') $values[] = $i+$num; }
  }
  return $values;
}
	</pre>
	</div>
<!--------------------------------------------------------------------------------------------------------->
	<h3>ajax test</h3>
	<div>
	<pre class="brush: js;">
	// sample 1
      $(function() {
        $('#button').click(
          function() {
            $.ajax({
              url: 'sample2.html',
              dataType: 'html',
              success: function(data) {
                $('#text').html(data);
              },
              error: function(data) {
                alert('error');
              }
             });
          }
        );
      });
    </script>
	  <body>
    <input type="button" id="button" value="button"/>
    <br/>
    <div id="text"></div>
	</body>

	// sample 2
	<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CSS overflow</title>
  </head>
  <body>
    <p>Sample2</p>
  </body>
</html>
	</pre>
	</div>
<!--------------------------------------------------------------------------------------------------------->
	<h3>inform php</h3>
	<div>
	<pre class="brush: js;">

	<script type="text/javascript">

	function pstDt(x, y){
		$.post("logon2.php",
			{"x":x, "y":y},
			function(data){
				if (data != ""){
				$("#result").html(data);
				$("#f1").hide();
				} else {

				}
			}
		);
	}

	$(function(){

		// クリックでポップアップ
		$("#btn").click(function(){
			// POST形式でデータを送信し，受信したHTML文字列を画面に表示する
			var x = $("#x").val();
			var y = $("#y").val();
			pstDt(x, y);
		});
		// タイマーでポップアップ
		setInterval(function(){
			var x = "tajiri";
			var y = "19360801";
			pstDt(x, y);
			var p1 = "<p>a</p>";
			$("#result").html(p1);
		},20000); // 20秒

	});
	</script>

	<div id='f1'>
	<h1>ログイン</h1>
	<p>ログインしてください</p>
	<ul>
	<li><p class='w1'>id:</p><input type="text" id="x"/></li>
	<li><p class='w1'>pw:</p><input type="password" id="y"/></li>
	<li><button type="button" id="btn">login</button></li>
	</ul>
	</div>

	<div id="result"></div>
	</pre>
	</div>
<!--------------------------------------------------------------------------------------------------------->
	<h3>logon</h3>
	<div>
	<pre class="brush: js;">
	<!------------>
	// logon.html logon2.php
<script type="text/javascript">

	function pstDt(x, y){
	//	var x2 = localStorage.getItem("id");
	//	var y2 = localStorage.getItem("pw");
	//	if (x2 != ""){
	//		$("#result").attr(x2);
	//	}
		$.post("logon2.php",
			{"x":x, "y":y},
			function(data){
				if (data != ""){
				$("#result").html(data);
				$("#f1").hide();
		//		localStorage.setItem("id", x);
		//		localStorage.setItem("pw", y);
				} else {

				}
			}
		);
	}

	$(function(){

		// クリックでポップアップ
		$("#btn").click(function(){
			// POST形式でデータを送信し，受信したHTML文字列を画面に表示する
			var x = $("#x").val();
			var y = $("#y").val();
			pstDt(x, y);
		});
		// タイマーでポップアップ
		setInterval(function(){
			var x = "tajiri";
			var y = "19360801";
			pstDt(x, y);
		},5000); // 10秒

	});
</script>
	<div id='f1'>
<h1>ログイン</h1>
<p>ログインしてください</p>
<ul>
<li><p class='w1'>id:</p><input type="text" id="x"/></li>
<li><p class='w1'>pw:</p><input type="password" id="y"/></li>
<li><button type="button" id="btn">login</button></li>
</ul>
</div>

<div id="result"></div>
	<!------------>
	// logon2
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
	</pre>
	</div>
<!--------------------------------------------------------------------------------------------------------->
	<h3>test checkbox php</h3>
	<div>
	<pre class="brush: js;">
	<?php

if (isset($_GET['chk'])){
	$chk = $_GET['chk'];
//	var_dump($chk);
	for($i=0;$i<count($chk);$i++){
		$a1 = substr($chk[$i],0,3);
		$a2 = substr($chk[$i],4,1);
		echo "a=".$a1."-".$a2."<br>";
	}

}


?>
<script type="text/javascript">
/* ready method */
	$(function(){

		$("#hide1").click(function(){
			$("table").eq(1).hide();
		});

		$("#slct").click(function(){

		});
	});
</script>
<body class="top">
<div>
<form>
<div id='inputs'>
<input type='submit' value='登録'>
<input type='button' value='隠す' id='hide1'>
<input type='' value=''>
</div>
<table><tbody>
<tr><td>
<?php
	$chkd = array();
	$id = 0;
	$dt = 0;
	$disp0 = "";
	for ($i=1;$i<=4;$i++){
		if ((isset($chkd[$id][$dt][$i])) && ($chkd[$id][$dt][$i] == 1)){$chked = "checked";} else {$chked = "";}
		$disp0 .= "<input type='checkbox' name='chk[]' value='101:{$i}' {$chked}><br>";
	}
	echo $disp0;
?>

</td><td>
<input type='checkbox' name='chk[]' value='102:1'>
</td>
</tbody></table>
<table><tbody>
<tr><td>
<input type='checkbox' name='chk[]' value='201:2'>
</td><td>
<input type='checkbox' name='chk[]' value='202:1'>
</td>
</tbody></table>

</form>
</div>

</body>
	</pre>
	</div>
<!--------------------------------------------------------------------------------------------------------->
	<h3>社員順番入れ替え jq/index.html</h3>
	<div>
	<pre class="brush: js;">

	<script type="text/javascript" src="js/jquery.reveal.js"></script>
<script>
$(function(){
    setInterval(function(){
      //  alert("KKK");
//	  window.open(this.href,"WindowName","width=600,height=500,resizable=yes,scrollbars=yes");
 //       return false;

    },10000);
});


</script>
</head>
<body>
<p><a href="#" data-reveal-id="myModal">上から表示</a></p>
<div id="myModal" class="reveal-modal">
<h1>社員の順番を入れ替え</h1>
<form>


<ul id="sorttable">
<li><input type='hidden' name='chk' value='1'>社員1</li>
<li><input type='hidden' name='chk' value='5'>社員5</li>
<li><input type='hidden' name='chk' value='6'>社員6</li>
<li><input type='hidden' name='chk' value='3'>社員3</li>
<li><input type='hidden' name='chk' value='7'>社員7</li>
<li><input type='hidden' name='chk' value='2'>社員2</li>
<li><input type='hidden' name='chk' value='4'>社員4</li>
<li><input type='hidden' name='chk' value='1'>社員1</li>
<li><input type='hidden' name='chk' value='4'>社員44</li>
</ul>


<input type='submit' value='aa'>
</form>
</div>
<script type="text/javascript">
$(function(){
	$('#sorttable').sortable({
		cursor:'move',
		opacity:0.5,
		placeholder:'placeholder',
	}).disableSelection();
});
</script>

	</pre>
	</div>

<!--------------------------------------------------------------------------------------------------------->
	<!------------>
	<h3>新規用セット</h3>
	<div>
	<pre class="brush: js;">
	</pre>
	</div>
	<!------------>
	</div>
	</div>
</body>
</html>
