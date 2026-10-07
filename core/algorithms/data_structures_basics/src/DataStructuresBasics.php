<?php

// data_structures_basics — Node, LinkedList, Stack y Queue manuales sobre el
// mismo tipo de nodo enlazado.
//
// Especificación: 06_Data_Structures_Basics
//
// Contrato: un único tipo `Node` (valor + enlace) compartido por las tres
// estructuras, que gestionan sus propios punteros y no delegan operaciones entre
// sí (`Stack` y `Queue` no envuelven `LinkedList`). Cada instancia pasa por
// `init` antes de cualquier otra operación.
//
// Adaptaciones: solo el enlace de un `Node` (`next`) usa `null` como ausencia;
// las lecturas que pueden fallar devuelven el indicador -1 (`getHead`, `pop`,
// `peek`, `dequeue`), `delete` devuelve booleano (éxito o fallo) y `size`
// devuelve 0 mientras no hay nodos. `init` y `setNext` devuelven la instancia.
//
// Implementación pendiente: la escribe el autor. Esta delegación solo genera el
// contrato y el esqueleto.

final class Node
{
    private int $value;
    private ?Node $next;

    public function init(int $value): ?self
    {
        return null;
    }

    public function getValue(): int
    {
        return 0;
    }

    public function getNext(): ?Node
    {
        return null;
    }

    public function setNext(?Node $next): ?self
    {
        return null;
    }
}

final class LinkedList
{
    private ?Node $head;
    private ?Node $tail;
    private int $count;

    public function init(): void
    {
    }

    public function getHead(): int
    {
        return -1;
    }

    public function insertHead(int $value): void
    {
    }

    public function insertTail(int $value): void
    {
    }

    public function delete(int $value): bool
    {
        return false;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function size(): int
    {
        return 0;
    }
}

final class Stack
{
    private ?Node $top;
    private int $count;

    public function init(): void
    {
    }

    public function push(int $value): void
    {
    }

    public function pop(): int
    {
        return -1;
    }

    public function peek(): int
    {
        return -1;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function size(): int
    {
        return 0;
    }
}

final class Queue
{
    private ?Node $front;
    private ?Node $rear;
    private int $count;

    public function init(): void
    {
    }

    public function enqueue(int $value): void
    {
    }

    public function dequeue(): int
    {
        return -1;
    }

    public function peek(): int
    {
        return -1;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function size(): int
    {
        return 0;
    }
}
