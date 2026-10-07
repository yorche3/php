<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

// Casos de prueba de la especificación 06_Data_Structures_Basics.md.
//
// Adaptación PHP: `null` representa exclusivamente la ausencia de enlace de
// Node; las lecturas fallidas devuelven -1. Las estructuras no aceptan una
// instancia nula, por lo que no existe un caso nulo de entrada adicional.
//
// Cada tabla conserva una única instancia por estructura porque sus filas son
// pasos sucesivos sobre el mismo estado lógico.

final class DataStructuresBasicsTest extends TestCase
{
    private const FAILURE = -1;

    private const NODE_INITIAL_VALUE = 10;
    private const NODE_LINKED_VALUE = 20;
    private const NODE_INITIAL_OUTPUT = [true, self::NODE_INITIAL_VALUE, null];
    private const NODE_LINKED_OUTPUT = [true, true, self::NODE_LINKED_VALUE, null];

    private const LIST_TAIL_FIRST_VALUE = 10;
    private const LIST_TAIL_SECOND_VALUE = 20;
    private const LIST_HEAD_VALUE = 5;
    private const LIST_ABSENT_VALUE = 99;
    private const LIST_EMPTY_OUTPUT = [true, 0, self::FAILURE];
    private const LIST_INSERTED_OUTPUT = [4, self::LIST_HEAD_VALUE];
    private const LIST_DELETE_FIRST_OUTPUT = [true, 3, self::LIST_HEAD_VALUE];
    private const LIST_ABSENT_OUTPUT = [false, 3, self::LIST_HEAD_VALUE];
    private const LIST_EMPTIED_OUTPUT = [
        true,
        self::LIST_TAIL_SECOND_VALUE,
        true,
        self::LIST_TAIL_FIRST_VALUE,
        true,
        true,
        0,
        self::FAILURE,
    ];

    private const STACK_FIRST_VALUE = 10;
    private const STACK_SECOND_VALUE = 20;
    private const STACK_THIRD_VALUE = 30;
    private const STACK_REUSED_VALUE = 40;
    private const STACK_EMPTY_OUTPUT = [true, 0, self::FAILURE, self::FAILURE];
    private const STACK_LIFO_OUTPUT = [self::STACK_THIRD_VALUE, 3];
    private const STACK_REMOVAL_OUTPUT = [
        self::STACK_THIRD_VALUE,
        self::STACK_REUSED_VALUE,
        self::STACK_SECOND_VALUE,
        self::STACK_FIRST_VALUE,
        true,
        0,
    ];
    private const STACK_EMPTY_AFTER_REMOVAL_OUTPUT = [self::FAILURE, true];

    private const QUEUE_FIRST_VALUE = 10;
    private const QUEUE_SECOND_VALUE = 20;
    private const QUEUE_THIRD_VALUE = 30;
    private const QUEUE_REUSED_VALUE = 40;
    private const QUEUE_EMPTY_OUTPUT = [true, 0, self::FAILURE, self::FAILURE];
    private const QUEUE_FIFO_OUTPUT = [self::QUEUE_FIRST_VALUE, 3];
    private const QUEUE_REMOVAL_OUTPUT = [
        self::QUEUE_FIRST_VALUE,
        self::QUEUE_SECOND_VALUE,
        self::QUEUE_THIRD_VALUE,
        self::QUEUE_REUSED_VALUE,
        true,
        0,
    ];
    private const QUEUE_EMPTY_AFTER_REMOVAL_OUTPUT = [self::FAILURE, true];

    private const NODE_CASES = [
        'initialize and observe value and link' => self::NODE_INITIAL_OUTPUT,
        'initialize another node, link and traverse' => self::NODE_LINKED_OUTPUT,
    ];

    private const LINKED_LIST_CASES = [
        'an empty state' => self::LIST_EMPTY_OUTPUT,
        'insertion at both ends' => self::LIST_INSERTED_OUTPUT,
        'deletion of the first occurrence' => self::LIST_DELETE_FIRST_OUTPUT,
        'an absent value' => self::LIST_ABSENT_OUTPUT,
        'emptying the list' => self::LIST_EMPTIED_OUTPUT,
    ];

    private const STACK_CASES = [
        'an empty state and failed removal' => self::STACK_EMPTY_OUTPUT,
        'LIFO order and non-mutating peek' => self::STACK_LIFO_OUTPUT,
        'removal and reuse' => self::STACK_REMOVAL_OUTPUT,
        'an empty state after removal' => self::STACK_EMPTY_AFTER_REMOVAL_OUTPUT,
    ];

    private const QUEUE_CASES = [
        'an empty state and failed removal' => self::QUEUE_EMPTY_OUTPUT,
        'FIFO order and non-mutating peek' => self::QUEUE_FIFO_OUTPUT,
        'removal and reuse' => self::QUEUE_REMOVAL_OUTPUT,
        'an empty state after removal' => self::QUEUE_EMPTY_AFTER_REMOVAL_OUTPUT,
    ];

