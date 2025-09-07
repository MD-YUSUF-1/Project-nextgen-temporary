<?php
session_start();
require_once('../model/transactionModel.php');

if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}



$fromDate = isset($_GET['from_date']) ? trim($_GET['from_date']) : '';
$toDate = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';
$transactionType = isset($_GET['transaction_type']) ? trim($_GET['transaction_type']) : '';
$amountRange = isset($_GET['amount_range']) ? trim($_GET['amount_range']) : '';
$searchText = isset($_GET['search_Text']) ? trim($_GET['search_Text']) : '';

echo $fromDate, $toDate, $transactionType, $amountRange, $searchText;


if (!$fromDate  && !$toDate && !$transactionType  && !$amountRange && !$searchText) {
    header("location: ../view/Transaction-History.php?error=select_filter_or_search");
    exit();
}
if ($fromDate || $toDate) { 
    if (!($fromDate && $toDate)) {
        header("location: ../view/Transaction-History.php?error=both_dates");
        exit();
    }

    if (strtotime($toDate) > time()) {
        header("location: ../view/Transaction-History.php?error=date_exceed");
        exit();
    }

    if (strtotime($fromDate) > strtotime($toDate)) {
        header("location: ../view/Transaction-History.php?error=date_order");
        exit();
    }
}

if ($searchText && strlen($searchText) < 3) {
    header("location: ../view/Transaction-History.php?error=search_min_length");
        exit();
}

$filters = [
    'from_date' => $fromDate,
    'to_date' => $toDate,
    'transaction_type' => $transactionType,
    'amount_range' => $amountRange,
    'search_text' => $searchText
];


$filteredTransactions = getFilteredTransactions($_SESSION["u_id"], $filters);
$_SESSION['filtered_transactions'] = $filteredTransactions;
$appliedFilters = [];
foreach ($filters as $f) {
    if ($f !== '') {  
        $appliedFilters[] = $f;
    }
}
$_SESSION['applied_filters'] = $appliedFilters;
$_SESSION['show_filtered_message'] = true;
header("location: ../view/Transaction-History.php");




















