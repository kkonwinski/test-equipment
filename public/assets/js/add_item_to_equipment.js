$(function () {
    $('.add').on('click', function (e) {
        e.preventDefault();
        var link = $(e.currentTarget);
        $.ajax({
            method: 'POST',
            url: link.attr('href'),
        })
        alert("fmdfmdsifmnosdmfo");
        console.log(link.attr('href'));
    });
});