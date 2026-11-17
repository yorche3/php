<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

// Casos de prueba de la especificación 07_Data_Structures_Advanced.md.
//
// Adaptación PHP: `null` representa la ausencia de enlace en TreeNode y el fallo
// de Graph::getNeighbors (distinto de `[]`); los fallos booleanos son `false`
// y los de contains/hasEdge también. TreeNode es mutable, por lo que el caso
// «Adaptación inmutable (si aplica)» no aplica. El resultado de getNeighbors es
// un array por valor: modificar la copia devuelta no afecta al grafo.
//
// Cada caso crea instancias nuevas y ejecuta sus pasos en orden.

final class DataStructuresAdvancedTest extends TestCase
{
    private const PARENT_VALUE = 10;
    private const LEFT_VALUE = 20;
    private const RIGHT_VALUE = 30;
    private const ABSENT_VALUE = 99;

    private const TREE_ROOT = 50;
    private const TREE_LOWER = 30;
    private const TREE_HIGHER = 70;

    /** @return array<string, array{0: array, 1: callable(): array}> */
    public static function treeNodeCases(): array
    {
        $family = static function (): array {
            $parent = new TreeNode();
            $parent->init(self::PARENT_VALUE);
            $left = new TreeNode();
            $left->init(self::LEFT_VALUE);
            $right = new TreeNode();
            $right->init(self::RIGHT_VALUE);

            return [$parent, $left, $right];
        };

        return [
            'create a tree node' => [
                [self::PARENT_VALUE],
                static function (): array {
                    $node = new TreeNode();
                    $node->init(self::PARENT_VALUE);

                    return [$node->getValue()];
                },
            ],
            'absent initial links' => [
                [null, null],
                static function (): array {
                    $node = new TreeNode();
                    $node->init(self::PARENT_VALUE);

                    return [$node->getLeft(), $node->getRight()];
                },
            ],
            'link two children' => [
                [self::LEFT_VALUE, self::RIGHT_VALUE],
                static function () use ($family): array {
                    [$parent, $left, $right] = $family();
                    $parent->setLeft($left);
                    $parent->setRight($right);

                    return [$parent->getLeft()?->getValue(), $parent->getRight()?->getValue()];
                },
            ],
            'traverse each link' => [
                [self::LEFT_VALUE, self::RIGHT_VALUE, null, null, null, null],
                static function () use ($family): array {
                    [$parent, $left, $right] = $family();
                    $parent->setLeft($left);
                    $parent->setRight($right);
                    $leftChild = $parent->getLeft();
                    $rightChild = $parent->getRight();

                    return [
                        $leftChild?->getValue(),
                        $rightChild?->getValue(),
                        $leftChild?->getLeft(),
                        $leftChild?->getRight(),
                        $rightChild?->getLeft(),
                        $rightChild?->getRight(),
                    ];
                },
            ],
            'unlink children' => [
                [self::PARENT_VALUE, self::RIGHT_VALUE, self::PARENT_VALUE, null, null],
                static function () use ($family): array {
                    [$parent, $left, $right] = $family();
                    $parent->setLeft($left);
                    $parent->setRight($right);

                    $parent->setLeft(null);
                    $afterLeft = [$parent->getValue(), $parent->getRight()?->getValue()];
                    $parent->setRight(null);

                    return [...$afterLeft, $parent->getValue(), $parent->getLeft(), $parent->getRight()];
                },
            ],
        ];
    }

