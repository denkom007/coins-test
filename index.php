<?php
use src\Autoload;
use src\Kassa;

require_once __DIR__ . '/src/Autoload.php';

Autoload::register();

$kassa = new Kassa();
$kassa->setCoins([1, 5, 10]);
$kassa->setCostProducts(765.50);
$kassa->setCoinsFlowIn(1231);
$kassa->setRefundRoundedUp(true);

echo "<pre>";
print_r($kassa->getCoinsFlowOut());
echo "</pre>";
echo "Состояние кассы: " . mb_strtolower($kassa);
