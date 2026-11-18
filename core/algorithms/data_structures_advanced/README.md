# Data Structures Advanced — PHP

Implementación de la especificación [07_Data_Structures_Advanced](https://yorche3.github.io/programming_languages/core/algorithms/07_Data_Structures_Advanced/) en **PHP**, con un enfoque manual y minimalista.

**ES:** Estructuras con múltiples enlaces por nodo (`TreeNode` y `GraphNode` derivados de una base `Node`), un árbol binario de búsqueda (`BinaryTree`) y un grafo dirigido (`Graph`) con registro canónico enlazado de vértices y adyacencia ordenada manual, ejecutadas con **PHPUnit** (gestionado con Composer).

**EN:** Multiple-link structures (`TreeNode` and `GraphNode` derived from a `Node` base), a binary search tree (`BinaryTree`), and a directed graph (`Graph`) with a canonical linked vertex registry and manual sorted adjacency, run with **PHPUnit** (managed via Composer).

---

## 📂 Archivos y estructura / Files & Structure

| Archivo / Directorio | Propósito / Purpose |
|---|---|
| [`composer.json`](composer.json) | Manifiesto: PHPUnit como dependencia de desarrollo y autoload de `src/` y `test/`. / Manifest: PHPUnit as dev dependency and autoload for `src/` and `test/`. |
| [`phpunit.xml`](phpunit.xml) | Configuración de PHPUnit: bootstrap del autoload y suite sobre `test/`. / PHPUnit configuration: autoload bootstrap and suite over `test/`. |
| [`src/DataStructuresAdvanced.php`](src/DataStructuresAdvanced.php) | Cinco clases (`Node`, `TreeNode`, `BinaryTree`, `GraphNode`, `Graph`) en un único archivo. / Five classes (`Node`, `TreeNode`, `BinaryTree`, `GraphNode`, `Graph`) in a single file. |
| [`test/DataStructuresAdvancedTest.php`](test/DataStructuresAdvancedTest.php) | Suite con 23 casos en 3 tests parametrizados (`DataProvider`) y 23 aserciones que cubren la especificación. / Suite with 23 cases across 3 parameterized tests (`DataProvider`) and 23 assertions covering the specification. |
| [`.gitignore`](.gitignore) | Ignora `vendor/`, `composer.lock` y las cachés de PHPUnit. / Ignores `vendor/`, `composer.lock` and PHPUnit caches. |

```text
data_structures_advanced/
├── composer.json                       # PHPUnit (dev) + autoload classmap
├── phpunit.xml                         # bootstrap + suite sobre test/
├── src/
│   └── DataStructuresAdvanced.php      # Node, TreeNode, BinaryTree, GraphNode, Graph
├── test/
│   └── DataStructuresAdvancedTest.php  # 23 casos en 3 tests con DataProvider
├── .gitignore
└── README.md
```

**ES:** Desviación respecto a la ubicación esperada por la especificación: el pseudocódigo propone `data_structures_advanced.ext` y `data_structures_advanced_test.ext`, pero PHP sigue PSR-4 (un archivo por clase, en `PascalCase`); las cinco clases comparten archivo porque comparten el tipo `Node` y pertenecen a la misma jerarquía y dominio de estructuras avanzadas. No hay `run_tests.ext` porque PHPUnit aporta el runner nativo. `vendor/` y `composer.lock` quedan excluidos del repositorio.

**EN:** Deviation from the specification's expected location: the pseudocode proposes `data_structures_advanced.ext` and `data_structures_advanced_test.ext`, but PHP follows PSR-4 (one file per class, in `PascalCase`); the five classes share a single file because they share the `Node` type and belong to the same hierarchy and domain of advanced data structures. There is no `run_tests.ext` because PHPUnit provides the native runner. `vendor/` and `composer.lock` are excluded from the repository.

---

## 🛠️ Enfoque y construcción / Approach & Build

**ES:** Librería PHP con la implementación en `src/`, la suite en `test/` y PHPUnit como runner. La base abstracta `Node` encapsula el valor; `TreeNode` y `GraphNode` heredan de ella y validan sus propios enlaces. `BinaryTree` y `Graph` gestionan manualmente sus punteros y recorridos sin delegar en colecciones indexadas ni mapas hash de biblioteca.

**EN:** PHP library with the implementation under `src/`, the suite under `test/`, and PHPUnit as the runner. The abstract base `Node` encapsulates the value; `TreeNode` and `GraphNode` inherit from it and validate their own links. `BinaryTree` and `Graph` manually manage their pointers and traversals without delegating to library indexed collections or hash maps.

### Inicialización / Initialization

```bash
mkdir -p php/core/algorithms/data_structures_advanced/{src,test}
cd php/core/algorithms/data_structures_advanced
composer require --dev phpunit/phpunit
```

Después se añaden las clases en `src/`, la suite en `test/`, el manifiesto `composer.json` y la configuración `phpunit.xml`.

---

## 📄 Configuración clave / Key Configuration

### `composer.json`

```json
{
    "require-dev": {
        "phpunit/phpunit": "^13.4"
    },
    "autoload": {
        "classmap": [
            "src/"
        ]
    },
    "autoload-dev": {
        "classmap": [
            "test/"
        ]
    },
    "scripts": {
        "test": "phpunit"
    }
}
```

**ES:** El autoload por *classmap* publica `src/` y `test/` para que las suites y el runner resuelvan las clases sin necesidad de `require` manual.

**EN:** The *classmap* autoload publishes `src/` and `test/` so suites and runner resolve classes without manual `require` calls.

### `phpunit.xml`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
         cacheDirectory=".phpunit.cache">
    <testsuites>
        <testsuite name="data_structures_advanced">
            <directory>test</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

---

## 🚀 Compilación y ejecución / Build & Run

### Requisitos / Requirements

- **PHP 8.5.10**.
- **Composer 2.10.3** para instalar dependencias de desarrollo.

Verificar el entorno / Verify environment:

```bash
php --version
composer --version
```

### Instalar las dependencias / Install dependencies

```bash
cd php/core/algorithms/data_structures_advanced
composer install
```

### Verificar sintaxis sin ejecutar / Check syntax without running

```bash
php -l src/DataStructuresAdvanced.php
php -l test/DataStructuresAdvancedTest.php
```

**Salida real / Actual output:**

```text
No syntax errors detected in src/DataStructuresAdvanced.php
No syntax errors detected in test/DataStructuresAdvancedTest.php
```

### Ejecutar las pruebas / Run tests

```bash
cd php/core/algorithms/data_structures_advanced
composer test
```

**Salida real / Actual output:**

```text
PHPUnit 13.4.7 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.10
Configuration: ~/programming_languages/php/core/algorithms/data_structures_advanced/phpunit.xml

.......................                                           23 / 23 (100%)

Time: 00:00.003, Memory: 20.00 MB

OK (23 tests, 23 assertions)
```

---

## 🧠 Algoritmos y operaciones / Algorithms & Operations

### `Node`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init(value)` | `int → ?self` | `O(1)` | Asigna `value` a la propiedad protegida y devuelve `$this`. / Sets `value` on protected property and returns `$this`. |
| `getValue()` | `→ int` | `O(1)` | Devuelve el valor almacenado. / Returns the stored value. |

### `TreeNode`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init(value)` | `int → ?self` | `O(1)` | Llama a `parent::init` y reinicia `left` y `right` a `null`. / Calls `parent::init` and resets `left` and `right` to `null`. |
| `getValue()` | `→ int` | `O(1)` | Heredado de `Node`. / Inherited from `Node`. |
| `getLeft()` | `→ ?TreeNode` | `O(1)` | Enlace izquierdo o `null`. / Left link or `null`. |
| `getRight()` | `→ ?TreeNode` | `O(1)` | Enlace derecho o `null`. / Right link or `null`. |
| `setLeft(node)` | `?TreeNode → ?self` | `O(1)` | Actualiza el subárbol izquierdo y devuelve `$this`. / Updates left subtree and returns `$this`. |
| `setRight(node)` | `?TreeNode → ?self` | `O(1)` | Actualiza el subárbol derecho y devuelve `$this`. / Updates right subtree and returns `$this`. |

### `BinaryTree`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init()` | `→ void` | `O(1)` | Raíz en `null` y contador en 0. / Root as `null` and count to 0. |
| `insert(value)` | `int → bool` | `O(h)` | Inserta siguiendo la invariante BST; duplicado retorna `true` sin alterar tamaño. / Inserts following BST invariant; duplicate returns `true` without growing size. |
| `contains(value)` | `int → bool` | `O(h)` | Búsqueda por ramas del ABB; `true` si existe, `false` si no. / Traversal through BST branches; `true` if found, `false` otherwise. |
| `isEmpty()` | `→ bool` | `O(1)` | `true` cuando `count === 0`. / `true` when `count === 0`. |
| `size()` | `→ int` | `O(1)` | Devuelve la cantidad de nodos. / Returns node count. |

### `GraphNode`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init(label)` | `int → ?self` | `O(1)` | Llama a `parent::init` y limpia vecinos y `nextVertex`. / Calls `parent::init` and clears neighbors and `nextVertex`. |
| `getValue()` | `→ int` | `O(1)` | Etiqueta del vértice heredada de `Node`. / Vertex label inherited from `Node`. |
| `getNeighbors()` | `→ array<int, GraphNode>` | `O(1)` | Devuelve la lista interna de nodos vecinos. / Returns internal list of neighbor nodes. |
| `getNextVertex()` | `→ ?GraphNode` | `O(1)` | Enlace al siguiente vértice en el registro canónico. / Link to next vertex in canonical registry. |
| `addNeighbor(neighbor)` | `GraphNode → bool` | `O(d(u))` | Inserción ordenada manual sin duplicados; `true` si es nueva arista. / Manual sorted insertion without duplicates; `true` if new edge. |
| `setNextVertex(nextVertex)` | `?GraphNode → void` | `O(1)` | Enlaza el siguiente vértice del registro. / Links next vertex of the registry. |

### `Graph`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init()` | `→ void` | `O(1)` | Vértices en `null`, contadores de vértices y aristas a cero. / Vertices to `null`, vertex and edge counts to zero. |
| `addVertex(label)` | `int → bool` | `O(V)` | Registra el vértice en la lista enlazada canónica; idempotente. / Registers vertex in canonical linked list; idempotent. |
| `addEdge(u, v)` | `(int, int) → bool` | `O(V + d(u))` | Localiza ambos extremos; añade vecino ordenado si existen; `false` si falta alguno. / Locates both endpoints; adds sorted neighbor if they exist; `false` if either missing. |
| `hasEdge(u, v)` | `(int, int) → bool` | `O(V + d(u))` | Comprueba existencia de extremos y arista dirigida; `false` si no existe. / Checks endpoints and directed edge existence; `false` if absent. |
| `getNeighbors(u)` | `int → ?array` | `O(V + d(u))` | Copia independiente de etiquetas ordenadas o `null` si `u` no existe. / Independent copy of sorted labels or `null` if `u` is missing. |
| `isEmpty()` | `→ bool` | `O(1)` | `true` si no hay vértices registrados. / `true` if no registered vertices. |
| `vertexCount()` | `→ int` | `O(1)` | Cantidad de vértices registrados. / Count of registered vertices. |
| `edgeCount()` | `→ int` | `O(1)` | Cantidad de aristas dirigidas. / Count of directed edges. |

---

## 🧩 Decisiones de diseño / Design decisions

| Decisión / Decision | Alternativa considerada / Alternative | Razón / Reason |
|---|---|---|
| Herencia real desde `abstract class Node` | Valor embebido (composición) | PHP soporta herencia de clases (`extends`); una clase base `abstract class Node` encapsula el valor y evita instanciación directa no deseada, cumpliendo el contrato de la especificación sin duplicar campos. / PHP supports class inheritance (`extends`); an `abstract class Node` encapsulates the value and prevents direct instantiation, satisfying the specification contract without duplicate fields. |
| Cinco clases en un único archivo `src/DataStructuresAdvanced.php` | Un archivo por clase (PSR-4 estricto) | Las cinco clases forman una unidad conceptual cohesiva alrededor del nodo base y las estructuras avanzadas; un solo archivo evita fragmentación de código y simplifica el classmap. / The five classes form a cohesive conceptual unit around the base node and advanced structures; a single file avoids code fragmentation and simplifies classmap loading. |
| Registro de vértices como lista enlazada manual | Array asociativo o `SplObjectStorage` | El contrato exige explícitamente una implementación manual del registro canónico de vértices (`O(V)`) sin delegar en diccionarios, tablas hash o estructuras indexadas de biblioteca. / The contract explicitly requires a manual implementation of the canonical vertex registry (`O(V)`) without delegating to library dictionaries, hash tables, or indexed structures. |
| Inserción ordenada manual con `array_splice` en `GraphNode` | Llamar a `sort()` tras cada inserción o usar estructuras externas | Mantener los vecinos ordenados en `O(d(u))` al insertar garantiza determinismo sin degradar las cotas asintóticas ni delegar en algoritmos de alto nivel. / Maintaining sorted neighbors in `O(d(u))` at insertion time guarantees determinism without degrading asymptotic bounds or delegating to high-level algorithms. |
| Copia por valor mediante `array_map` en `getNeighbors` | Devolver referencia a la colección interna | Devolver un array nativo con enteros mapeados garantiza el aislamiento del resultado: modificaciones externas no mutan el grafo. / Returning a native array with mapped integers guarantees result isolation: external modifications do not mutate the graph. |

---

## 🔀 Adaptaciones idiomáticas / Idiomatic adaptations

| Especificación / Specification | Adaptación / Adaptation | Justificación / Justification |
|---|---|---|
| `Node` con `value` | `abstract class Node` con `$value` protegido | PHP soporta clases abstractas con modificadores de visibilidad; previene instancias aisladas de `Node`. / PHP supports abstract classes with visibility modifiers; prevents standalone instances of `Node`. |
| Ausencia nativa de nodo (`absent`) | `null` con tipos anulables (`?TreeNode`, `?GraphNode`) | PHP dispone de tipos anulables nativos; `null` es la representación canónica de ausencia. / PHP has native nullable types; `null` is the canonical representation of absence. |
| `Graph.get_neighbors(u)` con fallo | Devuelve `null` en caso de vértice inexistente | PHP no posee tipo `Option` en su biblioteca estándar; `null` distingue de forma no ambigua el fallo del caso de vértice aislado (que devuelve `[]`). / PHP lacks an `Option` type in standard library; `null` unambiguously distinguishes failure from an isolated vertex (which returns `[]`). |
| Métodos en `snake_case` (`get_value`, `set_left`, `has_edge`) | Métodos en `camelCase` (`getValue`, `setLeft`, `hasEdge`) | PHP sigue PSR-12 para nombres de métodos; `camelCase` es el estándar idiomático. / PHP follows PSR-12 for method names; `camelCase` is the idiomatic standard. |
| Operaciones con éxito/fallo (`insert`, `addEdge`, `contains`, `hasEdge`) | Retorno de tipo `bool` (`true`/`false`) | `bool` es el indicador natural en PHP para operaciones de éxito/fallo o pertenencia. / `bool` is the natural PHP indicator for success/failure or membership operations. |
| Ubicación esperada: `data_structures_advanced.ext` | `src/DataStructuresAdvanced.php` | Convención PSR-4 / PascalCase de PHP. / PHP PSR-4 / PascalCase convention. |
| Ubicación esperada: `run_tests.ext` | No existe; PHPUnit actúa como test runner | PHPUnit descubre y ejecuta los tests de forma nativa. / PHPUnit discovers and runs tests natively. |

---

## 🚨 Indicadores de fallo / Failure indicators

| Operación / Operation | Situación de fallo / Failure situation | Indicador / Indicator | Ejemplo / Example |
|---|---|---|---|
| `TreeNode.getLeft()`, `getRight()` | Enlace ausente | `null` | `$node->getLeft() === null` en nodo recién creado. / `$node->getLeft() === null` on freshly created node. |
| `BinaryTree.contains(value)` | Valor ausente en el árbol | `false` | `$tree->contains(99) === false`. |
| `Graph.addEdge(u, v)` | Extremo `u` o `v` inexistente | `false` | `$graph->addEdge(10, 99) === false`. |
| `Graph.hasEdge(u, v)` | Arista ausente o extremos inexistentes | `false` | `$graph->hasEdge(10, 30) === false`. |
| `Graph.getNeighbors(u)` | Vértice `u` inexistente | `null` | `$graph->getNeighbors(99) === null` (distinto de `[]` para vértice aislado). / `$graph->getNeighbors(99) === null` (distinct from `[]` for isolated vertex). |

---

## ✅ Cobertura de pruebas / Test coverage

### `TreeNode`

| Caso de la especificación / Specification case | Cubierto / Covered | Prueba / Test | Notas / Notes |
|---|---|:--:|---|
| Crear un nodo de árbol / Create a tree node | Sí | `testTreeNode` (caso `create a tree node`) | `TreeNode.init(10)` verifica `getValue() === 10`. |
| Enlaces iniciales ausentes / Absent initial links | Sí | `testTreeNode` (caso `absent initial links`) | `TreeNode.init(10)` verifica `getLeft() === null` y `getRight() === null`. |
| Enlazar dos hijos / Link two children | Sí | `testTreeNode` (caso `link two children`) | `setLeft(20)` y `setRight(30)` en el padre; verifica valores de los hijos. |
| Recorrer cada enlace / Traverse each link | Sí | `testTreeNode` (caso `traverse each link`) | Sigue `getLeft()` y `getRight()`; comprueba que sus enlaces sean `null`. |
| Desenlazar hijos / Unlink children | Sí | `testTreeNode` (caso `unlink children`) | Desconecta izquierdo y luego derecho con `null`; conserva valor 10. |
| Adaptación inmutable (si aplica) / Immutable adaptation (if applicable) | Omitido | — | `TreeNode` es mutable en PHP; la especificación declara la prueba condicional. / `TreeNode` is mutable in PHP; the specification marks this case conditional. |

### `BinaryTree`

| Caso de la especificación / Specification case | Cubierto / Covered | Prueba / Test | Notas / Notes |
|---|---|:--:|---|
| Crear vacío / Create empty | Sí | `testBinaryTree` (caso `create empty`) | `isEmpty() === true`, `size() === 0`, `contains(50) === false`. |
| Insertar la raíz / Insert the root | Sí | `testBinaryTree` (caso `insert the root`) | `insert(50)` retorna `true`, `size() === 1`, `contains(50) === true`. |
| Insertar menor y mayor / Insert lower and higher | Sí | `testBinaryTree` (caso `insert lower and higher`) | Inserta 50, 30, 70; tamaño 3 y los 3 presentes. |
| Ramas de varios niveles / Multilevel branches | Sí | `testBinaryTree` (caso `multilevel branches`) | Inserta 50, 30, 70, 20, 40; tamaño 5 y los 5 presentes. |
| Valor ausente en árbol no vacío / Missing value in nonempty tree | Sí | `testBinaryTree` (caso `missing value in nonempty tree`) | Inserta 50; `contains(99) === false`, tamaño 1 y 50 presente. |
| Duplicado idempotente / Idempotent duplicate | Sí | `testBinaryTree` (caso `idempotent duplicate`) | Inserta 50, 30, 70, 30; tamaño 3 y valores conservados. |
| Inserciones ordenadas / Ordered insertions | Sí | `testBinaryTree` (caso `ordered insertions`) | Inserta 20, 30, 40, 50, 70; tamaño 5 y `contains(99) === false`. |

### `Graph`

| Caso de la especificación / Specification case | Cubierto / Covered | Prueba / Test | Notas / Notes |
|---|---|:--:|---|
| Crear vacío / Create empty | Sí | `testGraph` (caso `create empty`) | `isEmpty() === true`, `vertexCount() === 0`, `edgeCount() === 0`, `hasEdge(10,30) === false`, `getNeighbors(10) === null`. |
| Vértice aislado / Isolated vertex | Sí | `testGraph` (caso `isolated vertex`) | `addVertex(10)`; 1 vértice, 0 aristas, vecinos de 10 es `[]`. |
| Etiquetas no consecutivas y arista dirigida / Nonconsecutive labels and directed edge | Sí | `testGraph` (caso `nonconsecutive labels and directed edge`) | Vértices 10, 70; arista (10,70); `hasEdge(10,70) === true` y `hasEdge(70,10) === false`. |
| Vértice duplicado conserva adyacencia / Duplicate vertex preserves adjacency | Sí | `testGraph` (caso `duplicate vertex preserves adjacency`) | Arista (10,30); segundo `addVertex(10)` conserva 2 vértices, 1 arista y vecinos `[30]`. |
| Arista duplicada / Duplicate edge | Sí | `testGraph` (caso `duplicate edge`) | `addEdge(10,30)` dos veces; 2 vértices, 1 arista, vecinos `[30]`. |
| Extremo inexistente sin mutación / Missing endpoint without mutation | Sí | `testGraph` (caso `missing endpoint without mutation`) | Cuatro intentos fallidos de aristas; contadores y adyacencias intactos; `getNeighbors(98)` y `(99)` devuelven `null`. |
| Vecinos ordenados y contadores / Sorted neighbours and counts | Sí | `testGraph` (caso `sorted neighbours and counts`) | Vértices 10, 30, 50, 70; aristas insertadas desordenadas; vecinos ordenados `[30, 50, 70]`. |
| Consulta de arista ausente / Missing-edge query | Sí | `testGraph` (caso `missing-edge query`) | Vértices 10, 30 sin arista; `hasEdge(10,30) === false`, 2 vértices, 0 aristas. |
| Vecinos de vértice inexistente / Neighbours of missing vertex | Sí | `testGraph` (caso `neighbours of missing vertex`) | `getNeighbors(99) === null`, distinto de `getNeighbors(10) === []`. |
| Bucle y duplicado / Self-loop and duplicate | Sí | `testGraph` (caso `self-loop and duplicate`) | `addEdge(10,10)` dos veces; `hasEdge(10,10) === true`, vecinos `[10]`, 1 arista. |
| Aislamiento del resultado de vecinos / Neighbour-result isolation | Sí | `testGraph` (caso `neighbour-result isolation`) | Modificar la copia del array retornado no altera el grafo ni futuras consultas. |

---

## ⚠️ Limitaciones conocidas / Known limitations

| Limitación / Limitation | Impacto / Impact | Alternativa o plan / Workaround or plan |
|---|---|---|
| Ninguna / None | No aplica / Not applicable | No aplica / Not applicable |

**ES:** El módulo implementa todas las operaciones del contrato con las complejidades declaradas; no hay límites arbitrarios de capacidad ni restricciones de uso pendientes.

**EN:** The module implements all contract operations with the declared complexities; there are no arbitrary capacity limits or pending usage restrictions.

---

## 📝 Notas de implementación / Implementation Notes

- **ES:** El proyecto no tiene punto de entrada `main`: el runner de PHPUnit actúa como ejecutor principal vía `composer test`.
- **EN:** The project has no `main` entry point: the PHPUnit runner acts as the test executor via `composer test`.
- **ES:** La base `Node` es `abstract class`: no puede instanciarse directamente y provee el valor a `TreeNode` y `GraphNode` mediante herencia real (`extends`), cumpliendo el contrato del módulo sin validaciones en la base.
- **EN:** The `Node` base is an `abstract class`: it cannot be directly instantiated and provides the value to `TreeNode` and `GraphNode` via real inheritance (`extends`), satisfying the module contract with no validations in the base.
- **ES:** `null` representa la ausencia de enlace en `TreeNode` y `GraphNode`, y el fallo en `Graph::getNeighbors` (distinguible del array vacío `[]` de un vértice aislado).
- **EN:** `null` represents link absence in `TreeNode` and `GraphNode`, and failure in `Graph::getNeighbors` (distinguishable from the empty array `[]` of an isolated vertex).
- **ES:** El registro canónico de vértices en `Graph` se gestiona como una lista enlazada manual a través del puntero `nextVertex` de `GraphNode`, garantizando una búsqueda `O(V)` sin emplear tablas hash ni mapas asociativos.
- **EN:** The canonical vertex registry in `Graph` is managed as a manual linked list via `GraphNode`'s `nextVertex` pointer, ensuring an `O(V)` traversal without using hash tables or associative maps.
- **ES:** Los vecinos de cada vértice se mantienen ordenados ascendentemente durante `addNeighbor` mediante inserción manual con `array_splice` en `O(d(u))`, evitando funciones de ordenación de alto nivel.
- **EN:** Neighbors of each vertex are kept in ascending order during `addNeighbor` through manual insertion with `array_splice` in `O(d(u))`, avoiding high-level sorting functions.
- **ES:** `getNeighbors` devuelve un array de enteros independientes generado con `array_map`; en PHP los arrays se asignan y pasan por valor, aislando el estado interno del grafo frente a mutaciones externas.
- **EN:** `getNeighbors` returns an independent integer array generated via `array_map`; in PHP arrays are assigned and passed by value, isolating internal graph state against external mutations.

---

## 🔍 Checklist de validación / Validation checklist

- [x] La suite nativa se ejecutó y su salida real está copiada en este README.
- [x] Cada caso de la especificación tiene su fila en _Cobertura de pruebas_ (o `Omitido` con razón).
- [x] Cada desviación del pseudocódigo o de la ubicación esperada está en _Adaptaciones idiomáticas_.
- [x] Cada operación con fallo posible está en _Indicadores de fallo_.
- [x] No hay rutas absolutas del autor, credenciales ni salidas inventadas.
- [x] Los enlaces relativos resuelven dentro del repositorio y el documento es bilingüe.
- [x] Ninguna sección repite lo que ya dice la especificación.

---

## 📚 Referencias / References

| Tipo / Kind | Referencia / Reference |
|---|---|
| Especificación / Specification | [`07_Data_Structures_Advanced.md`](https://yorche3.github.io/programming_languages/core/algorithms/07_Data_Structures_Advanced/) |
| Primera base del lenguaje / First language reference | `data_structures_basics` — [`../data_structures_basics/`](../data_structures_basics/) |
| Segunda base del lenguaje / Second language reference | `numbers` — [`../../foundations/numbers/`](../../foundations/numbers/) |
| Guía de inicialización / Initialisation guide | [`core/00_Project_Initialization_Guide.md`](https://yorche3.github.io/programming_languages/core/00_Project_Initialization_Guide.html) |
| Adaptaciones idiomáticas / Idiomatic adaptations | [`AGENT_Template.md`](https://yorche3.github.io/programming_languages/docs/AGENT_Template.html) |
| Validación de la documentación / Documentation validation | [`WORKFLOW.md`](https://yorche3.github.io/programming_languages/docs/WORKFLOW.html) |
| Documentación oficial del lenguaje / Language official docs | [PHP: Hypertext Preprocessor](https://www.php.net/) |

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
