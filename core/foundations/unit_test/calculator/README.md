# Calculator — PHP

Implementación de la especificación [03_Unit_Test_Calculator](https://yorche3.github.io/programming_languages/core/foundations/03_Unit_Test_Calculator/) en **PHP**, usando una estructura tipo librería con `src/` y `test/` y **PHPUnit** como framework de pruebas, instalado con Composer como dependencia de desarrollo.

La restricción de «solo biblioteca estándar» de la especificación aplica a la implementación del pseudocódigo (`src/`), no al runner de pruebas: las pruebas usan el framework, como en los ejemplos de referencia de la propia especificación (`unittest` en Python y `JUnit` en Java). `src/Calculator.php` no usa `*`, `/` ni `%` ni ninguna biblioteca de aritmética.

No se requiere `sudo`.

---

## 📂 Archivos y estructura / Files & Structure

| Archivo / Directorio | Propósito |
|----------------------|-----------|
| [`composer.json`](composer.json) | Manifiesto: PHPUnit como dependencia de desarrollo y autoload de `src/` y `test/`. |
| [`phpunit.xml`](phpunit.xml) | Configuración de PHPUnit: bootstrap del autoload y suite sobre `test/`. |
| [`src/Calculator.php`](src/Calculator.php) | Clase `Calculator` con las cinco operaciones. |
| [`test/CalculatorTest.php`](test/CalculatorTest.php) | Suite PHPUnit: un test por operación. |
| [`.gitignore`](.gitignore) | Ignora `vendor/`, `composer.lock` y las cachés de PHPUnit. |

```text
calculator/
├── composer.json            # PHPUnit (dev) + autoload classmap
├── phpunit.xml              # bootstrap + suite sobre test/
├── src/
│   └── Calculator.php       # clase Calculator: 5 operaciones
├── test/
│   └── CalculatorTest.php   # suite PHPUnit: 5 tests
├── .gitignore
└── README.md
```

---

## 🛠️ Enfoque y construcción / Approach & Build

**ES:** El proyecto se creó manualmente como una librería PHP y sus dependencias de desarrollo se gestionan con Composer. La implementación vive en `src/` y las pruebas en `test/`. Como framework de pruebas se usa **PHPUnit**, el estándar de facto de PHP, para poder reutilizarlo en las fases posteriores del roadmap. La implementación sigue siendo solo biblioteca estándar: la restricción de la especificación aplica al pseudocódigo, no al runner.

**EN:** The project was created manually as a PHP library, and its development dependencies are managed with Composer. The implementation lives in `src/`, and the tests live in `test/`. **PHPUnit**, PHP's de-facto standard, is used as the testing framework so that it can be reused in the later phases of the roadmap. The implementation still uses the standard library only: the specification's restriction applies to the pseudocode, not to the runner.

Las operaciones siguen las implementaciones educativas:

- `addition`: suma directa.
- `subtraction`: resta directa.
- `multiplication`: suma repetitiva, sin usar `*`.
- `division`: resta repetitiva, sin usar `/`.
- `modulus`: reutiliza `division` y `multiplication`, sin usar `%`.

### Inicialización / Initialization

```bash
mkdir -p php/core/foundations/unit_test/calculator/{src,test}
cd php/core/foundations/unit_test/calculator
composer require --dev phpunit/phpunit
```

Después se añaden la librería en `src/`, la suite en `test/`, el manifiesto `composer.json` y la configuración `phpunit.xml`.

---

## 📄 Archivos de configuración clave / Key Configuration Files

### `composer.json`

**ES:** Declara PHPUnit como dependencia de desarrollo, publica `src/` y `test/` mediante *classmap* (la clase `Calculator` y la suite se cargan sin `require`) y registra el script `composer test`, que ejecuta PHPUnit.

**EN:** It declares PHPUnit as a development dependency, publishes `src/` and `test/` through a *classmap* (both the `Calculator` class and the suite are loaded without `require`), and registers the `composer test` script, which runs PHPUnit.

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

### `phpunit.xml`

**ES:** Carga el autoload de Composer como *bootstrap* y define una suite llamada `calculator` sobre el directorio `test/`.

**EN:** It loads Composer's autoloader as the *bootstrap* and defines a suite named `calculator` over the `test/` directory.

### `test/CalculatorTest.php`

**ES:** La suite hereda de `PHPUnit\Framework\TestCase`, tiene un método `test*` por operación y usa `assertSame`. PHPUnit descubre los métodos por el prefijo `test`, así que no hace falta un archivo aparte como punto de entrada.

**EN:** The suite extends `PHPUnit\Framework\TestCase`, has one `test*` method per operation, and uses `assertSame`. PHPUnit discovers the methods by the `test` prefix, so no separate entry-point file is needed.

```php
public function testModulus(): void
{
    self::assertSame(1, Calculator::modulus(10, 3));
    self::assertSame(0, Calculator::modulus(10, 5));
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
cd php/core/foundations/unit_test/calculator
composer install
```

### Verificar sintaxis sin ejecutar / Check syntax without running

```bash
php -l src/Calculator.php
php -l test/CalculatorTest.php
```

Salida verificada:

```text
No syntax errors detected in src/Calculator.php
No syntax errors detected in test/CalculatorTest.php
```

### Ejecutar las pruebas / Run tests

```bash
cd php/core/foundations/unit_test/calculator
composer test        # equivale a: vendor/bin/phpunit
```

**Salida real / Actual output:**

```text
PHPUnit 13.3.4 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.10
Configuration: /home/yorche3/programming_languages/php/core/foundations/unit_test/calculator/phpunit.xml

.....                                                               5 / 5 (100%)

Time: 00:00.001, Memory: 18.00 MB

OK (5 tests, 10 assertions)
```

> **ES:** El código de salida es `0`. Cuando un test falla, PHPUnit lista las diferencias con archivo y línea (`Failed asserting that …`) y el código de salida pasa a `1`.
> **EN:** The exit code is `0`. When a test fails, PHPUnit lists the differences with file and line (`Failed asserting that …`) and the exit code becomes `1`.

---

## 🧠 Operaciones / Operations

| Operación | Implementación educativa | Test |
|-----------|--------------------------|------|
| `addition(a, b)` | Suma directa (`a + b`). | `testAddition` — `addition(2, 3) = 5` |
| `subtraction(a, b)` | Resta directa (`a - b`). | `testSubtraction` — `subtraction(5, 2) = 3` |
| `multiplication(a, b)` | `for` que suma `a` al acumulador `b` veces. | `testMultiplication` — `multiplication(3, 4) = 12` |
| `division(a, b)` | `while` que resta `b` del dividendo y cuenta las vueltas. | `testDivision` — `division(10, 3) = 3` |
| `modulus(a, b)` | `a - (q * b)` calculado con `division` y `multiplication`. | `testModulus` — `modulus(10, 3) = 1` |

Cada test añade un caso límite sencillo (suma de ceros, resta con resultado negativo, multiplicación por cero, división exacta y módulo exacto), así que la suite ejecuta 5 tests con 10 aserciones.

Each test adds a simple edge case (adding zeros, subtraction with a negative result, multiplication by zero, exact division, and exact modulus), so the suite runs 5 tests with 10 assertions.

---

## 📝 Notas de implementación / Implementation Notes

- **ES:** Framework de pruebas: **PHPUnit** como dependencia de desarrollo (Composer), el estándar de facto de PHP y reutilizable en las fases posteriores. La restricción de «solo biblioteca estándar» de la especificación se aplica al pseudocódigo: `src/Calculator.php` no usa `*`, `/` ni `%` ni ninguna biblioteca de aritmética.
- **EN:** Testing framework: **PHPUnit** as a development dependency (Composer), PHP's de-facto standard and reusable in later phases. The specification's "standard library only" restriction applies to the pseudocode: `src/Calculator.php` uses no `*`, `/`, or `%` and no arithmetic library.
- **ES:** El autoload cargado por `phpunit.xml` (`vendor/autoload.php`) publica `src/` y `test/` por *classmap*, así que la suite no hace ningún `require`: la clase `Calculator` se resuelve por el propio autoload.
- **EN:** The autoloader loaded by `phpunit.xml` (`vendor/autoload.php`) publishes `src/` and `test/` through a *classmap*, so the suite performs no `require`: the `Calculator` class is resolved by the autoloader itself.
- **ES:** Los métodos de prueba usan `test*` en camelCase (convención de PHP/PHPUnit) en lugar de los `test_*` del pseudocódigo, y comparan con `assertSame`, que exige valores idénticos.
- **EN:** Test methods use camelCase `test*` (PHP/PHPUnit convention) instead of the pseudocode's `test_*`, and compare with `assertSame`, which requires identical values.
- **ES:** No hay `run_tests.php`: PHPUnit aporta el runner, y la especificación solo pide un punto de entrada propio cuando el lenguaje no lo incluye.
- **EN:** There is no `run_tests.php`: PHPUnit provides the runner, and the specification only asks for a custom entry point when the language does not include one.
- **ES:** `src/Calculator.php` no usa `*`, `/` ni `%` (verificado excluyendo las líneas de comentario); `modulus` se apoya en `division` y `multiplication`.
- **EN:** `src/Calculator.php` uses no `*`, `/`, or `%` (verified by excluding comment lines); `modulus` relies on `division` and `multiplication`.
- **ES:** Igual que en los módulos homologados de `v/` y `vala/`, se rechazan el multiplicador negativo y el divisor no positivo con `InvalidArgumentException`; sin esa comprobación `division(10, 0)` sería un bucle infinito.
- **EN:** As in the standardized `v/` and `vala/` modules, a negative multiplier and a non-positive divisor are rejected with `InvalidArgumentException`; without that check `division(10, 0)` would loop forever.
- **ES:** Ubicación respecto a la especificación: `src/Calculator.php` y `test/CalculatorTest.php` usan el nombre de la clase en `PascalCase`, que es la convención de nombres de archivo de PHP (PSR-4); se añaden `composer.json`, `phpunit.xml` y `.gitignore`, y no hay `run_tests.php` porque PHPUnit aporta el runner. `vendor/` y `composer.lock` quedan excluidos del repositorio (mismo criterio que `package-lock.json` en `typescript/` y `Gemfile.lock` en `ruby/`).
- **EN:** Location relative to the specification: `src/Calculator.php` and `test/CalculatorTest.php` use the class name in `PascalCase`, which is PHP's file naming convention (PSR-4); `composer.json`, `phpunit.xml`, and `.gitignore` are added, and there is no `run_tests.php` because PHPUnit provides the runner. `vendor/` and `composer.lock` are excluded from the repository (the same criterion as `package-lock.json` in `typescript/` and `Gemfile.lock` in `ruby/`).

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
