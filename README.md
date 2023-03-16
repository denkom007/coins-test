# Тестовое задание coins-test

Требуется написать функцию, которая должна рассчитывать наименьшее количество монет, которыми можно выдать сдачу. Номинал монет 10, 5, 1.

На вход функции подается целое число, на выходе должен быть массив с номиналом монеты в качестве ключа и количество таких монет в качестве значения.

---

### Результат

Написал класс которым можно возможно воспользоваться для подсчета монет
```php
$kassa = new Kassa();
$kassa->setCoins([1, 5, 10]);
$kassa->setCostProducts(765.50);
$kassa->setCoinsFlowIn(1231);
$kassa->setRefundRoundedUp(true);

print_r($kassa->getCoinsFlowOut());
```

Сама функция подсчета

```php
/**
     * Функция подсчета монет
     *
     * @param float $refund
     *
     * @return void
     */
    public function getCountCoins(float $refund, $refundRoundedUp = false): array
    {
        $result = [];
        $coins = [1, 5, 10];
        arsort($coins);
        
        foreach ($coins as $coin) {
            $result[$coin] = floor($refund / $coin);
            $refund -= $result[$coin] * $coin;
        }
        
        $finalSum = array_sum(array_values($this->coinsFlowOut));
        
        if ($refundRoundedUp && ($refund < $finalSum)) {
            $result[min($coins)] += 1;
        }
        
        return $result;
    }
```