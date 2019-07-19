<?php

    //一字ファイルができているか（アップロードされているか）チェック
    if(is_uploaded_file($_FILES['up_file']['tmp_name'])){

        //一字ファイルを保存ファイルにコピーできたか
        if(move_uploaded_file($_FILES['up_file']['tmp_name'],"./".$_FILES['up_file']['name'])){

            //正常
            echo "uploaded";

        }else{

            //コピーに失敗（だいたい、ディレクトリがないか、パーミッションエラー）
            echo "error while saving.";
        }

    }else{

        //そもそもファイルが来ていない。
        echo "file not uploaded.";

    }

    
$filepath = "";
$file = new SplFileObject($filepath); 
$file->setFlags(SplFileObject::READ_CSV); 
foreach ($file as $line) {
  //終端の空行を除く処理　空行の場合に取れる値は後述
  if(is_null($line[0])){
    $records[] = $line;
  }
} 

var_dump($records);

?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>test</title>
</head>
<body>
<form method="post" action="test_res.php" enctype="multipart/form-data">
ファイル:<input type="file" name="up_file"><br>
<input type="submit" value="upload">
</form>
</body>
</html>
