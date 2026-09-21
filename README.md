# PHP

Proyectos en **PHP**, con scripts simples ejecutados mediante el intérprete `php` y proyectos tipo librería con pruebas unitarias gestionadas con **Composer** y **PHPUnit**.

---

## 📂 Módulos / Modules

| Módulo | Descripción |
| ------ | ----------- |
| [`core/foundations/`](core/foundations/) | **Fase 0 — Fundamentos**: `helloworld`, `hellouser`, `unit_test/calculator`, `numbers` |
| [`core/algorithms/`](core/algorithms/) | **Fase 1 — Algoritmos Puros**: `naive_sort` |

---

## ▶️ Comenzar / Getting Started

```bash
# Hello, World!
cd core/foundations/helloworld
php hello_world.php

# Hello, User!
cd core/foundations/hellouser
printf 'Ada\n' | php hello_user.php

# Calculator tests
cd core/foundations/unit_test/calculator
composer install
composer test

# Numbers tests
cd core/foundations/numbers
composer install
composer test

# Naive Sort tests
cd core/algorithms/naive_sort
composer install
composer test
```

---

## 📦 Requisitos / Requirements

| Herramienta | Uso | Verificación |
| ----------- | --- | ------------ |
| [PHP](https://www.php.net/) 8.5 | Ejecutar scripts y código de librería | `php --version` |
| [Composer](https://getcomposer.org/) 2.10 | Instalar la dependencia de desarrollo (PHPUnit) | `composer --version` |
| [PHPUnit](https://phpunit.de/) 13.3 | Framework de pruebas de `calculator`, `numbers` y `naive_sort` | `composer test` |

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

> **ES:** En este entorno PHP y Composer se instalaron con Homebrew, así que sus ejecutables viven en `/home/linuxbrew/.linuxbrew/bin`. En una sesión nueva, asegúrate de que ese directorio está en el `PATH` antes de usar `php` o `composer`.
> **EN:** In this environment PHP and Composer were installed with Homebrew, so their executables live in `/home/linuxbrew/.linuxbrew/bin`. In a new shell, make sure that directory is on the `PATH` before using `php` or `composer`.

---

## 🏗️ Tipos de proyecto / Project Types

### 1. Programa simple (interpretado con `php`)

**ES:** Un único archivo `.php` con la etiqueta de apertura `<?php`, sin dependencias externas, ejecutado directamente con el intérprete. Es el formato utilizado por `helloworld` y `hellouser`.

**EN:** A single `.php` file with the `<?php` opening tag and no external dependencies, run directly with the interpreter. This is the format used by `helloworld` and `hellouser`.

```bash
php <File>.php
```

### 2. Proyecto tipo librería con pruebas (Composer + PHPUnit)

**ES:** Los proyectos `calculator`, `numbers` y `naive_sort` separan el código fuente en `src/` y las pruebas en `test/`. Cada proyecto declara PHPUnit en su propio `composer.json` (dependencia de desarrollo), publica el código y las suites mediante *classmap* y configura el runner con `phpunit.xml`. La ejecución se hace con `composer test` o con `vendor/bin/phpunit`.

**EN:** The `calculator`, `numbers` and `naive_sort` projects separate source code into `src/` and tests into `test/`. Each project declares PHPUnit in its own `composer.json` (development dependency), publishes both code and suites through a *classmap*, and configures the runner with `phpunit.xml`. They are run with `composer test` or `vendor/bin/phpunit`.

```bash
composer install
composer test
```

---

## 🔁 Decisión de TCO / TCO Decision

PHP (motor Zend) no garantiza Tail Call Optimization: la recursión de cola sigue consumiendo pila. Por eso `numbers` conserva `_acc` como puente educativo, pero prueba solamente `_rec` e `_ite`: **TCO ❌ + iteración ✅ → 2 suites, 10 tests y 22 casos**.

PHP (Zend engine) does not guarantee Tail Call Optimization: tail recursion still consumes stack. Therefore, `numbers` keeps `_acc` as an educational bridge but tests only `_rec` and `_ite`: **TCO ❌ + iteration ✅ → 2 suites, 10 tests, and 22 cases**.

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*