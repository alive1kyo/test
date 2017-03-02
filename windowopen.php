<?php
$c1 = "abc";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>POPUP</title>

<script type="text/javascript" src="js/jquery-1.9.1.js"></script>

<script>
		var subWinObj1;     // サブウインドウオブジェクト

		var c1 = '<?php echo $c1; ?>';
		alert(c1);
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

</head>
<body>

<a href="inform.php" class="popup">リンクテキスト</a>

</body>
</html>