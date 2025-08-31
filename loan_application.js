// Loan Comparison
const loanCards = document.querySelectorAll(".loan-card button");

loanCards.forEach((btn) => {
  btn.addEventListener("click", function() {
    const loanName = this.parentElement.querySelector("h3").textContent;
    alert("You selected " + loanName + " for comparison");
  });
});

// Document Upload Validation
const idProof = document.getElementById("idProof");
const addressProof = document.getElementById("addressProof");
const incomeProof = document.getElementById("incomeProof");

function validateDocuments() {
  let hasError = false;

  // Clear previous errors
  document.getElementById("errorId").textContent = "";
  document.getElementById("errorAddress").textContent = "";
  document.getElementById("errorIncome").textContent = "";

  if (!idProof.files.length) {
    document.getElementById("errorId").textContent = "This field cannot be empty";
    hasError = true;
  }
  if (!addressProof.files.length) {
    document.getElementById("errorAddress").textContent = "This field cannot be empty";
    hasError = true;
  }
  if (!incomeProof.files.length) {
    document.getElementById("errorIncome").textContent = "This field cannot be empty";
    hasError = true;
  }

  return !hasError;
}

// Status Tracker
const esignBtn = document.querySelector(".esign");

esignBtn.addEventListener("click", function() {
  if (validateDocuments()) {
    const statusItems = document.querySelectorAll(".status-list li");
    for (let i = 0; i < statusItems.length; i++) {
      if (!statusItems[i].classList.contains("done")) {
        statusItems[i].classList.add("done");
        alert("Status Updated: " + statusItems[i].textContent);
        break;
      }
    }
  }
});
