# Hello, World! — PHP

Implementación de la especificación [01_Hello_World](https://yorche3.github.io/programming_languages/core/foundations/01_Hello_World/) en **PHP**, con un enfoque manual y minimalista.

---

## 📂 Archivos y estructura / Files & Structure

| Archivo | Propósito |
|---------|-----------|
| [`hello_world.php`](hello_world.php) | Código fuente: imprime `"Hello, World! from PHP!"` en la salida estándar. |

**Estructura de directorios esperada:**

```text
helloworld/
├── hello_world.php  # Código fuente
└── README.md        # Este archivo
```

---

## 🛠️ Enfoque y construcción / Approach & Build

**ES:** El proyecto se creó manualmente, sin herramientas de scaffolding ni gestor de paquetes. Un único archivo `.php` es suficiente: PHP es un lenguaje interpretado, así que no requiere compilación previa ni archivo de configuración.

**EN:** The project was created manually, without scaffolding tools or a package manager. A single `.php` file is enough: PHP is an interpreted language, so it requires no prior compilation or configuration file.

### Inicialización / Initialization

1. Crear la estructura de directorios:

   ```bash
   mkdir -p php/core/foundations/helloworld
   ```

2. Escribir el archivo `hello_world.php` con el código fuente.

3. Ejecutarlo con el intérprete `php`.

---

## 📄 Archivos de configuración clave / Key Configuration Files

No se requieren archivos de configuración de build. El script se ejecuta directamente con el intérprete `php`.

```php
<?php

echo "Hello, World! from PHP!\n";
```

| Elemento | Propósito |
|----------|-----------|
| `<?php` | Etiqueta de apertura obligatoria: marca el inicio del código PHP. |
| `echo "..."` | Construcción de salida del lenguaje: escribe la cadena en `stdout`. |
| `\n` dentro de comillas dobles | Secuencia de escape interpretada por PHP: aporta el salto de línea final. |

> **ES:** La etiqueta de cierre `?>` se omite a propósito: PHP recomienda no incluirla en archivos que solo contienen código PHP, para evitar enviar espacios o saltos de línea accidentales después del cierre.
> **EN:** The closing `?>` tag is omitted on purpose: PHP recommends leaving it out in files that contain only PHP code, to avoid sending accidental whitespace or newlines after the closing tag.

---

## 🚀 Compilación y ejecución / Build & Run

### Requisito: Tener PHP instalado

```bash
php --version
```

Salida verificada:

```text
PHP 8.4.25 (cli) (built: Aug 25 2026 18:15:03) (NTS)
```

### Ejecutar con el intérprete / Run with the interpreter

```bash
cd php/core/foundations/helloworld
php hello_world.php
```

### Verificar sintaxis sin ejecutar / Check syntax without running

```bash
php -l hello_world.php
```

Salida verificada:

```text
No syntax errors detected in hello_world.php
```

### Salida esperada / Expected output

```text
Hello, World! from PHP!
```

La salida fue verificada ejecutando `php hello_world.php` con **PHP 8.4.25** en Linux/WSL2: el resultado es exactamente el mensaje del contrato seguido de un salto de línea, sin salida adicional.

The output was verified by running `php hello_world.php` with **PHP 8.4.25** on Linux/WSL2: the result is exactly the contract message followed by a newline, with no additional output.

---

## 📝 Notas de implementación / Implementation Notes

- **ES:** PHP no tiene paso de compilación: el intérprete lee y ejecuta el archivo en cada invocación (`php hello_world.php`). No hay artefactos generados.
- **EN:** PHP has no compilation step: the interpreter reads and executes the file on every invocation (`php hello_world.php`). There are no generated artifacts.
- **ES:** El archivo no declara una función `main`: el código se ejecuta de arriba abajo, igual que en Python. No hay `composer.json` ni dependencias externas, solo construcciones del lenguaje.
- **EN:** The file declares no `main` function: the code runs top to bottom, as in Python. There is no `composer.json` and no external dependency, only language constructs.
- **ES:** La etiqueta de apertura `<?php` es imprescindible. Comprobado con una copia desechable en `/tmp` sin la etiqueta: el intérprete emite el contenido como texto literal (`echo "Hello, World! from PHP!\n";`) en lugar de ejecutarlo.
- **EN:** The opening `<?php` tag is essential. Checked with a disposable copy in `/tmp` without the tag: the interpreter emits the content as literal text (`echo "Hello, World! from PHP!\n";`) instead of executing it.
- **ES:** `echo` no añade salto de línea (a diferencia de `print` en Python): el `\n` del propio literal, interpretado por estar entre comillas dobles, es el que cierra la línea.
- **EN:** `echo` does not append a newline (unlike Python's `print`): the `\n` inside the literal, interpreted because it is enclosed in double quotes, is what ends the line.
- **ES:** Ubicación respecto a la especificación: se conserva el archivo `hello_world.php` (forma `hello_world.ext`) y la carpeta `helloworld/`, que es la que usan los demás lenguajes del repositorio.
- **EN:** Location relative to the specification: the `hello_world.php` file is kept (the `hello_world.ext` form) along with the `helloworld/` folder, which is the one used by the other languages in the repository.

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
