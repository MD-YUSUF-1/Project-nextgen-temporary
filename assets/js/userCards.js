function loadCards() {
    let queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    // console.log(urlParams);

    let id = urlParams.get('id');

    let cardsGrid = document.getElementById('cardsGrid');


    let xhttp = new XMLHttpRequest();
    xhttp.open('POST','../controller/userCardsCheck.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('id=' + id);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(this.responseText);

            let data = JSON.parse(this.responseText);

            let userCards = data.userCards;

            console.log(userCards);

            cardsGrid.innerHTML = "";



            for (let i = 0; i < userCards.length; i++) {
                const card = userCards[i];
              
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

loadCards();



