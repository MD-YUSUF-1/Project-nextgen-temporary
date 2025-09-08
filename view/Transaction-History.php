<?php

session_start();
require_once('../model/transactionModel.php');

$_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
}

setcookie('status', true, time() + 900, '/');
if (!isset($_COOKIE['status'])) {
    header('location: login.html?error=badrequest');
}

$transactions = [];
$errors = "";

if (isset($_SESSION['filtered_transactions'])) {
    $transactions = $_SESSION['filtered_transactions'];
    $appliedFilters = $_SESSION['applied_filters'];
    $isFiltered = $_SESSION['show_filtered_message'];
} else {
    $transactions = getTransactionsById($_SESSION["u_id"]);
    $isFiltered = false;
}

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'select_filter_or_search') {
        $errors = "Please select a filter type or write something in search box";
    } elseif ($_GET['error'] === 'both_dates') {
        $errors = "Please select a Both date";
    } elseif ($_GET['error'] === 'date_exceed') {
        $errors = "To date cannot exceed current date";
    } elseif ($_GET['error'] === 'date_order') {
        $errors = "To date must be after From date";
    } elseif ($_GET['error'] === 'search_min_length') {
        $errors = "Search input must be minimum 3 characters.";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/transaction-styles.css">
    <link rel="stylesheet" href="../assets/styles/Font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Transaction History</title>
</head>
<style>

</style>

<body>
    <header>
        <div class="back-container">
            <a href="../index.php"><button class="back-btn"> <i class="fa-solid fa-arrow-left"></i> Back to home
                </button></a>
        </div>
        <!-- Banner section -->
        <section class="container">
            <div class="banner">
                <h1> Transaction History</h1>
                <p>View and manage your account transactions details</p>
            </div>
        </section>
    </header>
    <main class="container">
        <!-- Filter section -->
        <section>
            <div class="filter-section">
                <form action="../controller/transactionHistoryCheck.php" method="get" onsubmit="return applyFilter()">
                    <div class="filters-container">
                        <div class="filter-fields">
                            <label for="from-date">From date</label>
                            <input name="from_date" type="date" id="from-date" class="filter-input">
                        </div>
                        <div class="filter-fields">
                            <label for="to-date">To date</label>
                            <input name="to_date" type="date" id="to-date" class="filter-input">
                        </div>
                        <div class="filter-fields">
                            <label for="transaction-type">Transaction Type</label>
                            <select name="transaction_type" id="transaction-type" class="filter-input">
                                <option value="">All Types</option>
                                <option value="debit">Debit</option>
                                <option value="credit">Credit</option>
                            </select>
                        </div>
                        <div class="filter-fields">
                            <label for="amount-range">Amount Range</label>
                            <select name="amount_range" id="amount-range" class="filter-input">
                                <option value="">All Amounts</option>
                                <option value="0-100">$0 - $100</option>
                                <option value="101-500">$101 - $500</option>
                                <option value="501-1000">$501 - $1,000</option>
                                <option value="1000+">$1,000+</option>
                            </select>
                        </div>
                    </div>
                    <p id="filter-error" class="error"></p>
                    <div>
                        <button type="submit" class="btn apply-btn">
                            <i class="fa-solid fa-filter"></i> Apply Filters
                        </button>
                    </div>
                </form>
                <form action="../controller/transactionHistoryCheck.php" method="get" onsubmit="return validateSearch()">
                    <div class="search-bar">
                        <label for="search-input">Search Transactions by Description and Status</label>
                        <input name="search_Text" type="search" id="search-input" class="search-input" placeholder="Search here...">
                    </div>
                    <p id="search-error" class="error"><?= $errors ? $errors : ''; ?></p>
                    <div class="action-buttons">
                        <button type="submit" class="btn secondary-btn">
                            <i class="fa-solid fa-search"></i> Search
                        </button>
                        <button type="button" class="btn secondary-btn">
                            <i class="fa-solid fa-file-csv"></i> Export CSV
                        </button>
                    </div>
                </form>
                <form method="post" style="display: flex; gap: 10px; align-items: center;" action="../controller/resetTransactionFilter.php">
                    <?php if ($isFiltered) { ?>
                        <p class="applied-filters">Filters applied - Showing filtered results</p>
                        <div>
                            <button type="submit" class="btn reset-btn">
                                <i class="fa-solid fa-rotate-left "></i>
                            </button>
                        </div>
                    <?php } ?>

                </form>
            </div>
        </section>

        <!-- Transactions section -->
        <section>
            <div class="transaction-table">
                <div class="transaction-heading">
                    <h3>Recent Transactions</h3>
                    <div class="transaction-count">
                        <i class="fa-solid fa-list"></i> <?= count($transactions); ?> transaction
                    </div>
                </div>
                <div class="table-data">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Transaction ID</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-table-body">
                            <?php if ($transactions) {
                                foreach ($transactions as $transaction) { ?>
                                    <tr>
                                        <td><?= $transaction['date'] ?> </td>
                                        <td><?= $transaction['description'] ?> </td>
                                        <td><?= $transaction['transaction_type'] ?> </td>
                                        <td><?= $transaction['transaction_category'] ?> </td>
                                        <td><?= $transaction['amount'] ?> </td>
                                        <td><?= $transaction['remaining_balance'] ?> </td>
                                        <td><?= $transaction['status'] ?> </td>
                                        <td><?= $transaction['transaction_id'] ?> </td>
                                    </tr>

                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 40px;">No transactions found matching your criteria</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Showing 1-4 of 100 transactions
                        </div>
                        <div class="pagination-controls">
                            <button class="page-btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button class="page-btn">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">4</button>
                            <button class="page-btn">5</button>
                            <button class="page-btn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>

    </footer>
    <script src="../assets/js/TransitionHistory.js"></script>

</body>

</html>