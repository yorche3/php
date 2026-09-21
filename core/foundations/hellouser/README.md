# Hello, User! — PHP

Implementación de la especificación [02_Hello_User](https://yorche3.github.io/programming_languages/core/foundations/02_Hello_User/) en **PHP**, con un enfoque manual y minimalista.

Solicita un nombre mediante la entrada estándar, lo guarda en una variable y muestra un saludo personalizado.

---

## 📂 Archivos y estructura / Files & Structure

| Archivo | Propósito |
|---------|-----------|
| [`hello_user.php`](hello_user.php) | Código fuente: solicita un nombre, lo lee desde `STDIN` y muestra un saludo. |

**Estructura de directorios esperada:**

```text
hellouser/
├── hello_user.php  # Código fuente
└── README.md       # Este archivo
```

---

## 🛠️ Enfoque y construcción / Approach & Build

**ES:** El proyecto se creó manualmente, sin herramientas de scaffolding ni gestor de paquetes. Un único archivo `.php` es suficiente: PHP es un lenguaje interpretado, así que no requiere compilación previa. El programa usa la E/S de la biblioteca estándar (`echo` y `fgets(STDIN)`) para escribir el prompt, leer una línea de la entrada estándar y mostrar el saludo.

**EN:** The project was created manually, without scaffolding tools or a package manager. A single `.php` file is enough: PHP is an interpreted language, so it requires no prior compilation. The program uses standard-library I/O (`echo` and `fgets(STDIN)`) to write the prompt, read one line from standard input, and print the greeting.

### Inicialización / Initialization

1. Crear la estructura de directorios:

   ```bash
   mkdir -p php/core/foundations/hellouser
   ```

2. Escribir el archivo `hello_user.php` con el código fuente.

3. Ejecutarlo con el intérprete `php`.

---

## 📄 Archivos de configuración clave / Key Configuration Files

No se requieren archivos de configuración de build. El script se ejecuta directamente con el intérprete `php`.

```php
<?php

echo "Enter your name: ";
$name = rtrim(fgets(STDIN), "\r\n");

echo "Hello, $name!\n";
```

| Elemento | Propósito |
|----------|-----------|
| `<?php` | Etiqueta de apertura obligatoria: marca el inicio del código PHP. |
| `echo "Enter your name: ";` | Escribe el prompt en `stdout` sin salto de línea. |
| `fgets(STDIN)` | Lee una línea completa desde la entrada estándar, incluido su terminador. Pertenece al núcleo del lenguaje. |
| `rtrim(..., "\r\n")` | Descarta el terminador de línea (`LF` o `CRLF`) del nombre leído. |
| `"Hello, $name!\n"` | Interpola la variable `$name` dentro de la cadena de comillas dobles y añade el salto de línea final. |

> **ES:** Se prefiere `fgets(STDIN)` a `readline()` porque `fgets` es parte del núcleo y no depende de la extensión `readline`, que puede no estar compilada en otras instalaciones.
> **EN:** `fgets(STDIN)` is preferred over `readline()` because `fgets` is part of the core and does not depend on the `readline` extension, which may not be compiled in other installations.

---

## 🚀 Compilación y ejecución / Build & Run

### Requisito: Tener PHP instalado

```bash
php --version
```

Salida verificada:

```text
PHP 8.5.10 (cli) (built: Aug 25 2026 21:09:32) (NTS)
```

### Ejecutar con entrada canalizada / Run with piped input

```bash
cd php/core/foundations/hellouser
printf 'Ada\n' | php hello_user.php
```

### Ejecutar de forma interactiva / Run interactively

```bash
cd php/core/foundations/hellouser
php hello_user.php
```

### Verificar sintaxis sin ejecutar / Check syntax without running

```bash
php -l hello_user.php
```

Salida verificada:

```text
No syntax errors detected in hello_user.php
```

### Salida esperada / Expected output

Con la entrada `Ada`, la salida verificada es:

```text
Enter your name: Hello, Ada!
```

El prompt permanece en la misma línea que la entrada porque no se imprime un salto de línea después del prompt; al ejecutar de forma interactiva, el terminal es el que muestra el nombre tecleado entre el prompt y el saludo.

The prompt remains on the same line as the input because no newline is printed after the prompt; when run interactively, the terminal is what shows the typed name between the prompt and the greeting.

---

## 📝 Notas de implementación / Implementation Notes

- **ES:** PHP no tiene paso de compilación: el intérprete ejecuta el archivo en cada invocación y no se generan artefactos.
- **EN:** PHP has no compilation step: the interpreter runs the file on every invocation and no artifacts are produced.
- **ES:** El archivo no declara una función `main`: el código se ejecuta de arriba abajo. No hay `composer.json` ni dependencias externas.
- **EN:** The file declares no `main` function: the code runs top to bottom. There is no `composer.json` and no external dependency.
- **ES:** `echo` no añade salto de línea, así que el prompt queda en la misma línea que la entrada; el `\n` del saludo es explícito.
- **EN:** `echo` does not append a newline, so the prompt stays on the same line as the input; the greeting's `\n` is explicit.
- **ES:** `fgets(STDIN)` devuelve la línea **con** su terminador, por lo que `rtrim(..., "\r\n")` quita solo el `LF`/`CRLF` y no toca los espacios internos del nombre. Verificado con `printf 'Grace Hopper\r\n' | php hello_user.php` → `Enter your name: Hello, Grace Hopper!`.
- **EN:** `fgets(STDIN)` returns the line **with** its terminator, so `rtrim(..., "\r\n")` removes only the `LF`/`CRLF` and leaves internal spaces in the name untouched. Verified with `printf 'Grace Hopper\r\n' | php hello_user.php` → `Enter your name: Hello, Grace Hopper!`.
- **ES:** Con entrada vacía o fin de entrada (`printf '' | php hello_user.php`) el resultado es `Enter your name: Hello, !`: el saludo se completa con la cadena vacía y no se lanza ningún error.
- **EN:** With empty input or end of input (`printf '' | php hello_user.php`) the result is `Enter your name: Hello, !`: the greeting is completed with the empty string and no error is raised.
- **ES:** Texto del prompt: se usa `Enter your name: `, la convención de los demás lenguajes homologados del repositorio, en lugar del `What is your name? ` del ejemplo de la especificación.
- **EN:** Prompt text: `Enter your name: ` is used, the convention of the other standardized languages in the repository, instead of the `What is your name? ` from the specification example.
- **ES:** Ubicación respecto a la especificación: se conserva el archivo `hello_user.php` (forma `hello_user.ext`) y la carpeta `hellouser/`, que es la que usan los demás lenguajes del repositorio.
- **EN:** Location relative to the specification: the `hello_user.php` file is kept (the `hello_user.ext` form) along with the `hellouser/` folder, which is the one used by the other languages in the repository.

---

## 🌐 Otras implementaciones / Other implementations

Este proyecto también está implementado en otros lenguajes. Explora el [repositorio principal](https://github.com/yorche3/programming_languages) para ver todas las versiones.

---

*🌐 [github.com/yorche3/programming_languages](https://github.com/yorche3/programming_languages) · [GitHub Pages](https://github.com/yorche3/programming_languages)*
