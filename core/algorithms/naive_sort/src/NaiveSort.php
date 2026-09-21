<?php

// naive_sort — ordenamientos elementales O(n²).
//
// Especificación: 05_Naive_Sort
//
// Contrato: las tres funciones reciben un array de enteros, lo ordenan in-place
// de menor a mayor y devuelven ese mismo array, sin invocar ninguna función de
// ordenamiento de la biblioteca estándar (`sort`, `usort`, `asort`…) y sin
// estructuras auxiliares complejas.
// API (camelCase, la convención de métodos de PHP): `selectionSort`,
// `bubbleSort` e `insertionSort`, con la firma `array $arr` y retorno `array`.
// El caso nulo se omite: el tipo `array` de PHP no admite `null` sin la
// anotación `?array`, que se formaliza en una fase posterior. Con menos de dos
// elementos el array vuelve sin cambios y ninguna función lanza excepciones.
//
// Implementación pendiente: la escribe el autor. Esta delegación solo genera el
// esqueleto y las pruebas unitarias.

final class NaiveSort
{
    public static function selectionSort(array $arr): array
    {
        $n = count($arr);
        for ($i = 0; $i < $n - 1; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($arr[$j] < $arr[$minIndex]) {
                    $minIndex = $j;
                }
            }
            if ($minIndex !== $i) {
                [$arr[$i], $arr[$minIndex]] = [$arr[$minIndex], $arr[$i]];
            }
        }
        return $arr;
    }

    public static function bubbleSort(array $arr): array
    {
        $n = count($arr);
        for ($i = 0; $i < $n - 1; $i++) {
            $swapped = false;
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    [$arr[$j], $arr[$j + 1]] = [$arr[$j + 1], $arr[$j]];
                    $swapped = true;
                }
            }
            if (!$swapped) {
                break;
            }
        }
        return $arr;
    }

    public static function insertionSort(array $arr): array
    {
        $n = count($arr);
        for ($i = 1; $i < $n; $i++) {
            $key = $arr[$i];
            $j = $i - 1;
            while ($j >= 0 && $arr[$j] > $key) {
                $arr[$j + 1] = $arr[$j];
                $j--;
            }
            $arr[$j + 1] = $key;
        }
        return $arr;
    }
}
