let fields = document.querySelectorAll('.field__file');
Array.prototype.forEach.call(fields, function(input) {
    let label = input.nextElementSibling,
        labelVal = label.querySelector('.field__file-fake').innerText;

    input.addEventListener('change', function(e) {
        let countFiles = '';
        if (this.files && this.files.length >= 1)
            countFiles = this.files.length;

        if (countFiles)
            label.querySelector('.field__file-fake').innerText = 'Выбрано файлов: ' + countFiles;
        else
            label.querySelector('.field__file-fake').innerText = labelVal;
    });
});

const STARS = document.getElementById('stars');
let stars_str = '';
// &#9733; &#9733; &#9733; &#9733; &#9733; &#9734; &#9734; &#9734; &#9734;
function printStars(numb) {
    for (let i = 1; i <= 10; i++) {
        stars_str = stars_str + `<span id="${i}" class="st_item">&#9734; </span>`;
    }
    STARS.insertAdjacentHTML("beforeend", stars_str);
}
printStars();
let allstars = document.querySelectorAll('.st_item');

STARS.onmouseout = (e) => {
    STARS.innerHTML = '';
    stars_str = '';
    printStars();
}

STARS.onmouseover = (e) => {
    document.getElementById(e.target.id).onmousemove = (evt) => {
        stars_str = '';
        STARS.innerHTML = '';
        for (let j = 1; j <= evt.target.id; j++) {
            stars_str = stars_str + `<span id="${j}">&#9733; </span>`;
        };
        if (evt.target.id < 10) {
            for (let i = evt.target.id; i < 10; i++) {
                stars_str = stars_str + `<span id="${i}">&#9734; </span>`;
            };
        };

        STARS.insertAdjacentHTML("beforeend", stars_str);
    }
    document.getElementById(e.target.id).addEventListener('click', (evt2) => {
        stars_str = '';
        STARS.innerHTML = '';
        for (let j = 1; j <= evt2.target.id; j++) {
            stars_str = stars_str + `<span id="${j}">&#9733; </span>`;
        };
        if (evt2.target.id < 10) {
            for (let i = evt2.target.id; i < 10; i++) {
                stars_str = stars_str + `<span id="${i}">&#9734; </span>`;
            };
        };

        STARS.insertAdjacentHTML("beforeend", stars_str);
        console.log(`click${evt2.target.id}`);

    })
};