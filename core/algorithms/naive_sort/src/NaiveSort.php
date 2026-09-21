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
    // Pendiente: selectionSort, bubbleSort e insertionSort según el contrato.
}
