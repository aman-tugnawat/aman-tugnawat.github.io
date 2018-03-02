<?php

/* counter */

//opens countlog.txt to read the number of hits
$datei = fopen("/kudolog.txt","r");
$count = fgets($datei,1000);
fclose($datei);

//echo "$count" ;
//echo " hits" ;
//echo "\n" ;

// opens countlog.txt to change new hit number
$datei = fopen("/countlog.txt","w");
fwrite($datei, $count);
fclose($datei);

header('Content-Type: application/json');

    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
            case 'getadd':
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
               		$count=$count + 1 ;
                   $aResult['result'] = $count;
               }
               break;
            case 'get':
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
                   $aResult['error'] = 'Error in arguments!';
               }
               else {
                   $aResult['result'] = $count;
               }
               break;
            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }

    echo json_encode($aResult);

?>