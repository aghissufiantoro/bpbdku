
<style>
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    input[type="text"],
    textarea {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    button {
        background-color: #f57604;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }

    button:hover {
        background-color: #f3a870;
    }

    .error {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .rating {
        display: flex;
        justify-content: center;
        align-items: center;
        grid-gap: .5rem;
        font-size: 2rem;
        color: #ecc739;
        margin-bottom: 2rem;
    }
    .rating .star {
        cursor: pointer;
    }
    .rating .star.active {
        opacity: 0;
        animation: animate .5s calc(var(--i) * .1s) ease-in-out forwards;
    }

    @keyframes animate {
        0% {
            opacity: 0;
            transform: scale(1);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .rating .star:hover {
        transform: scale(1.1);
    }
</style>

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

<div id="reviewPopup" class="popup">
	<div class="popup-content">
		<span class="close-button" onclick="closePopup()">&times;</span>
		<h3>Bagaimana websitenya?</h3>
		<p>Tolong berikan review dan saran!</p>
		<div class="rating">
			<input type="number" name="rating" id="ratingValue" hidden>
			<i class='bx bx-star star' style="--i: 0;"></i>
			<i class='bx bx-star star' style="--i: 1;"></i>
			<i class='bx bx-star star' style="--i: 2;"></i>
			<i class='bx bx-star star' style="--i: 3;"></i>
			<i class='bx bx-star star' style="--i: 4;"></i>
		</div>
		<input type="text" id="userName" placeholder="Nama (Max 20 Huruf)">
		<div id="nameError" class="error"></div>
		<textarea id="feedbackText" rows="4" cols="50" placeholder="Tuliskan review..."></textarea>
		<div id="feedbackError" class="error"></div>
		<div>
			<input type="checkbox" id="hidePopupCheckbox"> Jangan tampilkan lagi
		</div>
		<button onclick="submitFeedback()">Submit</button>
	</div>
</div>


<script>
    const allStar = document.querySelectorAll('.rating .star')
    const ratingValue = document.querySelector('.rating input')

    allStar.forEach((item, idx)=> {
        item.addEventListener('click', function () {
            let click = 0
            ratingValue.value = idx + 1

            allStar.forEach(i=> {
                i.classList.replace('bxs-star', 'bx-star')
                i.classList.remove('active')
            })
            for(let i=0; i<allStar.length; i++) {
                if(i <= idx) {
                    allStar[i].classList.replace('bx-star', 'bxs-star')
                    allStar[i].classList.add('active')
                } else {
                    allStar[i].style.setProperty('--i', click)
                    click++
                }
            }
        })
    })

    setTimeout(function () {
        if (!localStorage.getItem('hideReviewPopup')) {
            document.getElementById('reviewPopup').style.display = 'block';
        }
    }, 5000);

    function closePopup() {
        if (document.getElementById('hidePopupCheckbox').checked) {
            localStorage.setItem('hideReviewPopup', 'true');
        }
        document.getElementById('reviewPopup').style.display = 'none';
    }

    if (document.getElementById('hidePopupCheckbox').checked) {
        localStorage.setItem('hideReviewPopup', 'true');
    }

    function submitFeedback() {
        const feedbackText = document.getElementById('feedbackText').value.trim();
        const userName = document.getElementById('userName').value.trim();
        const rating = ratingValue.value;
        let valid = true;

        document.getElementById('nameError').innerText = '';
        document.getElementById('feedbackError').innerText = '';


        if (!userName) {
            document.getElementById('nameError').innerText = 'Kolom tidak boleh kosong!';
            valid = false;
        } else if (userName.length > 20) {
            document.getElementById('nameError').innerText = 'Nama maksimal 20 huruf!';
            valid = false;
        }

        if (!feedbackText) {
            document.getElementById('feedbackError').innerText = 'Kolom tidak boleh kosong!';
            valid = false;
        }

        if (!rating) {
            alert('Silakan pilih rating!');
            valid = false;
        }

        if (!valid) {
            return;
        }


        $.ajax({
            url: '<?= site_url('view/submit_feedback') ?>',
            method: 'POST',
            data: { name: userName, feedback: feedbackText, rating: rating },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.status === 'success') {
                    alert('Masukan telah diterima!');
                    closePopup();
                } else {
                    alert('Terdapat error saat mengirim review.');
                }
            },
            error: function(xhr, status, error) {
                alert('Terdapat error saat mengirim review.');
            }
        });
    }
</script>