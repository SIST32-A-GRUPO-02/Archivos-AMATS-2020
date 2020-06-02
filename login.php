<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="login">
  	<h1>Iniciar sesión</h1>
      <form method="post" action="index.php">
      	  <input type="text" name="usuario" placeholder="Usuario" required="required" />
          <input type="password" name="clave" placeholder="Contraseña" required="required" />
          <button type="submit" name="sesion" class="btn btn-primary btn-block btn-large">Entrar</button>
      </form>
  </div>
</body>
<script>
  document.write(
    '<script src="http://' +
      (location.host || '${1:localhost}').split(':')[0] +
      ':${2:35729}/livereload.js?snipver=1"></' +
      'script>'
  );
</script>
<html>

