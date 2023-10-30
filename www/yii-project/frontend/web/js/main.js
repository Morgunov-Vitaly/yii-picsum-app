$(document).ready(function () {
    let url;
    let extId;

    let btnLike = $('#btn-like');
    let btnDislike = $('#btn-dislike');
    let btnNextImage = $('#btn-next');

    let imageIdLabelElement = $('#image-id');
    let imageUrlLabelElement = $('#image-url');
    let imageElement = $('#image');
    let rerenderElements = function(extId, url){
        imageIdLabelElement.text(extId);
        imageUrlLabelElement.text(url);
        imageElement.attr("src", url);
    }

    let loadNextPicture = function () {
        console.log('запрашиваем картинку');

        $.ajax({
            url: 'site/get-image/',
            type: 'GET',
            dataType: 'json',

            success: function (data) {
                console.log(data);

                if (data && data.success) {
                    extId = data.data.extId;
                    url = data.data.url;
                    console.log('extId: ', extId);
                    console.log('url: ', url);
                    rerenderElements(extId, url);

                } else {
                    alert('Не удалось загрузить картинку');
                    // M.toast({'classes': 'danger', 'html': 'Не удалось сохранить оценку'});
                }
            },
            error: function (jqXHR, exception) {
                alert('Что-то пошло не так при загрузке картинки.');
            }
        })
    }

    let addRate = function (isApproved) {
        console.log('isApproved: ', isApproved);

        $.ajax({
            url: '/site/add-rate',
            type: 'POST',
            dataType: 'json',
            data: {
                extId: extId,
                url: url,
                isApproved: isApproved
            },

            success: function (data) {
                console.log(data);

                if (data && data.success) {
                    // загрузить следующую картинку
                    loadNextPicture();
                } else {
                    alert(data.message ?? 'Не удалось сохранить оценку');
                    // M.toast({'classes': 'danger', 'html': 'Не удалось сохранить оценку'});
                }
            },
            error: function (jqXHR, exception) {
                alert('Что-то пошло не так');
            }
        })
    }

    loadNextPicture();

    btnLike.on('click', function (event) {
        event.preventDefault();
        addRate(true);
    });

    btnDislike.on('click', function (event) {
        event.preventDefault();
        addRate(false);
    })

    btnNextImage.on('click', function (event) {
        event.preventDefault();
        loadNextPicture();
    })
});