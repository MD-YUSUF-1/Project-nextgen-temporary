<?php

session_start();
require_once('../model/cardsModel.php');

$_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
}

setcookie('status', true, time() + 900, '/');
if (!isset($_COOKIE['status'])) {
    header('location: login.html?error=badrequest');
}

$cards = [];
$cardsFeatures = [];

// $cards = getAllCards();
// $cardsFeatures = getAllCardsFeatures();



// print_r($cards);
// print_r($cardsFeatures);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/Cards.css">
    <link rel="stylesheet" href="../assets/styles/Font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <title>Credit & Debit Cards</title>
    <style>
    </style>
</head>

<body>
    <section>

        <div class="back-container">
            <a href="../index.php"><button class="btn back-btn"> <i class="fa-solid fa-arrow-left"></i> Back to home
                </button></a>
        </div>
    </section>

    <section class="hero-section">
        <div class="hero-section-content">
            <h1>Choose Your Perfect Card</h1>
            <p>From basic banking to premium rewards - find the card that fits your lifestyle</p>
            <button onclick="personalCards()" class="btn btn-user-cards">Your cards</button>
        </div>
    </section>

    <!-- Cards Section -->
    <section class="cards-section">
        <div class="cards-grid" id="cardsGrid">
            
        </div>
        <script src="../assets/js/Cards.js"></script>
    </section>
</body>

</html>