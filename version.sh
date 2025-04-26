#!/bin/bash

# Obtener el mensaje del último commit
mensaje_commit=$(git log -1 --pretty=%B)

# Determinar el tipo de versión a subir
tipo="patch"
if echo "$mensaje_commit" | grep -q "BREAKING CHANGE:"; then
    tipo="major"
elif echo "$mensaje_commit" | grep -q "^feat:"; then
    tipo="minor"
elif echo "$mensaje_commit" | grep -q "^fix:"; then
    tipo="patch"
fi

# Obtener última versión
ultima_version=$(git tag --sort=-v:refname | head -n 1)
if [ -z "$ultima_version" ]; then
    major=1
    minor=0
    patch=0
else
    IFS='.' read -r major minor patch <<< "${ultima_version#v}"
    case "$tipo" in
        major)
            major=$((major+1))
            minor=0
            patch=0
            ;;
        minor)
            minor=$((minor+1))
            patch=0
            ;;
        patch)
            patch=$((patch+1))
            ;;
    esac
fi

nueva_version="v$major.$minor.$patch"

# Crear nuevo tag y subirlo
git tag $nueva_version
git push origin $nueva_version

# Actualizar o crear CHANGELOG.md
archivo_changelog="CHANGELOG.md"
if [ ! -f "$archivo_changelog" ]; then
    echo "# 📦 CHANGELOG" > "$archivo_changelog"
    echo "" >> "$archivo_changelog"
fi

# Insertar entrada al principio del archivo
temp_file=$(mktemp)
echo "## [$nueva_version] - 2025-04-25" >> "$temp_file"
echo "- $mensaje_commit" >> "$temp_file"
echo "" >> "$temp_file"
cat "$archivo_changelog" >> "$temp_file"
mv "$temp_file" "$archivo_changelog"

# Subir cambios a GitHub
git add "$archivo_changelog"
git commit -m "📝 Añadido $nueva_version al CHANGELOG"
git push origin

echo "📦 CHANGELOG actualizado con $nueva_version"
