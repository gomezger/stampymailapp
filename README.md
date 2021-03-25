# stampymailapp
<b>Autor:</b> Germán A. Gómez 

<b> Web en producción </b>: https://stampymailapp.herokuapp.com

<b> Usuario:</b> 
<ul>
  <li><b>username:</b>  marcos</li>
  <li><b>password:</b>  123</li>
</ul>

<b>Comentarios:</b>
<ul>
  <li>Se utilizó MVC para el proyecto</li>
  <li>Se utiliza una base de datos remota. Las credenciales se peuden ver en el archivo [config.php](https://github.com/xeronweb/stampymailapp/blob/master/config/config.php)</li>
  <li>Las rutas se arman especificando el controlador como primer parametro y función como segundo parametro. Si se agregan mas parametros, se envian en formato de array a la función. Por ejemplo, si abrimos dominio.com/users/hola/78/45, se ejecutará la función hola([78,45]) del controlador Users.</li>
</ul>

<b>Posibles mejoras</b>
<ul>
  <li>Obligar al usuario a poner contraseñas más seguras</li>
  <li>Sistema de rutas que no obligue a poner contralador seguido de función en la url</li>
  <li>Mejorar las vistas de users</li>
  <li>Crear un front-end y back-end</li>
</ul>
