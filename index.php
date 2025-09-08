
<?php 

    session_start();
    $_SESSION["username"] = "Yusuf";
    $_SESSION["status"] = true;
    $_SESSION['u_id']=3;
    if (!isset($_SESSION["status"])) {
        header("location: login.html?error=badrequest");
    }
    // unset($_SESSION["status"]);
    // unset($_SESSION["username"]);
    // session_destroy();

setcookie('status', true, time() + 900, '/');
if (!isset($_COOKIE['status'])) {
    header('location: login.html?error=badrequest');
}
// setcookie('status', true, time() - 30, '/');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGen Bank Home </title>
    <link rel="stylesheet" href="./assets/styles/landing-page.css">
    <link rel="stylesheet" href="./assets/styles/Font.css">
    <style>
       
    </style>
</head>

<body>
    <header>
        <nav class="nav">
            <div class="container nav-container">
                <div class="logo">NextGen Bank</div>
                <div class="nav-menu">
                    <a href="">Home</a>
                    <a href="./view/Transaction-History.php">Transactions</a>
                    <a href="./view/Activity-log.php">Activity Log</a>
                    <a href="./view/Cards.php">Cards</a>
                    <a href="">About</a>
                    <a href="">About</a>

                </div>
                <div class="authentication-btn">
                    <!-- php -->
                    <?php 
                    if (isset($_SESSION['username'])) {
                        echo "<a href=\"\" class=\" btn username\">".$_SESSION['username']."</a>";
                        echo "<a href=\"\" class=\"btn btn-auth \">Logout</a>";
                    }
                    else{
                        echo "<a href=\"\" class=\"btn btn-auth \">Login</a>";
                    }
                    ?>
                    <!-- php -->
                </div>
            </div>
        </nav>
    </header>
    <main>
        <!-- hero section -->
        <section>
            <div class="hero">
                <div class="hero-content">
                    <h1>Your Everyday Banking Partner</h1>
                    <p>Your trusted partner for savings, investments, and everyday banking. Manage your money, pay
                        bills,transfer funds, and achieve your financial goals with ease.</p>
                    <div class="hero-buttons">
                        <a href="" class="btn btn-open-account ">Open Account</a>
                        <a href="#services" class="btn btn-services ">View Services</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- services Section -->
        <section class="services" id="services">
            <div class="container ">
                <div class="section-title">
                    <h2>Banking Services for Everyone</h2>
                    <p>From checking accounts to loans, we have all the banking services you need in one place</p>
                </div>

                <div class="services-grid">
                    <a href="">
                        <div class="service-card">
                            <div class="service-icon">💰</div>
                            <h3>Account Management</h3>
                            <p>View balances, track spending, and view account activity from one convenient dashboard.
                            </p>
                        </div>
                    </a>

                    <a href="">
                        <div class="service-card">
                            <div class="service-icon">💸</div>
                            <h3>Easy Transfers</h3>
                            <p>Send money to friends , family and business partners instantly.</p>
                        </div>
                    </a>

                    <a href="">
                        <div class="service-card">
                            <div class="service-icon">💵</div>
                            <h3>Bill pay</h3>
                            <p>Easily pay your utility, education, and business bills directly through our bank.</p>
                        </div>
                    </a>

                    <a href="">
                        <div class="service-card">
                            <div class="service-icon">💳</div>
                            <h3>Debit & Credit Cards</h3>
                            <p>Enjoy instant access to your money with our debit cards, and take advantage of credit
                                cards
                                with competitive rates and rewards.</p>
                        </div>

                    </a>
                    <a href="">
                        <div class="service-card">
                            <div class="service-icon">🏠</div>
                            <h3>Loans & Mortgages</h3>
                            <p>Whether you need a loan for a home, car, or personal expenses, we're here to help with
                                flexible options.</p>
                        </div>
                    </a>

                    <a href="">
                        <div class="service-card">
                            <div class="service-icon">🪙</div>
                            <h3>Interest Calculator</h3>
                            <p>Use our interest calculator to estimate your earnings and track your account growth.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- why choose us section-->
        <section class="why-choose-us">
            <div class="container">
                <div class="section-title">
                    <h2>Why Choose NextGen Bank?</h2>
                    <p>We make banking simple and convenient for our customers</p>
                </div>
                <div class="Choosing-reasons-grid">
                    <div class="reason-card">
                        <div class="reason-card-icon">🏧</div>
                        <h3>Nationwide ATMs</h3>
                        <p>Access your money at hundreds of ATMs across the country</p>
                    </div>
                    <div class="reason-card">
                        <div class="reason-card-icon">📞</div>
                        <h3>24/7 Customer Support</h3>
                        <p>Get help whenever you need it with our round-the-clock support</p>
                    </div>
                    <div class="reason-card">
                        <div class="reason-card-icon">💵</div>
                        <h3>Easy Transfer and Bill Payment</h3>
                        <p>Transfer Balance and pay your bills easily</p>
                    </div>
                    <div class="reason-card">
                        <div class="reason-card-icon">💳</div>
                        <h3>Special Benefits on Cards</h3>
                        <p>Get discounts and less maintenance fee on debit and credit cards </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <h1>NextGen Bank</h1>
                <p>Head Office : NextGen Bank, 35-42,44 Motijheel Commercial Area, Dhaka-1000, Bangladesh.</p>
                <p>Phone : ☎ +8809610016639</p>
                <p>Email : ✉ info@nextgenbank.com.bd</p>
                <h3>Social Links</h3>
                <div class="social-links">

                    <a href="https://www.facebook.com/"><img src="./img/facebook.png" alt=""></a>
                    <a href="https://www.linkedin.com/"><img src="./img/linkedin.png" alt=""></a>
                    <a href="https://x.com/"><img src="./img/twitter.png" alt=""></a>
                    <a href="https://www.youtube.com/"><img src="./img/youtube.png" alt=""></a>

                </div>
                <hr>
                <p class="copyright">© Copyright 2025 NextGen Bank. All rights reserved.</p>
            </div>
        </div>

    </footer>
</body>

</html>