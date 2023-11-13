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

    let disableBtns = function(elements){
        elements.forEach(function(el){
            el.addClass('disabled');
        });
    }

    let enableBtns = function(elements){
        elements.forEach(function(el){
            el.removeClass('disabled');
        });
    }

    let loadNextPicture = function () {
        disableBtns([btnLike, btnDislike, btnNextImage]);
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
                    enableBtns([btnLike, btnDislike, btnNextImage]);

                } else {
                    alert('Не удалось загрузить картинку');
                    enableBtns([btnNextImage]);
                    // M.toast({'classes': 'danger', 'html': 'Не удалось сохранить оценку'});
                }
            },
            error: function (jqXHR, exception) {
                enableBtns([btnNextImage]);
                alert('Что-то пошло не так при загрузке картинки.');
            }
        })
    }

    let addRate = function (isApproved) {
        disableBtns([btnLike, btnDislike, btnNextImage]);
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
                    enableBtns([btnNextImage]);
                    // M.toast({'classes': 'danger', 'html': 'Не удалось сохранить оценку'});
                }
            },
            error: function (jqXHR, exception) {
                alert('Что-то пошло не так');
                enableBtns([btnNextImage]);
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
