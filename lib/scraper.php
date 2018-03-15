<?php
require_once"simple_html_dom.php";
require_once"common.php";

/**
 * String $number
 */

//"https://www.richmondsunlight.com/bill/2018/" .$number
//"http://virginiageneralassembly.gov/house/agendas/agendaDates.php?id=H09&ses=181"
//$str = "https://lis.virginia.gov/cgi-bin/legp604.exe?ses=181&typ=bil&val=" . $number;
$str = "https://www.richmondsunlight.com/bill/2018/" .$number;
$html = file_get_html($str);
$dates = [];

foreach($html->find('div[id=status-history] tr')as $piece) {



    if(strpos($piece, 'Report')){
        $arr = explode(" ", $piece->plaintext);
        $link = findResource($arr);
        if($link){
            $piece = $piece . $link;

        };
    }
    $dates[] = ['data' => $piece];

}

?>

<ul>
<?php foreach ($dates as $date): ?>
<?php foreach ($date as $item): ?>
        <li>  <?php echo $item ?> </li>
    <?php endforeach ?>
    <?php endforeach ?>
</ul>
