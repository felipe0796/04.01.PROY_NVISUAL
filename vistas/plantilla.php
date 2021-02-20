<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi proyecto N Visual</title>

  <!-------==================================
        PLUGINS DE CSS
    =====================================------>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-------==================================
        PLUGINS DE JS
    =====================================------>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Latest compiled FontAwesome -->
  <script src="https://kit.fontawesome.com/60710a6fba.js" crossorigin="anonymous"></script>


</head>

<body>

  <!--BOTONERA / NAV VAR-->
  <div class="container-fluid bg-dark">

    <div class="container">

      <nav class="navbar navbar-expand-lg navbar-light bg-body">

        <a class="navbar-brand text-white"><i class="fas fa-store-alt mx-2"></i>TIENDA X</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

          
            <ul class="navbar-nav">

              
                <!-- INICIO -->
                <li class="nav-item">
                  <a class="nav-link text-light" href="index.php?pagina=inicio">Inicio<span class="sr-only">(current)</span></a>
                </li>
              


              <!-- PRODUCTOS / INSERT / READ -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                  
                    <!-- REGISTRO PRODUCTO -->
                    <a class="dropdown-item" href="index.php?pagina=registro_producto">Registra un nuevo producto</a>
                  

                  
                    <!-- REGISTRO PRODUCTO -->
                    <a class="dropdown-item" href="index.php?pagina=listado_producto">Listado de Productos</a>
                  
                </div>
              </li>

            </ul>

            <!-- LOGIN -->
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="far fa-user "><span class="font-weight-bold font-italic text-dark ml-3 px-5 py-2 bg-light rounded">login</span></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                  <!-- BOTON PARA INGRESAR LOGUEARSE (abre un modal) -->
                  <button type="button" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ingreso</button>

                  
                    <!-- PAGINA DE REGISTRO DE USUARIOS -->
                    <a class="dropdown-item" href="index.php?pagina=registro_usuario">Registrarse</a>
                  
                </div>
              </li>

            </ul>

        </div>
      </nav>

    </div>

  </div>


  <!-- CONTENIDO DE LAS PAGINAS -->
  <div class="container-fluid mt-5">

    <?php

      /**Lista blanca */
      if (isset($_GET["pagina"])) {

        if (
          /**Lista blanca */
          $_GET["pagina"] == "inicio" ||
          $_GET["pagina"] == "registro_producto" ||
          $_GET["pagina"] == "listado_producto" ||
          $_GET["pagina"] == "registro_usuario" ||
          $_GET["pagina"] == "actualizar_producto" 
         
        ) {

          include "paginas/" . $_GET["pagina"] . ".php";
        } else {

          include "paginas/error404.php";
        }
      } else {

        include "paginas/inicio.php";
      }

    ?>
  </div>

  <!-- MODAL PARA INGRESO AL SISTEMA (VER PARA DESPUES)-->

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-thumbtack"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- BLOQUE PARA INGREAR USUARIO Y CONTRASEÑA -->
        <div class="modal-body">
          <div class="container">

            <!-- form con íconos USERNAME-->
            <div class="form-group">
              <label for="email">Username:</label>
              <!-- bloque del ícono -->
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="email" class="form-control" placeholder="Ingresa tu usuario" id="email" name="ingresoEmail">
              </div>
            </div>

            <!-- form con íconos CONTRASEÑA-->
            <div class="form-group">
              <label for="pwd">Contraseña:</label>
              <!-- bloque del ícono -->
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Ingresa tu contraseña" id="pwd" name="ingresoPassword">
              </div>
            </div>

          </div>
        </div>

        <!-- BOTON PARA INGRESAR AL SISTEMA -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i></button>
        </div>

      </div>
    </div>
  </div>

</body>

</html>