# 🧭 Guía de Trabajo con Git Flow y Versionado Automático

Esta guía resume cómo trabajar de forma ordenada con Git Flow, cómo versionar correctamente tu proyecto y cuándo usar el script `version.sh`.

---

## 🧠 ¿Qué es Git Flow?

Es una metodología de trabajo con ramas que permite estructurar un proyecto de forma clara y escalable.

### 🔀 Ramas principales

- `main` → Rama de producción (estable)
- `develop` → Desarrollo principal
- `feature/*` → Nuevas funcionalidades
- `release/*` → Preparar una nueva versión
- `hotfix/*` → Corregir errores en producción

---

## 🔢 Versionado Semántico (SemVer)

Cada versión sigue este formato: `MAJOR.MINOR.PATCH`

| Tipo de Cambio         | Ejemplo     | Tipo       | Prefijo             | Tipo de cambio                | Ejemplo                                                |
|------------------------|-------------|------------|---------------------|-------------------------------|--------------------------------------------------------|
| Cambio mayor           | `2.0.0`     |    MAJOR   | `BREAKING CHANGE:`  | Cambio incompatible (mayor)   | `git commit -m "BREAKING CHANGE: cambia esquema de BD"`|
| Nueva funcionalidad    | `1.1.0`     |    MINOR   | `feat:`             | Nueva funcionalidad           | `git commit -m "feat: añadir formulario de contacto"`  |
| Corrección de errores  | `1.0.1`     |    PATCH   | `fix:`              | Corrección de errores         | `git commit -m "fix: error en validación de email"`    |

---

## ⚙️ ¿Qué hace `version.sh`?

- Detecta el tipo de commit (`feat:`, `fix:`, `BREAKING CHANGE:`)
- Calcula la siguiente versión según SemVer
- Crea un nuevo tag como `v1.1.0`
- Actualiza automáticamente el archivo `CHANGELOG.md`
- Hace commit y `git push` del changelog
- Hace `git push origin <tag>`

---

## ⏱️ ¿Cuándo ejecutar `version.sh`?

| Situación                        | ¿Ejecutar `version.sh`? |
|----------------------------------|--------------------------|
| Estás trabajando en `feature/`   | ❌ No  
| Has terminado una `feature/` y la integras en `develop` | ✅ Sí  
| Vas a pasar de `develop` a `release` | ✅ Sí  
| Haces un hotfix en `main`        | ✅ Sí  
| Commit pequeño dentro de la misma rama | ❌ No  

🔁 Piensa en `version.sh` como el botón para decir:
> “Esta versión del proyecto ya es entregable”.

---

## 🧠 Buenas prácticas finales

- Escribe commits claros y consistentes.
- No hagas commits directos en `main`.
- Usa `develop` como base para las funcionalidades.
- Usa tags (`git tag v1.1.0`) para marcar versiones importantes.
- Mantén `CHANGELOG.md` actualizado con el historial.
- Automatiza siempre que puedas para evitar errores humanos.

---

## ✅ Entonces… ¿cuál es el flujo correcto?

1. Trabajas y haces varios commits ✅  
2. Terminas una funcionalidad ✅  
3. Ejecutas `./version.sh` ✅  
4. El script hace el tag, changelog y push ✅  
5. ¡Listo! Todo actualizado y versionado automáticamente 🚀

¡Sigue esta guía y tu proyecto estará siempre limpio, organizado y listo para presentar! 🎯
---

🔗 Evitar tener que poner --set-upstream al hacer git push

Solo tienes que configurar Git globalmente para que, cuando crees una nueva rama y hagas git push, automáticamente la enlace al remoto.


Configura push automático para nuevas ramas:

git config --global push.autoSetupRemote true


🔥 ¿Qué hace esto?

La primera vez que hagas git push en una rama nueva, Git automáticamente hará el --set-upstream origin nombre-rama por ti.

Ya no tendrás que escribirlo manualmente cada vez.
