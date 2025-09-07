

function applyFilter() {
    let fromDate = document.getElementById("from-date").value;
    let toDate = document.getElementById("to-date").value;
    let activityType = document.getElementById("activity-type").value;

    let filterErr = document.getElementById("filter-error");

    if (!fromDate && !toDate && !activityType) {
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


// reset functionality
function resetEverything() {
    document.getElementById("from-date").value = "";
    document.getElementById("to-date").value = ""
    document.getElementById("activity-type").value = ""
    document.getElementById("filter-error").innerHTML=""
}




