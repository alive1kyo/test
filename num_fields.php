<?php
$sql = "SELECT * FROM dt_table";
$res = mysql_query($sql,$connectDB); 
 
//フィールドの数を取得する
$numFields = mysql_num_fields($res);
 
//フィールド名を格納する配列を用意する
$nameFields = array();
 
for($i=0;$i<$numFields;$i++){
$nameFields[] = mysql_field_name($res, $i);
}
 
foreach($nameFields as $name){
echo $name."<br />";
}



// http://phpjavascriptroom.com/?t=php&p=mysql_fetch

/* 例：mysql_fetch_array()関数をMYSQL_NUMと共に利用 */
$dbc=mysql_connect("localhost","root","") or die("MySQL接続失敗 :".mysql_error());
mysql_select_db("db_customer");
$sql="SELECT id, firstname, lastname FROM tbl_customer";
$res=mysql_query($sql,$dbc);
while($dat=mysql_fetch_array($res,MYSQL_NUM)){
    printf("ID: %s NAME: %s %s",$dat[0],$dat[1],$dat[2]); echo "<br>";
}
mysql_free_result($res);


/* 例：mysql_fetch_array()関数をMYSQL_ASSOCと共に利用 */
$dbc=mysql_connect("localhost","root","") or die("MySQL接続失敗 :".mysql_error());
mysql_select_db("db_customer");
$sql="SELECT id, firstname, lastname FROM tbl_customer";
$res=mysql_query($sql,$dbc);
while($dat=mysql_fetch_array($res,MYSQL_ASSOC)){
    printf("ID: %s NAME: %s %s",$dat["id"],$dat["firstname"],$dat["lastname"]); echo "<br>";
}
mysql_free_result($res);


/* 例：mysql_fetch_array()関数をMYSQL_BOTHと共に利用 */
$dbc=mysql_connect("localhost","root","") or die("MySQL接続失敗 :".mysql_error());
mysql_select_db("db_customer");
$sql="SELECT id, firstname, lastname FROM tbl_customer";
$res=mysql_query($sql,$dbc);
while($dat=mysql_fetch_array($res,MYSQL_BOTH)){
    printf("ID: %s NAME: %s %s",$dat[0],$dat["firstname"],$dat["lastname"]); echo "<br>";
}
mysql_free_result($res);