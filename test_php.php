<?php
//error_reporting(0);
function debug_mode($mode) {
	if ($mode === true) {
		// エラー表示
		ini_set('display_errors', 1);
		error_reporting(E_ALL & ~E_NOTICE);
	} else {
		// エラー非表示
		ini_set('display_errors', 0);
		error_reporting(0);
	}
}

	ini_set('display_errors', 0);
	error_reporting(0);

	$a = 50;
	echo $a.'php\n';
	echo $a."php\n";
	echo $a,"php<br>";
	echo '{$a}<br>';
	echo "{$a}<br>";
	$b = 66;
	$c = $a.$b;
	echo $c;

	// エラー表示ならtrue、非表示ならfalse
	debug_mode(true);


	function br(){
	echo nl2br("\n"); //<br />タグが挿入される。
	}

echo "hoge";

br(); 

echo "fuga";
?>
定数	値	説明
–	-1	エラーをすべて表示する
–	0	エラーをすべて非表示にする
E_ERROR	1	重大な実行時エラー。
スクリプトの実行は中断されます。
E_WARNING	2	実行時の警告（致命的エラーではない）
E_PARSE	4	コンパイル時のパースエラー
E_NOTICE	8	実行時の警告
※デフォルト設定では出力されない。
E_CORE_ERROR	16	PHPの開始時点での致命的エラー。
PHPのコアから発行される点がE_ERRORと異なる。
E_CORE_WARNING	32	PHPの開始時点での警告。（致命的エラーではない）
PHPのコアから発行される点がE_WARNINGと異なる。
E_COMPILE_ERROR	64	コンパイル時の致命的エラー。
Zendスクリプティングエンジンに発行される点がE_ERRORと異なる
E_COMPILE_WARNING	128	コンパイル時の警告（致命的エラーではない）
Zendスクリプティングエンジンに発行される点がE_ERRORと異なる。
E_USER_ERROR	256	ユーザーが発行するエラー
PHPコード上でtrigger_error()を使用した場合に発行される点がE_ERRORと異なる。
E_USER_WARNING	512	ユーザーが発行する警告
PHPコード上でtrigger_error()を使用した場合に発行される点がE_WARNINGと異なる。
E_USER_WARNING	1024	ユーザーが発行する注意
PHPコード上でtrigger_error()を使用した場合に発行される点がE_NOTICEと異なる。
E_ALL	2047	E_STRICT以外の全てのエラーメッセージ
E_STRICT	2048	実行時の注意（非推奨関数を使用した場合に発行される）
※デフォルト設定では出力されない。
http://mislead.jp/1803.html