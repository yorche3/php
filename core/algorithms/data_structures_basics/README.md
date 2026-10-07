# Data Structures Basics — PHP

Implementación de la especificación [06_Data_Structures_Basics](https://yorche3.github.io/programming_languages/core/algorithms/06_Data_Structures_Basics/) en **PHP**, con un enfoque manual y minimalista.

**ES:** Cuatro estructuras (`Node`, `LinkedList`, `Stack`, `Queue`) construidas a mano sobre un único tipo de nodo enlazado, con **PHPUnit** (gestionado con Composer) como framework de pruebas.

**EN:** Four structures (`Node`, `LinkedList`, `Stack`, `Queue`) built by hand over a single linked-node type, with **PHPUnit** (managed via Composer) as the test framework.

---

## 📂 Archivos y estructura / Files & Structure

| Archivo / Directorio | Propósito / Purpose |
|---|---|
| [`composer.json`](composer.json) | Manifiesto: PHPUnit como dependencia de desarrollo y autoload de `src/`. / Manifest: PHPUnit as dev dependency and `src/` autoload. |
| [`phpunit.xml`](phpunit.xml) | Configuración de PHPUnit: bootstrap del autoload y suite sobre `test/`. / PHPUnit configuration: autoload bootstrap and suite over `test/`. |
| [`src/DataStructuresBasics.php`](src/DataStructuresBasics.php) | Cuatro clases `final` (`Node`, `LinkedList`, `Stack`, `Queue`) en un único archivo. / Four `final` classes (`Node`, `LinkedList`, `Stack`, `Queue`) in a single file. |
| [`test/DataStructuresBasicsTest.php`](test/DataStructuresBasicsTest.php) | Suite con 4 tests y 15 aserciones que cubren los casos de la especificación. / Suite with 4 tests and 15 assertions covering the specification cases. |
| [`.gitignore`](.gitignore) | Ignora `vendor/`, `composer.lock` y las cachés de PHPUnit. / Ignores `vendor/`, `composer.lock` and PHPUnit caches. |

```text
data_structures_basics/
├── composer.json                       # PHPUnit (dev) + autoload classmap
├── phpunit.xml                         # bootstrap + suite sobre test/
├── src/
│   └── DataStructuresBasics.php        # Node, LinkedList, Stack, Queue
├── test/
│   └── DataStructuresBasicsTest.php    # 4 tests, 15 aserciones
├── .gitignore
└── README.md
```

**ES:** Desviación respecto a la ubicación esperada por la especificación: el pseudocódigo propone `data_structures_basics.ext` y `data_structures_basics_test.ext`, pero PHP sigue PSR-4 (un archivo por clase, en `PascalCase`); las cuatro clases comparten archivo porque comparten el tipo `Node`. No hay `run_tests.ext` porque PHPUnit aporta el runner. `vendor/` y `composer.lock` quedan excluidos del repositorio.

**EN:** Deviation from the specification's expected location: the pseudocode proposes `data_structures_basics.ext` and `data_structures_basics_test.ext`, but PHP follows PSR-4 (one file per class, in `PascalCase`); the four classes share a file because they share the `Node` type. There is no `run_tests.ext` because PHPUnit provides the runner. `vendor/` and `composer.lock` are excluded from the repository.

---

## 🛠️ Enfoque y construcción / Approach & Build

**ES:** Librería PHP con la implementación en `src/`, la suite en `test/` y PHPUnit como runner. Las cuatro clases se declaran `final` para evitar herencia no deseada; cada ADT gestiona sus propios punteros y no delega operaciones en otro.

**EN:** PHP library with the implementation under `src/`, the suite under `test/`, and PHPUnit as the runner. The four classes are declared `final` to prevent unwanted inheritance; each ADT manages its own pointers and does not delegate operations to another.

### Inicialización / Initialization

```bash
mkdir -p php/core/algorithms/data_structures_basics/{src,test}
cd php/core/algorithms/data_structures_basics
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
    "scripts": {
        "test": "phpunit"
    }
}
```

**ES:** El autoload por *classmap* publica `src/` para que las suites no necesiten `require`.

**EN:** The *classmap* autoload publishes `src/` so the suites need no `require`.

### `phpunit.xml`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
         cacheDirectory=".phpunit.cache">
    <testsuites>
        <testsuite name="data_structures_basics">
            <directory>test</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

---

## 🚀 Compilación y ejecución / Build & Run

### Requisitos / Requirements

- **PHP 8.5.10**.
- **Composer 2.10.3** para instalar la dependencia de desarrollo.

Verificar el entorno:

```bash
php --version
composer --version
```

### Instalar las dependencias / Install dependencies

```bash
cd php/core/algorithms/data_structures_basics
composer install
```

### Verificar sintaxis sin ejecutar / Check syntax without running

```bash
php -l src/DataStructuresBasics.php
php -l test/DataStructuresBasicsTest.php
```

**Salida real / Actual output:**

```text
No syntax errors detected in src/DataStructuresBasics.php
No syntax errors detected in test/DataStructuresBasicsTest.php
```

### Ejecutar las pruebas / Run tests

```bash
cd php/core/algorithms/data_structures_basics
composer test
```

**Salida real / Actual output:**

```text
PHPUnit 13.4.1 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.10
Configuration: ~/programming_languages/php/core/algorithms/data_structures_basics/phpunit.xml

....                                                                4 / 4 (100%)

Time: 00:00.001, Memory: 20.00 MB

Data Structures Basics
 ✔ Node
 ✔ Linked list
 ✔ Stack
 ✔ Queue

OK (4 tests, 15 assertions)
```

---

## 🧠 Algoritmos y operaciones / Algorithms & Operations

### `Node`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init(value)` | `int → self` | `O(1)` | Asigna `value` y deja `next` en `null`. / Sets `value` and leaves `next` as `null`. |
| `getValue()` | `→ int` | `O(1)` | Devuelve el valor almacenado. / Returns the stored value. |
| `getNext()` | `→ ?Node` | `O(1)` | Devuelve el enlace o `null`. / Returns the link or `null`. |
| `setNext(next)` | `?Node → self` | `O(1)` | Enlaza otro nodo; devuelve la instancia. / Links another node; returns the instance. |

### `LinkedList`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init()` | `→ void` | `O(1)` | Cabeza, cola y contador a cero. / Head, tail and count to zero. |
| `isEmpty()` | `→ bool` | `O(1)` | `true` cuando `count === 0`. / `true` when `count === 0`. |
| `size()` | `→ int` | `O(1)` | Devuelve `count`. / Returns `count`. |
| `getHead()` | `→ int` | `O(1)` | Valor de la cabeza o `-1` si está vacía. / Head value or `-1` if empty. |
| `insertHead(value)` | `int → void` | `O(1)` | Inserta al inicio; actualiza cabeza y cola si estaba vacía. / Inserts at the front; updates head and tail if empty. |
| `insertTail(value)` | `int → void` | `O(1)` | Inserta al final; actualiza cabeza y cola si estaba vacía. / Inserts at the end; updates head and tail if empty. |
| `delete(value)` | `int → bool` | `O(n)` | Elimina la primera aparición; devuelve `true` en éxito, `false` si no está. / Removes the first occurrence; returns `true` on success, `false` if absent. |

### `Stack`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init()` | `→ void` | `O(1)` | `top` en `null` y contador a cero. / `top` as `null` and count to zero. |
| `isEmpty()` | `→ bool` | `O(1)` | `true` cuando `count === 0`. / `true` when `count === 0`. |
| `size()` | `→ int` | `O(1)` | Devuelve `count`. / Returns `count`. |
| `push(value)` | `int → void` | `O(1)` | Coloca el valor sobre `top`. / Places the value on `top`. |
| `pop()` | `→ int` | `O(1)` | Extrae el tope o `-1` si está vacía. / Removes the top or `-1` if empty. |
| `peek()` | `→ int` | `O(1)` | Observa el tope sin extraerlo o `-1` si está vacía. / Observes the top without removing it or `-1` if empty. |

### `Queue`

| Operación / Operation | Entrada → salida / Input → output | Complejidad / Complexity | Notas / Notes |
|---|---|---|---|
| `init()` | `→ void` | `O(1)` | `front` y `rear` en `null`, contador a cero. / `front` and `rear` as `null`, count to zero. |
| `isEmpty()` | `→ bool` | `O(1)` | `true` cuando `count === 0`. / `true` when `count === 0`. |
| `size()` | `→ int` | `O(1)` | Devuelve `count`. / Returns `count`. |
| `enqueue(value)` | `int → void` | `O(1)` | Añade el valor tras `rear`. / Adds the value after `rear`. |
| `dequeue()` | `→ int` | `O(1)` | Extrae `front` o `-1` si está vacía; ajusta `rear` a `null` si queda vacía. / Removes `front` or `-1` if empty; sets `rear` to `null` if it becomes empty. |
| `peek()` | `→ int` | `O(1)` | Observa `front` sin extraerlo o `-1` si está vacía. / Observes `front` without removing it or `-1` if empty. |

---

## 🧩 Decisiones de diseño / Design decisions

| Decisión / Decision | Alternativa considerada / Alternative | Razón / Reason |
|---|---|---|
| Cuatro clases `final` en un único archivo | Un archivo por clase (PSR-4 estricto) | Las cuatro comparten el tipo `Node`; un solo archivo reduce la fragmentación y mantiene la cohesión del módulo. / The four share the `Node` type; a single file reduces fragmentation and keeps the module cohesive. |
| `init` como método de instancia | Constructor con parámetros | La especificación exige `init` explícito antes de cualquier otra operación; usar el constructor obligaría a pasar valores en la declaración. / The specification requires explicit `init` before any other operation; using the constructor would force passing values at declaration. |
| `delete` devuelve `bool` | Devolver el nodo eliminado o un código de estado | El contrato pide éxito o fallo; `bool` es el indicador natural en PHP para operaciones que pueden fallar. / The contract asks for success or failure; `bool` is PHP's natural indicator for operations that can fail. |
| `getHead`, `pop`, `peek`, `dequeue` devuelven `-1` en fallo | Lanzar una excepción o devolver `null` | La especificación permite el indicador natural del lenguaje; `-1` es un centinela entero que no colisiona con los valores de prueba (enteros positivos). / The specification allows the language's natural indicator; `-1` is an integer sentinel that does not collide with test values (positive integers). |

---

## 🔀 Adaptaciones idiomáticas / Idiomatic adaptations

| Especificación / Specification | Adaptación / Adaptation | Justificación / Justification |
|---|---|---|
| `type Node` con `value` y `next` | Clase `final class Node` con propiedades `private` | PHP usa clases para encapsular estado; `private` protege la representación interna. / PHP uses classes to encapsulate state; `private` protects the internal representation. |
| `init(value)` como procedimiento | Método `init(int $value): ?self` que devuelve `$this` | PHP permite encadenar métodos; devolver la instancia facilita la fluidez sin cambiar la semántica. / PHP allows method chaining; returning the instance enables fluency without changing semantics. |
| `next` como ausencia nativa | `?Node` con `null` | PHP soporta tipos anulables; `null` es la representación nativa de ausencia. / PHP supports nullable types; `null` is the native representation of absence. |
| `get_head()` devuelve indicador de fallo | `getHead(): int` devuelve `-1` | PHP no tiene `Option` en la biblioteca estándar; `-1` es un centinela entero que no colisiona con los valores de prueba. / PHP has no `Option` in the standard library; `-1` is an integer sentinel that does not collide with test values. |
| `delete(value)` devuelve éxito o fallo | `delete(int $value): bool` | PHP usa `bool` para operaciones que pueden fallar; es el indicador natural del lenguaje. / PHP uses `bool` for operations that can fail; it is the language's natural indicator. |
| Nombres en `snake_case` (`insert_head`, `insert_tail`) | Nombres en `camelCase` (`insertHead`, `insertTail`) | PHP sigue PSR-12 para métodos; `camelCase` es la convención idiomática. / PHP follows PSR-12 for methods; `camelCase` is the idiomatic convention. |
| Ubicación esperada: `data_structures_basics.ext` | `DataStructuresBasics.php` | PHP sigue PSR-4: un archivo por clase, en `PascalCase`. / PHP follows PSR-4: one file per class, in `PascalCase`. |
| Ubicación esperada: `run_tests.ext` | No existe; PHPUnit aporta el runner | PHPUnit descubre tests automáticamente; no se necesita un script de entrada. / PHPUnit discovers tests automatically; no entry script is needed. |

---

## 🚨 Indicadores de fallo / Failure indicators

| Operación / Operation | Situación de fallo / Failure situation | Indicador / Indicator | Ejemplo / Example |
|---|---|---|---|
| `getHead()` | Lista vacía | `-1` | Tras `init()`, `getHead()` devuelve `-1`. / After `init()`, `getHead()` returns `-1`. |
| `delete(value)` | Valor no está en la lista | `false` | `delete(99)` sobre `[5, 20, 10]` devuelve `false`. / `delete(99)` on `[5, 20, 10]` returns `false`. |
| `pop()` | Pila vacía | `-1` | Tras `init()`, `pop()` devuelve `-1`. / After `init()`, `pop()` returns `-1`. |
| `peek()` (Stack) | Pila vacía | `-1` | Tras `init()`, `peek()` devuelve `-1`. / After `init()`, `peek()` returns `-1`. |
| `dequeue()` | Cola vacía | `-1` | Tras `init()`, `dequeue()` devuelve `-1`. / After `init()`, `dequeue()` returns `-1`. |
| `peek()` (Queue) | Cola vacía | `-1` | Tras `init()`, `peek()` devuelve `-1`. / After `init()`, `peek()` returns `-1`. |

---

## ✅ Cobertura de pruebas / Test coverage

### `Node`

| Caso de la especificación / Specification case | Cubierto / Covered | Prueba / Test | Notas / Notes |
|---|---|:--:|---|
| Inicializar y observar valor/enlace | Sí | `testNode` | `init(10)`, `getValue()`, `getNext()`. |
| Inicializar otro nodo, enlazar y recorrer | Sí | `testNode` | `init(20)`, `setNext()`, `getNext()->getValue()`. |

### `LinkedList`

| Caso de la especificación / Specification case | Cubierto / Covered | Prueba / Test | Notas / Notes |
|---|---|:--:|---|
| Estado vacío | Sí | `testLinkedList` | `init()`, `isEmpty()`, `size()`, `getHead()`. |
| Insertar por ambos extremos | Sí | `testLinkedList` | `insertTail(10)`, `insertTail(20)`, `insertHead(5)`, `insertTail(10)`. |
| Eliminar primera aparición | Sí | `testLinkedList` | `delete(10)` devuelve `true`, tamaño `3`. |
| Valor ausente | Sí | `testLinkedList` | `delete(99)` devuelve `false`, tamaño no cambia. |
| Vaciar | Sí | `testLinkedList` | `delete(5)`, `delete(20)`, `delete(10)`; `isEmpty()` = `true`. |

### `Stack`

| Caso de la especificación / Specification case | Cubierto / Covered | Prueba / Test | Notas / Notes |
|---|---|:--:|---|
| Estado vacío y extracción fallida | Sí | `testStack` | `init()`, `isEmpty()`, `size()`, `peek()`, `pop()`. |
| LIFO y `peek` no mutante | Sí | `testStack` | `push(10)`, `push(20)`, `push(30)`, `peek()` = `30`. |
| Extracción y reutilización | Sí | `testStack` | `pop()`, `push(40)`, tres `pop()`; resultados `30`, `40`, `20`, `10`. |
| Vacío tras extracción | Sí | `testStack` | `pop()` devuelve `-1`, `isEmpty()` = `true`. |

### `Queue`

| Caso de la especificación / Specification case | Cubierto / Covered | Prueba / Test | Notas / Notes |
|---|---|:--:|---|
| Estado vacío y extracción fallida | Sí | `testQueue` | `init()`, `isEmpty()`, `size()`, `peek()`, `dequeue()`. |
| FIFO y `peek` no mutante | Sí | `testQueue` | `enqueue(10)`, `enqueue(20)`, `enqueue(30)`, `peek()` = `10`. |
| Extracción y reutilización | Sí | `testQueue` | `dequeue()`, `enqueue(40)`, tres `dequeue()`; resultados `10`, `20`, `30`, `40`. |
| Vacío tras extracción | Sí | `testQueue` | `dequeue()` devuelve `-1`, `isEmpty()` = `true`. |

---

## ⚠️ Limitaciones conocidas / Known limitations

Ninguna / None

**ES:** El módulo implementa todas las operaciones del contrato con las complejidades declaradas; no hay límites de capacidad ni restricciones de uso no documentadas.

**EN:** The module implements all contract operations with the declared complexities; there are no capacity limits or undocumented usage restrictions.

---

## 📝 Notas de implementación / Implementation Notes

- **ES:** El proyecto no tiene `main`: el «punto de entrada» es el runner de PHPUnit a través de `composer test`.
- **EN:** The project has no `main`: the "entry point" is PHPUnit's runner through `composer test`.
- **ES:** Las cuatro clases se declaran `final` para evitar herencia no deseada y mantener la cohesión del módulo.
- **EN:** The four classes are declared `final` to prevent unwanted inheritance and maintain module cohesion.
- **ES:** `Node` usa `?Node` para el enlace `next`; `null` representa la ausencia de enlace, siguiendo la convención de PHP para tipos anulables.
- **EN:** `Node` uses `?Node` for the `next` link; `null` represents link absence, following PHP's convention for nullable types.
- **ES:** `getHead`, `pop`, `peek` y `dequeue` devuelven `-1` como indicador de fallo; los valores de prueba son enteros positivos para no colisionar con este centinela.
- **EN:** `getHead`, `pop`, `peek` and `dequeue` return `-1` as the failure indicator; test values are positive integers to avoid colliding with this sentinel.
- **ES:** `delete` devuelve `bool` (`true` en éxito, `false` si el valor no está); es el indicador natural de PHP para operaciones que pueden fallar.
- **EN:** `delete` returns `bool` (`true` on success, `false` if the value is absent); it is PHP's natural indicator for operations that can fail.
- **ES:** Los nombres de los métodos usan `camelCase` (`insertHead`, `insertTail`) en lugar del `snake_case` del pseudocódigo (`insert_head`, `insert_tail`), siguiendo la convención de métodos de PHP (PSR-12).
- **EN:** Method names use `camelCase` (`insertHead`, `insertTail`) instead of the pseudocode's `snake_case` (`insert_head`, `insert_tail`), following PHP's method convention (PSR-12).
- **ES:** Ubicación respecto a la especificación: `src/DataStructuresBasics.php` y `test/DataStructuresBasicsTest.php` siguen la convención de nombres de PHP (PSR-4: un archivo por clase, en `PascalCase`); se añaden `composer.json`, `phpunit.xml` y `.gitignore`, y no hay `run_tests.php` porque PHPUnit aporta el runner. `vendor/` y `composer.lock` quedan excluidos del repositorio.
- **EN:** Location relative to the specification: `src/DataStructuresBasics.php` and `test/DataStructuresBasicsTest.php` follow PHP's naming convention (PSR-4: one file per class, in `PascalCase`); `composer.json`, `phpunit.xml`, and `.gitignore` are added, and there is no `run_tests.php` because PHPUnit provides the runner. `vendor/` and `composer.lock` are excluded from the repository.
- **ES:** Este proyecto también está implementado en otros lenguajes. Explora el repositorio principal para consultar las demás versiones.
- **EN:** This project is also implemented in other languages. Explore the main repository to see the other versions.

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
| Especificación / Specification | [`06_Data_Structures_Basics.md`](https://yorche3.github.io/programming_languages/core/algorithms/06_Data_Structures_Basics/) |
| Módulo homologado del lenguaje / Homologated module | [`php/core/foundations/numbers/`](../foundations/numbers/) |
| Guía de inicialización / Initialisation guide | [`core/00_Project_Initialization_Guide.md`](https://yorche3.github.io/programming_languages/core/00_Project_Initialization_Guide.html) |
| Adaptaciones idiomáticas / Idiomatic adaptations | [`AGENT_Template.md`](https://yorche3.github.io/programming_languages/docs/AGENT_Template.html) |
| Validación de la documentación / Documentation validation | [`WORKFLOW.md`](https://yorche3.github.io/programming_languages/docs/WORKFLOW.html) |
| Documentación oficial del lenguaje / Language official docs | [PHP: Hypertext Preprocessor](https://www.php.net/) |

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
