<?php

if (empty($_POST)) {
    exit;
}

require_once 'sdbh.php';

$dbh = new sdbh();

// Наименование продукта
$product = htmlspecialchars($_POST['product']);
// Количество дней
$amountDays = htmlspecialchars($_POST['amountDays']);

// Начальная цена за сутки
$price = $dbh->mselect_rows('a25_products', ['NAME' => $product], 0, 1, 'id')[0]['PRICE'];
// Тарифы
$tariff = $dbh->mselect_rows('a25_products', ['NAME' => $product], 0, 1, 'id')[0]['TARIFF'];

if (isset($tariff)) {
    $rates = unserialize($tariff);
}

// Расчет стоимости за сутки
$prevKey = 0;
if (isset($rates)) {
    foreach ($rates as $key => $rate) {
        if ($key > $amountDays) {
            $price = $rates[$prevKey];
            break;
        } elseif ($rate == end($rates)) {
            $price = $rate;
        }
        $prevKey = $key;
    }
}

// Расчет стоимости выбранных доп услуг
$sumServices = 0;
if (isset($_POST['checkedList'])) {
    $checkedList = $_POST['checkedList'];
    if (empty($checkedList)) {
        echo("Вы не выбрали ни одного доп продукта");
    } else {
        for ($i = 0; $i < count($checkedList); $i++) {
            $sumServices += $checkedList[$i] * $amountDays;
        }
    }
}

// Вывод общей стоимости заказа
echo json_encode($price * $amountDays + $sumServices);
