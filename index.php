<?php
require_once 'backend/sdbh.php';
$dbh = new sdbh();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet"/>
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <script defer src="js/main.js"></script>
</head>
<body>
<div class="container">
    <div class="row row-header">
        <div class="col-12">
            <img src="assets/img/logo.png" alt="logo" style="max-height:50px"/>
            <h1>Прокат</h1>
        </div>
    </div>
    <!-- TODO: реализовать форму расчета -->
    <div class="row row-form">
        <div class="col-12">
            <h4>Форма расчета:</h4>
            <form action="" id="form" class="form mb-4">
                <label class="form-label" for="product">Выберите продукт:</label>
                <select class="form-select mb-3" name="product" id="product" required>
                    <option value="">Выбрать</option>
                    <?php include './backend/products.php' ?>
                </select>
                <p class="mb-1">Стоимость аренды:</p>
                <ul id="ratesList"></ul>
                <label for="customRange1" class="form-label">Количество дней:</label>
                <input type="number" name="amountDays" class="form-control mb-3" id="customRange1" min="1" max="30"
                       required
                       placeholder="Укажите количество суток аренды от 1 до 30">

                <label for="customRange1" class="form-label">Дополнительно:</label>

                <?php include './backend/services.php' ?>
                <button type="submit" class="btn btn-primary mt-3">Рассчитать</button>
            </form>
            <h5>Стоимость проката:</h5>
            <div id="rentalAmount"></div>
        </div>
    </div>
    <!-- END -->
</div>
</body>
</html>
