<?php

final class Numbers
{
    // ---- Recursión directa (_rec) ----

    public static function sumOfFirstNRec(int $n): int
    {
        if ($n <= 0) {
            return 0;
        }

        return $n + self::sumOfFirstNRec($n - 1);
    }

    public static function factorialRec(int $n): int
    {
        if ($n <= 1) {
            return 1;
        }

        return $n * self::factorialRec($n - 1);
    }

    public static function fibonacciRec(int $n): int
    {
        if ($n <= 1) {
            return $n;
        }

        return self::fibonacciRec($n - 1) + self::fibonacciRec($n - 2);
    }

    public static function greatestCommonDivisorRec(int $a, int $b): int
    {
        if ($b === 0) {
            return $a;
        }

        return self::greatestCommonDivisorRec($b, $a % $b);
    }

    public static function leastCommonMultipleRec(int $a, int $b): int
    {
        return intdiv($a * $b, self::greatestCommonDivisorRec($a, $b));
    }

    // ---- Recursión con acumulador (_acc): puente didáctico, PHP no garantiza TCO ----

    public static function sumOfFirstNAcc(int $n): int
    {
        return self::sumOfFirstNAccHelp($n, 0);
    }

    private static function sumOfFirstNAccHelp(int $n, int $acc): int
    {
        if ($n <= 0) {
            return $acc;
        }

        return self::sumOfFirstNAccHelp($n - 1, $n + $acc);
    }

    public static function factorialAcc(int $n): int
    {
        return self::factorialAccHelp($n, 1);
    }

    private static function factorialAccHelp(int $n, int $acc): int
    {
        if ($n <= 1) {
            return $acc;
        }

        return self::factorialAccHelp($n - 1, $n * $acc);
    }

    public static function fibonacciAcc(int $n): int
    {
        return self::fibonacciAccHelp($n, 0, 1);
    }

    private static function fibonacciAccHelp(int $n, int $acc2, int $acc1): int
    {
        if ($n <= 0) {
            return $acc2;
        }

        if ($n <= 2) {
            return $acc1 + $acc2;
        }

        return self::fibonacciAccHelp($n - 1, $acc1, $acc1 + $acc2);
    }

    public static function greatestCommonDivisorAcc(int $a, int $b): int
    {
        return self::greatestCommonDivisorAccHelp($a, $b);
    }

    private static function greatestCommonDivisorAccHelp(int $a, int $b): int
    {
        if ($b === 0) {
            return $a;
        }

        return self::greatestCommonDivisorAccHelp($b, $a % $b);
    }

    public static function leastCommonMultipleAcc(int $a, int $b): int
    {
        return intdiv($a * $b, self::greatestCommonDivisorAcc($a, $b));
    }

    // ---- Iterativo (_ite) ----

    public static function sumOfFirstNIte(int $n): int
    {
        $result = 0;
        for ($i = 1; $i <= $n; $i++) {
            $result += $i;
        }

        return $result;
    }

    public static function factorialIte(int $n): int
    {
        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }

        return $result;
    }

    public static function fibonacciIte(int $n): int
    {
        if ($n <= 1) {
            return $n;
        }

        $acc2 = 0;
        $acc1 = 1;
        for ($i = 2; $i <= $n; $i++) {
            $temp = $acc1 + $acc2;
            $acc2 = $acc1;
            $acc1 = $temp;
        }

        return $acc1;
    }

    public static function greatestCommonDivisorIte(int $a, int $b): int
    {
        $temp = 0;
        while ($b !== 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }

        return $a;
    }

    public static function leastCommonMultipleIte(int $a, int $b): int
    {
        return intdiv($a * $b, self::greatestCommonDivisorIte($a, $b));
    }
}
