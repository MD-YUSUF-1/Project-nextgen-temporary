let transactions = [
    {
        date: '2024-08-09',
        description: 'Direct Deposit - Salary',
        type: 'Credit',
        amount: 3500.00,
        balance: 12847.32,
        status: 'Completed',
        id: '2024-0809-001'
    },
    {
        date: '2024-08-08',
        description: 'Amazon.com Purchase',
        type: 'Debit',
        amount: -87.45,
        balance: 9347.32,
        status: 'Completed',
        id: '2024-0808-023'
    },
    {
        date: '2024-08-07',
        description: 'Gas Station Purchase',
        type: 'Debit',
        amount: -45.20,
        balance: 9434.77,
        status: 'Pending',
        id: '2024-0807-015'
    },
    {
        date: '2024-08-06',
        description: 'ATM Withdrawal',
        type: 'Debit',
        amount: -200.00,
        balance: 9479.97,
        status: 'Completed',
        id: '2024-0806-008'
    },
    {
        date: '2024-08-05',
        description: 'Transfer to Savings',
        type: 'Transfer',
        amount: -1000.00,
        balance: 9679.97,
        status: 'Completed',
        id: '2024-0805-002'
    },
    {
        date: '2024-08-03',
        description: 'Mobile Check Deposit',
        type: 'Credit',
        amount: 235.50,
        balance: 10679.97,
        status: 'Completed',
        id: '2024-0803-012'
    },
    {
        date: '2024-08-02',
        description: 'Grocery Store Purchase',
        type: 'Debit',
        amount: -158.73,
        balance: 10444.47,
        status: 'Completed',
        id: '2024-0802-035'
    },
    {
        date: '2024-08-01',
        description: 'Online Payment - Utilities',
        type: 'Debit',
        amount: -125.00,
        balance: 10603.20,
        status: 'Failed',
        id: '2024-0801-019'
    }
];

let filteredTransactions = [];
for (let i = 0; i < transactions.length; i++) {
    filteredTransactions.push(transactions[i]);
}


// Filter functionalities
function applyFilter(e) {
    let fromDate = document.getElementById("from-date").value;
    let toDate = document.getElementById("to-date").value;
    let transactionType = document.getElementById("transaction-type").value;
    let amountRange = document.getElementById("amount-range").value;

    let filterErr = document.getElementById("filter-error");
    e.preventDefault();

    if (!((fromDate && toDate) || amountRange || transactionType)) {
        if (!(fromDate || toDate || amountRange || transactionType)) {
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


    filteredTransactions = [];

    for (let i = 0; i < transactions.length; i++) {

        let isApplicable = true;
        if (fromDate && transactions[i].date < fromDate) {
            isApplicable = false;
        }
        if (toDate && transactions[i].date > toDate) {
            isApplicable = false;
        }
        if (transactionType && transactions[i].type.toLowerCase() !== transactionType) {
            isApplicable = false;
        }
        if (amountRange) {
            let absAmount = Math.abs(transactions[i].amount)
            if (amountRange === '0-100' && (absAmount < 0 || absAmount > 100)) {
                isApplicable = false;
            }
            else if (amountRange === '101-500' && (absAmount < 101 || absAmount > 500)) {
                isApplicable = false;
            }
            else if (amountRange === '501-1000' && (absAmount < 501 || absAmount > 1000)) {
                isApplicable = false;
            }
            else if (amountRange === '1000+' && absAmount < 1001) {
                isApplicable = false;
            }
        }
        if (isApplicable) {
            filteredTransactions.push(transactions[i]);
        }
        console.log(filteredTransactions);

    }
    loadTransactionData();
    updateTransactionCount()
    filterErr.innerHTML = "";
    return true;
}


// Search functionalities
function validateSearch(e) {
    let searchInput = document.getElementById("search-input").value.trim().toLowerCase();
    let searchErr = document.getElementById("search-error");
    e.preventDefault();
    if (!searchInput) {
        searchErr.innerHTML = " Please write something in search box ";
        return false;
    }

    if (searchInput.length < 3) {
        searchErr.innerHTML = "Search input must be minimum 3 characters.";
        return false;
    }


    filteredTransactions = [];

    for (let i = 0; i < transactions.length; i++) {
        const transaction = transactions[i];
        transactionText = (transaction.description +' '+ transaction.status).toLowerCase();
        // console.log(transactionText);
        if (transactionText.indexOf(searchInput) !== -1) {
            filteredTransactions.push(transaction);
        }
    }

    loadTransactionData();
    updateTransactionCount();

    // console.log(searchInput);
   

    document.getElementById("search-input").value = "";
    searchErr.innerHTML = ""
    return true;
}

// reset functionality
function resetEverything() {
    document.getElementById("from-date").value = "";
    document.getElementById("to-date").value = ""
    document.getElementById("transaction-type").value = ""
    document.getElementById("amount-range").value = ""
    document.getElementById("search-input").value = "";
    document.getElementById("search-error").innerHTML=""
    document.getElementById("filter-error").innerHTML=""
    filteredTransactions = [];
    for (let i = 0; i < transactions.length; i++) {
        filteredTransactions.push(transactions[i]);
    }
    // console.log(filteredTransactions);
    loadTransactionData();
    updateTransactionCount();
}


// table data load
function loadTransactionData() {
    const tbody = document.getElementById('transaction-table-body');
    if (filteredTransactions.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 40px;">No transactions found matching your criteria</td></tr>';
        return;
    }

    let rows = [];

    for (let i = 0; i < filteredTransactions.length; i++) {
        const transaction = filteredTransactions[i];
        var amountSign = transaction.amount >= 0 ? '+' : '-';
        let rowStructure = '<tr>' +
            '<td>' + transaction.date + '</td>' +
            '<td>' + transaction.description + '</td>' +
            '<td>' + transaction.type + '</td>' +
            '<td>' + amountSign + '$' + Math.abs(transaction.amount.toFixed(2)) + '</td>' +
            '<td>' + '$' + transaction.balance.toFixed(2) + '</td>' +
            '<td>' + transaction.status + '</td>' +
            '<td>' + transaction.id + '</td>' +
            '</tr>';
        rows.push(rowStructure);
    }
    tbody.innerHTML = rows.join("");
}


loadTransactionData();

// update transaction count

function updateTransactionCount() {
    let count = document.getElementById('transaction-count')
    count.innerHTML = filteredTransactions.length;
}

updateTransactionCount()


