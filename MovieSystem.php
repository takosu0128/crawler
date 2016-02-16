//MovieSystem

<?php

//$hpに検索したいURLをいれる
//$hp="http://movie-tsutaya.tsite.jp/netdvd/dvd/goodsDetail.do?pageNo=2&titleID=1172661892&order=1&selGoodsIdx=0&seriesPageNo=1&pT=0#review";

$ii=0;
$k=1;
while($k < 5){
  $hp="http://rental.geo-online.co.jp/detail-340984.html";
  echo("\n");
  if($k<>1){
    $hp=$hp."?p=".strval($k);
  }
  
  //htmlを$htmlに保存
  $html = file_get_contents($hp);

  $min_pos = 99999999999999;//十分に大きな数字
  $from_encoding ='UTF-8';//デフォルト
  foreach(array('UTF-8','SJIS','EUC-JP','ASCII','JIS','ISO-2022-JP') as $charcode){
    if($min_pos > stripos($html,$charcode,0) && stripos($html,$charcode,0)>0){
      $min_pos =  stripos($html,$charcode,0);
      $from_encoding = $charcode;
    }
  }
  $html = mb_convert_encoding($html, "utf8", $from_encoding);
  //$html="p claalt\"3点\"ss=c_rating-_raiting-point_07star><span class=c_raiting-point_08></span></p";		
  //タグのパターンを指定
  $pattern = '/\"[0-9]点\"/';
  //検索！！
  preg_match_all($pattern,$html,$matches);
		//$matchesの中に検索結果が入ってる
  $matches=null;
  $match_num = preg_match_all($pattern, $html, $matches);
  $count=$match_num; // int 2
  //echo ($count);
  for( $i=0; $i<$count; $i++ ){
    $ii++;
    $point[$ii] = str_replace("\"alt\"", "", $matches[0][$i]);
    $point[$ii] = str_replace("点\"", "", $point[$ii]);
    $point[$ii] = str_replace("\"", "", $point[$ii]);
    echo($point[$ii]);
  }
  echo("\nLoop End>>>ii=".strval($ii).">>>k=".strval($k).">>>count=".strval($count)."\n");
  $k++;
}
/* ファイルポインタをオープン */
$file = fopen("movie.csv", "w");

/* CSVファイルを配列へ */
if( $file ){
  var_dump( fputcsv($file, $point) );
}

/* ファイルポインタをクローズ */
fclose($file);
?>
