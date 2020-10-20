<?
include("../confighome/config.php");
$conn = new mysqli('localhost', 'root', 'vubPCM)K2}L]T5Y', 'giasu');
        $conn->set_charset('utf8');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

date_default_timezone_set("Asia/Bangkok");
$day = date('Y-m-d\TH:i:sP', time());
$curentPage = 250;

$numrow = new db_query("SELECT id FROM baiviet WHERE status = 1"); 
$numcount = mysql_num_rows($numrow->result);

$nb_file = $numcount/$curentPage;

$nb_file = (int)$nb_file + 1;

for ($i=0; $i < $nb_file ; $i++) { 
    $start = $i * $curentPage;
    $urls = array();

    if ($i == 0) {
        foreach ($db_blog as $type => $item) {
            
            $link = 'https://timviec365.com.vn/gia-su/'.replaceTitle($item['name'].'.html');
            $urls[] = array($link , $day,  'daily', '0.1');
        }
    }
   
    // 250 link bài viết blog và tin tức tiếp theo
    $result = new db_query("SELECT id,title,alias,sapo,created_day,update_time FROM baiviet WHERE status = 1 LIMIT ".$start.",".$curentPage);  

    while($row = mysql_fetch_assoc($result->result)) {
        if ($row['update_time'] != 0) {
            $day = date('Y-m-d\TH:i:sP', $row['update_time']);
        }else{
            $day = date('Y-m-d\TH:i:sP', strtotime($row['created_day']));
        }

        $link = "https://timviec365.com.vn/gia-su/".$row['alias']."-b".$row['id'].".html";

        // if ($row['new_new'] == 0) {
        //     $link = "https://timviec365.com/blog/".$row['new_title_rewrite']."-new".$row['new_id'].".html";
        // }else{
        //     $link = "https://timviec365.com/tin-tuc/".replaceTitle($row['new_title'])."-new".$row['new_id'].".html";
        // }

        preg_match_all('/<img[^>]+src=(?:\"|\')\K(.[^">]+?)(?=\"|\')/', $row['sapo'], $imgs);
        $imgs = $imgs[1];
        $imgs = array_unique($imgs);

        $urls[] = array($link , $day,  'daily', '0.6',$imgs);
        unset($imgs);
    }

    //cấu trúc sitemap
    $xml = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="https://timviec365.com.vn/gia-su/cssnew/css-sitemap.xsl"?>
    <urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $key => $value) { 
        $xml .= '<url><loc>'.$value['0'].'</loc><lastmod>'.$value['1'].'</lastmod><changefreq>'.$value['2'].'</changefreq><priority>'.$value['3'].'</priority>';
        if (count($value['4']) > 0) {
            foreach ($value['4'] as $keys => $values) {
                $xml .= '<image:image><image:loc>https://timviec365.com/gia-su/'.$values.'</image:loc></image:image>';
            }
        }
        $xml .= '</url>';
    }
    $xml .= '</urlset>';
    $stt_file = ($i == 0) ? '':$i;
    $file =  '../sitemap-blog'.$stt_file.'.xml';
    $fp = fopen($file,"w"); 
    fputs($fp, $xml); 
    fclose($fp);
    unset($xml,$url);
}

echo 'done';

?>

