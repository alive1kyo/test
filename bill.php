<?php

$s2 = <<< EOF
  	<span class="green-label">緑のラベル</span>
EOF;
 $str = ""; 	
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<style>
	/*  */
	@import url(http://fonts.googleapis.com/earlyaccess/notosansjapanese.css);
	@import url(//fonts.googleapis.com/earlyaccess/hannari.css);
	/* ページサイズの設定 */
	.sheet {
		width: 210mm;
  		height: 296mm; /* 1mm余裕をもたせる */
		page-break-after: always;
		position: absolute;
	}
	@page {
	  size: A4;
	  margin: 0;
	}
	/* カウンター設定 */
	body {
	  counter-reset: sheet; /* カウンタの初期化 */
	}
	.sheet::after {
	  position: absolute;
	  bottom: 50px;
	  left: 400px;
	  counter-increment: sheet;
	  content: "-page " counter(sheet) "-";
	}

	/* 印刷・プレビュー共通のスタイル */
	body {
		font-family: 'Hannari', serif;
	}
	.all-border {
	  border: 1px solid #aaa; /* 1pxが最小 */
	}
	.border-radius {
		border-radius: 6px;
	}
	.blue-back {
		background-color: #00F;
		color: white;
		text-align: center;
	}
	.water-back {
		background-color: #CFF;
		color: #00F;
		border-bottom: 1px solid #aaa;
	}
	.center {
		text-align: center;
	}
	.right {
		text-align: right;
	}

	.green-label {
	  border: 1px solid green;
	  border-left-width: 10px;
	  padding: 1px 3px;
	  position: absolute;
	  top: 200px;
	  left: 350px;
	}
	.under-line {
		border-bottom: solid 1px #aaa;
	}
	/**/
	table.sepa {
	  border: 1px solid #aaa;
	  border-collapse: separate;
	  border-spacing: 0;
	  border-radius: 6px;
	  overflow: hidden;
	}
	table.sepa thead th,
	table.sepa tbody th,
	table.sepa tbody td {
	  padding: .3em 1em;
	  border-bottom: 1px solid #aaa;
	}
	table.sepa thead th {
	  background-color: #ddd;
	}
	table.sepatbody th {
	  background-color: #eee;
	}
	table.sepa thead th + th,
	table.sepa tbody td {
	  border-left: 1px solid #aaa;
	}
	table.sepa tbody tr:last-child th,
	table.sepa tbody tr:last-child td {
	  border-bottom: none;
	}
	/**/
	#t10 tbody tr:nth-child(even) {
		background-color: #CFF;
	}
	/**/
	#t1 {
		position: absolute;
		top: 20px;
		right: 50px;
		width: 340px;
	}
	#t2 {
		position: absolute;
		top: 55px;
		right: 50px;
		width: 340px;
	}
	#t3 {
		position: absolute;
		top: 75px;
		left: 40px;
		width: 340px;
	}
	#t4 {
		position: absolute;
		top: 100px;
		right: 50px;
		width: 340px;
	}
	#t5 {
		position: absolute;
		top: 200px;
		left: 40px;
		width: 340px;
		height: 140px;
	}
	#t6 {
		position: absolute;
		top: 200px;
		right: 50px;
		width: 120px;
		height: 60px;
	}
	#t7 {
		position: absolute;
		top: 360px;
		left: 40px;
		width: 340px;	
	}
	#t8 {
		position: absolute;
		top: 400px;
		left: 40px;
		width: 340px;	
	}
	#t9 {
		position: absolute;
		top: 400px;
		right: 50px;
		width: 120px;	
	}
	#t10 {
		position: absolute;
		top: 480px;
		left: 40px;
		width: 186mm;	
	}
	/**/
	#t5 {
		border: solid 1px #aaa;
	}
	/**/
	.w1 {
		width: 20mm;
	}
	.w2 {
		width: 60mm;
	}
	.w3 {
		width: 16mm;
	}
	.w4 {
		width: 10mm;
	}
	.w5 {
		width: 25mm;
	}
	/* プリント用のスタイル */
	@media print {
	  body {
	    width: 210mm; /* needed for Chrome */
	    height: 295mm;
	  }
	}
	/* プレビュー用のスタイル */
	@media screen {
	  body {
	    background: #eee;
	  }
	  .sheet {
	    background: white; /* 背景を白く */
	    box-shadow: 0 .5mm 2mm rgba(0,0,0,.3); /* ドロップシャドウ */
	    margin: 5mm;
	  }
	}
</style>
<script>
//	window.print()
//	window.close()
</script>
</head>
<body>
	<section class="sheet">
  <!-- 印刷内容 1枚目 -->
  <table id="t1" class="border-radius blue-back">
  	<tr><td>t1 ab</td></tr>
  </table>
    <div id="t2" class='under-line'>
  		<?php echo "t2 date"; ?>
  	</div>
  	<div id="t3">
  		<?php echo "t3 comp"; ?>
  	</div>
	<div id="t4">
  		<?php echo "t4 mine"; ?>
  	</div>
  	<div id="t5" class="border-radius">
	  <table>
	  	<tr><td>t5</td></tr>
	  </table>
	</div>
  <table id="t6" class="sepa">
  	<tbody>
  		<tr><td>t6</td><td>cd</td></tr>
  	</tbody>
  </table>
  <div id="t7" class='under-line'>
  		<?php echo "t7 title"; ?>
  	</div>
  <table id="t8" class="sepa">
  	<thead>
  		<tr><td class="blue-back">t8 ab</td><td class="water-back center">cd</td></tr>
  	</thead>
  	<tbody>
  		<tr><td>t8 ab</td><td>cd</td></tr>
  	</tbody>
  </table>	
  <table id="t9" class="sepa">
  	<thead>
  		<tr class="blue-back"><td>t9 ab</td></tr>
  	</thead>
  	<tbody>
	  	<tr><td>t9 ab</td></tr>
	  </tbody>
  </table>
  <table id="t10" class="sepa">
  	<thead class="blue-back">
  		<tr><td class="w1">t10 ab</td>
  			<td class="w2">cd</td>
  			<td class="w3">cd</td>
  			<td class="w4">cd</td>
  			<td class="w1">cd</td><td class="w1">cd</td>
  			<td class="w5">cd</td>
  		</tr>
	</thead>
	<tbody>
	<?php
		for ($i = 0; $i < 14; $i++){	
	?>
		<tr><td>t10 ab</td><td>cd</td><td>cd</td><td>cd</td><td>cd</td><td>cd</td><td>cd</td></tr>
	<?php
		}
	?>
	</tbody>
  </table>   
  <?php echo $str; ?>
	</section>
<!--	<section class="sheet">
	   印刷内容 2枚目 
	</section>-->
</body>
</html>
