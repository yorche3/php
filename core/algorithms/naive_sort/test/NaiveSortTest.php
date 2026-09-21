<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

// Casos de prueba de la especificación 05_Naive_Sort.md
//
// Caso nulo omitido: el tipo `array` de PHP no admite `null` sin la anotación
// `?array`, que se formaliza en una fase posterior, así que una entrada nula no
// es representable en la firma y no hay indicador de fallo que comprobar.
// Se conservan los 7 casos de la especificación.
//
// Aislamiento: los arrays de PHP son tipos de valor (copy-on-write), así que
// cada caso trabaja sobre una copia propia y ninguna constante se contamina.

final class NaiveSortTest extends TestCase
{
    private const STANDARD_INPUT = [5, 2, 9, 1, 5, 6];
    private const STANDARD_OUTPUT = [1, 2, 5, 5, 6, 9];

    private const SORTED_INPUT = [1, 2, 3, 4, 5];
    private const SORTED_OUTPUT = [1, 2, 3, 4, 5];

    private const REVERSE_INPUT = [5, 4, 3, 2, 1];
    private const REVERSE_OUTPUT = [1, 2, 3, 4, 5];

    private const IDENTICAL_INPUT = [7, 7, 7, 7];
    private const IDENTICAL_OUTPUT = [7, 7, 7, 7];

    private const NEGATIVE_INPUT = [3, -1, 4, -5, 0];
    private const NEGATIVE_OUTPUT = [-5, -1, 0, 3, 4];

    private const SINGLE_INPUT = [42];
    private const SINGLE_OUTPUT = [42];

    private const EMPTY_INPUT = [];
    private const EMPTY_OUTPUT = [];

    // Tabla de casos: descripción => [entrada, salida esperada].
    private const CASES = [
        'an unsorted array' => [self::STANDARD_INPUT, self::STANDARD_OUTPUT],
        'an already sorted array' => [self::SORTED_INPUT, self::SORTED_OUTPUT],
        'a reverse ordered array' => [self::REVERSE_INPUT, self::REVERSE_OUTPUT],
        'an array of identical elements' => [self::IDENTICAL_INPUT, self::IDENTICAL_OUTPUT],
        'an array with negative numbers' => [self::NEGATIVE_INPUT, self::NEGATIVE_OUTPUT],
        'a single element array' => [self::SINGLE_INPUT, self::SINGLE_OUTPUT],
        'an empty array' => [self::EMPTY_INPUT, self::EMPTY_OUTPUT],
    ];

    public function testSelectionSort(): void
    {
        self::assertSortsAllCases(NaiveSort::selectionSort(...), 'selection_sort');
    }

    public function testBubbleSort(): void
    {
        self::assertSortsAllCases(NaiveSort::bubbleSort(...), 'bubble_sort');
    }

    public function testInsertionSort(): void
    {
        self::assertSortsAllCases(NaiveSort::insertionSort(...), 'insertion_sort');
    }

    // Helper compartido: recibe la función a probar y el nombre del algoritmo, y
    // ejecuta todos los casos con el mensaje descriptivo del contrato.
    private static function assertSortsAllCases(callable $sort, string $algorithm): void
    {
        foreach (self::CASES as $description => [$input, $expected]) {
            $actual = $sort($input);

            self::assertSame(
                $expected,
                $actual,
                sprintf('%s should sort %s', $algorithm, $description)
            );
        }
    }
}
