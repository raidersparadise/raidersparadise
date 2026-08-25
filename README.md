PASO A PASO 

1. Ir a develop
    git checkout develop

2. Actualizar develop
    git pull origin develop

3. Crear tu rama
    git checkout -b feat/(nombre de la rama)

Comprueba:

    git branch

Deberías ver:

    * feat/(nombre de la rama)
      develop
      main

4. Crear la migración
    php artisan make:migration create_(nombre de la rama)

    Haces la migración que vimos anteriormente.

5. Probarla
    Si trabajas con Docker:
       docker compose exec app php artisan migrate
   
7. Guardar el trabajo en Git
   git status
   git add .
   git commit -m "feat:(nombre de la rama)"

   
9. Subir tu rama a GitHub
    git push -u origin feat/(nombre de la rama)
