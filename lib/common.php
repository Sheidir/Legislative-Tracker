<?php

/**
 *Gets the root path of the project
 *
 *@return string.
 */

function getRootPath(){
    return realpath(__DIR__ . '/..');
}
/**
 * Gets the full path for the database file
 * @return string.
 */
function getDatabasePath(){
    return getRootPath() . '/data/data.sqlite';

}
/**
 *Gets the DSN for the SQlite connection
 *
 * @return string
 */
function getDsn(){
    return 'sqlite:' . getDatabasePath();

}
/**
 * Gets the PDO object for database access
 *
 * return \PDO
 */
function getPDO(){
    $pdo = new PDO(getDSN());
        //Foreign key constraints need to be enabled manually in SQLite
        $result = $pdo->query('PRAGMA foreign_keys = ON');
        if($result === false){
            throw new Exception('Could not turn on foreign key constraints.');
    }
    return $pdo;
}
/**
 *
 * Escapes HTML so it is safe to output
 *@param string $html
 *@return string
 */
function htmlEscape($html){
    return htmlspecialchars($html, ENT_HTML5, 'UTF-8');

}
function redirectAndExit($script){
//Get the domain-relative URL (e.g. /blog/whatever.php or /whatever.php) and
//out the folder (e.g. /blog/ or /).
    $relativeUrl = $_SERVER['PHP_SELF'];
    $urlFolder = substr($relativeUrl, 0, strrpos($relativeUrl, '/') +1);
//Redirect to the full URL (http://myhost/blog/script.php)
    $host = $_SERVER['HTTP_HOST'];
    $fullURL = 'http://' . $host . $urlFolder . $script;
    header('Location: ' . $fullURL);
    exit();
}
function findResource(Array $item){


$str = committeeName($item);
$str2= null;
$url = null;
$return = null;
switch($str){
    case "Health":
        $str2 = "12";
        break;
    case "General":
        $str2 = "11";
        break;
    case "Courts":
        $str2 = "08";
        break;
    case "Counties":
        $str2 = "07";
        break;
    case "Appropriations":
        $str2 = "02";
        break;
    case "Education":
        $str2 = "09";
        break;
    default:
    $str2 = false;
}
if($str2){
    $url = "http://virginiageneralassembly.gov/house/agendas/agendaDates.php?id=H" .$str2 ."&ses=181";
}
if($url){

    $html = file_get_html($url);
    foreach($html->find('tr.standardZebra')as $value){
        if(strpos($value, $item[0])){

        $return = $value;

        }

    }

}

return $return;

}
function committeeName(Array $array){
    $str = "";
    for($i = 0; $i < count($array); $i++) {
        if (strpos($array[$i], "from") !==false) {
            $str = $array[$i + 1];


        }
    }
    return $str;

}