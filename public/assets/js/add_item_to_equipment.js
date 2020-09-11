$(function () {
    $('.add').on('click', function (e) {
        e.preventDefault();
        var link = $(e.currentTarget);
        $.ajax({
            method: 'POST',
            url: link.attr('href'),
        }).done(function (data) {

            console.log(window.location.href = data);
            // window.location.href = data
        })


    });
});