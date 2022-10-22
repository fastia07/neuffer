<?php

interface OperationInterface
{
    public function process();

    public function validate(int $number1, int $number2): bool;
}
