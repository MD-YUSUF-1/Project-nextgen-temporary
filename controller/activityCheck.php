<?php
session_start();
require_once('../model/activityLogModel.php');

if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}



$fromDate = isset($_GET['from_date']) ? trim($_GET['from_date']) : '';
$toDate = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';
$action = isset($_GET['action']) ? trim($_GET['action']) : '';

echo $fromDate, $toDate, $action;


if (!$fromDate  && !$toDate && !$action) {
    header("location: ../view/Activity-log.php?error=select_filter");
    exit();
}
if ($fromDate || $toDate) { 
    if (!($fromDate && $toDate)) {
        header("location: ../view/Activity-log.php?error=both_dates");
        exit();
    }

    if (strtotime($toDate) > time()) {
        header("location: ../view/Activity-log.php?error=date_exceed");
        exit();
    }

    if (strtotime($fromDate) > strtotime($toDate)) {
        header("location: ../view/Activity-log.php?error=date_order");
        exit();
    }
}


$filters = [
    'from_date' => $fromDate,
    'to_date' => $toDate,
    'action' => $action,
];


$filteredActivities = getFilteredActivites($_SESSION["u_id"], $filters);
$_SESSION['filtered_acitivities'] = $filteredActivities;
$appliedFilters = [];
foreach ($filters as $f) {
    if ($f !== '') {  
        $appliedFilters[] = $f;
    }
}
$_SESSION['applied_filters'] = $appliedFilters;
$_SESSION['show_filtered_message'] = true;
header("location: ../view/Activity-log.php");




















