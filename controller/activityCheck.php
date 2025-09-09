<?php
session_start();
require_once('../model/activityLogModel.php');

if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}

setcookie('status', true, time() + 900, '/');
if (!isset($_COOKIE['status'])) {
    header('location: login.html?error=badrequest');
}



// $fromDate = isset($_GET['from_date']) ? trim($_GET['from_date']) : '';
// $toDate = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';
// $action = isset($_GET['action']) ? trim($_GET['action']) : '';


$data = isset($_REQUEST['filters']) ? $_REQUEST['filters'] : '';
$filters = json_decode(($data));


$fromDate = isset($filters->fromDate) ? trim($filters->fromDate) : '';
$toDate = isset($filters->toDate) ? trim($filters->toDate) : '';
$action = isset($filters->activityType) ? trim($filters->activityType) : '';

$value = isset($filters->value) ? trim($filters->value) : '';

// echo $fromDate, $toDate, $action;
// exit;

if ($value) {
    $allActivites = getActivitesById($_SESSION["u_id"]);
    echo json_encode(['allActivites' => $allActivites]);
    exit;
}



$errors = [];

if (!$fromDate  && !$toDate && !$action) {
    // header("location: ../view/Activity-log.php?error=select_filter");
    // exit();
    $errors[] = "Please select a filter";
}
if ($fromDate || $toDate) {
    if (!($fromDate && $toDate)) {
        // header("location: ../view/Activity-log.php?error=both_dates");
        // exit();
        $errors[] = "Please select a Both date ";
    }

    if (strtotime($toDate) > time()) {
        // header("location: ../view/Activity-log.php?error=date_exceed");
        // exit();
        $errors[] = "From date cannot exceed to date ";
    }
}
if (!empty($errors)) {
    $error = ['errors' => $errors];
    echo json_encode($error);
    exit();
}


$filters = [
    'from_date' => $fromDate,
    'to_date' => $toDate,
    'action' => $action,
];


$filteredActivities = getFilteredActivites($_SESSION["u_id"], $filters);
echo json_encode(['filteredActivities' => $filteredActivities]);


// $_SESSION['filtered_acitivities'] = $filteredActivities;
// $appliedFilters = [];
// foreach ($filters as $f) {
//     if ($f !== '') {
//         $appliedFilters[] = $f;
//     }
// }
// $_SESSION['applied_filters'] = $appliedFilters;
// $_SESSION['show_filtered_message'] = true;
// header("location: ../view/Activity-log.php");
