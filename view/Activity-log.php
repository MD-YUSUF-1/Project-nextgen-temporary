<?php 
    // session_start();
    // if (!isset($_SESSION["status"])) {
    //     header("location: login.html?error=badrequest");
    // }
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
                <form onsubmit="return applyFilter(event)">
                    <div class="filters-container">
                        <div class="filter-fields">
                            <label for="from-date">From date</label>
                            <input type="date" id="from-date" class="filter-input">
                        </div>
                        <div class="filter-fields">
                            <label for="to-date">To date</label>
                            <input type="date" id="to-date" class="filter-input">
                        </div>
                        <div class="filter-fields" style="grid-column: 1/span 2;">
                            <label for="activity-type">Action</label>
                            <select id="activity-type" class="filter-input">
                                <option value="">All Actions</option>
                                <option value="login">Login</option>
                                <option value="transfer">Fund Transfer</option>
                                <option value="bill">Bill Payment</option>
                                <option value="card">Card Management</option>
                                <option value="profile">Profile Update</option>
                                <option value="security">Security Alert</option>
                                <option value="export">Data Export</option>
                                <option value="deposit">Deposit</option>
                            </select>
                        </div>
                    </div>
                    <p id="filter-error" class="error"></p>
                    <div class="action-buttons">
                        <button type="submit" class="btn apply-btn">
                            <i class="fa-solid fa-filter"></i> Apply Filters
                        </button>
                        <button type="button" class="btn btn-reset" onclick="resetEverything()">
                            <i class="fa-solid fa-rotate-left"></i>Reset
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- activity section -->
        <section>
            <div class="activity-table">
                <div class="activity-heading">
                    <h3>Recent activity</h3>
                    <div class="activity-count">
                        <i class="fa-solid fa-list"></i> <span id="activity-count">0</span> activity
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