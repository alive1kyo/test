<?php
/** en_ereamgrs.php
 * @copyright & author ryotajiri

*/
	// 初期化処理 ================================================================
	define('INTERNAL_ENCODING', 'UTF-8');
	mb_internal_encoding(INTERNAL_ENCODING);
	mb_regex_encoding(INTERNAL_ENCODING);
	define('MYSELF', basename($_SERVER['SCRIPT_NAME']));
	$myself = MYSELF;
//	define('REFERENCE', 'http://www.pahoo.org/e-soul/webtech/php02/php02-27-01.shtm');

	// Define database connection constants====================================

	require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	mysqli_set_charset( $dbc, "UTF8");
//	global $dbc;
	define('NYURYOKUMOJISU', '1024');
	
	$imads = date("Ymd");
	
	//	global $youbi;
	$clryb = array('crimson','','','','','','skyblue','');
	//	global $clryb;
		$year = isset($_COOKIE['YEAR']) ? $_COOKIE['YEAR'] : intval(date("Y"));
		$mon = isset($_COOKIE['mon']) ? $_COOKIE['mon'] : intval(date("m"));
		if (isset($_GET['ym'])) {
			$ym = $_GET['ym'];
			$year = substr($ym,0,4);
			$mon = intval(substr($ym,4,2));
			setcookie('YEAR',$year,time()+86400,'/');
			setcookie('mon',$mon,time()+86400,'/');
		}
		$msg = '';
//	echo "year=".$year."&mon=".$mon;
	$kanry2 = 200001;
	//*****
// ---------------------------------------------------------------------------
	// セッション
  require_once('startsession.php');
// ---------------------------------------------------------------------------

	if (isset($_SESSION['shisetsu_id'])) {
	  $shisetsu_id = $_SESSION['shisetsu_id'];
	  $page_title = $_SESSION['shisetsu_name_short'];
	  $kanri = $_SESSION['shisetsu_id'];
	  $shozoku2 = $_SESSION['s_shozoku'];
	    $slevel = $_SESSION['s_level'];
		$spp_shain_id = $kanri%10000;
	  }
	  define('SLEVEL', $slevel);
	  define('SPP_SHAIN_ID', $spp_shain_id);
//	echo $shisetsu_id.":".$page_title.":".$kanri.":".$shozoku2.":".$slevel.":".$spp_shain_id;
	// ---


	$sql = "SELECT * FROM emp_tbl";
	$res = mysqli_query($dbc, $sql);
	while ($row = mysqli_fetch_array($res) ){
		$shain_idk = $row['shain_id'];
		$s_name[$shain_idk] = $row['s_name'];
		$s_names[$shain_idk] = $row['s_names'];
		$s_lev[$shain_idk] = $row['s_level'];
		if ($shain_idk == $spp_shain_id){
			$shainmei = $row['s_name'];
			define('SHAIN_MEI', $shainmei);
		}
	}

	$lev = array("","本社管理職","本社事務職","マネージャー","管理者・サ責","相談員","現場事務","本社営業","営業管理","ケアマネージャー","未定義","人事・システム管理者","役員");
	// if ((in_array($spp_shain_id,$eizens)) || (in_array($shain_id,$eizens))) {
		// $lev = array("","本社管理職","本社事務職","マネージャー","管理者・サ責","営繕","現場事務","本社営業","営業管理","","","人事・システム管理者","役員");
	// }
	$colors = array("","skyblue","yellowgreen","yellow","pink","red","olive");
// ---------------------------------------------------------------------------
	// エリアマネージャーの抽出
	$sql = "SELECT * FROM en_busho WHERE enbstate = 1";
	$res = mysqli_query($dbc, $sql);
	while ($row = mysqli_fetch_array($res) ){
		$enbshainid = $row['enbshainid'];
		$enbusho = $row['enbusho'];
	//	$enb[$enbshainid][$enbusho] = 1;
		switch($enbusho){
			case 1:// 営業所属 1　他の営業も表示する
				$eigyos[] = $enbshainid;
			break;
			case 11:// 営業管理　11　他の営業の内容を触れる
				$eigyok[] = $enbshainid;
			break;
			case 2://　エリアマネージャー 2 自分しか表示しない
				$mangrs[] = $enbshainid;
			break;
			case 3:// 営繕所属 3
				$eizens[] = $enbshainid;
			break;
			case 9:// ケアマネージャー　9
				$cmngrs[] = $enbshainid;
			break;
			case 13:// 営繕管理 13
				$eizenk[] = $enbshainid;
			break;
			case 21://　本社所属 21
				$honsys[] = $enbshainid;
			break;
			case 22:// 総務所属 22
				$soumus[] = $enbshainid;
			break;
			case 29:// 役員 29
				$yakuis[] = $enbshainid;
			break;
			case 31:// システム
				$systms[] = $enbshainid;
			break;
			default:
			break;
		}
	}
		$tachable = $systms;
		$tachable[] .= $spp_shain_id;

// --------------------------------------------------------------------------
	// 個別表示のためのクッキー
		$ckeysid = 0;
		if (isset($_COOKIE['CKEY'])) {
			$ckeysid = $_COOKIE['CKEY'];
		//	echo $ckeysid;
		}
		if (isset($_GET['removeckey'])) {
			// setcookie の第４引数が重要だった！
			setcookie('CKEY','',time()-1800,'/');
			$ckeysid = 0;
			setcookie('HTMR',0,time()-1800,'/');
			$htmr = 0;
		}
//	echo "ckeysid=".$ckeysid."/CKEY=".$_COOKIE['CKEY']."/HTMR=".$_COOKIE['HTMR'];

	//	var_dump($tachable);
// ---------------------------------------------------------------------------
	// groupのためのクッキー
		$group = 0;
		if (isset($_COOKIE['GRP'])) {
			$group = $_COOKIE['GRP'];
		//	echo $group;
		}
		if (isset($_GET['grp'])) {
			// setcookie の第４引数が重要だった！
			setcookie('GRP',$_GET['grp'],time()+864000,'/');
			$group = $_GET['grp'];
		}
	// 表示グループの切り替え
	function makeSlctgrps($group){
//	echo "group=".$group;
//	$group = 9;
		global $myself;
		global $dbc;
		$sql = "SELECT * FROM en_bushoname";
		$res = mysqli_query($dbc, $sql);
		while ($row = mysqli_fetch_array($res)){
			$bid[] = $row['bnid'];
			$bushos[] = $row['bname'];
		}
		$option = "";
		for ($i = 0; $i < count($bid); $i++){
			$option .= "<option value='{$bid[$i]}'";
			if ($bid[$i] == $group) {$option .= " selected";}
		//	$option .= " onclick='location.href=\"{$myself}?grp={$bid[$i]}\"'>{$bushos[$i]}</optino>\n";
			$option .= " >{$bushos[$i]}</optino>\n";
		}
		$slctgroup = "<select name='grp' id='grp' style='font-size:0.8em; width:70px; height:30px;' >\n{$option}</select>\n";
	return($slctgroup);
	}
	$slctgroup = makeSlctgrps($group);
