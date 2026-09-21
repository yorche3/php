<?php

final class Calculator
{
    public static function addition(int $a, int $b): int
    {
        return $a + $b;
    }

    public static function subtraction(int $a, int $b): int
    {
        return $a - $b;
    }

    public static function multiplication(int $a, int $b): int
    {
        $result = 0;
        for ($i = 1; $i <= $b; $i++) {
            $result = self::addition($result, $a);
        }

        return $result;
    }

    public static function division(int $a, int $b): int
    {
        $dividend = $a;
        $quotient = 0;
        while ($dividend >= $b) {
            $dividend = self::subtraction($dividend, $b);
            $quotient = self::addition($quotient, 1);
        }

        return $quotient;
    }

    public static function modulus(int $a, int $b): int
    {
        $quotient = self::division($a, $b);
        $product = self::multiplication($quotient, $b);

        return self::subtraction($a, $product);
    }
}
