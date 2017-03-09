<?php


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

?>