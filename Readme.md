# Vinyl Records

## Instalación del Back:
    1. Agregas variables de entorno, *importante* se debe cargar la variable `APP_URL` con el puerto y servidor correspondiente, en el archivo `.env.example` está seteado en el `http://localhost:8001/`
    2. Ejecutar `Composer install`
    3. Crear las migraciones y ejecutar semillas `php artisan migrate --seed`
    3. Desplegar la api con `php artisan serv --port 8001`, si se desea cambiar el puerto para el despliegue, debe de cambiar los archivos `.env` tanto del back como del front

## Instalación del Front:
    1. Si se cambió el puerto de despliegue del back, se debe de cambiar la ruta de acceso en el archivo `.env`
    2. Ejecutar `npm install`
    3. Desplegar el proyecto con `npm run serve` por default, la ruta de acceso del front es `http://localhost:3000

### Tomar En cuenta
    Usuario: usuario@vinylrecords.com
    Admin: admin@vinylrecords.com

    contraseña: password