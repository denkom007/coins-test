# Тестовое задание coins-test

Требуется написать функцию, которая должна рассчитывать наименьшее количество монет, которыми можно выдать сдачу. Номинал монет 10, 5, 1.

На вход функции подается целое число, на выходе должен быть массив с номиналом монеты в качестве ключа и количество таких монет в качестве значения.

---

### Результат

Написал класс которым можно воспользоваться для подсчета монет:
```php
$kassa = new Kassa();
$kassa->setCoins([1, 5, 10]);
$kassa->setCostProducts(765.50);
$kassa->setCoinsFlowIn(1231);
$kassa->setRefundRoundedUp(true);

echo "<pre>";
print_r($kassa->getCoinsFlowOut());
echo "</pre>";
echo "Состояние кассы: " . mb_strtolower($kassa);
```
Результат выполнения:

```text
Array
(
    [10] => 46
    [5] => 1
    [1] => 1
)
Состояние кассы: в кассе сейчас монеты следующих номиналов: 1, 5, 10.
```


Сама функция подсчета:

```php
    /**
     * Функция подсчета монет
     *
     * @param float $refund
     * @param bool  $refundRoundedUp
     *
     * @return array
     */
    public function getCountCoins(float $refund, $refundRoundedUp = false): array
    {
        $result = [];
        $coins = [1, 5, 10];
        arsort($coins);
        
        if (in_array($refund, $coins)) {
            return [$refund => 1];
        }
        
        if ($refund < min($coins)) {
            return [];
        }
        
        foreach ($coins as $coin) {
            $math = floor($refund / $coin);
            
            if ($math != 0) {
                $result[$coin] = $math;
                $refund -= $result[$coin] * $coin;
            }
        }
        
        $finalSum = array_sum(array_values($result));
        
        if ($refundRoundedUp && ($refund < $finalSum)) {
            $result[min($coins)] += 1;
        }
        
        return $result;
    }
```