function loadCards(value) {
    let cardsGrid = document.getElementById('cardsGrid');

    let data = JSON.stringify(value);

    console.log(data);

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/cardsCheck.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('values=' + data);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(this.responseText);

            let data = JSON.parse(this.responseText);

            cardsData = data.cards;
            cardsFeature = data.features

            // console.log(cardsData);
            // console.log(cardsFeature);

            cardsGrid.innerHTML = "";
            


            for (let i = 0; i < cardsData.length; i++) {
                const card = cardsData[i];
                let featureGrid = "";
                for (let i = 0; i < cardsFeature.length; i++) {
                    if (cardsFeature[i].card_id === card.card_id) {
                        featureGrid += '<li>' + cardsFeature[i].feature + '</li>';
                    }
                }
                cardsGrid.innerHTML +=
                    '<div class="card">' +
                    '<div class="card-image">' +
                    '<img src="' + card.img + '" alt="' + card.name + '">' +
                    '</div>' +

                    '<div class="card-body">' +
                    '<div class="card-title">' + card.name + '</div>' +
                    '<ul class="card-features">' +
                    featureGrid +
                    '</ul>' +
                    '<div class="card-fee">' +
                    '<p class="fee-label">Annual Fee</p>' +
                    '<p class="fee-amount">' + card.annual_fee + '</p>' +
                    '</div>' +
                    '<div class="card-btn-div">' +
                    '<a href="./CardDetails.php?id=' + card.card_id + '" class="btn-know">KNOW MORE</a>' +
                    '<a href="" class="apply-btn">Apply Now</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            }
        }
    }
}


loadCards({ value: 'all' });
