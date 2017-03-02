<?php
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title></title>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<style type="text/css">
	.w1 {
		margin: 5;
		width: 40px;
		}
	li {
		display: inline;
	}	
</style>
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
</head>
<body>
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

</body>
</html>