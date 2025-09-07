
function applyFilter() {
    let fromDate = document.getElementById("from-date").value;
    let toDate = document.getElementById("to-date").value;
    let transactionType = document.getElementById("transaction-type").value;
    let amountRange = document.getElementById("amount-range").value;
    let filterErr = document.getElementById("filter-error");

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
}

function validateSearch() {
    let searchInput = document.getElementById("search-input").value.trim().toLowerCase();
    let searchErr = document.getElementById("search-error");
    if (!searchInput) {
        searchErr.innerHTML = " Please write something in search box ";
        return false;
    }

    if (searchInput.length < 3) {
        searchErr.innerHTML = "Search input must be minimum 3 characters.";
        return false;
    }


}
function resetEverything() {
    document.getElementById("from-date").value = "";
    document.getElementById("to-date").value = ""
    document.getElementById("transaction-type").value = ""
    document.getElementById("amount-range").value = ""
    document.getElementById("search-input").value = "";
    document.getElementById("search-error").innerHTML = ""
    document.getElementById("filter-error").innerHTML = ""
}

