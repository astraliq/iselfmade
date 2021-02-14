'use strict';

class Audio {
    constructor(audioBlock) {
        this.audioBlock = document.querySelector(audioBlock);
        this.audio = document.getElementById('audio');
        this.audioControls  = this.audioBlock ? this.audioBlock.querySelector('.audio-controls') : null;
        this.audioTrack  = this.audioBlock ? this.audioBlock.querySelector('.audio-track') : null;
        this.time  = this.audioBlock ? this.audioBlock.querySelector('.time') : null;
        this.volume  = this.audioBlock ? this.audioBlock.querySelector('.volume') : null;
        this.btnPlay  = this.audioBlock ? this.audioBlock.querySelector('.play') : null;
        this.btnPause  = this.audioBlock ? this.audioBlock.querySelector('.pause') : null;
        this.btnPrev;
        this.btnNext;
        this.playlist = [
            // СЮДА ДОБАВЛЯТЬ ТРЕКИ
        ];
        this.track = 0;
        this.audioPlay;

    }

    changeTrackInList(numTreck) {
        // Меняем значение атрибута src
        this.audio.src = 'mp3/' + this.playlist[numTreck];
        // Назначаем время песни ноль
        this.audio.currentTime = 0;
    }

    switchTrack(numTreck) {
        this.changeTrack(numTreck);
        // Включаем песню
        this.audio.play();
    }

    pauseTrack() {
        this.btnPlay.style.display = 'block';
        this.btnPause.style.display = 'none';
        this.audio.pause(); // Останавливает песню
        clearInterval(this.audioPlay) // Останавливает интервал
    }

    playTrack() {
        this.btnPause.style.display = 'block';
        this.btnPlay.style.display = 'none';
        this.audio.play();
        clearInterval(this.audioPlay) // Останавливает интервал
    }

    init() {
        this.audio.src = 'mp3/' + this.playlist[this.track];
        this.audio.volume = 0.1;
        this.btnPlay.addEventListener("click", (e) => {
            this.playTrack(); // Запуск песни
            // Запуск интервала
            this.audioPlay = setInterval((e) =>{
                // Получаем значение на какой секунде песня
                let audioTime = Math.round(this.audio.currentTime);
                // Получаем всё время песни
                let audioLength = Math.round(this.audio.duration);
                let audioMinutes = Math.floor((audioLength - audioTime) / 60);
                let audioSeconds = audioLength - audioTime - audioMinutes * 60;
                // Назначаем ширину элементу time
                this.audioTrack.style.width = (this.audioControls.offsetWidth - 65) * audioTime / audioLength + 65 + 'px';
                let doubleZeroSec = audioSeconds < 10 ? '0' : '';
                let doubleZeroMin = audioMinutes< 10 ? '0' : '';
                this.time.innerText = `${doubleZeroMin}${audioMinutes}:${doubleZeroSec}${audioSeconds}`;
                // Сравниваем, на какой секунде сейчас трек и всего сколько времени длится
                // И проверяем что переменная track меньше четырёх
                if (audioTime == audioLength && this.track >= (this.playlist.length - 1)) {
                    this.pauseTrack();
                    this.track = 0;
                    this.changeTrackInList(this.track);
                    // Иначе проверяем тоже самое, но переменная track больше или равна четырём
                } else if (audioTime == audioLength) {
                    this.track++; // То присваиваем track ноль
                    this.switchTrack(this.track); //Меняем трек
                }
            }, 10)
        });

        this.btnPause.addEventListener("click", (e) => {
            this.pauseTrack();
        });

        this.volume.addEventListener('input', (e) => {
            this.audio.volume = this.volume.value / 10;
        })

        // this.btnPrev.addEventListener("click", (e) => {
        //     // Проверяем что переменная track больше нуля
        //     if (this.track > 0) {
        //         this.track--; // Если верно, то уменьшаем переменную на один
        //         this.switchTrack(this.track); // Меняем песню.
        //     } else { // Иначе
        //         this.track = this.playlist.length - 1; // Присваиваем три
        //         this.switchTrack(this.track); // Меняем песню
        //     }
        // });
        //
        // this.btnNext.addEventListener("click", (e) => {
        //     // Проверяем что переменная track больше трёх
        //     if (this.track < (this.playlist.length - 1)) { // Если да, то
        //         this.track++; // Увеличиваем её на один
        //         this.switchTrack(this.track); // Меняем песню
        //     } else { // Иначе
        //         this.track = 0; // Присваиваем ей ноль
        //         this.switchTrack(this.track); // Меняем песню
        //     }
        // });
    }

}

let curator = new Audio('.curator__sound');
if (curator.audioBlock) {
    curator.init();
}