// -----------------------------------	
//	予定にデータのある人のみ表示する
	//	$mangrz = array_unique($mangrz);
	//	$mangrz = array_values($mangrz);
//	$mangrz = sort($mangrz, SORT_NUMERIC);
//	（背反関係）
// ************************************************
// ************************************************
//	対象者は予定がなくても表示する
	switch($group){
		case 9: $mangrz = $cmngrs;
		break;
		case 21: $mangrz = $honsys;
		break;
		case 31: $mangrz = $systms;
		break;
		default: $mangrz = $cmngrs;
	}
	
//	echo var_dump($mangrz);		
// ---------------------------------------------------------------------------
	// cldsのためのクッキー
		$clds = 0;
		if (isset($_COOKIE['CLD'])) {
			$clds = $_COOKIE['CLD'];
		//	echo $clds;
		}
		if (isset($_GET['clds'])) {
			// setcookie の第４引数が重要だった！
			setcookie('CLD',$_GET['clds'],time()+864000,'/');
			$clds = $_GET['clds'];
		}
	// 表示カレンダーの切り替え
	function makeSlctclds($clds){
		global $myself;
		$cldsn = array("31日A","上半月","下半月","31日B");
		$option = "";
		for ($i = 0; $i < 4; $i++){
			$option .= "<option value='{$i}'";
			if ($i == $clds) {$option .= " selected";}
		//	$option .= " onclick='location.href=\"{$myself}?clds={$i}\"'>{$cldsn[$i]}</optino>\n";
			$option .= ">{$cldsn[$i]}</optino>\n";
		}
		$slctclds = "<select name='clds' id='clds' style='font-size:0.8em; width:70px; height:30px;' >\n{$option}</select>\n";
	return($slctclds);
	}
	$slctclds = makeSlctclds($clds);
// ---------------------------------------------------------------------------
	//　予定の抽出
	function makeStdedd($year, $mon){
		$d1d = $year."-".$mon."-1";
		$d1str = strtotime($d1d);
		$std = date("Ymd",($d1str-(86400*7)));
		$edd = date("Ymd",($d1str+(604800*7)));
		return array($std, $edd);
	}
	$i = 0;
	
// -----------------------------------
// en_weekのデータ取得	
/* 	function getEnweek($std, $edd){
		global $dbc;
		$sql = "SELECT * FROM en_week WHERE enw_date > $std AND enw_date < $edd AND enw_state = 1 ORDER BY enw_shainid";
		$res = mysqli_query($dbc, $sql);
		while ($row = mysqli_fetch_array($res) ){
			$enw_shainid = $row['enw_shainid'];
			// カレンダーの対象はmangrs
			if (in_array($enw_shainid,$mangrs)){
				$ed = $row['enw_date'];
				$enw_plan[$enw_shainid][$ed] = $row['enw_plan'];
				$mangrz[$i] = $enw_shainid;
				$i++;
			}
		}
	return array($ed, $enw_plan, $mangrz);
	}
	 */
	
// -----------------------------------
// en_schdlのデータ取得	
	function getSchdl($std, $edd){
		global $dbc;
		$sql = "SELECT * FROM en_schdl WHERE schdl_day > $std AND schdl_day < $edd AND schdl_state = 1 ORDER BY schdl_day, schdlgid DESC, schdl_stm";
//	echo $sql;
		$res = mysqli_query($dbc, $sql);
		while ($row = mysqli_fetch_array($res)){
			$shain_id = $row['shain_id'];
			$day = $row['schdl_day'];
			$schdlid[$shain_id][$day][] = $row['schdlid'];
			$schdlgid[$shain_id][$day][] = $row['schdlgid'];
			$schdl_title[$shain_id][$day][] = $row['schdl_title'];
			$schdl_dtl[$shain_id][$day][] = $row['schdl_dtl'];
			$schdl_color[$shain_id][$day][] = $row['schdl_clr'];
			if ($row['schdl_allday_flg'] == 0){
				$t = intval($row['schdl_stm']/100).":".sprintf("%02d",$row['schdl_stm']%100)."-".intval($row['schdl_etm']/100).":".sprintf("%02d",$row['schdl_etm']%100);
				$schdl_time[$shain_id][$day][] = $t;
			} else {
				$schdl_time[$shain_id][$day][] = "終日";
			}
		}
	return array($schdlid, $schdlgid, $schdl_title, $schdl_time, $schdl_dtl, $schdl_color);
	}

	// カレンダーの最初のデータ取得
	function getFday(){
		global $dbc;
		$sql = "SELECT * FROM en_schdl WHERE schdl_day > 0 ORDER BY schdl_day LIMIT 1";
//	echo $sql;
		$res = mysqli_query($dbc, $sql);
		while ($row = mysqli_fetch_array($res)){
			$day = $row['schdl_day'];
		}
		$fym = substr($day,0,6);
	return($fym);
	}
	$fym = getFday();
//	echo "fday=".$fym;
	// 年月の選択
	function makeYm($fym, $year, $mon){
		$sy = substr($fym,0,4);
		$sm = intval(substr($fym,4,2));
		$ey = date("Y");
		$em = intval(date("m"));
		$a = $em - $sm;
		$b = $ey - $sy;
		if ($a < 0){$a += 12; $b--;}
		$count = ($b*12) + $a +1;
//	echo "c=".$count."/a=".$a."/b=".$b;
		$option = "";
			$m = sprintf("%02d",$em);
			$y = $ey;
		for($i = 0; $i < $count; $i++){
			$ym = $y.$m;
			$option .= "<option value='{$ym}'";
			if (($y == $year) && ($m == $mon)) {$option .= " selected";}
			$option .= ">{$y}-{$m}</optino>\n";
			$m--;
			if ($m < 1){$m+=12; $y--;}
		}
		$slctym = "<select name='ym' id='ym' style='font-size:0.8em; width:70px; height:30px;' >\n{$option}</select>\n";
	return($slctym);
	}
	$slctym = makeYm($fym, $year, $mon);
