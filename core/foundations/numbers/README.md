# Numbers — PHP

Implementación de la especificación [04_Numbers](https://yorche3.github.io/programming_languages/core/foundations/04_Numbers/) en **PHP**, usando una estructura tipo librería con `src/` y `test/` y **PHPUnit** (gestionado con Composer) como framework de pruebas.

Cinco algoritmos numéricos (suma de los primeros `n`, factorial, Fibonacci, MCD y MCM) en tres enfoques: **recursivo directo** (`_rec`), **recursivo con acumulador** (`_acc`) e **iterativo** (`_ite`), con los sufijos PHP `Rec`, `Acc` e `Ite`.

No se requiere `sudo`.

---

## 📂 Archivos y estructura / Files & Structure

| Archivo / Directorio | Propósito |
|----------------------|-----------|
| [`composer.json`](composer.json) | Manifiesto: PHPUnit como dependencia de desarrollo y autoload de `src/` y `test/`. |
| [`phpunit.xml`](phpunit.xml) | Configuración de PHPUnit: bootstrap del autoload y suite sobre `test/`. |
| [`src/Numbers.php`](src/Numbers.php) | Clase `Numbers` — 15 métodos (3 enfoques × 5 algoritmos) + 4 helpers `private static`. |
| [`test/NumbersRecursiveTest.php`](test/NumbersRecursiveTest.php) | 5 tests para el enfoque recursivo directo (11 casos). |
| [`test/NumbersIterativeTest.php`](test/NumbersIterativeTest.php) | 5 tests para el enfoque iterativo (11 casos). |
| [`.gitignore`](.gitignore) | Ignora `vendor/`, `composer.lock` y las cachés de PHPUnit. |

```text
numbers/
├── composer.json                   # PHPUnit (dev) + autoload classmap
├── phpunit.xml                     # bootstrap + suite sobre test/
├── src/
│   └── Numbers.php                 # 15 métodos + 4 helpers private static
├── test/
│   ├── NumbersRecursiveTest.php    # tests recursivos (11 casos)
│   └── NumbersIterativeTest.php    # tests iterativos (11 casos)
├── .gitignore
└── README.md
```

---

## 🛠️ Enfoque y construcción / Approach & Build

**ES:** Sigue el mismo patrón que [`calculator`](../unit_test/calculator/): librería PHP con la implementación en `src/`, las suites en `test/` y PHPUnit como runner. Las 15 funciones se organizan en 3 grupos por enfoque:

| Enfoque | Sufijo | Ejemplo | ¿Tiene tests directos? |
| ------- | ------ | ------- | :---------------------: |
| Recursivo directo | `...Rec` | `fibonacciRec(n)` | ✅ Sí |
| Recursivo con acumulador | `...Acc` | `fibonacciAcc(n)` | ❌ No (ver nota TCO) |
| Iterativo | `...Ite` | `fibonacciIte(n)` | ✅ Sí |

**EN:** Follows the same pattern as [`calculator`](../unit_test/calculator/): a PHP library with the implementation under `src/`, the suites under `test/`, and PHPUnit as the runner. The 15 functions are organized into 3 groups by approach:

| Approach | Suffix | Example | Direct tests? |
| -------- | ------ | ------- | :-----------: |
| Direct recursion | `...Rec` | `fibonacciRec(n)` | ✅ Yes |
| Accumulator recursion | `...Acc` | `fibonacciAcc(n)` | ❌ No (see TCO note) |
| Iterative | `...Ite` | `fibonacciIte(n)` | ✅ Yes |

**Combinación aplicada:** TCO no garantizada + iteración nativa ✅ → `Rec` + `Ite` = **2 suites, 10 tests y 22 casos**.

**Applied combination:** No guaranteed TCO + native iteration ✅ → `Rec` + `Ite` = **2 suites, 10 tests, and 22 cases**.

### Inicialización / Initialization

```bash
mkdir -p php/core/foundations/numbers/{src,test}
cd php/core/foundations/numbers
composer require --dev phpunit/phpunit
```

Después se añaden la librería en `src/`, las dos suites en `test/`, el manifiesto `composer.json` y la configuración `phpunit.xml`.

---

## 📄 Archivos de configuración clave / Key Configuration Files

### `src/Numbers.php` — implementación

**ES:** Cada algoritmo tiene 3 implementaciones en un único archivo. Los helpers con acumulador son `private static`, así que quedan encapsulados en la clase. Por ejemplo, `fibonacci`:

**EN:** Each algorithm has 3 implementations in a single file. The accumulator helpers are `private static`, so they stay encapsulated in the class. For example, `fibonacci`:

```php
public static function fibonacciRec(int $n): int
{
    if ($n <= 1) {
        return $n;
    }

    return self::fibonacciRec($n - 1) + self::fibonacciRec($n - 2);
}

public static function fibonacciAcc(int $n): int
{
    return self::fibonacciAccHelp($n, 0, 1);
}

private static function fibonacciAccHelp(int $n, int $acc2, int $acc1): int
{
    if ($n <= 0) {
        return $acc2;
    }

    if ($n <= 2) {
        return $acc1 + $acc2;
    }

    return self::fibonacciAccHelp($n - 1, $acc1, $acc1 + $acc2);
}

public static function fibonacciIte(int $n): int
{
    if ($n <= 1) {
        return $n;
    }

    $acc2 = 0;
    $acc1 = 1;
    for ($i = 2; $i <= $n; $i++) {
        $temp = $acc1 + $acc2;
        $acc2 = $acc1;
        $acc1 = $temp;
    }

    return $acc1;
}
```

| Algoritmo | `_rec` | `_acc` | `_ite` |
| --------- | ------ | ------ | ------ |
| `sumOfFirstN` | `$n + sumRec($n - 1)` | helper con `$n + $acc` | bucle `1..n` |
| `factorial` | `$n * factRec($n - 1)` | helper con `$n * $acc` | bucle `2..n` |
| `fibonacci` | `fibRec($n-1) + fibRec($n-2)` | helper con `$acc2, $acc1` | bucle de intercambio |
| `greatestCommonDivisor` | Euclides recursivo | Euclides helper | Euclides con `while ($b !== 0)` |
| `leastCommonMultiple` | `intdiv($a * $b, gcdRec)` | `intdiv($a * $b, gcdAcc)` | `intdiv($a * $b, gcdIte)` |

### `test/NumbersRecursiveTest.php` y `test/NumbersIterativeTest.php`

**ES:** Cada método `test*` agrupa los casos de un algoritmo (11 aserciones por suite, 22 en total). PHPUnit descubre los métodos por el prefijo `test`, así que no hace falta un punto de entrada propio.

**EN:** Each `test*` method groups the cases of one algorithm (11 assertions per suite, 22 in total). PHPUnit discovers the methods by the `test` prefix, so no custom entry point is needed.

```php
public function testFibonacciRec(): void
{
    self::assertSame(0, Numbers::fibonacciRec(0));
    self::assertSame(1, Numbers::fibonacciRec(1));
    self::assertSame(8, Numbers::fibonacciRec(6));
}
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

Salida verificada:

```text
PHP 8.5.10 (cli) (built: Aug 25 2026 21:09:32) (NTS)
```

```text
Composer version 2.10.3 2026-08-27 13:34:23
PHP version 8.5.10 (/home/linuxbrew/.linuxbrew/Cellar/php/8.5.10/bin/php)
```

### Instalar las dependencias / Install dependencies

```bash
cd php/core/foundations/numbers
composer install
```

### Verificar sintaxis sin ejecutar / Check syntax without running

```bash
php -l src/Numbers.php
php -l test/NumbersRecursiveTest.php
php -l test/NumbersIterativeTest.php
```

Salida verificada:

```text
No syntax errors detected in src/Numbers.php
No syntax errors detected in test/NumbersRecursiveTest.php
No syntax errors detected in test/NumbersIterativeTest.php
```

### Ejecutar las pruebas / Run tests

```bash
cd php/core/foundations/numbers
composer test        # equivale a: vendor/bin/phpunit
```

**Salida real / Actual output:**

```text
PHPUnit 13.3.4 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.10
Configuration: /home/yorche3/programming_languages/php/core/foundations/numbers/phpunit.xml

..........                                                        10 / 10 (100%)

Time: 00:00.002, Memory: 18.00 MB

OK (10 tests, 22 assertions)
```

> **ES:** PHPUnit cuenta 10 métodos de prueba; los 22 casos (11 por enfoque) viven como aserciones dentro de ellos. El código de salida es `0`.
> **EN:** PHPUnit counts 10 test methods; the 22 cases (11 per approach) live as assertions within them. The exit code is `0`.

---

## 🔁 Sobre recursión con acumulador y Tail Call Optimization (TCO)

**ES:**
Tail recursion ocurre cuando la llamada recursiva es la última acción que ejecuta una función; después de la llamada no hay más instrucciones. La recursión con acumulador consigue esto pasando el estado previo como parámetro, sin dejar trabajo pendiente en la pila.

En PHP, **no se garantiza TCO**: el motor Zend no optimiza las llamadas de cola, así que la versión con acumulador se conserva únicamente con fines educativos, como puente conceptual entre la recursión directa (`_rec`) y la versión iterativa (`_ite`). Como no hay un beneficio de rendimiento garantizado, **no se escriben pruebas unitarias específicas para los métodos `_acc`**. La falta de optimización es observable: `Numbers::sumOfFirstNAcc(1000000)` no se limita a iterar, sino que agota la pila y termina con `PHP Fatal error: Allowed memory size of 134217728 bytes exhausted` mostrando frames de `Numbers::sumOfFirstNAccHelp(…)`.

Los 11 casos del puente `_acc` se comprobaron además de forma puntual con un script desechable (no versionado), que dio `casos _acc verificados: 11 ok, 0 fallos`.

**EN:**
Tail recursion occurs when the recursive call is the last action executed by a function; after the call there are no more instructions. Accumulator recursion achieves this by passing the previous state as a parameter, leaving no pending work on the stack.

In PHP, **TCO is not guaranteed**: the Zend engine does not optimize tail calls, so the accumulator version is kept purely for educational purposes, as a conceptual bridge between direct recursion (`_rec`) and the iterative version (`_ite`). Since there is no guaranteed performance benefit, **no dedicated unit tests are written for the `_acc` methods**. The lack of optimization is observable: `Numbers::sumOfFirstNAcc(1000000)` does not simply iterate, but exhausts the stack and ends with `PHP Fatal error: Allowed memory size of 134217728 bytes exhausted` while showing `Numbers::sumOfFirstNAccHelp(…)` frames.

The 11 cases of the `_acc` bridge were additionally checked once with a throwaway script (not versioned), which reported `casos _acc verificados: 11 ok, 0 fallos`.

---

## 📝 Notas de implementación / Implementation Notes

- **ES:** El proyecto no tiene `main`: el «punto de entrada» es el runner de PHPUnit a través de `composer test`.
- **EN:** The project has no `main`: the "entry point" is PHPUnit's runner through `composer test`.
- **ES:** `leastCommonMultiple*` usa `intdiv()` en lugar de `/` para conservar el tipo `int` (en PHP `/` devuelve `float` cuando la división no es exacta); `intdiv` pertenece a la biblioteca estándar.
- **EN:** `leastCommonMultiple*` uses `intdiv()` instead of `/` to keep the `int` type (in PHP `/` returns `float` when the division is not exact); `intdiv` belongs to the standard library.
- **ES:** Los nombres de los métodos usan camelCase (`sumOfFirstNRec`) en lugar del `snake_case` del pseudocódigo (`sum_of_first_n_rec`), siguiendo la convención de métodos de PHP (PSR-12); los helpers añaden el sufijo `Help` (`sumOfFirstNAccHelp`).
- **EN:** Method names use camelCase (`sumOfFirstNRec`) instead of the pseudocode's `snake_case` (`sum_of_first_n_rec`), following PHP's method convention (PSR-12); helpers add the `Help` suffix (`sumOfFirstNAccHelp`).
- **ES:** El autoload cargado por `phpunit.xml` (`vendor/autoload.php`) publica `src/` y `test/` por *classmap*, así que las suites no hacen ningún `require`.
- **EN:** The autoloader loaded by `phpunit.xml` (`vendor/autoload.php`) publishes `src/` and `test/` through a *classmap*, so the suites perform no `require`.
- **ES:** Ubicación respecto a la especificación: `src/Numbers.php` y `test/Numbers*Test.php` siguen la convención de nombres de PHP (PSR-4: un archivo por clase, en `PascalCase`); se añaden `composer.json`, `phpunit.xml` y `.gitignore`, y no hay `run_tests.php` porque PHPUnit aporta el runner. `vendor/` y `composer.lock` quedan excluidos del repositorio.
- **EN:** Location relative to the specification: `src/Numbers.php` and `test/Numbers*Test.php` follow PHP's naming convention (PSR-4: one file per class, in `PascalCase`); `composer.json`, `phpunit.xml`, and `.gitignore` are added, and there is no `run_tests.php` because PHPUnit provides the runner. `vendor/` and `composer.lock` are excluded from the repository.

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
