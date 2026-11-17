<?php

declare(strict_types=1);

abstract class Node
{
    public function init(int $value): void
    {
        $this->value = $value;
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

    public function init(int $value): void
    {
        parent::init($value);
        $this->left = null;
        $this->right = null;
    }

    public function getLeft(): ?TreeNode
    {
        return $this->left;
    }

    public function getRight(): ?TreeNode
    {
        return $this->right;
    }

    public function setLeft(?TreeNode $node): void
    {
        $this->left = $node;
    }

    public function setRight(?TreeNode $node): void
    {
        $this->right = $node;
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
        while(true) {
            $v = $current->getValue();
            if ($value === $v) {
                return false;
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

    public function init(int $label): void
    {
        parent::init($label);
        $this->neighbors = [];
        $this->nextVertex = null;
    }

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
        if (in_array($neighbor, $this->neighbors, true)) {
            return false;
        }
        $pos = 0;
        while ($pos < count($this->neighbors) && $this->neighbors[$pos]->getValue() < $neighbor->getValue()) {
            $pos++;
        }
        array_splice($this->neighbors, $pos, 0, [$neighbor]);
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
            return false;
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
            return true;
        }
        return false;
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
        return $vertexU->getNeighbors();
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
