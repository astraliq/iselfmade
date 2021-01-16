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


let disagree = document.getElementById('disagree');

disagree.addEventListener('click', () => {
    let disblock = document.getElementById('disblock');
    disblock.classList.remove('invisible');
    disagree.classList.remove('comments__line-blue');
    disagree.classList.add('comments__line');

});

document.getElementById('dissend').addEventListener('click', () => {
    let distext = document.getElementById('distext');
    console.log(distext.value);
    let disblock = document.getElementById('disblock');
    disblock.innerHTML = '';
    disagree.innerHTML = '';
    disblock.innerHTML = `
        <p class="my__comment">${distext.value}</p>
    `;
})