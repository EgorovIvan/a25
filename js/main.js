$(document).ready(function () {

    // Отправка формы расчета
    $("form").submit(function (e) {
        e.preventDefault();
        const form = $(this);
        const data = form.serialize();

        $.ajax({
            url: '/backend/calculation.php',
            data: data,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#rentalAmount').text(data);
            },
            error: function (err) {
                console.error('Ошибка', JSON.parse(err));
            }
        });
    });

    // Выбор продукта
    $("select").change(function () {
        const select = $(this);
        const data = select.serialize();

        $.ajax({
            url: '/backend/info.php',
            data: data,
            type: "POST",
            dataType: 'html',
            success: function (data) {
                $('#rentalAmount').text('');
                $('#ratesList').text('');
                $('#ratesList').append(data);
            },
            error: function (err) {
                console.error('Ошибка', JSON.parse(err));
            }
        });
    });
});