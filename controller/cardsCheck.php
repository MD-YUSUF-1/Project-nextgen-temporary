<?php

require_once('../model/cardsModel.php');
$data = isset($_REQUEST['values']) ? $_REQUEST['values'] : '';

// echo $data;
//  exit;


$values = json_decode(($data));
$allCards = $values->value;

if ($allCards==="all") {
    
    $allCards = getAllCards();
    $allCardsFeatures = getAllCardsFeatures();
    echo json_encode(['cards' => $allCards , 'features' => $allCardsFeatures]);
}
