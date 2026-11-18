<?php

declare(strict_types=1);

abstract class Node
{
    protected int $value = 0;

    public function init(int $value): ?self
    {
        $this->value = $value;
        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}

final class TreeNode extends Node
{
    private ?TreeNode $left = null;
    private ?TreeNode $right = null;

    public function init(int $value): ?self
    {
        parent::init($value);
        $this->left = null;
        $this->right = null;
        return $this;
    }

    public function getLeft(): ?TreeNode
    {
        return $this->left;
    }

    public function getRight(): ?TreeNode
    {
        return $this->right;
    }

    public function setLeft(?TreeNode $node): ?self
    {
        $this->left = $node;
        return $this;
    }

    public function setRight(?TreeNode $node): ?self
    {
        $this->right = $node;
        return $this;
    }
}

final class BinaryTree
{
    private ?TreeNode $root = null;
    private int $count = 0;

    public function init(): void
    {
        $this->root = null;
        $this->count = 0;
    }

    public function insert(int $value): bool
    {
        if ($this->root === null) {
            $this->root = new TreeNode();
            $this->root->init($value);
            $this->count++;
            return true;
        }
        $current = $this->root;
        while (true) {
            $v = $current->getValue();
            if ($value === $v) {
                return true;
            }
            if ($value < $v) {
                if ($current->getLeft() === null) {
                    $node = new TreeNode();
                    $node->init($value);
                    $current->setLeft($node);
                    $this->count++;
                    return true;
                }
                $current = $current->getLeft();
            } else {
                if ($current->getRight() === null) {
                    $node = new TreeNode();
                    $node->init($value);
                    $current->setRight($node);
                    $this->count++;
                    return true;
                }
                $current = $current->getRight();
            }
    }
    }

    public function contains(int $value): bool
    {
        $current = $this->root;
        while ($current !== null) {
            $v = $current->getValue();
            if ($value === $v) {
                return true;
            }
            if ($value < $v) {
                $current = $current->getLeft();
            } else {
                $current = $current->getRight();
            }
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

final class GraphNode extends Node
{
    private array $neighbors = [];
    private ?GraphNode $nextVertex = null;

    public function init(int $label): ?self
    {
        parent::init($label);
        $this->neighbors = [];
        $this->nextVertex = null;
        return $this;
    }

    /** @return array<int, GraphNode> */
    public function getNeighbors(): array
    {
        return $this->neighbors;
    }

    public function getNextVertex(): ?GraphNode
    {
        return $this->nextVertex;
    }

    public function addNeighbor(GraphNode $neighbor): bool
    {
        foreach ($this->neighbors as $position => $current) {
            $label = $current->getValue();
            if ($label === $neighbor->getValue()) {
                return false;
            }
            if ($label > $neighbor->getValue()) {
                array_splice($this->neighbors, $position, 0, [$neighbor]);
                return true;
            }
        }
        $this->neighbors[] = $neighbor;
        return true;
    }

    public function setNextVertex(?GraphNode $nextVertex): void
    {
        $this->nextVertex = $nextVertex;
    }
}

final class Graph
{
    private ?GraphNode $vertices = null;
    private int $vertexCount = 0;
    private int $edgeCount = 0;

    public function init(): void
    {
        $this->vertices = null;
        $this->vertexCount = 0;
        $this->edgeCount = 0;
    }

    private function findVertex(int $label): ?GraphNode
    {
        $current = $this->vertices;
        while ($current !== null) {
            if ($current->getValue() === $label) {
                return $current;
            }
            $current = $current->getNextVertex();
        }
        return null;
    }

    public function addVertex(int $label): bool
    {
        if ($this->findVertex($label) !== null) {
            return true;
        }
        $newVertex = new GraphNode();
        $newVertex->init($label);
        if ($this->vertices === null) {
            $this->vertices = $newVertex;
        } else {
            $current = $this->vertices;
            while ($current->getNextVertex() !== null) {
                $current = $current->getNextVertex();
            }
            $current->setNextVertex($newVertex);
        }
        $this->vertexCount++;
        return true;
    }

    public function addEdge(int $u, int $v): bool
    {
        $vertexU = $this->findVertex($u);
        $vertexV = $this->findVertex($v);
        if ($vertexU === null || $vertexV === null) {
            return false;
        }
        if ($vertexU->addNeighbor($vertexV)) {
            $this->edgeCount++;
        }
        return true;
    }

    public function hasEdge(int $u, int $v): bool
    {
        $vertexU = $this->findVertex($u);
        $vertexV = $this->findVertex($v);
        if ($vertexU === null || $vertexV === null) {
            return false;
        }
        foreach ($vertexU->getNeighbors() as $neighbor) {
            if ($neighbor->getValue() === $v) {
                return true;
            }
        }
        return false;
    }

    public function getNeighbors(int $u): ?array
    {
        $vertexU = $this->findVertex($u);
        if ($vertexU === null) {
            return null;
        }
        return array_map(
            static fn (GraphNode $neighbor): int => $neighbor->getValue(),
            $vertexU->getNeighbors()
        );
    }

    public function isEmpty(): bool
    {
        return $this->vertexCount === 0;
    }

    public function vertexCount(): int
    {
        return $this->vertexCount;
    }

    public function edgeCount(): int
    {
        return $this->edgeCount;
    }
}
