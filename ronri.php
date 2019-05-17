<!DOCTYPE html>
	<html lang="ja">
	<head>
	<meta charset="UTF-8">
	<title>論理計算</title>
	</head>
	<body>
<?php
	if (isset($_GET['a'])){
		$a = (isset($_GET['a']))?$_GET['a']:"";
		$b = (isset($_GET['b']))?$_GET['b']:"";
		$c = $_GET['c'];
	}
?>		
		<p>1,0,null,文字 などを入力してみよう</p>
		<p>アドレスバーで?a=1&b[]=a&b[]=2&b[]=3などと入れてみよう</p>
		<form>
			a = <input type='text' name='a' value='<?php echo $a; ?>' style='width:50px'>
			: b = <input type='text' name='b' value='<?php echo $b; ?>' style='width:50px'>
			<input type='submit' value=''>
		</form>
<?php
	if (isset($a) && isset($b)){
		echo "<br>";
		echo "<br>\$a = \$_GET['a']; <br>\$b = \$_GET['b']; <br>\$c = \$_GET['c'];";
		echo "<br>";
		echo "<br>キャスト var_dump((int)value)";
		echo "<br>(int)\$a = ";
		var_dump((int)$a);
		echo "<br>(int)\$b = ";
		var_dump((int)$b);
		echo "<br>(int)\$c = ";
		var_dump((int)$c);
		echo "<br>キャストしても元の変数は変化しない";
		
		echo "<br>";
		echo "<br>var_dump(value)";
		echo "<br>\$a = ";
		var_dump($a);
		echo "<br>\$b = ";
		var_dump($b);
		echo "<br>\$c = ";
		var_dump($c);

		echo "<br>";
		echo "<br>var_dump((bool) value)";
		echo "<br>\$a = ";
		var_dump((bool) $a);
		echo "<br>\$b = ";
		var_dump((bool) $b);
		echo "<br>\$c = ";
		var_dump((bool) $c);
		echo "<br>";

		echo "<br>論理演算子";
		echo "<br>a && b= ";
		var_dump($a && $b);
		echo "<br>a || b = ";
		var_dump($a || $b);

		echo "<br>a and b = ";
		var_dump($a and $b);
		echo "<br>a or b = ";
		var_dump($a or $b);
		echo "<br>a xor b = ";
		var_dump($a xor $b);

		echo "<p>&& and, || or は働きは同じだが優先順位が違う</p>";
	}
?>
	</body>
	</html>
