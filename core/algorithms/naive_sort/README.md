# Naive Sort — PHP

Implementación de la especificación [05_Naive_Sort](https://yorche3.github.io/programming_languages/core/algorithms/05_Naive_Sort/) en **PHP**, usando una estructura tipo librería con `src/` y `test/` y **PHPUnit** (gestionado con Composer) como framework de pruebas.

Los tres algoritmos elementales de ordenamiento $O(n^2)$ — **selection sort**, **bubble sort** e **insertion sort** — reciben un array de enteros, lo ordenan de menor a mayor y devuelven el array ordenado, sin invocar ninguna función de ordenamiento de la biblioteca estándar.

No se requiere `sudo`.

---

## 📂 Archivos y estructura / Files & Structure

| Archivo | Propósito |
|---------|-----------|
| [`src/NaiveSort.php`](src/NaiveSort.php) | Clase `NaiveSort` — único archivo con los 3 métodos del contrato. |
| [`test/NaiveSortTest.php`](test/NaiveSortTest.php) | Suite PHPUnit: 3 tests (uno por algoritmo) con los 7 casos. |
| [`composer.json`](composer.json) | Dependencias del proyecto (PHPUnit como *dev*), autoload por *classmap* y script `test`. |
| [`phpunit.xml`](phpunit.xml) | Configuración de PHPUnit (bootstrap del autoload y suite sobre `test/`). |
| [`.gitignore`](.gitignore) | Ignora `vendor/`, `composer.lock` y las cachés de PHPUnit. |

**Estructura de directorios / Directory structure:**

```text
naive_sort/
├── composer.json              # PHPUnit (dev) + autoload classmap + script test
├── phpunit.xml                # bootstrap + suite sobre test/
├── src/
│   └── NaiveSort.php          # clase NaiveSort: 3 algoritmos
├── test/
│   └── NaiveSortTest.php      # suite PHPUnit: 3 tests × 7 casos (21 aserciones)
├── .gitignore
└── README.md
```

---

## 🛠️ Enfoque y construcción / Approach & Build

**ES:** El proyecto se creó manualmente como una librería PHP, igual que `core/foundations/numbers/` y `core/foundations/unit_test/calculator/`: implementación en `src/`, suites en `test/`, PHPUnit declarado en `composer.json` y autoload por *classmap*, así que la suite no hace ningún `require`.

**EN:** The project was created by hand as a PHP library, like `core/foundations/numbers/` and `core/foundations/unit_test/calculator/`: implementation under `src/`, suites under `test/`, PHPUnit declared in `composer.json`, and *classmap* autoloading, so the suite performs no `require`.

### Inicialización / Initialization

```bash
mkdir -p php/core/algorithms/naive_sort/{src,test}
cd php/core/algorithms/naive_sort
composer require --dev phpunit/phpunit
```

Después se añaden la clase en `src/`, la suite en `test/`, `phpunit.xml` y el `.gitignore`.

---

## 📄 Configuración clave / Key Configuration

### `composer.json`

**ES:** Declara PHPUnit como dependencia de desarrollo (`phpunit/phpunit: ^13.3`), publica `src/` y `test/` por *classmap* y registra el script `composer test`.

**EN:** It declares PHPUnit as a development dependency (`phpunit/phpunit: ^13.3`), publishes `src/` and `test/` through a *classmap*, and registers the `composer test` script.

```json
"require-dev": {
    "phpunit/phpunit": "^13.3"
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
```

### `src/NaiveSort.php` — contrato e implementación

**ES:** La clase `NaiveSort` expone tres métodos estáticos. Cada uno recibe el array, trabaja sobre su propia copia y devuelve el array ordenado; ninguna función lanza excepciones.

**EN:** The `NaiveSort` class exposes three static methods. Each one receives the array, works on its own copy, and returns the sorted array; no function throws.

| Elemento del contrato | Representación en PHP |
| --------------------- | --------------------- |
| Array de enteros | `array` (índices 0-based; `int[]` en la especificación) |
| Caso nulo / inválido | Omitido: `array` no admite `null` sin la anotación `?array` |
| Array vacío | `[]` (`count($arr) === 0`) |
| Orden | sobre una copia propia del array recibido, devuelve el array ordenado |
| Nombres de la especificación | `selectionSort`, `bubbleSort`, `insertionSort` (camelCase, la convención de métodos de PHP; la especificación los escribe `snake_case`) |

```php
public static function selectionSort(array $arr): array
{
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$j] < $arr[$minIndex]) {
                $minIndex = $j;
            }
        }
        if ($minIndex !== $i) {
            [$arr[$i], $arr[$minIndex]] = [$arr[$minIndex], $arr[$i]];
        }
    }
    return $arr;
}
```

### Suite de pruebas / Test suite

**ES:** La suite usa constantes nombradas por caso, una tabla `CASES` (descripción → entrada y salida esperada) y un único helper compartido que recibe la función a probar y el nombre del algoritmo. PHPUnit admite mensaje en `assertSame`, así que cada fallo reporta el mensaje del contrato.

**EN:** The suite uses named constants per case, a `CASES` table (description → input and expected output), and a single shared helper that receives the function under test and the algorithm name. PHPUnit accepts a message in `assertSame`, so every failure reports the contract message.

```php
private static function assertSortsAllCases(callable $sort, string $algorithm): void
{
    foreach (self::CASES as $description => [$input, $expected]) {
        $actual = $sort($input);

        self::assertSame(
            $expected,
            $actual,
            sprintf('%s should sort %s', $algorithm, $description)
        );
    }
}
```

---

## 🚀 Compilación y ejecución / Build & Run

### Requisitos / Requirements

- **PHP 8.5.10**.
- **Composer 2.10.3** para instalar la dependencia de desarrollo.

```bash
php --version
composer --version
```

Salida verificada:

```text
PHP 8.5.10 (cli) (built: Aug 25 2026 21:09:32) (NTS)
```

```text
Composer version 2.10.3 2026-08-27 13:34:23
PHP version 8.5.10 (/home/linuxbrew/.linuxbrew/Cellar/php/8.5.10/bin/php)
```

### Verificar sintaxis sin ejecutar / Check syntax without running

```bash
cd php/core/algorithms/naive_sort
php -l src/NaiveSort.php
php -l test/NaiveSortTest.php
```

Salida verificada:

```text
No syntax errors detected in src/NaiveSort.php
No syntax errors detected in test/NaiveSortTest.php
```

### Ejecutar las pruebas / Run tests

```bash
cd php/core/algorithms/naive_sort
composer install
composer test        # equivale a: vendor/bin/phpunit
```

**Salida real / Actual output:**

```text
PHPUnit 13.3.4 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.10
Configuration: /home/yorche3/programming_languages/php/core/algorithms/naive_sort/phpunit.xml

...                                                                 3 / 3 (100%)

Time: 00:00.001, Memory: 18.00 MB

OK (3 tests, 21 assertions)
```

> **ES:** PHPUnit cuenta 3 tests; los 21 casos (7 por algoritmo) viven como aserciones dentro de ellos. El código de salida es `0`.
> **EN:** PHPUnit counts 3 tests; the 21 cases (7 per algorithm) live as assertions within them. The exit code is `0`.

---

## 🧠 Algoritmos y operaciones / Algorithms & Operations

| Función / Algorithm | Enfoque / Approach | Descripción / Description |
| ------------------- | ------------------ | ------------------------- |
| `selectionSort($arr)` | iterativo, sobre copia propia | Busca el mínimo del tramo no ordenado con `$minIndex` y lo intercambia al inicio mediante desestructuración (`[$a, $b] = [$b, $a]`). $O(n^2)$ siempre. |
| `bubbleSort($arr)` | iterativo, con bandera | Compara adyacentes e intercambia; sale antes con `break` cuando `$swapped` queda en `false`. $O(n^2)$ peor/promedio, $O(n)$ mejor. |
| `insertionSort($arr)` | iterativo, estable | Guarda `$key`, desplaza el tramo ordenado con `while ($j >= 0 && $arr[$j] > $key)` y lo inserta en su posición. $O(n^2)$ peor/promedio, $O(n)$ mejor. |

| Caso (descripción en la suite) | Entrada | Salida esperada |
| ------------------------------ | ------- | --------------- |
| an unsorted array | `[5, 2, 9, 1, 5, 6]` | `[1, 2, 5, 5, 6, 9]` |
| an already sorted array | `[1, 2, 3, 4, 5]` | `[1, 2, 3, 4, 5]` |
| a reverse ordered array | `[5, 4, 3, 2, 1]` | `[1, 2, 3, 4, 5]` |
| an array of identical elements | `[7, 7, 7, 7]` | `[7, 7, 7, 7]` |
| an array with negative numbers | `[3, -1, 4, -5, 0]` | `[-5, -1, 0, 3, 4]` |
| a single element array | `[42]` | `[42]` |
| an empty array | `[]` | `[]` |

---

## 📝 Notas de implementación / Implementation Notes

- **ES:** Divergencia idiomática aceptada: los tres métodos trabajan sobre **su propia copia** del array recibido y devuelven el array ordenado, la variante «copia ordenada» que la especificación permite junto con el orden *in-place*. En PHP los arrays son tipos de valor (*copy-on-write*), así que la mutación no alcanza al array del llamador salvo que se pase por referencia (`array &$arr`), cosa que este módulo no hace.
- **EN:** Accepted idiomatic divergence: all three methods work on **their own copy** of the received array and return the sorted array, the "sorted copy" variant that the specification allows alongside *in-place* sorting. In PHP, arrays are value types (*copy-on-write*), so the mutation does not reach the caller's array unless the parameter is passed by reference (`array &$arr`), which this module does not do.
- **ES:** El `if n <= 1 / return arr` del pseudocódigo no se escribe de forma explícita: las cotas de los bucles ya devuelven el array intacto. Con `$n = 0`, `$n - 1` es `-1` y la condición `$i < -1` nunca se cumple, así que el array vacío se devuelve sin cambios; con `$n = 1` tampoco hay iteraciones. El comportamiento observable coincide con el contrato.
- **EN:** The pseudocode's `if n <= 1 / return arr` is not written explicitly: the loop bounds already return the array untouched. With `$n = 0`, `$n - 1` is `-1` and the condition `$i < -1` is never true, so the empty array is returned unchanged; with `$n = 1` there are no iterations either. The observable behavior matches the contract.
- **ES:** Caso nulo omitido: `array` no admite `null` sin la anotación `?array` (equivalente a `int[]?` de otros lenguajes), que se formaliza en la fase de abstracción y persistencia, así que no hay indicador de fallo que comprobar. Se conservan los 7 casos. Ninguna función lanza excepciones.
- **EN:** Null case omitted: `array` does not admit `null` without the `?array` annotation (equivalent to other languages' `int[]?`), which is formalized in the abstraction and persistence phase, so there is no failure indicator to check. The 7 cases are kept. No function throws.
- **ES:** `bubbleSort` conserva la optimización de salida temprana: la bandera `$swapped` y el `break` reproducen el `if not swapped: break` del pseudocódigo (mejor caso $O(n)$). La bandera no es observable en la salida, así que su presencia se verifica contra el pseudocódigo.
- **EN:** `bubbleSort` keeps the early-exit optimization: the `$swapped` flag and the `break` reproduce the pseudocode's `if not swapped: break` (best case $O(n)$). The flag is not observable in the output, so its presence is verified against the pseudocode.
- **ES:** El bucle interior de `bubbleSort` es `for ($j = 0; $j < $n - $i - 1; $j++)`, el equivalente exacto de `for j = 0 to n - 2 - i` del pseudocódigo.
- **EN:** The inner loop of `bubbleSort` is `for ($j = 0; $j < $n - $i - 1; $j++)`, the exact equivalent of the pseudocode's `for j = 0 to n - 2 - i`.
- **ES:** `insertionSort` usa la condición `$j >= 0 && $arr[$j] > $key`; `&&` evalúa en cortocircuito, así que la guarda `$j >= 0` protege el acceso `$arr[$j]` cuando `$j` llega a `-1`. Al ser `$j` un entero con signo no hay riesgo de *underflow* y la comparación estricta mantiene el algoritmo estable.
- **EN:** `insertionSort` uses the condition `$j >= 0 && $arr[$j] > $key`; `&&` short-circuits, so the `$j >= 0` guard protects the `$arr[$j]` access when `$j` reaches `-1`. Since `$j` is a signed integer there is no *underflow* risk, and the strict comparison keeps the algorithm stable.
- **ES:** Ninguno de los tres métodos invoca `sort`, `rsort`, `asort`, `usort` ni ninguna otra ayuda de ordenamiento de la biblioteca estándar: solo comparaciones, índices e intercambios.
- **EN:** None of the three methods calls `sort`, `rsort`, `asort`, `usort`, or any other standard-library sorting helper: only comparisons, indexes, and swaps.
- **ES:** El aislamiento de los casos es estructural: los arrays de PHP son tipos de valor, así que el helper recibe en cada caso una copia nueva de la constante y ninguna entrada compartida puede quedar contaminada por el ordenamiento.
- **EN:** Case isolation is structural: PHP arrays are value types, so the helper receives a fresh copy of the constant in every case and no shared fixture can be polluted by the sort.
- **ES:** Nota de desviación respecto a la ubicación esperada: `src/NaiveSort.php` y `test/NaiveSortTest.php` usan el nombre de la clase en `PascalCase`, la convención de archivos de PHP (PSR-4: un archivo por clase), y se añaden `composer.json`, `phpunit.xml` y `.gitignore`; no se añade `run_tests.php` porque `composer test` ejecuta PHPUnit. `vendor/` y `composer.lock` quedan fuera del repositorio.
- **EN:** Deviation note from the expected location: `src/NaiveSort.php` and `test/NaiveSortTest.php` use the class name in `PascalCase`, PHP's file naming convention (PSR-4: one file per class), and `composer.json`, `phpunit.xml`, and `.gitignore` are added; no `run_tests.php` is added because `composer test` runs PHPUnit. `vendor/` and `composer.lock` stay out of the repository.

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*[← Volver a Algoritmos Puros](../README.md)*

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