    public function testNode(): void
    {
        $first = new Node();
        $second = new Node();

        self::assertAllCases(
            self::NODE_CASES,
            function (string $case) use ($first, $second): array {
                return match ($case) {
                    'initialize and observe value and link' => [
                        $first->init(self::NODE_INITIAL_VALUE) === $first,
                        $first->getValue(),
                        $first->getNext(),
                    ],
                    'initialize another node, link and traverse' => [
                        $second->init(self::NODE_LINKED_VALUE) === $second,
                        $first->setNext($second) === $first,
                        $first->getNext()?->getValue(),
                        $second->getNext(),
                    ],
                };
            },
            'Node'
        );
    }

    public function testLinkedList(): void
    {
        $list = new LinkedList();

        self::assertAllCases(
            self::LINKED_LIST_CASES,
            function (string $case) use ($list): array {
                return match ($case) {
                    'an empty state' => (function () use ($list): array {
                        $list->init();

                        return [$list->isEmpty(), $list->size(), $list->getHead()];
                    })(),
                    'insertion at both ends' => (function () use ($list): array {
                        $list->insertTail(self::LIST_TAIL_FIRST_VALUE);
                        $list->insertTail(self::LIST_TAIL_SECOND_VALUE);
                        $list->insertHead(self::LIST_HEAD_VALUE);
                        $list->insertTail(self::LIST_TAIL_FIRST_VALUE);

                        return [$list->size(), $list->getHead()];
                    })(),
                    'deletion of the first occurrence' => [
                        $list->delete(self::LIST_TAIL_FIRST_VALUE),
                        $list->size(),
                        $list->getHead(),
                    ],
                    'an absent value' => [
                        $list->delete(self::LIST_ABSENT_VALUE),
                        $list->size(),
                        $list->getHead(),
                    ],
                    'emptying the list' => [
                        $list->delete(self::LIST_HEAD_VALUE),
                        $list->getHead(),
                        $list->delete(self::LIST_TAIL_SECOND_VALUE),
                        $list->getHead(),
                        $list->delete(self::LIST_TAIL_FIRST_VALUE),
                        $list->isEmpty(),
                        $list->size(),
                        $list->getHead(),
                    ],
                };
            },
            'LinkedList'
        );
    }

    public function testStack(): void
    {
        $stack = new Stack();

        self::assertAllCases(
            self::STACK_CASES,
            function (string $case) use ($stack): array {
                return match ($case) {
                    'an empty state and failed removal' => (function () use ($stack): array {
                        $stack->init();

                        return [$stack->isEmpty(), $stack->size(), $stack->peek(), $stack->pop()];
                    })(),
                    'LIFO order and non-mutating peek' => (function () use ($stack): array {
                        $stack->push(self::STACK_FIRST_VALUE);
                        $stack->push(self::STACK_SECOND_VALUE);
                        $stack->push(self::STACK_THIRD_VALUE);

                        return [$stack->peek(), $stack->size()];
                    })(),
                    'removal and reuse' => [
                        $stack->pop(),
                        (function () use ($stack): int {
                            $stack->push(self::STACK_REUSED_VALUE);

                            return $stack->pop();
                        })(),
                        $stack->pop(),
                        $stack->pop(),
                        $stack->isEmpty(),
                        $stack->size(),
                    ],
                    'an empty state after removal' => [$stack->pop(), $stack->isEmpty()],
                };
            },
            'Stack'
        );
    }

    public function testQueue(): void
    {
        $queue = new Queue();

        self::assertAllCases(
            self::QUEUE_CASES,
            function (string $case) use ($queue): array {
                return match ($case) {
                    'an empty state and failed removal' => (function () use ($queue): array {
                        $queue->init();

                        return [$queue->isEmpty(), $queue->size(), $queue->peek(), $queue->dequeue()];
                    })(),
                    'FIFO order and non-mutating peek' => (function () use ($queue): array {
                        $queue->enqueue(self::QUEUE_FIRST_VALUE);
                        $queue->enqueue(self::QUEUE_SECOND_VALUE);
                        $queue->enqueue(self::QUEUE_THIRD_VALUE);

                        return [$queue->peek(), $queue->size()];
                    })(),
                    'removal and reuse' => [
                        $queue->dequeue(),
                        (function () use ($queue): int {
                            $queue->enqueue(self::QUEUE_REUSED_VALUE);

                            return $queue->dequeue();
                        })(),
                        $queue->dequeue(),
                        $queue->dequeue(),
                        $queue->isEmpty(),
                        $queue->size(),
                    ],
                    'an empty state after removal' => [$queue->dequeue(), $queue->isEmpty()],
                };
            },
            'Queue'
        );
    }

    private static function assertAllCases(array $cases, callable $operation, string $subject): void
    {
        foreach ($cases as $case => $expected) {
            self::assertSame(
                $expected,
                $operation($case),
                sprintf('%s should produce the expected result for %s', $subject, $case)
            );
        }
    }
}
