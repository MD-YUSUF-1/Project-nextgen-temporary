



function loadActivites(filters) {
    let tbody = document.getElementById('activity-table-body');
    let tcount = document.getElementById('data-count');
    let searchErr = document.getElementById("filter-error");

    let data = JSON.stringify(filters);

    // console.log(data);

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/activityCheck.php', true);
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

            activitiesData = data.allActivites || data.filteredActivities;

            // console.log(activitiesData);

            tbody.innerHTML = "";
                    tcount.innerHTML = activitiesData.length;
            if (activitiesData.length === 0) {
                tbody.innerHTML =
                    "<tr>" +
                    " <td colspan='8' style='text-align: center; padding: 40px;'>No activities found matching your criteria</td>" +
                    "</tr>";
            }
            else {
                for (let i = 0; i < activitiesData.length; i++) {
                    const element = activitiesData[i];
                    tbody.innerHTML +=
                        "<tr>" +
                        "<td>" + element.activity_time + "</td>" +
                        "<td>" + element.activity_date + "</td>" +
                        "<td>" + element.details + "</td>" +
                        "<td>" + element.action + "</td>" +
                        "</tr>";
                }
            }
        }
    }
}

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
    let filters = {
        fromDate,
        toDate,
        activityType,
    };
    loadActivites(filters);



}

loadActivites({ value: true });




// reset functionality
function resetEverything() {
    document.getElementById("from-date").value = "";
    document.getElementById("to-date").value = ""
    document.getElementById("activity-type").value = ""
    document.getElementById("filter-error").innerHTML=""
    loadActivites({ value: true });
}




