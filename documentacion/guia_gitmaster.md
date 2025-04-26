# 👑 Guía de Trabajo para el Git Master y el Equipo

Esta guía define cómo deben trabajar el Git Master y los desarrolladores en el proyecto siguiendo buenas prácticas de Git Flow.

---

# 👨‍💻 Instrucciones para los desarrolladores

## 📌 Normas principales

- Trabajar siempre en ramas `feature/` creadas desde `develop`.
- Escribir commits claros siguiendo convención:
  - `feat:` → Nueva funcionalidad
  - `fix:` → Corrección de errores
  - `BREAKING CHANGE:` → Cambios incompatibles
- Subir su rama a GitHub (`git push`).
- Crear un **Pull Request** hacia `develop` cuando terminen una tarea.
- **No tocar** `develop`, `main`, ni ejecutar `version.sh`.

---

## 🚀 Flujo de trabajo de los desarrolladores

```bash
git switch develop
git branch feature/nombre-funcionalidad
# Trabajar...
git add .
git commit -m "feat: agregar formulario de inscripción"
git push
```

Luego, crear un **Pull Request** desde GitHub.

---

# 👑 Responsabilidades del Git Master

- Revisar Pull Requests:
  - Verificar que los commits están bien (convención correcta).
  - Verificar que el código respeta las buenas prácticas del proyecto.
- Hacer el **merge** de las `feature/*` hacia `develop`.
- Ejecutar **`version.sh`** después de integrar cambios importantes:
  - Para generar un nuevo tag.
  - Para actualizar el `CHANGELOG.md`.
- Fusionar `develop` en `main` al lanzar una versión final o estable.

---

## ⚙️ Flujo de trabajo del Git Master

1. Revisar Pull Request en GitHub.
2. Aceptar y hacer merge a `develop` si todo está bien.
3. Ejecutar:

```bash
./version.sh
```

(Solo cuando es necesario versionar cambios importantes.)

4. Cuando corresponda:
    - Crear rama `release/`
    - O fusionar `develop` → `main` para publicación.

---

# 📝 Resumen rápido

| Acción                              | Quién lo hace          |
|:------------------------------------|:-----------------------|
| Trabajar en `feature/`              | Desarrolladores        |
| Hacer commits siguiendo convención  | Desarrolladores        |
| Subir ramas `feature/` a GitHub     | Desarrolladores        |
| Crear Pull Requests                 | Desarrolladores        |
| Revisar y hacer merge               | Git Master             |
| Ejecutar `version.sh`               | Git Master             |
| Mantener `develop` y `main` limpias | Git Master             |

---

Con esta organización, el proyecto se mantiene **ordenado, estable y profesional**. 🚀
