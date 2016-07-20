<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$token = $_GET['token'];
include 'auth.php';

if (!in_array($token, $tokens)) {
    die(json_encode(array("success" => false)));
}

$outletId = $_GET['outletId'];
$outletStatus = $_GET['outletStatus'];

$codes = array(
    "1" => array(
        "on" => 4478259,
        "off" => 4478268
    ),
    "2" => array(
        "on" => 4478403,
        "off" => 4478412
    ),
    "3" => array(
        "on" => 4478723,
        "off" => 4478732
    ),
    "4" => array(
        "on" => 4480259,
        "off" => 4480268
    ),
    "5" => array(
        "on" => 4486403,
        "off" => 4486412
    ),
    "6" => array(
        "on" => 4216115,
        "off" => 4216124
    ),
    "7" => array(
        "on" => 4216579,
        "off" => 4216588
    ),
);

$file = 'outletState.json';
$outletStateEncoded = file_get_contents($file);
$outletStateTemp = json_decode($outletStateEncoded, true);
$outletState = array(
  "success" => true,
  "1" => $outletStateTemp[1],
  "2" => $outletStateTemp[2],
  "3" => $outletStateTemp[3],
  "4" => $outletStateTemp[4],
  "5" => $outletStateTemp[5],
  "6" => $outletStateTemp[6],
  "7" => $outletStateTemp[7]
);

$state = 0; //Default to off
if (is_null($outletId)) {
    die($outletStateEncoded);
}
else if (is_null($outletStatus)) {
    print($outletState[$outletId]);
    exit(0);
}
else if ($outletStatus == "on") {
    $state = 1;
}

if ($outletId == (count($codes) + 1)) { //All Outlets
    $codesToToggle = array_column($codes, $outletStatus);

    for ($i = 1; $i <= count($codes); $i++) {
        $outletState[$i] = $state;
    }
}
else {
    $codesToToggle = array($codes[$outletId][$outletStatus]);
    $outletState[$outletId] = $state;
}

$codeSendPulseLength = "189";
foreach ($codesToToggle as $codeSendCode) {
    shell_exec('./codesend ' . $codeSendCode . ' -p ' . $codeSendPIN . ' -l ' . $codeSendPulseLength);
}

$outletStateEncoded = json_encode($outletState);
file_put_contents($file, $outletStateEncoded);
print($state);
?>
