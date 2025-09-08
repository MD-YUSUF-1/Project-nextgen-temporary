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
$id = $_GET['id'];

$cardFeatures = getCardFeaturesByID($id);
$cardvouchers = getCardVouchersByID($id);
$card = getCardByID($id);


// print_r($cardFeatures);
// print_r($card);
// print_r($cardvouchers);



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/CardDetails.css">
    <link rel="stylesheet" href="../assets/styles/Font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <title>Card Details</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="back-container">
                <a href="./Cards.html"><button class="btn back-btn"> <i class="fa-solid fa-arrow-left"></i> Back to
                        Cards
                    </button></a>
            </div>
            <h1 class="page-title">Card Details</h1>
        </div>
    </header>

    <main class="container">
        <section>
            <div>
                <div class="card-header">
                    <h1 class="card-name">Khidmah Credit Card</h1>
                    <h1 class="card-type">Credit Card</h1>
                </div>
        </section>

        <!-- Welcome Vouchers -->
        <section class="section">
            <h2 class="section-title">Curated Exclusive Welcome Vouchers</h2>
            <ul class="voucher-list">
                <?php if ($cardvouchers) {
                    foreach ($cardvouchers as $cv) { ?>

                        <li><i class="fa-solid fa-circle list-icons"></i><?= $cv['description']; ?></li>
                <?php }
                } ?>
            </ul>
        </section>

        <!-- Facilities -->
        <section class="section">
            <h2 class="section-title">Facilities</h2>
            <ul class="facility-list">
                <?php if ($cardFeatures) {
                    foreach ($cardFeatures as $cf) { ?>

                        <li><i class="fa-solid fa-circle list-icons"></i><?= $cf['feature']; ?></li>
                <?php }
                } ?>
            </ul>
        </section>

        <!-- Basic Info -->
        <section class="section" style="border: none;">
            <h2 class="section-title">Card Information</h2>
            <table class="charges-table">
                <tbody>
                    <tr>
                        <td><strong>Credit Limit</strong></td>
                        <td><?= $card['credit_limit']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Annual Fee</strong></td>
                        <td><?= $card['annual_fee']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Interest Rate</strong></td>
                        <td><?= $card['interest_rate']; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>