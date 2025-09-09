<?php
session_start();
require_once('../model/transactionModel.php');

if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}


setcookie('status', true, time() + 900, '/');
if (!isset($_COOKIE['status'])) {
    header('location: login.html?error=badrequest');
}



// $fromDate = isset($_REQUEST['from_date']) ? trim($_REQUEST['from_date']) : '';
// $toDate = isset($_REQUEST['to_date']) ? trim($_REQUEST['to_date']) : '';
// $transactionType = isset($_REQUEST['transaction_type']) ? trim($_REQUEST['transaction_type']) : '';
// $amountRange = isset($_REQUEST['amount_range']) ? trim($_REQUEST['amount_range']) : '';
// $searchText = isset($_REQUEST['search_Text']) ? trim($_REQUEST['search_Text']) : '';

$data = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : '';
$filters = json_decode(($data));


$fromDate = isset($filters->fromDate) ? trim($filters->fromDate) : '';
$toDate = isset($filters->toDate) ? trim($filters->toDate) : '';
$transactionType = isset($filters->transactionType) ? trim($filters->transactionType) : '';
$amountRange = isset($filters->amountRange) ? trim($filters->amountRange) : '';
$searchText = isset($filters->searchInput) ? trim($filters->searchInput) : '';

$value = isset($filters->value) ? trim($filters->value) : '';

if ($value) {
    $allTransactions = getTransactionsById($_SESSION["u_id"]);
    echo json_encode(['allTransactions' => $allTransactions]);
    exit;
}



$errors = [];


if (!$fromDate  && !$toDate && !$transactionType  && !$amountRange && !$searchText) {
    // header("location: ../view/Transaction-History.php?error=select_filter_or_search");
    // exit();
    $errors[] = "Please select a filter or enter a search term ";
}
if ($fromDate || $toDate) {
    if (!($fromDate && $toDate)) {
        // header("location: ../view/Transaction-History.php?error=both_dates");
        // exit();
        $errors[] = "Please select a Both date ";
    }

    if (strtotime($toDate) > time()) {
        // header("location: ../view/Transaction-History.php?error=date_exceed");
        // exit();
        $errors[] = "To date cannot exceed current date ";
    }

    if (strtotime($fromDate) > strtotime($toDate)) {
        // header("location: ../view/Transaction-History.php?error=date_order");
        // exit();
        $errors[] = "From date cannot exceed To date ";
    }
}

if ($searchText && strlen($searchText) < 3) {
    // header("location: ../view/Transaction-History.php?error=search_min_length");
    //     exit();
    $errors[] = "Search input must be minimum 3 characters ";
}


if (!empty($errors)) {
    $error = ['errors' => $errors];
    echo json_encode($error);
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
echo json_encode(['filteredTransaction' => $filteredTransactions]);



// $_SESSION['filtered_transactions'] = $filteredTransactions;
// $appliedFilters = [];
// foreach ($filters as $f) {
//     if ($f !== '') {  
//         $appliedFilters[] = $f;
//     }
// }
// $_SESSION['applied_filters'] = $appliedFilters;
// $_SESSION['show_filtered_message'] = true;
// header("location: ../view/Transaction-History.php");
