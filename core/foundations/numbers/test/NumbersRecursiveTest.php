<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

// Suite del enfoque recursivo directo (_rec): 5 tests, 11 casos.

final class NumbersRecursiveTest extends TestCase
{
    public function testSumOfFirstNRec(): void
    {
        self::assertSame(0, Numbers::sumOfFirstNRec(0));
        self::assertSame(6, Numbers::sumOfFirstNRec(3));
    }

    public function testFactorialRec(): void
    {
        self::assertSame(1, Numbers::factorialRec(0));
        self::assertSame(24, Numbers::factorialRec(4));
    }

    public function testFibonacciRec(): void
    {
        self::assertSame(0, Numbers::fibonacciRec(0));
        self::assertSame(1, Numbers::fibonacciRec(1));
        self::assertSame(8, Numbers::fibonacciRec(6));
    }

    public function testGreatestCommonDivisorRec(): void
    {
        self::assertSame(4, Numbers::greatestCommonDivisorRec(12, 8));
        self::assertSame(1, Numbers::greatestCommonDivisorRec(7, 5));
    }

    public function testLeastCommonMultipleRec(): void
    {
        self::assertSame(12, Numbers::leastCommonMultipleRec(4, 6));
        self::assertSame(24, Numbers::leastCommonMultipleRec(6, 8));
    }
}
