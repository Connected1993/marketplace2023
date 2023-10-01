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
let files = [];


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
    // очищаем PREVIEW
    PREVIEW.innerHTML = '';

    // проверяем, что файлы ранее были в массиве
    if (files) {
        //новые
        let newFiles = Event.dataTransfer.files;

        Array.from(newFiles).forEach(file => {
            let getType = file.name.split('.').pop();
            let add = true;

            // делаем сравнение по размеру файла
            files.forEach(oldFile => {
                if (file.size === oldFile.size) {
                    add = false
                }
            })

            // делаем проверку на размер и доступность расширения
            if (add && file.size <= MAXSIZE && T_ALL.includes(getType)) {
                files.push(file);
            }

        });
    } else {

        Array.from(Event.dataTransfer.files).forEach(file => {
            // делаем проверку на размер и доступность расширения
            if (file.size <= MAXSIZE && T_ALL.includes(getType)) {
                files.push(file);
            }
        })

    }

    if (files.length > 0) {
        files.forEach(file => {

            let getType = file.name.split('.').pop();
            // если такой тип разрешен и размер файла не превышает MAXSIZE
            // если это изображение
            if (T_IMAGES.includes(getType)) {
                //генерируем ссылку на изображение
                let url = URL.createObjectURL(file);

                PREVIEW.insertAdjacentHTML('afterbegin', `
                    <div class = "preview__item" data-size="${file.size}">
                        <img class = "preview__image" src = "${url}">
                        <div onclick = "deleteFile(${file.size})">
                            <i class = "fa fa-2x fa-times" ></i>
                        </div>
                    </div>
                    `)
            }

        })

        PREVIEW.nextElementSibling.classList.remove('d-none');
    } else {
        PREVIEW.nextElementSibling.classList.add('d-none');
    }

})

function deleteFile(size) {
    files.forEach((file, idx) => {
        if (file.size === size) {
            //удаляем файл из коллекции
            files.splice(idx, 1);
            //удаляем элемент из верстки
            PREVIEW.querySelector(`div[data-size="${file.size}"]`)?.remove();
        }
    })
}


function upload() {
    let data = new FormData(product);
    files.forEach((file, idx) => data.append('files[]', file, file.name,))

    fetch('/upload', {
        method: 'POST',
        body: data,
        // headers:{
        //     'Content-Type':'application/x-www-form-urlencoded'
        // }
    })
        .then(responce => responce.json())
        .then(responce => console.log(responce))
}


