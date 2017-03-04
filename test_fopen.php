<!DOCTYPE HTML>
 <html lang="ja">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

 <title>CSVファイルを読み込む２</title>
 </head>
 <body>
 <table border="1">

 <?php
// $csv = array();
// $cnt = 0;
 $fp = fopen("kiztbl1.csv", "r");
	while ($data = fgetcsv($fp, 10000)) {
//  while ($data = fgetcsv($fp, 0, ",")) {
 // while(!feof($fp)){
 // $csv = fgets($fp);
//	$csv[] = $data;
//	$str[$cnt] = explode(",", $csv);
  print "<tr>";
  foreach ($data as $d) {
    print "<td>$d</td>";
  }
   print "</tr>\n";
//echo $csv[$cnt][2];
//$cnt++;
 }

 ?>
  </table>
<?php  echo "aa=".$data[1]."<br>"; ?>
 </body>
 </html>
 <?php

/*  $fp = fopen("kiztbl1.csv", "r");
 while ($array = fgetcsv($fp)) {
	var_dump($array);
	echo "<br>";
 }*/
// var_dump($csv);

// fclose($fp);

//$shop_id=$_GET[shop_id];
//↑URL引数からshop_idを変数に渡す。

$fileName = "kiztbl1.txt";
//↑店舗情報の読み込むCSVを決める

$file = fopen($fileName,"r"); 
//↑そのファイルを開く

$cnt=0;
//↑カウンターを設置、初期化

while(!feof($file)){
//↑ファイルが終わるまで回せ
$csv = fgets($file);
//↑一行づつ配列に入れる
$str[$cnt] = explode(",", $csv);
//$str[]の配列にはもちろん0から入る。
//しかし下のIF文に必要なので
//明示的に$cntというカウンターを設置次第。

//if($str[$cnt][0]==$shop_id){
//↑もし$shop_idと1列目が
//ビンゴしたら正解変数へ
echo $str[$cnt][0].",";
echo $str[$cnt][1].",";
echo $str[$cnt][2].",";
echo $str[$cnt][3].",";
echo $str[$cnt][4].",";
echo $str[$cnt][5].",";
echo $str[$cnt][6].",";
echo $str[$cnt][7].",";
echo $str[$cnt][8].",";
echo $str[$cnt][9].",";
echo $str[$cnt][10].",";
echo $str[$cnt][11].",";
echo $str[$cnt][12].",";
echo $str[$cnt][13].",";
echo $str[$cnt][14].",";
echo $str[$cnt][15].",";
echo $str[$cnt][16].",";
echo $str[$cnt][17].",";
echo $str[$cnt][18].",";
echo $str[$cnt][19].",";
echo $str[$cnt][20]."/";
echo "<br>";
//}
//↑もし文の終了
$cnt++;
//↑回す度にカウントアップ
}
//↑回せ文の終了
fclose($file);
//↑ファイルクローズ
echo $cnt;
?>
