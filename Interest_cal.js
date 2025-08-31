var form = document.querySelector("form");
var principal = document.getElementById("principal");
var rate = document.getElementById("rate");
var time = document.getElementById("time");
var resultSection = document.querySelector(".result");

// assuming your HTML has these divs for errors
// <div id="errorPrincipal" class="error"></div> etc.
var errorPrincipal = document.getElementById("errorPrincipal");
var errorRate = document.getElementById("errorRate");
var errorTime = document.getElementById("errorTime");

form.addEventListener("submit", function(event) {
    let hasError = false;

    // clear previous errors
    errorPrincipal.textContent = "";
    errorRate.textContent = "";
    errorTime.textContent = "";

    // validation checks
    if (!principal.value) {
        errorPrincipal.textContent = "This field cannot be empty";
        hasError = true;
    }

    if (!rate.value) {
        errorRate.textContent = "This field cannot be empty";
        hasError = true;
    }

    if (!time.value) {
        errorTime.textContent = "This field cannot be empty";
        hasError = true;
    }

    // stop form submission if any error
    if (hasError) {
        event.preventDefault();
        return;
    }

    // convert inputs to numbers
    var p = Number(principal.value);
    var r = Number(rate.value);
    var t = Number(time.value);

    // calculate interest
    var interest = p * r * t / 100;
    var total = p + interest;

    // show result
    resultSection.innerHTML = "<h2>Result</h2>" +
                              "<p>Interest: ৳" + interest + "</p>" +
                              "<p>Total Amount: ৳" + total + "</p>";
});
