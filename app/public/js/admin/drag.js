// dragenter - когда обьект в дроп зоне
// dragleave - когда обьект вышел за пределы зоны
// dragover - срабатывает постоянно, когда элемент находится в дроп зоне
// drop - срабатывает когда отпустили обьект над зоной

const DRAGZONE = document.getElementById('DRAGZONE');

// список разрешенных типов
const T_IMAGES = ['png', 'jpg', 'webp', 'svg', 'jpeg'];
const T_OTHER = ['7z', 'rar', 'zip'];
// все типы
const T_ALL = T_IMAGES.concat(T_OTHER);

const PREVIEW = document.querySelector('.drag__preview');
// const UPLOAD = document.querySelector('.drag__upload');
const UPLOAD = document.getElementById('uploadFiles');
const MAXSIZE = (20 * 1024) * 1024 // 20Mb но получаем в байтах

// коллекция файлов
let files = null;

DRAGZONE.addEventListener('dragenter', function (Event) {
    // отмена стандартного поведения
    Event.preventDefault();
    // console.log('dragenter');
})
DRAGZONE.addEventListener('dragleave', function (Event) {
    // отмена стандартного поведения
    Event.preventDefault();
    // console.log('dragleave');
})
DRAGZONE.addEventListener('dragover', function (Event) {
    // отмена стандартного поведения
    Event.preventDefault();
    // console.log('dragover');
})

DRAGZONE.addEventListener('drop', function (Event) {
    // отмена стандартного поведения
    Event.preventDefault();
    // console.log('drop');

    let newFiles = Event.dataTransfer.files;
    Array.from(newFiles).forEach(file => {
        let getType = file.name.split('.').pop();

        // если такой тип разрешен и размер файла не превышает MAXSIZE
        // если это изображение
        if (T_IMAGES.includes(getType)) {
            //генерируем ссылку на изображение
            let url = URL.createObjectURL(file);

            PREVIEW.insertAdjacentHTML('afterbegin', `
                <div class = "preview__item">
                    <img class = "preview__image" src = "${url}">
                    <div onclick = "deleteFile(${file.size})">
                        <i class = "fa fa-2x fa-times" ></i>
                    </div>
                </div>
                `)
        }
    })

})