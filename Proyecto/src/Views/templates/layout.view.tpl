<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{SITE_TITLE}}</title>

  <!--Fonts e Inconos-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <script src="https://kit.fontawesome.com/{{FONT_AWESOME_KIT}}.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

  <!--Bootstrap y CSS-->
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <!--scripts Bootstrap-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  
  {{foreach SiteLinks}}
    <link rel="stylesheet" href="/{{~BASE_DIR}}/{{this}}" />
  {{endfor SiteLinks}}
  {{foreach BeginScripts}}
    <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor BeginScripts}}
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #3E1000" id="menu">
      <div class="container">
        <a href="index.php?page=index" class="navbar-brand center">
          <img class="mr-3" src="public\imgs\LOGO1.png" style="height:75px; border-radius: 20%;">{{SITE_TITLE}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?page=index">
                <i class="fas fa-home"></i>&nbsp;Inicio
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?page=sec_login">
                <i class="fas fa-sign-in-alt"></i>&nbsp;Iniciar Sesión
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?page=sec_register">
                <i class="fas fa-user-plus"></i>&nbsp;Crear Cuenta
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?page=carrito">
                <i class="fas fa-shopping-cart mx-2"></i>&nbsp;Carrito
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    {{{page_content}}}
  </main>
  <footer class="py-4">
    <div class="container">
      <p class="m-0 text-center text-white">Todo los Derechos Reservados 2022</p>
    </div>
  </footer>
  {{foreach EndScripts}}
    <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor EndScripts}}
</body>
</html>