// ================================== カレンダーphp
	require_once('f_calender.php');
// ==================================

	//	入力候補
			LIST($std, $edd) = makeStdedd($year, $mon);
			$rooms = "[";
			// DISTINCTの位置に注意が必要
			$sql = "SELECT DISTINCT schdl_title FROM en_schdl WHERE shain_id = $spp_shain_id ORDER BY schdl_day LIMIT 30";
			$res = mysqli_query($dbc, $sql);
			while( $row = mysqli_fetch_array($res) ) {
				$stitles = $row['schdl_title'];
				$rooms .= '{"value":"'.$stitles.'","titles":"'.$stitles.'"},';
			}
			if (mb_strlen($rooms) > 1) {
				$rooms = substr($rooms, 0, -1)."]";
			} else {
				// javascriptの構文エラーを回避するために必要
				$rooms .= '{"value":"","titles":""}]';
			}
			
// **************************************************************************************************************************************
//プログラム・タイトル
define('TITLE', 'ケアマネージャー予定一覧');

/**
 * 共通HTMLヘッダ
 * @global string $HtmlHeader
*/
$encode = INTERNAL_ENCODING;
$title = TITLE;
$HtmlHeader = '';
$HtmlHeader .=<<<EOD
<!DOCTYPE html>
<html>
<head>
<meta charset="{$encode}">
<title>{$title}</title>
<meta name="author" content="studio pahoo" />
<meta name="copyright" content="studio pahoo" />
<meta name="ROBOTS" content="NOINDEX,NOFOLLOW" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
		  <link rel='stylesheet' href='/css/style2.css'>
		  <link rel="stylesheet" href="/css/table4.css">
		  <link rel="shortcut icon" href="favicon.ico">
		  
			<!-- 名前候補用スクリプト -->
		
	<!--	<link type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet" /> -->
	<!--	<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script> -->
	<!--	<script type="text/javascript" src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
		<script type="text/javascript" src="/js/jquery-1.7.1.js"></script>
		<script type="text/javascript" src="/js/jquery-ui.js"></script>
		<link type="text/css" href="/js/jquery-ui.css" rel="stylesheet" />
		
	<!--	<script type="text/javascript" src="/js/jquery.fittext.js"></script> -->
		
		<script type="text/javascript" src="/js/js.cookie.js"></script>
		<script type="text/javascript" src="/js/jquery.timers.js"></script>
	<!--	<script type="text/javascript" src="js/jquery-ui-1.10.0.custom.min.js"></script> -->

	<style type="text/css">
		td:first-child {
			text-align: left;
		/*	padding-left: 20px;*/
			width: 100px;
		}
		tr.days td:not(first-child) {
			text-align: center;
		/*	width: 120px;*/
		}
		td.youb {width: 13%;}
		
		tr.days td {
			background-color: lightgray;
			height:45px;
			}
		/*tr.days td:first-child + td {background-color: #ff6666;}*/
		/*tr.days td:last-child {background-color: #00ccff;}*/
		tr.days td.holiday, tbody.days tr td.holiday {background-color: #ff6666;}
		tr.days td.sunday, tbody.days tr td.sunday {background-color: #ff6666;}
		tr.days td.saturday, tbody.days tr td.saturday {background-color: #C2EEFF;}
		
		tr:not(.days):not(#week) td:not(.namex) {font-size: 14px;}
	/*	tr:not(.days):not(#week):nth-child(2n) {background-color: #cbffd3;}*/
		tr.kobe2  {background-color: #cbffd3;}
		
		tr#detail div {
			margin : 5 0;
		}
		
		#title {
			margin-top: 0;
			background-color: #B1F9D0;
			padding: 15;
		}

		.tdy {background-color: #FFDEAD;}
		.tmon {color: gray;}
		td.themon {padding: 10; font-size: 24px; height: 55px; font-weight: bold;}
		.days {border-top: 2px solid;}
		.schtm {color: blue; font-size: 10px;}
		.schtmg {color: gray; font-size: 10px;}
		.ttl {background-color: #cbffd3; line-height: 30px; font-weight: bold;}
		.hiduke, .shainmei {font-size: 16px; font-weight: bold;}
		.ttlb {font-size: 26px; font-weight: bold;}
		.clock {
			margin: 0 0 1 0;
			padding: 1 0 0 3;
			width: 98%;
		/*	background-color: #FFDEAD;*/
			}
		/*半月仕様*/
		div.clock2 {
			float: left;
			margin: 0 2 1 0;
			padding: 1 0 2 3;
			border: solid 1px;
			border-color: gray;
			}
		.fnt {font-size: 12px;}	
		tbody {border: 2px solid;}
		
		tr.hover td:not(.namex){
			border-top:1px solid red;
			border-bottom:1px solid red;
			background-color: #99FF66;
		}
		
		table {
			margin: 5 0; 
			border-collapse: collapse;
			cellpadding: 0;
			}
		table#main {width: 100%;}
		tbody tr td input[type="button"]{
			margin: 0 15 0 0;
		}
		td.namex {
			padding: 10px;
		}
		td.namex a {
			display:block;
			width: 100%;
			height:100%;
		}
		td.namex:hover {
			background-color: palegreen;
		}
		td.sch, td.schs {
			margin: 2;
			padding: 0;
			vertical-align: top;
		}
		td img {
			align: top;
			width:10px;
			margin: 0;
			padding: 0;
		}
		
		span.hol {
			font-size: 11px;
		}
		#menu1 input {
			vertical-align:baseline; 
			margin: 5px 5px;
			height: 30px;
			}
		
	</style>
		  

	<script>
	
	function changePage(row){
		var str = row.children().eq(0).text();
		var a1 = str.split("[");
			a2 = a1[1].split("]");
		Cookies.set("CKEY", a2[0], { expires: 7 });
		var str = ".n"+a2[0];
		$("tr").not("#week,.days").hide();
		$("tr.kobe2").css("background-color","white");
		$(str).show();
	}
	
	function CountDownLength( idn, str, mnum ) {
		document.getElementById(idn).innerHTML = "あと" + (mnum - str.length) + "文字";
	}
	function CountDownLength2( idn, str, mnum ) {
		document.getElementById(idn).innerHTML = "あと" + (mnum - str) + "文字";
	}

	function removeCkey(){
		Cookies.remove("CKEY");
	}
	
	$(function(){
		
		$(window).load(function(){
			$(".loadingWrap").fadeOut();
		});
EOD;

	$htimer .=<<<EOD
	var i=30;
	var lim=0;
	$(document).everyTime(1000,'timer01',function(){
		i--;
		if(i<=lim) location.reload(true);
		$('.sample01').text(i);
	});
EOD;
	// タイマー
	// htimerのためのクッキー
		$htmr = 0;
		if (isset($_COOKIE['HTMR'])) {
			$htmr = $_COOKIE['HTMR'];
		//	echo $htmr;
		}
		if (isset($_GET['htmr'])) {
			// setcookie の第４引数が重要だった！
			setcookie('HTMR',1,'','/');
			$htmr = $_GET['htmr'];
		}
		
	switch($htmr){
		case 0: $htimer = "";	
				$htmr = 1;
		break;
		case 1: $htmr = 0;
		break;
		default: $htimer = "";
	}
	$HtmlHeader .= $htimer;

	$HtmlHeader .=<<< EOD
	// fittext
	//	$(".fnt").css("font-size","12px");
	//	$(".fnt").fitText(1.1);	
		
		var ckey1 = Cookies.get("CKEY");
	//	Cookies.remove("CKEY");
		if (ckey1 > 0){
		//	Cookies.remove("CKEY");
		//	var ckey1 = Cookies.get("CKEY");
		//	alert(ckey1);
		//	var str = ".n"+ckey1;
		//	$("tr").not("#week,.days").hide();
			$("tr.kobe2").css("background-color","white");
		//	$(str).show();
			// $("td.namex").on({"click":function(){
					// location.reload();
				// }
			// });
		}
		
		// 名前クリックで他の人を隠す
		$("td.namex").on({"mouseover mouseout":function(){
			$(this).toggleClass("hover");
		},
		"click":function(){
		//	var ckey1 = Cookies.get("CKEY");
		//	if (ckey1 > 0){
			//	Cookies.remove("CKEY");
			//	location.reload();
			//	$("tr").not("#week,.days").show();
		//	} else {
		//		changePage($(this));
		//	}
			changePage($(this));
		}
		});
		
		// タイトル　あと何文字を最初は隠す
		$("#cdlgt1").hide();
		$("#idn").keyup(function(){
			var lgn = $(this).val().length;
			$("#cdlgt1").show();
			CountDownLength( 'idn', lgn, 32 );
		});
		// 詳細
		$("#cdlgt2").hide();
		$("#dtla").keyup(function(){
			var lgn2 = $(this).val().replace(/\s+/g,'').length;
		//	alert(lgn2);
			$("#cdlgt2").show();
		//	var idn = 'cdlgt2';
			CountDownLength2( 'cdlgt2', lgn2, 120 );
		});
		
		
		// 終日チェックボックスで時間を隠す
		// リロード対策
		if ($("#chk1").prop('checked') == true){
			$(".ttls").hide();
		}
		// クリックされたら
		$("#chk1").click(function(){
			if ($(this).prop('checked') == true){
				$(".ttls").hide();
			//	$(".ttls").prev().html(txt.replace(''));
			} else {
				$(".ttls").show();
			}
		});
		
		// 詳細のチェックボックス
		$("#detail").hide();
		if ($("#chk2").prop('checked') == true){
				$("#detail").show();
		}
		// クリックされたら
		$("#chk2").click(function(){
			if ($(this).prop('checked') == true){
				$("#detail").show();
			} else {
				$("#detail").hide();
			}
		});
		
		// 入力候補
		var titleslist = {$rooms};
		$("#idn").autocomplete({
			source:titleslist
		});
		
		// グループ切り替え
		$("#grp").change(function(){
			var val = $("#grp").find(':selected').val();
			var loc = 'http://'+location.host+location.pathname+'?grp='+val;
			location.href = loc;
		//	alert(loc);
		});
		
		// カレンダー切り替え
		$("#clds").change(function(){
			var val = $("#clds").find(':selected').val();
			var loc = 'http://'+location.host+location.pathname+'?clds='+val;
			location.href = loc;
		});
		
		// 年月切り替え
		$("#ym").change(function(){
			var val = $("#ym").find(':selected').val();
			var loc = 'http://'+location.host+location.pathname+'?ym='+val+'&sanshosid=IPC';
			location.href = loc;
		});
		
	}); // end of event listener

	function sakujo(){
	  ret = confirm("本当に削除してもよろしいすか？");
	  if (ret == true){
	  this.sakujo.submit(); 
	  } else {
		return false;
		}
	}
	
	</script>

</head>
<body>

<!-- start of loadingwrap -->
<div class='loadingWrap'>
<img src='images/8a33b035.gif'>
</div> <!-- end of loadingwrap -->

EOD;
$HtmlHeader .= "<div id='wrapper";
	// 表示幅変更
	// wbuttonのためのクッキー
		$wbtn = 0;
		if (isset($_COOKIE['WBTN'])) {
			$wbtn = $_COOKIE['WBTN'];
		//	echo $wbtn;
		}
		if (isset($_GET['wbtn'])) {
			// setcookie の第４引数が重要だった！
			setcookie('WBTN',$_GET['wbtn'],time()+864000,'/');
			$wbtn = $_GET['wbtn'];
		}
//	echo "wbtn=".$wbtn."/cookie=".$_COOKIE['WBTN'];	
		switch($wbtn){
			case 0: $HtmlHeader .= "";	
					$wbtnx = 1;
			break;
			case 1: $HtmlHeader .= "_ww";
					$wbtnx = 0;
			break;
			default: $HtmlHeader .= "";
					$wbtnx = 1;
		}
	$wbutton = "<input type='button' value='幅変更' onclick='location.href=\"{$myself}?wbtn={$wbtnx}\"'>";
$HtmlHeader .= "'>";

/**
 * 共通HTMLフッタ
 * @global string $HtmlFooter
*/
$HtmlFooter = "<hr />";
if ($primo == 0){
$HtmlFooter .= "<p class='footer'>&copy;".date("Y")." Kawasho, Inc. & RyoTajiri, this page is running since 2017</p>";
} 
$HtmlFooter .=<<< EOD
  </div>
</body>
</html>

EOD;

// --------------------------------------------------------------------------------------

	function makeCommonMenu($year, $mon) {
	// カレンダー時のヘッダー部分

		$spp_shain_id = SPP_SHAIN_ID;
		global $myself;
		$refere = REFERENCE;
		$title  = TITLE;
		$shainmei = SHAIN_MEI;
		$slevel = SLEVEL;
		$ipc = IPC;
		global $shisetsu_name_short;
		global $lev;
		global $slctym;
				$sakujobun = 0;
			if (isset($_GET['sakujobun'])) {
				$sakujobun = 1;
			}
	//	$select_shisetsu = SELECT_SHISETSU;
		$version = '<span style="font-size:small;"><span class="gray2">' . date('Y/m/d版', filemtime(__FILE__)) . '</span>　　　ログオン者：'.$shainmei.''." (".$lev[$slevel].")</span>";
		$pre_mon = $mon-1;
		$pre_year = $year;
		if ($pre_mon == 0) {
			$pre_mon = 12;
			$pre_year = $year-1;
		}
		$next_mon = $mon+1;
		$next_year = $year;
		if ($next_mon == 13) {
			$next_mon = 1;
			$next_year = $year+1;
		}
		$month = date("m");
	
//	$slct_busho = slctBusho();
	
	$menu0 = "<h2 id='title'><span>{$title} {$year}年{$mon}月分 　　{$version}</span></h2>";

	$menu =<<< EOT
<div class='nopri' id='menu1'>
<form name="myform" method="get" action="{$myself}">
<input type="button" class='' value="menu" onclick="location.href='menu.php'">  
EOT;
//<input type="button" value="日報・週報" onclick="location.href='en_nippo.php'">
	$menu .= $slctym;
	$menu .= "<input type='button' value='前月' onclick=\"location.href='{$myself}?year={$pre_year}&mon={$pre_mon}&sanshosid={$ipc}'\">";
/*西暦年：<input name="year" type="text" size="2" value="{$year}" />
月：<input name="mon" type="text" size="1" value="{$mon}" />
<input type="submit" value="" >*/
	$ym = date("Ym");
	$menu .=<<< EOT
<input type="button" value="当月" onclick="location.href='{$myself}?ym={$ym}&sanshosid={$ipc}'">
EOT;
	//	if ($sakujobun == 0) {
		// $menu .= "<input type=\"button\" value=\"復活\" onclick=\"location.href='{$myself}?year={$year}&mon={$mon}&sanshosid={$ipc}&sakujobun=1'\">&nbsp;&nbsp;";
		// } else {
		// $menu .= "<input type=\"button\" value=\"当月\" onclick=\"location.href='{$myself}?sanshosid={$ipc}'\">";
		// }
		$menu .= "<input type=\"button\" value=\"翌月\" onclick=\"location.href='{$myself}?year={$next_year}&mon={$next_mon}&sanshosid={$ipc}'\">&nbsp;&nbsp;";
		$menu .= "<input type='button' value='更新' onclick=\"location.href='{$myself}?year={$year}&mon={$mon}&sanshosid={$ipc}&removeckey=1'\">&nbsp;&nbsp;";
		return array($menu0, $menu);
	}
		LIST($menu0, $menu) = makeCommonMenu($year, $mon);
		
		$menu .= $wbutton;
		if ($spp_shain_id == 677){
			$menu .= "&nbsp;&nbsp;".$slctclds."&nbsp;&nbsp;".$slctgroup."&nbsp;&nbsp;";
		}
		// タイマーボタン
		$menu .= "&nbsp;&nbsp;<input type='button' value='自動更新' class='item mt5' onclick='location=\"{$myself}?htmr=1\"'>";
		$menu .= "あと<span class='sample01'>30</span>秒";
		$menu .= "</form></div><hr />";
		
// **************************************************************************************************************************************
// 月末
	function getsuMatsu($year, $mon) {
		$getsumatsu = $year."-".$mon."-01 00:00:00";
		$getsumatsu = strtotime($getsumatsu) - 1;
		$getsumatsu = date("d", $getsumatsu);
		$matsu = intval($getsumatsu);
	return($matsu);
	}
//　カレンダー本体(1カ月バージョン)
	function makeCalenderBody($year, $mon, $half){
		LIST($std, $edd) = makeStdedd($year, $mon);
		LIST($schdlid, $schdlgid, $schdl_title, $schdl_time, $schdl_dtl, $schdl_color) = getSchdl($std, $edd);
		global $myself;
		global $spp_shain_id;
		global $tachable;
		global $mangrz;
	//	global $mangr;
		global $s_names;
		global $ckeysid;
		global $colors;
	//	global $enw_plan;
		// カレンダーの最初に表示する前月の日を求める
		$d1d = $year."-".$mon."-1";
		$d1str = strtotime($d1d);
		//　まず１日のSTRを求める
		$w = date("w",$d1str);
		//　曜日に変換する
		$wx = -1;
		$iw = ($w+$wx >= 0) ? $w+$wx : $w+$wx+7;
		$dstr = $d1str - (86400*($iw));
		$d = $dstr;
		//　カレンダーの最初の月日STR
		//　ｄは動かす
		$youbi = array('日', '月', '火', '水', '木', '金', '土', '日');
		$youbiclr = array('sunday', '', '', '', '', '', 'saturday', 'sunday');
		$is = 1;
		$ie = 8;
		
		$dt = date("Ymd");
		$matsu = getsuMatsu($year, $mon);
		//　カレンダーの週数を求める
		$shu = ceil(($matsu+$iw)/7);
		
		$b = "<table id='main'><tbody>";
		$b .= "<tr id='week' class='days'>";
		$b .= "<td></td>"; // 社員名が入る欄
		// 曜日
		for ($i = $is; $i < $ie; $i++){
			$b .= "<td class='youb'>{$youbi[$i]}</td>";
		}
		$b .= "</tr>";
		
	//　週部分	
		for ($i = 0; $i < $shu; $i++){
			$b .= "<tr class='days'>";
			$b .= "<td></td>";
			// -月-日作成部分
			for ($k = $is; $k < $ie; $k++){
				$hname = "";
				$cls04 = "";
				list($yy,$mm,$dd) = explode('-',date("Y-m-d",$d));

				// 祝祭日取得	
				$hname = getHoliday($yy, $mm, $dd, 'jp');
				if ($hname != FALSE) {
					$cls04 = "holiday";
					$hname = "<br><span class='hol'>".$hname."</span>";
				}
				if (mb_strlen($cls04) == 0){$cls04 = $youbiclr[$k];}
				// 月が違う日は色を薄くするtmon
				if (date("m",$d) != $mon){$cls03 = "tmon";} else {$cls03 = "";}
				$b .= "<td class='{$cls03} {$cls04}'>".date("m月d日",$d).$hname."</td>";
				$d+=86400;
			}
			$b .= "</tr>";
			// ---　スケジュール部分
			for ($j = 0; $j < count($mangrz); $j++){
				//　人ごと（１週）
				$d-=(86400*7);
				$cls00 = "n".$mangrz[$j];
				$sunday = date("Ymd",$d);
				$stdy = strtotime($sunday)-86400;
				$yearz = date("Y",$stdy);
				$monz = date("m",$stdy);
				$dayz = date("d",$stdy);
				if ($j%2 == 1){$cls0k = "kobe2";} else {$cls0k = "";}
				// 表示する人 ckeysid => クッキー
				if (($ckeysid == 0) || (($ckeysid > 0) && ($ckeysid == $mangrz[$j]))) {
					$b .= "<tr class='{$cls0k} {$cls00}'>";
					$b .= "<td class='namex'>";
					$b .= "{$s_names[$mangrz[$j]]}<span style='color:white'>[{$mangrz[$j]}]</span></td>";
					for ($k = $is; $k < $ie; $k++){
						//　日々のスケジュール
						$theday = date("Ymd",$d);
						// 今日は色を変える
						if ($theday == $dt){$cls01 = "tdy";} else {$cls01 = "";}
						// 今月以外は色を薄くする
						if (date("m",$d) != $mon){$cls02 = " tmon"; $clstm = "schtmg";} else {$cls02 = ""; $clstm = "schtm";}
						$b .= "<td class='sch {$cls01} {$cls02}'>";
						// ----予定本体
					//	$b .= $enw_plan[$mangrz[$j]][$theday];
						if ((in_array($spp_shain_id ,$tachable)) || ($spp_shain_id == $mangrz[$j])){$img01 = "<img src='images/clockm.png'>";}
						for ($k2 = 0; $k2 < count($schdlid[$mangrz[$j]][$theday]); $k2++){
							$sidx = $schdlid[$mangrz[$j]][$theday][$k2];
							$gidx = $schdlgid[$mangrz[$j]][$theday][$k2];
							$b .= "<a href='{$myself}?makesch=1&dt={$theday}&sid={$mangrz[$j]}&id={$sidx}&gid={$gidx}&htmr=0'>";
							$fntx = $colors[$schdl_color[$mangrz[$j]][$theday][$k2]];
							$grays = array("公休","休み","休");
							if (in_array($schdl_title[$mangrz[$j]][$theday][$k2],$grays)){$fntx = "gray";}
							if ($schdl_title[$mangrz[$j]][$theday][$k2] == "有休"){$fntx = "pink";}
							$b .= "<div class='clock' style='background-color:{$fntx}'>";
							if (date("m",$d) == $mon){$img01x = "<img src='images/clockmb.png'>";} else {$img01x = $img01;}
							$b .= $img01x." <span class='{$clstm}'>{$schdl_time[$mangrz[$j]][$theday][$k2]}</span><br>";
							
							$b .= "<span class='fnt'>{$schdl_title[$mangrz[$j]][$theday][$k2]}</span></div></a>";
						}
					//	if (date("m",$d) == $mon){
						$b .= "<a href='{$myself}?makesch=1&dt={$theday}&sid={$mangrz[$j]}&id=0&gid=0&htmr=0'><div class='clock'>".$img01."</div></a>";
					//	}
						if (count($schdlid[$mangrz[$j]][$theday]) == 0){$b .= "<br><br>";}
						$b .= "</td>";
						$d+=86400;
					}
					$b .= "</tr>";
				}
			}
		}
		$b .= "</tbody></table>";
		
		$HtmlBody = $b;

	return($HtmlBody);
	}
	// ----------------------------------------------------------------------
	// ----------------------------------------------------------------------
	//　カレンダー本体(半月バージョン)
	function makeCalenderBody2($year, $mon, $half){
		LIST($std, $edd) = makeStdedd($year, $mon);
		LIST($schdlid, $schdlgid, $schdl_title, $schdl_time, $schdl_dtl, $schdl_color) = getSchdl($std, $edd);
		global $myself;
		global $spp_shain_id;
		global $tachable;
		global $mangrz;
	//	global $mangr;
		global $s_names;
		global $ckeysid;
		global $colors;
	//	global $enw_plan;
		// カレンダーの最初に表示する前月の日を求める
//	$half = 1;
		
		switch($half){
			case 0: $d1d = $year."-".$mon."-01";
					$matsu = 16;
					$gesho = 0;
			break;
			case 1: $d1d = $year."-".$mon."-16";
					$matsu = getsuMatsu($year, $mon)-15;
					$gesho = 0;
			break;
			case 2: $d1d = $year."-".$mon."-01";
					$matsu = getsuMatsu($year, $mon);
					$gesho = 0;
			break;
			default:$d1d = $year."-".$mon."-01";
					$matsu = 16;
					$gesho = 0;
		}
		$d1str = strtotime($d1d);
		//　まず初日のSTRを求める
	//	$w = date("w",$d1str);
		//　曜日に変換する
	//	$wx = -1;
	//	$iw = ($w+$wx >= 0) ? $w+$wx : $w+$wx+7;
	//	$dstr = $d1str - (86400*($iw));
		$d = $d1str;
		//　カレンダーの最初の月日STR
		//　ｄは動かす
		$youbi = array('日', '月', '火', '水', '木', '金', '土', '日');
		$youbiclr = array('sunday', '', '', '', '', '', 'saturday', 'sunday');
		$cls03 = "themon";
		$clstm = "schtmg";
		$dt = date("Ymd");

	
		$b = "<table id='main'><tbody class='days'>";

		// 名前
		$b .= "<tr><td class='ttlb'>".$mon."月</td>";
		$mangrn = intval(95/count($mangrz));
			for($j = 0; $j < count($mangrz); $j++){
				$b .= "<td class='namex' style='width:{$mangrn}%;'>";
				$b .= $s_names[$mangrz[$j]];
				$b .= "</td>";
			}
			$b .= "</tr>";
		for ($i = $gesho; $i < $matsu; $i++){
				

			$b .= "<tr>";
			$hname = "";
			$cls04 = "";
			$yb = date("w",$d);
			list($yy,$mm,$dd) = explode('-',date("Y-m-d",$d));
			// 祝祭日取得	
				$hname = getHoliday($yy, $mm, $dd, 'jp');
				if ($hname != FALSE) {
					$cls04 = "holiday";
					$hname = "<br><span class='hol'>".$hname."</span>";
				} else {
					$cls04 = $youbiclr[$yb];
				}

				$b .= "<td class='themon {$cls04}'>".date("d日",$d)."(".$youbi[$yb].")".$hname."</td>";
				
			// スケジュール部分
			for($j = 0; $j < count($mangrz); $j++){
				
				$theday = date("Ymd",$d);
				// 今日は色を変える
						if ($theday == $dt){$cls01 = "tdy";} else {$cls01 = "";}
				// ----予定本体
					$b .= "<td class='schs {$cls01}'>";
					//	$b .= $enw_plan[$mangrz[$j]][$theday];
						if ((in_array($spp_shain_id ,$tachable)) || ($spp_shain_id == $mangrz[$j])){$img01 = "<img src='images/clockm.png'>";}
						for ($k2 = 0; $k2 < count($schdlid[$mangrz[$j]][$theday]); $k2++){
							$sidx = $schdlid[$mangrz[$j]][$theday][$k2];
							$gidx = $schdlgid[$mangrz[$j]][$theday][$k2];
							$b .= "<a href='{$myself}?makesch=1&dt={$theday}&sid={$mangrz[$j]}&id={$sidx}&gid={$gidx}&htmr=0'>";
							$fntx = $colors[$schdl_color[$mangrz[$j]][$theday][$k2]];
							$grays = array("公休","休み","休");
							if (in_array($schdl_title[$mangrz[$j]][$theday][$k2],$grays)){$fntx = "gray";}
							if ($schdl_title[$mangrz[$j]][$theday][$k2] == "有休"){$fntx = "pink";}
							$b .= "<div class='clock2' style='background-color:{$fntx}'>";
							if (date("m",$d) == $mon){$img01x = "<img src='images/clockmb.png'>";} else {$img01x = $img01;}
							$b .= $img01x." <span class='{$clstm}'>{$schdl_time[$mangrz[$j]][$theday][$k2]}</span><br>";
							
							$b .= "<span class='fnt'>{$schdl_title[$mangrz[$j]][$theday][$k2]}</span></div></a>";
						}
					//	if (date("m",$d) == $mon){
						$b .= "<a href='{$myself}?makesch=1&dt={$theday}&sid={$mangrz[$j]}&id=0&gid=0&htmr=0'><div class='clock'>".$img01."</div></a>";
					//	}
						if (count($schdlid[$mangrz[$j]][$theday]) == 0){$b .= "<br><br>";}
				
				$b .= "</td>";
			}
			$d+=86400;
			$b .= "</tr>";

		}
	
		$b .= "</tbody></table>";
		
		$HtmlBody = $b;

	return($HtmlBody);
	}
	// ----------------------------------------------------------------------
	// データベース入力
	if (isset($_GET['inpt'])){
		$idx = $_GET['id'];
		$sidx = $_GET['sid'];
		$gidx = ($_GET['gid'] > 0) ? $_GET['gid'] : 0;
		$chkx = (mb_strlen($_GET['chk']) > 0) ? 1 : 0;
		$dtx = $_GET['dt'];
		$stmx = (mb_strlen($_GET['stm']) > 0) ? $_GET['stm'] : 900;
		$etmx = (mb_strlen($_GET['etm']) > 0) ? $_GET['etm'] : 1000;
		$titlex = mysqli_real_escape_string($dbc, trim($_GET['title']));
		$dtlx = (mb_strlen($_GET['dtl']) > 0) ? mysqli_real_escape_string($dbc, trim($_GET['dtl'])) : "";
		$dtlx = str_replace("\r\n", "\r", $dtlx); //Windowsの改行コードを置き換え
		$dtlx = str_replace("\r", "\n", $dtlx); //Machintoshの改行コードを置き換え
		$clrx = $_GET['clr'];
		$ds = date("Ymd");
		$tm = date("His");
		
		if ($idx == 0){
			$sql = "INSERT INTO en_schdl SET schdlgid = $gidx, shain_id = $sidx, schdl_day = $dtx, schdl_stm = $stmx, schdl_etm = $etmx,";
			$sql .= " schdl_clr = $clrx, schdl_allday_flg = $chkx, schdl_title = '$titlex', schdl_dtl = '$dtlx', schdl_state = 1,";
			$sql .= " schdl_updt = $ds, schdl_uptm = $tm, schdl_upid = $spp_shain_id";
		} else {
			$sql = "UPDATE en_schdl SET schdlgid = $gidx, shain_id = $sidx, schdl_day = $dtx, schdl_stm = $stmx, schdl_etm = $etmx,";
			$sql .= " schdl_clr = $clrx, schdl_allday_flg = $chkx, schdl_title = '$titlex', schdl_dtl = '$dtlx',";
			$sql .= " schdl_updt = $ds, schdl_uptm = $tm, schdl_upid = $spp_shain_id WHERE schdlid = $idx";
		}
	//	echo $sql;
		$res = mysqli_query($dbc, $sql);
		header("Location: $myself");
	}
	if (isset($_GET['del'])){
		$idx = $_GET['del'];
		$ds = date("Ymd");
		$tm = date("His");
		$sql = "UPDATE en_schdl SET schdl_state = 9, schdl_updt = $ds, schdl_uptm = $tm, schdl_upid = $spp_shain_id WHERE schdlid = $idx";
		$res = mysqli_query($dbc, $sql);
	//	echo $sql;
		header("Location: $myself");
	}
	// ------------------------------------------
	// 色セレクター
	
	function slctColor($color, $name){
		global $colors;
		$option = "";
		for ($i = 0; $i < 7; $i++){
			$option .= "<option value='{$i}'";
			if ($i == $color){$option .= " selected";}
			$option .= " style='background-color:{$colors[$i]};'>{$colors[$i]}</option>\n";
		}
		$select="<select name='{$name}' style='font-size:0.8em; width:80px; height:30px;' >\n{$option}</select>\n";	
	return($select);	
	}
	
	// ------------------------------------------
	// 時間セレクター
	function makeSlct($tm, $name){
		$option = "";
		if (mb_strlen($tm) > 0) {$tmx = $tm;}
		if (mb_strlen($tm) == 0) {$tmx = 900;}
		if ((mb_strlen($tm) == 0) && ($name == "etm")) {$tmx = 1000;}
		for ($i = 0; $i <= 2330; $i+=30) {
			if ($i%100 == 60){$i +=40;}
			$ix = sprintf("%02d",intval($i/100)).":".sprintf("%02d",$i%100);
			$option .= "<option value='{$i}'";
			if ($i == $tmx){$option .= " selected";}
			$option .= ">{$ix}</option>\n";
		}
		$select="<select name='{$name}' style='font-size:0.8em; width:80px; height:30px;' >\n{$option}</select>\n";	
	return($select);	
	}
	
	// ------------------------------------------
	// --- 予定インプット画面
	function makeInputBody($sid, $dt, $id, $gid){
		global $dbc;
		global $myself;
		global $s_name;
		global $spp_shain_id;
		global $honsys;
		$chkd = "";
		$chkd2 = "";
		if ((in_array($spp_shain_id,$honsys)) || ($spp_shain_id == $sid)) {$hens = 1;} else {$hens = 0;}
		
		if ($id > 0){
			$sql = "SELECT * FROM en_schdl WHERE schdlid = $id";
			$res = mysqli_query($dbc, $sql);
			while ($row = mysqli_fetch_array($res)){
				$shain_id = $row['shain_id'];
				$day = $row['schdl_day'];
			//	$schdlid[$shain_id][$day][] = $row['schdlid'];
				$gid = $row['schdlgid'];
				$stm = $row['schdl_stm'];
				$etm = $row['schdl_etm'];
				$title = $row['schdl_title'];
				$dtl = $row['schdl_dtl'];
				$color = ($row['schdl_clr'] > 0) ? $row['schdl_clr'] : 0;
				$ptn = ($row['schdl_ptn'] > 0) ? $row['schdl_ptn'] : 0;
				if ($row['schdl_allday_flg'] == 1){
					$chkd = "checked";
				}
				if ((mb_strlen($dtl) > 0) || ($color > 0) || ($ptn > 0)){
					$chkd2 = "checked";
				}
			}
		}
		
		$dd = substr($dt,0,4)."年".substr($dt,4,2)."月".substr($dt,6,2)."日";
		$slcts = makeSlct($stm, "stm");
		$slcte = makeSlct($etm, "etm");
		$slctc = slctColor($color, "clr");
		
	//	$b = "<div id='dialog-form' title='項目の追加'>";
		$b = "<table id='inpt'><tbody>";
		$b .= "<form>";
		$b .= "<input type='hidden' name='sid' value='{$sid}'>";
		$b .= "<input type='hidden' name='id' value='{$id}'>";
		$b .= "<input type='hidden' name='gid' value='{$gid}'>";
		$b .= "<input type='hidden' name='dt' value='{$dt}'>";
		$b .= "<tr><td class='ttl'>社員名</td><td class='shainmei'>{$s_name[$sid]}</td>";
		$b .= "<td colspan='4'><input type='button' value='キャンセル' onclick='location.href=\"{$myself}\"'>";
		
		if ($hens == 1){
		$b .= "<input type='submit' name='inpt' value='登録'>";
		}
		
		$b .= "</td></tr>";
		$b .= "<tr><td class='ttl'>日付</td><td><span class='hiduke'>{$dd}</span>　　";
		$b .= "<label for='chk1'>終日：</label><input type='checkbox' id='chk1' name='chk' {$chkd}></td>";
		$b .= "<td class='ttl'>開始</td><td style='width:100px;' class='ttls'>{$slcts}</td>";
		$b .= "<td class='ttl'>終了</td><td style='width:100px;' class='ttls'>{$slcte}</td></tr>";
		$b .= "<tr><td class='ttl'>タイトル</td><td colspan='5'>";
		$b .= "<input type='text' id='idn' name='title' value='{$title}' style='width:300px;' onkeyup=\"CountDownLength( 'cdlgt1' , value , 32 );\" maxlength='32'>";
		
	//	if ($spp_shain_id == 677){
			$b .= "&nbsp;&nbsp;&nbsp;<label for='chk2'>詳細：</label><input type='checkbox' name='chk2' id='chk2' {$chkd2}>";
	//	}	
		
		$b .= "<p id='cdlgt1'>あと32文字</p></td></tr>";
		
	//	if ($spp_shain_id == 677){
		$b .= "<tr id='detail'><td class='ttl'>詳細</td><td colspan='5'>";
		// 背景色
		$b .= "<div>背景色：{$slctc}</div>";
		//　詳細
		$b .= "<div>内容：　<br><textarea name='dtl' id='dtla' placeholder='入力してください' maxlength='120'>{$dtl}</textarea></div>";
		$b .= "<p id='cdlgt2'>あと120文字</p>";
		// パターン
		// mada
		$b .= "</td></tr>";
	//	}
		$b .= "</form>";
	//	$b .= "<tr><td class='ttl'>詳細</td><td colspan='5'><input type='textarea' name='dtl' value='{$dtl}'></td></tr>";
		if (($id > 0) && ($hens == 1)){
			$b .= "<tr><td colspan='6'>";
			$b .= "<form><input type='submit' value='削除' onclick='return sakujo()'><input type='hidden' name='del' value='{$id}'></form>";
			$b .= "</td></tr>";
		}
		$b .= "</tbody></table>";
	//	$b .= "</div>";
		
		$HtmlBody = $b;
	return($HtmlBody);	
	}
	// ------------------------------------
	if (isset($_GET['makesch'])){
		$sid = $_GET['sid'];
		$dt = $_GET['dt'];
		$id = $_GET['id'];
		$gid = $_GET['gid'];
		$HtmlBody = $menu0;
		$HtmlBody .= makeInputBody($sid, $dt, $id, $gid);
	} else {
		$HtmlBody = $menu0.$menu;
//	if ($spp_shain_id == 677){echo "clds=".$clds;}
		switch($clds){
			case 0: $HtmlBody .= makeCalenderBody($year, $mon, $half);
			break;
			case 1: $HtmlBody .= makeCalenderBody2($year, $mon, 0);
			break;
			case 2: $HtmlBody .= makeCalenderBody2($year, $mon, 1);
			break;
			case 3: $HtmlBody .= makeCalenderBody2($year, $mon, 2);
			break;
			default: $HtmlBody .= makeCalenderBody($year, $mon, $half);
		}
	}
// **************************************************************************************************************************************
// 表示処理
	echo $HtmlHeader;
	// 見る人たち
	$perms = array_merge($honsys,$soumus,$yakuis,$cmngrs);
//	var_dump($perms);
	if ((in_array($spp_shain_id,$perms)) && ($slevel > 0)) {

	echo "";
	
	// カレンダー表示　******************************
//	echo date("YmdHis");
	echo $HtmlBody;
		
	echo $msg;
//	echo "</div>";
	} else {
?>

<p>このページは権限がなければ見られません。</p>
<div class='nopri'><input type="button" value="menu" onclick="location.href='menu.php'"></div>
<?php
	echo "<p>[{$spp_shain_id}]</p>"; 
	} // end of else
//	echo "</div>";
	if ($ikka2 == 0) {
	echo $HtmlFooter;
	}		
?>