# 🛠️ Guía para trabajar correctamente en el proyecto (Git Flow)

Esta guía está pensada para los desarrolladores del equipo, y describe paso a paso cómo trabajar en el proyecto utilizando **Git**, **GitHub** y la metodología **Git Flow**.

---

## 1. ⚙️ Configuración inicial de Git Bash

Antes de comenzar, asegúrate de tener Git configurado correctamente.

### 📌 Configuración recomendada

```bash
# 1. Push automático para nuevas ramas
git config --global push.autoSetupRemote true

# 2. Manejo correcto de saltos de línea en Windows
git config --global core.autocrlf true

# 3. Activa colores para mejorar la lectura en la terminal
git config --global color.ui auto
```

Puedes verificar tu configuración con:

```bash
git config --list
```

---

## 2. 🚀 Flujo de trabajo de un desarrollador en Git Flow

### 🌀 Antes de empezar: actualiza tu repositorio local

```bash
git fetch --all
git pull
```

Esto te asegura tener la versión más reciente de todas las ramas.

---

### 🌱 Crear una nueva rama de trabajo

1. Asegúrate de estar en `develop`:
```bash
git switch develop
```

2. Crea y cambia a una nueva rama:
```bash
git switch -c feature/nombre-de-la-tarea
```

---

### 💾 Hacer commits correctamente

Cada vez que completes una parte del trabajo:

```bash
git add .
git commit -m "prefijo: descripción del cambio"
```

#### Prefijos válidos:

| Prefijo | Uso |
|--------|-----|
| `feat:` | Nueva funcionalidad |
| `fix:`  | Corrección de errores |
| `BREAKING CHANGE:` | Cambio que rompe compatibilidad |

Ejemplo:
```bash
git commit -m "feat: añadir formulario de inscripción"
```

---

### ☁️ Subir tu trabajo a GitHub

```bash
git push
```

🔄 Si es la primera vez que subes esta rama, Git la enlazará automáticamente (gracias a la configuración inicial).

---

### 📬 Crear un Pull Request

Cuando hayas terminado tu tarea:

- Entra en GitHub.
- Abre un Pull Request de tu rama `feature/*` hacia `develop`.
- El Git Master revisará tu código y decidirá si hace el merge.

---

## ⛔ Qué **no debes hacer**

- No trabajar directamente en `develop` ni `main`.
- No ejecutar `version.sh` (esto lo hace solo el Git Master).
- No hacer merges por tu cuenta si no eres el Git Master.

---

## ✅ Buenas prácticas

- Haz commits pequeños y frecuentes.
- Escribe mensajes de commit claros.
- Usa ramas bien nombradas (`feature/formulario-contacto`, `feature/listar-usuarios`, etc).
- Siempre haz `pull` antes de empezar a trabajar para evitar conflictos.

---

Con este flujo de trabajo el equipo mantiene un desarrollo limpio, ordenado y profesional 💼🚀
