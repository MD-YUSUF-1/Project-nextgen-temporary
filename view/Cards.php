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
            <a href="userCards.html"><button class="btn btn-user-cards">Your cards</button></a>
        </div>
    </section>

    <!-- Cards Section -->
    <section class="cards-section">
        <div class="cards-grid" id="cardsGrid">
            <!-- <?php if ($cards) {
                foreach ($cards as $card) { ?>
                    <div class="card">
                        <div class="card-image">
                            <img src="<?= $card['img']; ?>" alt="<?= $card['name']; ?>">
                        </div>

                        <div class="card-body">
                            <div class="card-title"><?= $card['name']; ?></div>
                            <ul class="card-features">
                                <?php foreach ($cardsFeatures as $cf) {
                                 if ($cf['card_id']===$card['card_id']) { ?>
                                        <li><?= $cf['feature']; ?></li>
                                <?php }
                                } ?>
                            </ul>
                            <div class="card-fee">
                                <p class="fee-label">Annual Fee</p>
                                <p class="fee-amount"><?= $card['annual_fee']; ?></p>
                            </div>
                            <div class="card-btn-div">
                                <a href="./CardDetails.php?id=<?=$card['card_id']?>" class="btn-know">KNOW MORE</a>
                                <a href="" class="apply-btn">Apply Now</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?> -->
        </div>
        <script src="../assets/js/Cards.js"></script>
    </section>
</body>

</html>