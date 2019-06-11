<?php
$dom = new DOMDocument;
$html = file_get_contents('https://paiza.hatenablog.com/');
@$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
$xpath = new DOMXPath($dom);
foreach($xpath->query("//a[contains(@class,'recent-entries-title-link')]") as $tag){
    echo $tag->nodeValue . "\n<br>";
    echo urldecode(substr($tag->attributes[0]->value,46)) . "\n";
    echo "<br>";
}
?>
