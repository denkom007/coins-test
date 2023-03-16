<?php

namespace src;

interface KassaInterface
{
    public function setCoins(array $array): void;
    
    public function setCostProducts(float $number): void;
    
    public function setCoinsFlowIn(float $number): void;
    
    public function setRefundRoundedUp(bool $bool): void;
    
    public function getCoinsFlowOut(): ?array;
    
    public function getCountCoins(float $refund): void;
    
    public function __toString(): string;
}