    /** @return array<string, array{0: array, 1: callable(): array}> */
    public static function binaryTreeCases(): array
    {
        $insertAll = static function (array $values): array {
            $tree = new BinaryTree();
            $tree->init();
            $results = [];
            foreach ($values as $value) {
                $results[] = $tree->insert($value);
            }

            return [$tree, $results];
        };
        $membership = static function (BinaryTree $tree, array $values): array {
            return array_map(static fn (int $value): bool => $tree->contains($value), $values);
        };

        return [
            'create empty' => [
                [true, 0, false],
                static function (): array {
                    $tree = new BinaryTree();
                    $tree->init();

                    return [$tree->isEmpty(), $tree->size(), $tree->contains(self::TREE_ROOT)];
                },
            ],
            'insert the root' => [
                [true, 1, false, true],
                static function () use ($insertAll): array {
                    [$tree, $results] = $insertAll([self::TREE_ROOT]);

                    return [$results[0], $tree->size(), $tree->isEmpty(), $tree->contains(self::TREE_ROOT)];
                },
            ],
            'insert lower and higher' => [
                [[true, true, true], 3, [true, true, true]],
                static function () use ($insertAll, $membership): array {
                    $values = [self::TREE_ROOT, self::TREE_LOWER, self::TREE_HIGHER];
                    [$tree, $results] = $insertAll($values);

                    return [$results, $tree->size(), $membership($tree, $values)];
                },
            ],
            'multilevel branches' => [
                [[true, true, true, true, true], [true, true, true, true, true], 5],
                static function () use ($insertAll, $membership): array {
                    $values = [50, 30, 70, 20, 40];
                    [$tree, $results] = $insertAll($values);

                    return [$results, $membership($tree, $values), $tree->size()];
                },
            ],
            'missing value in nonempty tree' => [
                [false, 1, true],
                static function () use ($insertAll): array {
                    [$tree] = $insertAll([self::TREE_ROOT]);

                    return [$tree->contains(self::ABSENT_VALUE), $tree->size(), $tree->contains(self::TREE_ROOT)];
                },
            ],
            'idempotent duplicate' => [
                [[true, true, true, true], 3, [true, true, true]],
                static function () use ($insertAll, $membership): array {
                    [$tree, $results] = $insertAll([50, 30, 70, 30]);

                    return [$results, $tree->size(), $membership($tree, [50, 30, 70])];
                },
            ],
            'ordered insertions' => [
                [[true, true, true, true, true], 5, [true, true, true, true, true], false],
                static function () use ($insertAll, $membership): array {
                    $values = [20, 30, 40, 50, 70];
                    [$tree, $results] = $insertAll($values);

                    return [
                        $results,
                        $tree->size(),
                        $membership($tree, $values),
                        $tree->contains(self::ABSENT_VALUE),
                    ];
                },
            ],
        ];
    }

