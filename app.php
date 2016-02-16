//app.php
//charenge

<?php

require_once __DIR__ . '/vendor/autoload.php';

$cli = new Goutte\Client();
$url = 'http://movie-tsutaya.tsite.jp/netdvd/dvd/goodsDetail.do?pageNo=2&titleID=1172661892&order=1&selGoodsIdx=0&seriesPageNo=1&pT=0#review';
$min_pos = 99999999999999;//十分に大きな数字
$from_encoding ='UTF-8';//デフォルト
foreach(array('UTF-8','SJIS','EUC-JP','ASCII','JIS','ISO-2022-JP') as $charcode){
  if($min_pos > stripos($html,$charcode,0) && stripos($html,$charcode,0)>0){
    $min_pos =  stripos($html,$charcode,0);
    $from_encoding = $charcode;
  }
}
echo "1\n";
$html = mb_convert_encoding($html, "utf8", $from_encoding);
echo "2\n";
$crawler = $cli->request('GET', $url);

$crawler->filter('.name code a')->each(function($name) {
    $href = $name->attr('href');
    if (preg_match('/^source/' , $href)) {
        echo $name->text() . "\n";
    }
});



/*$crawler->filter('.name code a')->each(function($name) {
    $href = $name->attr('href');
    if (preg_match('/^source/' , $href)) {
        echo $name->text() . "\n";
    }
});
*/

