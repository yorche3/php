# 🚀 Algoritmos Puros / Algorithms Pure — PHP

Implementaciones de la [Fase 1 — Algoritmos Puros](https://yorche3.github.io/programming_languages/ROADMAP/#fase-1--algoritmos-puros--algorithms-pure-) en **PHP**: ordenamientos elementales, estructuras de datos propias, ordenamientos óptimos y distribuidos, y búsqueda.

Los módulos de esta fase trabajan sobre **arrays de enteros**. En PHP los arrays son tipos de valor (*copy-on-write*), así que los algoritmos ordenan su propia copia y devuelven el array ordenado. El tipo `array` no admite `null` sin la anotación `?array`, así que el caso nulo no es representable en la firma del contrato.

---

## 📂 Módulos / Modules

| Módulo | Especificación | Enfoque | Tests | Estado |
|--------|---------------|---------|:-----:|:------:|
| [`naive_sort/`](naive_sort/) | [05_Naive_Sort](https://yorche3.github.io/programming_languages/core/algorithms/05_Naive_Sort/) | `composer test` (PHPUnit 13 + Composer) | 21 | ✅ |

---

## 📁 Estructura / Structure

```text
algorithms/
└── naive_sort/                  # 05_Naive_Sort
    ├── .gitignore               # Ignora vendor/, composer.lock y las cachés de PHPUnit
    ├── composer.json            # PHPUnit (dev) + autoload classmap + script test
    ├── phpunit.xml              # bootstrap + suite sobre test/
    ├── src/
    │   └── NaiveSort.php        # clase NaiveSort: 3 métodos
    ├── test/
    │   └── NaiveSortTest.php    # 3 tests × 7 casos
    └── README.md
```

---

## 🛠️ Patrón común / Common Pattern

| Característica | Descripción |
|---------------|-------------|
| **Runtime** | PHP 8.5.10 (CLI de Homebrew), ejecutado con `php` |
| **CLI** | `composer test`, ejecutado desde la raíz del módulo (equivale a `vendor/bin/phpunit`) |
| **Andamiaje** | ✍️ Estructura manual (`mkdir -p src test` + `composer require --dev phpunit/phpunit`), la que ya usan [`foundations/numbers/`](../foundations/numbers/) y `foundations/unit_test/calculator/` |
| **Framework de tests** | PHPUnit declarado en `composer.json` (`phpunit/phpunit: ^13.3`), instalado con `composer install` |
| **Runner** | PHPUnit descubre las clases `*Test.php` de `test/`; no hay `run_tests.php` |
| **Separación** | `src/` (clase del módulo) ↔ `test/` (suites) |
| **Módulo fuente** | Una clase con métodos estáticos (`final class NaiveSort`), como `Numbers` y `Calculator` |
| **API** | Una función por algoritmo, con el array recibido y el array ordenado devuelto |
| **Naming** | `camelCase` para los métodos (`selectionSort`), la convención de PHP (PSR-12); la especificación los escribe `snake_case` |
| **Mutabilidad** | Los arrays son tipos de valor: el algoritmo ordena su propia copia y la devuelve; la suite pasa cada caso como valor y ningún fixture se contamina |
| **Nulabilidad** | `array` no admite `null` sin `?array`: el caso nulo no es representable y se omite |
| **Mensajes de aserción** | `assertSame($expected, $actual, $mensaje)` con el mensaje del contrato (`selection_sort should sort an unsorted array`) |
| **Verificación estática** | `php -l <archivo>` → `No syntax errors detected`; el módulo no declara linter |
| **Artefactos** | `vendor/`, `composer.lock` y las cachés de PHPUnit (`.phpunit.cache/`, `.phpunit.result.cache`) — ignorados por el `.gitignore` del módulo |
| **Particularidades** | Intercambio por desestructuración (`[$a, $b] = [$b, $a]`); `&&` cortocircuita y la guarda `$j >= 0` protege el acceso; las cotas de los bucles cubren el caso `n <= 1` sin retorno temprano |

---

## 🚀 Compilación rápida / Quick Build

```bash
# Naive Sort Tests
cd naive_sort
composer install
composer test
```

---

## ▶️ Siguiente / Next

👉 Continúa con los módulos pendientes de esta fase en el [Roadmap](https://yorche3.github.io/programming_languages/ROADMAP/).

👉 Continue with the pending modules of this phase in the [Roadmap](https://yorche3.github.io/programming_languages/ROADMAP/).

---

*[← Volver a Core](../README.md)*

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
