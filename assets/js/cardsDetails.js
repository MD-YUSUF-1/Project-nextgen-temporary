let urlParams = new URLSearchParams(window.location.search);

let Param = urlParams.get('id');


function loadCardDetails(id) {
    let cardHeader = document.getElementById('card-header');
    let cardVoucherList = document.getElementById('voucher-list');
    let cardFeatureList = document.getElementById('feature-list');
    let cardFee = document.getElementById('annual-fee');
    let cardLimit = document.getElementById('credit-limit');
    let cardInterest = document.getElementById('inetrest-rate');
    let data = JSON.stringify(id);

    console.log(data);

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/CardsDetailsCheck.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('id=' + data);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(this.responseText);

            let data = JSON.parse(this.responseText);

            let cardData = data.card;
            let cardFeature = data.features
            let cardVoucher = data.vouchers

            // console.log(cardData);
            // console.log(cardFeature);
            // console.log(cardVoucher);

            cardHeader.innerHTML = "";
            cardVoucherList.innerHTML = "";
            cardFeatureList.innerHTML = "";
            cardFee.innerHTML = "";
            cardLimit.innerHTML = "";
            cardInterest.innerHTML = "";
            cardHeader.innerHTML +=
                '<h1 class="card-name">' + cardData.name + '</h1>' +
                '<h1 class="card-type">' + cardData.type + '</h1>';
            for (let j = 0; j < cardVoucher.length; j++) {
                cardVoucherList.innerHTML +=
                    '<li><i class="fa-solid fa-circle list-icons"></i>'  + cardVoucher[j].description + '</li>';
            }
            for (let i = 0; i < cardFeature.length; i++) {
                cardFeatureList.innerHTML +=
                    '<li><i class="fa-solid fa-circle list-icons"></i>' + cardFeature[i].feature + '</li>';
            }
            cardFee.innerHTML = cardData.annual_fee;
            cardLimit.innerHTML = cardData.credit_limit;
            cardInterest.innerHTML = cardData.interest_rate;


        }
    }
}


loadCardDetails({ 'id': Param });




