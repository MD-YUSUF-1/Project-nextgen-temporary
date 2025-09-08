function loadTransaction(filters) {
    let tbody = document.getElementById('transaction-table-body');
    let tcount = document.getElementById('transaction-count');
    let searchErr = document.getElementById("search-error");

    let data = JSON.stringify(filters);

    // console.log(data);

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/transactionHistoryCheck.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('filters=' + data);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(this.responseText);

            let data = JSON.parse(this.responseText);
            if (data.errors) {
                errors = data.errors.join(',');

                // console.log(errors);

                searchErr.innerHTML = errors;
                return;
            }

            transactionsData = data.allTransactions || data.filteredTransaction;

            // console.log($transactionsData);

            tbody.innerHTML = "";
            tcount.innerHTML = transactionsData.length;
            if (transactionsData.length === 0) {
                tbody.innerHTML =
                    "<tr>" +
                    " <td colspan='8' style='text-align: center; padding: 40px;'>No transactions found matching your criteria</td>" +
                    "</tr>";
            }
            else {
                for (let i = 0; i < transactionsData.length; i++) {
                    const element = transactionsData[i];
                    tbody.innerHTML +=
                        "<tr>" +
                        "<td>" + element.date + "</td>" +
                        "<td>" + element.description + "</td>" +
                        "<td>" + element.transaction_type + "</td>" +
                        "<td>" + element.transaction_category + "</td>" +
                        "<td>" + element.amount + "</td>" +
                        "<td>" + element.remaining_balance + "</td>" +
                        "<td>" + element.status + "</td>" +
                        "<td>" + element.transaction_id + "</td>" +
                        "</tr>";
                }
            }
        }
    }
}

function applyFilter() {
    let fromDate = document.getElementById("from-date").value;
    let toDate = document.getElementById("to-date").value;
    let transactionType = document.getElementById("transaction-type").value;
    let amountRange = document.getElementById("amount-range").value;
    let filterErr = document.getElementById("filter-error");

    filterErr.innerHTML = ""
    if (!fromDate && !toDate && !amountRange && !transactionType) {
        filterErr.innerHTML = " Please select a filter type ";
        return false;
    }
    if (fromDate || toDate) {
        if (!(fromDate && toDate)) {
            filterErr.innerHTML = " Please select a Both date ";
            return false
        }

        if (new Date(toDate) > new Date()) {
            filterErr.innerHTML = "To date cannot exceed current date";
            return false;
        }

        if (new Date(fromDate) > new Date(toDate)) {
            filterErr.innerHTML = " To date must be after From date ";
            return false;
        }
    }

    let filters = {
        fromDate,
        toDate,
        transactionType,
        amountRange,
    };
    loadTransaction(filters);
}

function validateSearch() {
    let searchInput = document.getElementById("search-input").value.trim().toLowerCase();
    let searchErr = document.getElementById("search-error");
    let tbody = document.getElementById('transaction-table-body');
    searchErr.innerHTML = "";
    if (!searchInput) {
        searchErr.innerHTML = " Please write something in search box ";
        return false;
    }

    if (searchInput.length < 3) {
        searchErr.innerHTML = "Search input must be minimum 3 characters.";
        return false;
    }
    let searchText = {
        searchInput
    };
    loadTransaction(searchText)

}



function resetEverything() {
    document.getElementById("from-date").value = "";
    document.getElementById("to-date").value = ""
    document.getElementById("transaction-type").value = ""
    document.getElementById("amount-range").value = ""
    document.getElementById("search-input").value = "";
    document.getElementById("search-error").innerHTML = ""
    document.getElementById("filter-error").innerHTML = ""
    let reset = { reset: true }
    loadTransaction(reset);

}

