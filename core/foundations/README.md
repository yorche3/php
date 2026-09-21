# 🚀 Fundamentos / Foundations — PHP

Implementación de los ejercicios de la sección [Fundamentos / Foundations](https://yorche3.github.io/programming_languages/core/foundations/) del repositorio principal en **PHP**.

---

## 📖 Descripción / Description

**ES:** Esta sección reúne los conceptos esenciales para empezar a trabajar con **PHP**. Cubre desde los programas más básicos (`Hello, World!` y `Hello, User!`) hasta una calculadora con pruebas unitarias y algoritmos numéricos implementados en tres enfoques progresivos: recursivo directo, recursivo con acumulador e iterativo.

**EN:** This section brings together the essential concepts for getting started with **PHP**. It covers everything from the basic (`Hello, World!` and `Hello, User!`) programs to a unit-tested calculator and numerical algorithms implemented through three progressive approaches: direct recursion, accumulator recursion, and iteration.

---

## 📁 Estructura / Structure

```text
php/
└── core/
    └── foundations/
        ├── README.md              # Este archivo / This file
        ├── helloworld/            # 01_Hello_World — Primer programa
        │   ├── hello_world.php
        │   └── README.md
        ├── hellouser/             # 02_Hello_User — Entrada y salida
        │   ├── hello_user.php
        │   └── README.md
        ├── unit_test/
        │   └── calculator/        # 03_Unit_Test_Calculator — Pruebas unitarias
        │       ├── src/
        │       │   └── Calculator.php
        │       ├── test/
        │       │   └── CalculatorTest.php
        │       ├── composer.json
        │       ├── phpunit.xml
        │       ├── .gitignore
        │       └── README.md
        └── numbers/               # 04_Numbers — Algoritmos numéricos
            ├── src/
            │   └── Numbers.php
            ├── test/
            │   ├── NumbersRecursiveTest.php
            │   └── NumbersIterativeTest.php
            ├── composer.json
            ├── phpunit.xml
            ├── .gitignore
            └── README.md
```

---

## 🔢 Progresión / Progression

| Especificación | Proyecto | Conceptos | Tests | Dependencias |
| -------------- | -------- | --------- | :---: | ------------ |
| [`01_Hello_World`](https://yorche3.github.io/programming_languages/core/foundations/01_Hello_World/) | [`helloworld/`](helloworld/) | `echo`, etiqueta `<?php`, ejecución interpretada | — | Solo PHP |
| [`02_Hello_User`](https://yorche3.github.io/programming_languages/core/foundations/02_Hello_User/) | [`hellouser/`](hellouser/) | `fgets(STDIN)`, variables, interpolación de cadenas | — | Solo PHP |
| [`03_Unit_Test_Calculator`](https://yorche3.github.io/programming_languages/core/foundations/03_Unit_Test_Calculator/) | [`unit_test/calculator/`](unit_test/calculator/) | Clases, métodos estáticos, PHPUnit y Composer | 5 (10 aserciones) | `phpunit/phpunit` |
| [`04_Numbers`](https://yorche3.github.io/programming_languages/core/foundations/04_Numbers/) | [`numbers/`](numbers/) | Recursión, acumuladores, bucles y TCO | 10 (22 casos) | `phpunit/phpunit` |

---

## 🛠️ Enfoque general / General Approach

**ES:** Los proyectos de esta sección siguen una progresión gradual:

1. **Hello World** y **Hello User**: scripts PHP independientes ejecutados directamente con `php`. No requieren `composer.json` ni dependencias externas.
2. **Calculator**: primer proyecto con estructura tipo librería (`src/` + `test/`). Usa una clase `Calculator` con métodos estáticos y PHPUnit gestionado con Composer.
3. **Numbers**: clase `Numbers` con 15 métodos organizados en tres enfoques. PHP no garantiza Tail Call Optimization, por lo que `_acc` se conserva como puente didáctico sin suite propia. Se prueban `_rec` e `_ite`: **TCO ❌ + iteración ✅ → 2 suites, 10 tests y 22 casos**.

**EN:** The projects in this section follow a gradual progression:

1. **Hello World** and **Hello User**: standalone PHP scripts run directly with `php`. They require no `composer.json` or external dependencies.
2. **Calculator**: the first library-style project (`src/` + `test/`). It uses a `Calculator` class with static methods and PHPUnit managed with Composer.
3. **Numbers**: a `Numbers` class with 15 methods organized into three approaches. PHP does not guarantee Tail Call Optimization, so `_acc` is kept as an educational bridge without its own suite. `_rec` and `_ite` are tested: **TCO ❌ + iteration ✅ → 2 suites, 10 tests, and 22 cases**.

---

## 📦 Requisitos / Requirements

| Herramienta | Uso | Verificación |
| ----------- | --- | ------------ |
| [PHP](https://www.php.net/) 8.5 | Ejecutar scripts y código de librería | `php --version` |
| [Composer](https://getcomposer.org/) 2.10 | Resolver la dependencia de desarrollo de los proyectos con tests | `composer --version` |
| [PHPUnit](https://phpunit.de/) 13.3 | Framework de pruebas de `calculator` y `numbers` | `composer test` |

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

---

## 🚀 Ejecución rápida / Quick Start

### Hello World

```bash
cd php/core/foundations/helloworld
php hello_world.php
```

**Salida real / Actual output:**

```text
Hello, World! from PHP!
```

### Hello User

```bash
cd php/core/foundations/hellouser
printf 'Ada\n' | php hello_user.php
```

**Salida real / Actual output:**

```text
Enter your name: Hello, Ada!
```

### Calculator (PHPUnit)

```bash
cd php/core/foundations/unit_test/calculator
composer install
composer test
```

Salida resumida esperada:

```text
OK (5 tests, 10 assertions)
```

### Numbers (PHPUnit)

```bash
cd php/core/foundations/numbers
composer install
composer test
```

Salida resumida esperada:

```text
OK (10 tests, 22 assertions)
```

---

## 🧪 Convenciones de pruebas / Testing Conventions

**ES:** Los proyectos con tests usan **PHPUnit** declarado como dependencia de desarrollo en un `composer.json` local, con las suites en `test/`. `phpunit.xml` carga el autoload de Composer como *bootstrap* y define la suite sobre `test/`, así que las clases de producción y de prueba se resuelven por *classmap* sin `require`. Las pruebas están separadas por enfoque en `numbers/` y cada método `test*` (camelCase, convención de PHP) agrupa los casos de un algoritmo mediante `assertSame`.

**EN:** Projects with tests use **PHPUnit** declared as a development dependency in a local `composer.json`, with the suites under `test/`. `phpunit.xml` loads Composer's autoloader as the *bootstrap* and defines the suite over `test/`, so both production and test classes are resolved through a *classmap* without `require`. Tests are separated by approach in `numbers/`, and each `test*` method (camelCase, PHP convention) groups the cases of one algorithm using `assertSame`.

---

## 🧹 Artefactos de compilación / Build Artifacts

Los `.gitignore` locales excluyen `vendor/` (dependencias instaladas por Composer), `composer.lock` y las cachés de PHPUnit (`.phpunit.cache/`, `.phpunit.result.cache`).

Local `.gitignore` files exclude `vendor/` (dependencies installed by Composer), `composer.lock`, and PHPUnit caches (`.phpunit.cache/`, `.phpunit.result.cache`).

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
