<?php
require_once('db.php');

function getAllCards()
{
    $con = getConnection();
    $sql = "SELECT * from cards";
    $result = mysqli_query($con, $sql);
    $cards = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($cards, $row);
    }
    return $cards;
}

function getCardByID($id)
{
    $con = getConnection();
    $sql = "SELECT * from cards  where card_id = '{$id}'";
    $result = mysqli_query($con, $sql);
    // print_r($result);
    $row = mysqli_fetch_assoc($result);
    // print_r($row);
    return $row;
}


function getAllCardsFeatures()
{
    $con = getConnection();
    $sql = "SELECT * from card_features";
    $result = mysqli_query($con, $sql);
    $card_features = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($card_features, $row);
    }
    return $card_features;
}
function getCardFeaturesByID($id)
{
    $con = getConnection();
    $sql = "SELECT * from card_features where card_id = '{$id}'";
    $result = mysqli_query($con, $sql);
    $card_features = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($card_features, $row);
    }
    return $card_features;
}


function getCardVouchersByID($id)
{
    $con = getConnection();
    $sql = "SELECT * from card_vouchers where card_id = '{$id}'";
    $result = mysqli_query($con, $sql);
    $cardVouchers = [];

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($cardVouchers, $row);
    }
    return $cardVouchers;
}
