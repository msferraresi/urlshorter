## Acerca de Urlshorter

Es una aplicacion web desarrollada con laravel, que cuenta con un front integrado en el que se utiliza blade para armar las respectivas pantallas y dentro del backend se encuentran definidas las rutas de api que le permiten actuar como un servicio.

## Metodos de la api:

      * longUrl: el cual sirve para pasar una URL larga y retorna una corta.
      * shortCode: el cual recibe una URL acortada y redirecciona a la dirección original.
      * urlStatistics: retorna todos los datos estadísticos de una URL solicitada, puede ser consultada ya sea con una URL larga o corta.
      * delteUrl: realiza la baja lógica de una URL dentro de la base de datos, al igual que el anterior puede ser eliminada por una URL           corta o larga.
