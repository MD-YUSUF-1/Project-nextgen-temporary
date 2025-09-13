<?php

require_once('../model/cardsModel.php');
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

$userCards = getAllCardsOfUser($id);
echo json_encode(['userCards' => $userCards]);