    /** @return array<string, array{0: array, 1: callable(): array}> */
    public static function graphCases(): array
    {
        $build = static function (array $labels, array $edges = []): array {
            $graph = new Graph();
            $graph->init();
            $results = [];
            foreach ($labels as $label) {
                $results[] = $graph->addVertex($label);
            }
            foreach ($edges as [$u, $v]) {
                $results[] = $graph->addEdge($u, $v);
            }

            return [$graph, $results];
        };

        return [
            'create empty' => [
                [true, 0, 0, false, null],
                static function (): array {
                    $graph = new Graph();
                    $graph->init();

                    return [
                        $graph->isEmpty(),
                        $graph->vertexCount(),
                        $graph->edgeCount(),
                        $graph->hasEdge(10, 30),
                        $graph->getNeighbors(10),
                    ];
                },
            ],
            'isolated vertex' => [
                [true, false, 1, 0, []],
                static function () use ($build): array {
                    [$graph, $results] = $build([10]);

                    return [
                        $results[0],
                        $graph->isEmpty(),
                        $graph->vertexCount(),
                        $graph->edgeCount(),
                        $graph->getNeighbors(10),
                    ];
                },
            ],
            'nonconsecutive labels and directed edge' => [
                [[true, true, true], true, false, 2, 1],
                static function () use ($build): array {
                    [$graph, $results] = $build([10, 70], [[10, 70]]);

                    return [$results, $graph->hasEdge(10, 70), $graph->hasEdge(70, 10), $graph->vertexCount(), $graph->edgeCount()];
                },
            ],
            'duplicate vertex preserves adjacency' => [
                [[true, true, true, true], 2, 1, [30]],
                static function () use ($build): array {
                    [$graph, $results] = $build([10, 30], [[10, 30]]);
                    $results[] = $graph->addVertex(10);

                    return [$results, $graph->vertexCount(), $graph->edgeCount(), $graph->getNeighbors(10)];
                },
            ],
            'duplicate edge' => [
                [[true, true, true, true], 2, 1, [30]],
                static function () use ($build): array {
                    [$graph, $results] = $build([10, 30], [[10, 30], [10, 30]]);

                    return [$results, $graph->vertexCount(), $graph->edgeCount(), $graph->getNeighbors(10)];
                },
            ],
            'missing endpoint without mutation' => [
                [[false, false, false, false], 2, 1, [30], [], [false, false, false, false], null, null],
                static function () use ($build): array {
                    [$graph] = $build([10, 30], [[10, 30]]);
                    $attempts = [[10, 99], [99, 10], [98, 99], [99, 99]];
                    $results = array_map(static fn (array $edge): bool => $graph->addEdge($edge[0], $edge[1]), $attempts);

                    return [
                        $results,
                        $graph->vertexCount(),
                        $graph->edgeCount(),
                        $graph->getNeighbors(10),
                        $graph->getNeighbors(30),
                        array_map(static fn (array $edge): bool => $graph->hasEdge($edge[0], $edge[1]), $attempts),
                        $graph->getNeighbors(98),
                        $graph->getNeighbors(99),
                    ];
                },
            ],
            'sorted neighbours and counts' => [
                [
                    [true, true, true, true, true, true, true, true],
                    [30, 50, 70],
                    [50],
                    [],
                    [],
                    4,
                    4,
                ],
                static function () use ($build): array {
                    [$graph, $results] = $build([10, 30, 50, 70], [[10, 70], [10, 30], [10, 50], [30, 50]]);

                    return [
                        $results,
                        $graph->getNeighbors(10),
                        $graph->getNeighbors(30),
                        $graph->getNeighbors(50),
                        $graph->getNeighbors(70),
                        $graph->vertexCount(),
                        $graph->edgeCount(),
                    ];
                },
            ],
            'missing-edge query' => [
                [false, 2, 0, false],
                static function () use ($build): array {
                    [$graph] = $build([10, 30]);

                    return [$graph->hasEdge(10, 30), $graph->vertexCount(), $graph->edgeCount(), $graph->isEmpty()];
                },
            ],
            'neighbours of missing vertex' => [
                [null, [], 1, 0],
                static function () use ($build): array {
                    [$graph] = $build([10]);

                    return [$graph->getNeighbors(self::ABSENT_VALUE), $graph->getNeighbors(10), $graph->vertexCount(), $graph->edgeCount()];
                },
            ],
            'self-loop and duplicate' => [
                [[true, true, true], true, [10], 1, 1],
                static function () use ($build): array {
                    [$graph, $results] = $build([10], [[10, 10], [10, 10]]);

                    return [$results, $graph->hasEdge(10, 10), $graph->getNeighbors(10), $graph->vertexCount(), $graph->edgeCount()];
                },
            ],
            'neighbour-result isolation' => [
                [[30], [30, 50], 3, 2],
                static function () use ($build): array {
                    [$graph] = $build([10, 30, 50], [[10, 30]]);
                    $saved = $graph->getNeighbors(10);
                    $copy = $graph->getNeighbors(10);
                    $copy[] = 99;
                    $copy[0] = 11;
                    $graph->addEdge(10, 50);

                    return [$saved, $graph->getNeighbors(10), $graph->vertexCount(), $graph->edgeCount()];
                },
            ],
        ];
    }

    #[DataProvider('treeNodeCases')]
    public function testTreeNode(array $expected, callable $scenario): void
    {
        self::assertSame($expected, $scenario(), 'TreeNode should produce the expected result');
    }

    #[DataProvider('binaryTreeCases')]
    public function testBinaryTree(array $expected, callable $scenario): void
    {
        self::assertSame($expected, $scenario(), 'BinaryTree should produce the expected result');
    }

    #[DataProvider('graphCases')]
    public function testGraph(array $expected, callable $scenario): void
    {
        self::assertSame($expected, $scenario(), 'Graph should produce the expected result');
    }
}
