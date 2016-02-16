app1

<?php

//$hpに検索したいURLをいれる

$hp="http://movie-tsutaya.tsite.jp/netdvd/dvd/goodsDetail.do?pageNo=2&titleID=1172661892&order=1&selGoodsIdx=0&seriesPageNo=1&pT=0#review";

//htmlを$htmlに保存
$html = file_get_contents($hp);
		
//タグのパターンを指定
//$pattern = '/rating-point_[0-9][0-9]/';
$pattern = '/UA-[0-9][0-9]/';

//検索！！
preg_match_all($pattern,$html,$matches);
		//$matchesの中に検索結果が入ってる
		for( $a=0; $a<=3; $a++ ){
            
            //タグを除去してから検索結果を表示
            echo ($matches[0][$a]);
         
            
            //うんち
        }

echo ($html);

?>