<?php

require_once 'sdbh.php';
$dbh = new sdbh();

$rates = [];
$q = "SELECT * FROM  `a25_products`";

// Запрос к таблице продуктов
$products = $dbh->make_query($q);

foreach ($products as $key => $product) { ?>
    <option value="<?= $product['NAME'] ?>"><?= $product['NAME'] ?></option>
    <?
}
?>



