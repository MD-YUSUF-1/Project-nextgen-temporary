<?php
session_start();
require_once('../model/activityLogModel.php');

$_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
}

$activityLogs = [];
$errors = "";


if (isset($_SESSION['filtered_acitivities'])) {
    $activities = $_SESSION['filtered_acitivities'];
    $appliedFilters = $_SESSION['applied_filters'];
    $isFiltered = $_SESSION['show_filtered_message'];
} else {
    $activities = getActivitesById($_SESSION["u_id"]);
    $isFiltered = false;
}

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'select_filter') {
        $errors = "Please select a filter type";
    } elseif ($_GET['error'] === 'both_dates') {
        $errors = "Please select a Both date";
    } elseif ($_GET['error'] === 'date_exceed') {
        $errors = "To date cannot exceed current date";
    } elseif ($_GET['error'] === 'date_order') {
        $errors = "To date must be after From date";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/Activity.css">
    <link rel="stylesheet" href="../assets/styles/Font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Activity Log</title>
</head>
<style>

</style>

<body>
    <header>
        <div class="back-container">
            <a href="../index.php"><button class="btn back-btn"> <i class="fa-solid fa-arrow-left"></i> Back to home
                </button></a>
        </div>
        <!-- Banner section -->
        <section class="container">
            <div class="banner">
                <h1> Activity Log</h1>
                <p>Track all recent actions on your account in one place. </p>
            </div>
        </section>
    </header>
    <main class="container">
        <!-- Filter section -->
        <section>
            <div class="filter-section">
                <form action="../controller/activityCheck.php" method="get" onsubmit="return applyFilter()">
                    <div class="filters-container">
                        <div class="filter-fields">
                            <label for="from-date">From date</label>
                            <input name="from_date" type="date" id="from-date" class="filter-input">
                        </div>
                        <div class="filter-fields">
                            <label for="to-date">To date</label>
                            <input name="to_date" type="date" id="to-date" class="filter-input">
                        </div>
                        <div class="filter-fields" style="grid-column: 1/span 2;">
                            <label for="activity-type">Action</label>
                            <select name="action" id="activity-type" class="filter-input">
                                <option value="">All Actions</option>
                                <option value="login">Login</option>
                                <option value="transfer">Fund Transfer</option>
                                <option value="bill">Bill Payment</option>
                                <option value="card">Card Management</option>
                                <option value="profile">Profile Update</option>
                                <option value="security">Security Alert</option>
                                <option value="export">Data Export</option>
                            </select>
                        </div>
                    </div>
                    <p id="filter-error" class="error"><?= $errors ? $errors : ''; ?></p>
                    <div class="action-buttons">
                        <button type="submit" class="btn apply-btn">
                            <i class="fa-solid fa-filter"></i> Apply Filters
                        </button>
                    </div>
                </form>
                <form method="post" style="display: flex; gap: 10px; align-items: center;" action="../controller/resetActivityFilter.php">
                    <?php if ($isFiltered) { ?>
                        <p class="applied-filters">Filters applied - Showing filtered results</p>
                        <div>
                            <button type="submit" class="btn reset-btn" onclick="resetEverything()">
                                <i class="fa-solid fa-rotate-left "></i>
                            </button>
                        </div>
                    <?php } ?>

                </form>
            </div>
        </section>

        <!-- activity section -->
        <section>
            <div class="activity-table">
                <div class="activity-heading">
                    <h3>Recent activity</h3>
                    <div class="activity-count">
                        <i class="fa-solid fa-list"></i> <?= count($activities); ?> activity
                    </div>
                </div>
                <div class="table-data">
                    <table>
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Details</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="activity-table-body">
                            <?php if ($activities) {
                                foreach ($activities as $activity) { ?>
                                    <tr>
                                        <td><?= $activity['activity_time'] ?> </td>
                                        <td><?= $activity['activity_date'] ?> </td>
                                        <td><?= $activity['details'] ?> </td>
                                        <td><?= $activity['action'] ?> </td>
                                    </tr>
                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px;">No transactions found matching your criteria</td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Showing 1-4 of 100 activity
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
    <script src="../assets/js/Activity.js"></script>
</body>

</html>