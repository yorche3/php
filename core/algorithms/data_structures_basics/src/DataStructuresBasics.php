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
        $this->value = $value;
        $this->next = null;
        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }

    public function setNext(?Node $next): ?self
    {
        $this->next = $next;
        return $this;
    }
}

final class LinkedList
{
    private ?Node $head;
    private ?Node $tail;
    private int $count;

    public function init(): void
    {
        $this->head = null;
        $this->tail = null;
        $this->count = 0;
    }

    public function getHead(): int
    {
        return $this->head ? $this->head->getValue() : -1;
    }

    public function insertHead(int $value): void
    {
        $newNode = (new Node())->init($value);
        if ($this->head === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
        } else {
            $newNode->setNext($this->head);
            $this->head = $newNode;
        }
        $this->count++;
    }

    public function insertTail(int $value): void
    {
        $newNode = (new Node())->init($value);
        if ($this->tail === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
        } else {
            $this->tail->setNext($newNode);
            $this->tail = $newNode;
        }
        $this->count++;
    }

    public function delete(int $value): bool
    {
        $current = $this->head;
        $previous = null;
        while ($current !== null) {
            if ($current->getValue() === $value) {
                if ($previous === null) {
                    $this->head = $current->getNext();
                } else {
                    $previous->setNext($current->getNext());
                }
                if ($current === $this->tail) {
                    $this->tail = $previous;
                }
                $this->count--;
                return true;
            }
            $previous = $current;
            $current = $current->getNext();
        }
        return false;
    }

    public function isEmpty(): bool
    {
        return $this->count === 0;
    }

    public function size(): int
    {
        return $this->count;
    }
}

final class Stack
{
    private ?Node $top;
    private int $count;

    public function init(): void
    {
        $this->top = null;
        $this->count = 0;
    }

    public function push(int $value): void
    {
        $newNode = (new Node())->init($value);
        if ($this->top === null) {
            $this->top = $newNode;
        } else {
            $newNode->setNext($this->top);
            $this->top = $newNode;
        }
        $this->count++;
    }

    public function pop(): int
    {
        if ($this->top === null) {
            return -1;
        }
        $value = $this->top->getValue();
        $this->top = $this->top->getNext();
        $this->count--;
        return $value;
    }

    public function peek(): int
    {
        return $this->top ? $this->top->getValue() : -1;
    }

    public function isEmpty(): bool
    {
        return $this->count === 0;
    }

    public function size(): int
    {
        return $this->count;
    }
}

final class Queue
{
    private ?Node $front;
    private ?Node $rear;
    private int $count;

    public function init(): void
    {
        $this->front = null;
        $this->rear = null;
        $this->count = 0;
    }

    public function enqueue(int $value): void
    {
        $newNode = (new Node())->init($value);
        if ($this->rear === null) {
            $this->front = $newNode;
            $this->rear = $newNode;
        } else {
            $this->rear->setNext($newNode);
            $this->rear = $newNode;
        }
        $this->count++;
    }

    public function dequeue(): int
    {
        if ($this->front === null) {
            return -1;
        }
        $value = $this->front->getValue();
        $this->front = $this->front->getNext();
        if ($this->front === null) {
            $this->rear = null;
        }
        $this->count--;
        return $value;
    }

    public function peek(): int
    {
        return $this->front ? $this->front->getValue() : -1;
    }

    public function isEmpty(): bool
    {
        return $this->count === 0;
    }

    public function size(): int
    {
        return $this->count;
    }
}
