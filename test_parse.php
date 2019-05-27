<h1>echo の挙動</h1>
<p>echo は関数ではなく言語構造なので（）は省略できる（要らない）</p>
<?php
	$arr = array(3,7);
	echo "01$arr[0]";
	echo "<br>";
	echo "02{$arr[0]}";
	echo "<br>";	
	echo '03$arr[0]'; // 展開しない
	echo "<br>";
	echo "<hr>";

	echo "11$arr[0]";
	echo "<br>";
	echo '12,$arr[0]'; // 展開しない
	echo "<br>";
	echo '13{$arr[0]}'; // 展開しない
	echo "<br>";
	echo "14{$arr[0]}";
	echo "<br>";
	echo "<hr>";

	echo 31,$arr[0];
	echo "<br>";
	echo 32,$arr[0].$arr[1];
	echo "<br>";
	echo 33,$arr[0],$arr[1];
	echo "<br>";
	echo 34,$arr[0]+$arr[1];
	echo "<br>";
	echo 35,$arr[0]*$arr[1];
	echo "<br>";
	//echo 36.$arr[0]+$arr[1]; // これはエラーになる
	echo "<hr>";

	echo 41,($arr[0]);
	echo "<br>";
	//echo 42.($arr[0]); // これはエラーになる
	echo "<br>";
	echo 43,($arr[0].$arr[1]);
	echo "<br>";	
	// echo 44,($arr[0],$arr[1];) // これはエラーになる
	echo "<br>";
	echo 45,($arr[0]+$arr[1]);
	echo "<br>";
	echo "<hr>";

	$name = "KCG";

	echo "51 My name is $name";
	echo "<br>";
	echo "52 My name is ${name}";
	echo "<br>";
	echo "53 My name is {$name}";
	echo "<br>";

	echo '54 こんにちは。', $name, 'さん。';
	echo "<br>";
	echo '55 こんにちは。'. $name. 'さん。';
	echo "<br>";
	echo ('56 こんにちは。'. $name. 'さん。');
	echo "<br>";
	// echo ('57 こんにちは。', $name, 'さん。'); // これはエラーになる
	echo "<br>";
	echo "<hr>";

	echo "<h2>不思議な挙動</h2>";
	echo "61".$arr[0]+$arr[1]; // ** 不思議な挙動
	echo "<br>";
	echo "61"+$arr[0]+$arr[1]; // ** 不思議な挙動
	echo "<br>";
	echo "61"+$arr[0].$arr[1]; // ** 不思議な挙動
	echo "<br>";
	echo 61,$arr[0]+$arr[1];
	echo "<br>";
	echo "61".($arr[0]+$arr[1]);
	echo "<br>";
	// echo 61.$arr[0]+$arr[1]; // これはエラーになる
	echo "<br>";
	
	echo "61"."10";
	echo "<br>";
		$a = 11;
	echo "61".$a;
	echo "<br>";
	echo "61".$arr[0];
	echo "<br>";
	echo "6 1".$arr[0]+$arr[1]; // Noticeになる
	echo "<br>";
	echo "<hr>";
