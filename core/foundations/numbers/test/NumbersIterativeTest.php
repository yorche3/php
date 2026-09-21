<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

// Suite del enfoque iterativo (_ite): 5 tests, 11 casos.

final class NumbersIterativeTest extends TestCase
{
    public function testSumOfFirstNIte(): void
    {
        self::assertSame(0, Numbers::sumOfFirstNIte(0));
        self::assertSame(6, Numbers::sumOfFirstNIte(3));
    }

    public function testFactorialIte(): void
    {
        self::assertSame(1, Numbers::factorialIte(0));
        self::assertSame(24, Numbers::factorialIte(4));
    }

    public function testFibonacciIte(): void
    {
        self::assertSame(0, Numbers::fibonacciIte(0));
        self::assertSame(1, Numbers::fibonacciIte(1));
        self::assertSame(8, Numbers::fibonacciIte(6));
    }

    public function testGreatestCommonDivisorIte(): void
    {
        self::assertSame(4, Numbers::greatestCommonDivisorIte(12, 8));
        self::assertSame(1, Numbers::greatestCommonDivisorIte(7, 5));
    }

    public function testLeastCommonMultipleIte(): void
    {
        self::assertSame(12, Numbers::leastCommonMultipleIte(4, 6));
        self::assertSame(24, Numbers::leastCommonMultipleIte(6, 8));
    }
}
