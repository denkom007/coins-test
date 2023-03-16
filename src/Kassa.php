<?php

namespace src;

require_once __DIR__ . '/Autoload.php';

final class Kassa implements KassaInterface
{
    private array $coins = [0.10, 0.50, 1, 2, 5, 10];
    private float $coinsFlowIn = 0;
    private array $coinsFlowOut = [];
    private float $costProducts = 0;
    private bool $refundRoundedUp = false;
    
    /**
     * Присваиваем текущие номиналы монет в кассе
     *
     * @param array $array
     *
     * @return void
     */
    public function setCoins(array $array): void
    {
        $this->coins = $array;
    }
    
    /**
     * Устанавливаем количество входящих монет/денег
     *
     * @param float $number
     *
     * @return void
     */
    public function setCoinsFlowIn(float $number): void
    {
        $this->coinsFlowIn = $number;
    }
    
    /**
     * Устанавливаем стоимость всех товаров покупателя
     *
     * @param float $number
     *
     * @return void
     */
    public function setCostProducts(float $number): void
    {
        $this->costProducts = $number;
    }
    
    /**
     * Возвращаем полную сумму клиенту самой меньшей монетой при наличии копеек в числе
     *
     * @param bool $bool
     *
     * @return void
     */
    public function setRefundRoundedUp(bool $bool): void
    {
        $this->refundRoundedUp = $bool;
    }
    
    /**
     * Считаем сколько нужно выдать
     *
     * @return array|null
     */
    public function getCoinsFlowOut(): array
    {
        if (empty($this->coins) || empty($this->coinsFlowIn) || ($this->costProducts >= $this->coinsFlowIn)) {
            return [];
        }
        
        $this->getCountCoins($this->coinsFlowIn - $this->costProducts);
        
        return $this->coinsFlowOut;
    }
    
    /**
     * Магический метод вызова echo класса для считывания текущего состояния кассы
     *
     * @return string
     */
    public function __toString(): string
    {
        return "В кассе сейчас монеты следующих номиналов: " . implode(", ", $this->coins) . ".";
    }
    
    /**
     * Функция подсчета монет
     *
     * @param float $refund
     *
     * @return void
     */
    public function getCountCoins(float $refund): void
    {
        $coins = $this->coins;
        arsort($coins);
        
        foreach ($coins as $coin) {
            $this->coinsFlowOut[$coin] = floor($refund / $coin);
            $refund -= $this->coinsFlowOut[$coin] * $coin;
        }
        
        $finalSum = array_sum(array_values($this->coinsFlowOut));
        
        if ($this->refundRoundedUp && ($refund < $finalSum)) {
            $this->coinsFlowOut[min($this->coins)] += 1;
        }
    }
}
