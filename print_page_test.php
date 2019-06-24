<?php

$s2 = <<< EOF
  	<span class="green-label">緑のラベル</span>
EOF;
 $str = $s2; 	
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
	table {
	  border: 1px solid black; /* 1pxが最小 */
	  border-radius: 0.2em;
	}

	.green-label {
	  border: 1px solid green;
	  border-left-width: 10px;
	  padding: 1px 3px;
	  position: absolute;
	  top: 200px;
	  left: 350px;
	}

	/* プリント用のスタイル */
	@media print {
	  body {
	    width: 210mm; /* needed for Chrome */
	    height: 296mm;
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
  <table id="">
  	<tr><td>ab</td></tr>
  	<tr><td>cd</td></tr>
  </table>
  <table id="">
  	<tr><td>ab</td></tr>
  	<tr><td>cd</td></tr>
  </table>
  <table id="">
  	<tr><td>ab</td></tr>
  	<tr><td>cd</td></tr>
  </table>
  <table id="">
  	<tr><td>ab</td></tr>
  	<tr><td>cd</td></tr>
  </table>	    
  <?php echo $str; ?>
	</section>
<!--	<section class="sheet">
	   印刷内容 2枚目 
	</section>-->
</body>
</html>
