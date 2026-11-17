<?php

declare(strict_types=1);

abstract class Node
{
    public function init(int $value): ?self
    {
        return null;
    }

    public function getValue(): int
    {
        return 0;
    }
}

final class TreeNode extends Node
{
    public function init(int $value): ?self
    {
        return null;
    }

    public function getLeft(): ?TreeNode
    {
        return null;
    }

    public function getRight(): ?TreeNode
    {
        return null;
    }

    public function setLeft(?TreeNode $node): ?self
    {
        return null;
    }

    public function setRight(?TreeNode $node): ?self
    {
        return null;
    }
}

final class BinaryTree
{
    public function init(): void
    {
    }

    public function insert(int $value): bool
    {
        return false;
    }

    public function contains(int $value): bool
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

final class GraphNode extends Node
{
    public function init(int $label): ?self
    {
        return null;
    }
}

final class Graph
{
    public function init(): void
    {
    }

    public function addVertex(int $label): bool
    {
        return false;
    }

    public function addEdge(int $u, int $v): bool
    {
        return false;
    }

    public function hasEdge(int $u, int $v): bool
    {
        return false;
    }

    public function getNeighbors(int $u): ?array
    {
        return null;
    }

    public function isEmpty(): bool
    {
        return false;
    }

    public function vertexCount(): int
    {
        return 0;
    }

    public function edgeCount(): int
    {
        return 0;
    }
}
