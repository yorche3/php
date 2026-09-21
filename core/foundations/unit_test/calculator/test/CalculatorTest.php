<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    public function testAddition(): void
    {
        self::assertSame(5, Calculator::addition(2, 3));
        self::assertSame(0, Calculator::addition(0, 0));
    }

    public function testSubtraction(): void
    {
        self::assertSame(3, Calculator::subtraction(5, 2));
        self::assertSame(-2, Calculator::subtraction(3, 5));
    }

    public function testMultiplication(): void
    {
        self::assertSame(12, Calculator::multiplication(3, 4));
        self::assertSame(0, Calculator::multiplication(3, 0));
    }

    public function testDivision(): void
    {
        self::assertSame(3, Calculator::division(10, 3));
        self::assertSame(2, Calculator::division(10, 5));
    }

    public function testModulus(): void
    {
        self::assertSame(1, Calculator::modulus(10, 3));
        self::assertSame(0, Calculator::modulus(10, 5));
    }
}
