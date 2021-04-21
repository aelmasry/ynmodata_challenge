<?php

use Nathanmac\Utilities\Responder\Facades\Responder;

require 'vendor/autoload.php';
$dataManger = new DataManager();
$data = $dataManger->fetch();
if (isset($_REQUEST["query"]))
{
    $data = $dataManger->search($data, $_REQUEST["query"]);
    $data = array_values($data);
}else {
    $data = json_decode($data, true);
    $data = $data['data'];
}

echo json_encode($data, true);
