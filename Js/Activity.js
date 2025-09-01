
var activities = [
    {
        time: '09:15:23',
        date: '2024-09-01',
        details: 'User logged into account from Chrome browser',
        action: 'Login'
    },
    {
        time: '09:22:07',
        date: '2024-09-01',
        details: 'Downloaded transaction history (CSV format)',
        action: 'Export'
    },
    {
        time: '09:25:33',
        date: '2024-09-01',
        details: 'Attempted money transfer to account ****1234',
        action: 'Transfer'
    },
    {
        time: '09:25:58',
        date: '2024-09-01',
        details: 'Money transfer completed successfully - $500.00',
        action: 'Transfer'
    },
    {
        time: '14:30:15',
        date: '2024-08-31',
        details: 'Password changed successfully',
        action: 'Security'
    },
    {
        time: '14:40:18',
        date: '2024-08-31',
        details: 'Profile information updated (phone number)',
        action: 'Profile'
    },
    {
        time: '16:22:09',
        date: '2024-08-31',
        details: 'Failed login attempt from unknown device',
        action: 'Login'
    },
    {
        time: '10:15:22',
        date: '2024-08-30',
        details: 'Bill payment scheduled: Electric Company - $125.00',
        action: 'Bill'
    },
    {
        time: '10:18:44',
        date: '2024-08-30',
        details: 'Email notification settings updated',
        action: 'Profile'
    },
    {
        time: '11:45:12',
        date: '2024-08-30',
        details: 'Mobile check deposit initiated - $235.50',
        action: 'Deposit'
    },
    {
        time: '11:47:33',
        date: '2024-08-30',
        details: 'Mobile check deposit approved and processed',
        action: 'Deposit'
    },
    {
        time: '15:20:07',
        date: '2024-08-29',
        details: 'Card payment at Amazon.com - $87.45',
        action: 'Bill'
    },
    {
        time: '15:22:15',
        date: '2024-08-29',
        details: 'Real-time fraud alert sent via SMS',
        action: 'Security'
    }
];


let filteredActivity = [];
for (let i = 0; i < activities.length; i++) {
    filteredActivity.push(activities[i]);
}


// Filter functionalities
function applyFilter(e) {
    let fromDate = document.getElementById("from-date").value;
    let toDate = document.getElementById("to-date").value;
    let activityType = document.getElementById("activity-type").value;

    let filterErr = document.getElementById("filter-error");
    e.preventDefault();

    if (!((fromDate && toDate) ||  activityType)) {
        if (!(fromDate || toDate || activityType)) {
            filterErr.innerHTML = " Please select a filter type ";
            return false;
        }
        else if (!(fromDate && toDate)) {
            filterErr.innerHTML = " Please select a Both date ";
            return false
        }
    }
    if (new Date(toDate) > new Date()) {
        filterErr.innerHTML = "To date cannot exceed current date";
        return false;
    }

    if (new Date(fromDate) > new Date(toDate)) {
        filterErr.innerHTML = " To date must be after From date ";
        return false;
    }


    filteredActivity = [];

    for (let i = 0; i < activities.length; i++) {

        let isApplicable = true;
        if (fromDate && activities[i].date < fromDate) {
            isApplicable = false;
        }
        if (toDate && activities[i].date > toDate) {
            isApplicable = false;
        }
        if (activityType && activities[i].action.toLowerCase() !== activityType.toLowerCase()) {
            isApplicable = false;
        }
        if (isApplicable) {
            filteredActivity.push(activities[i]);
        }
        console.log(filteredActivity);

    }
    loadActivityData();
    updateActivityCount()
    filterErr.innerHTML = "";
    return true;
}


// reset functionality
function resetEverything() {
    document.getElementById("from-date").value = "";
    document.getElementById("to-date").value = ""
    document.getElementById("activity-type").value = ""
    document.getElementById("filter-error").innerHTML=""
    filteredActivity = [];
    for (let i = 0; i < activities.length; i++) {
        filteredActivity.push(activities[i]);
    }
    console.log(filteredActivity);
    loadActivityData();
    updateActivityCount();
}


// table data load
function loadActivityData() {
    const tbody = document.getElementById('activity-table-body');
    if (filteredActivity.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align: center; padding: 40px;">No activities found matching your criteria</td></tr>';
        return;
    }

    let rows = [];

    for (let i = 0; i < filteredActivity.length; i++) {
        const activity = filteredActivity[i];
        let rowStructure = '<tr>' +
            '<td>' + activity.time + '</td>' +
            '<td>' + activity.date + '</td>' +
            '<td>' + activity.details + '</td>' +
            '<td>' + activity.action + '</td>' +
            '</tr>';
        rows.push(rowStructure);
    }
    tbody.innerHTML = rows.join("");
}


loadActivityData();

// update activity count

function updateActivityCount() {
    let count = document.getElementById('activity-count')
    count.innerHTML = filteredActivity.length;
}

updateActivityCount()


