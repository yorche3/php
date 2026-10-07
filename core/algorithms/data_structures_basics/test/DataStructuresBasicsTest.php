<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

// Suite de pruebas de la especificación 06_Data_Structures_Basics.md
//
// Esqueleto del contrato (paso 4b): la suite arranca sin casos. Los 15 casos de
// la especificación (Node 2, LinkedList 5, Stack 4, Queue 4) se añaden en el
// encargo `suite` (paso 4c), sobre una misma instancia por estructura.

final class DataStructuresBasicsTest extends TestCase
{
    public function testLaSuiteArranca(): void
    {
        $this->assertTrue(true, 'la suite arranca sin casos');
    }
}
