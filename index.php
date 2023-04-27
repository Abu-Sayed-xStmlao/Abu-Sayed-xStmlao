<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>XSTMLAO | TECHNICAL</title>
  <link rel="stylesheet" href="controls.css">
  <link rel="stylesheet" href="system/xstmlao_fonts/xstmlao_fa.css">
  <link rel="stylesheet" href="majin.css">
</head>


<style>


  <?php
  echo file_get_contents("main.css");
  ?>




</style>





<body>
  <nav>
    <a class="nav_icon" href="">
      <i class="fab fa-envira"></i>
      XSTMLAOTECHNICAL
    </a>
    <div class="control">
      <i class="fab fa-usb"></i>
    </div>
    <div class="menu-button">
      <i class="fab fa-apple"></i>
    </div>
  </nav>

  <div class="interface flex2_container">
    <div class="hook"></div>
    <div class="interface_info flex1">
      <div class="intro">
        <h1>Welcome Back!</h1>
        <p>
          Design and Create a Modern and beautiful friendly responsive Website and Web Application for your
          Business.
        </p>

      </div>
      <div class="developer">
        <div class="card">
          <div class="carousel fader">
            <div class="image">
              <img src="sayed.png" alt="">
            </div>

            <div class="image active">
              <img src="x.png" alt="">
            </div>

            <div class="image">
              <img src="y.png" alt="">
            </div>


          </div>
          <div class="info">
            <h1 class="name">Abu Sayed xStmloa</h1>
            <h3>Computer Science Engineering </h3>
            <div class="typing fader">
              <div class="type">
                PHP Software Developer
              </div>
              <div class="type">
                Python Developer
              </div>
              <div class="type">
                Web Application Developer
              </div>

            </div>
            <!-- social link -->
            <ul class="links">
              <li><a href=""><i class="fas fa-phone-alt"></i></a></li>
              <li><a href=""><i class="fab fa-facebook"></i></a></li>
              <li><a href=""><i class="fab fa-twitter"></i></a></li>
              <li><a href=""><i class="fab fa-github"></i></a></li>
              <li><a href=""><i class="fab fa-facebook-messenger"></i></a></li>
              <li><a href=""><i class="fas fa-envelope"></i></a></li>
              <li><a href=""><i class="fab fa-apple"></i></a></li>
              <li><a href=""><i class="fab fa-youtube"></i></a></li>
              <li><a href=""><i class="fab fa-microsoft"></i></a></li>
            </ul>
            <!-- end social link -->
          </div>
        </div>
      </div>
      <div class="buttons">
        <div class="button" onclick="fader_controller()">
          <i class="fab fa-usb"></i>
          <span>Get Start</span>
        </div>
        <div class="button_alt">
          <i class="fab fa-usb"></i>
          <span>Explore More</span>
        </div>
      </div>
    </div>
    <div class="interface_carousel flex2">
      <div class="carousel">
        <div class="image">
          <img src="intro.png" alt="">
        </div>
      </div>
    </div>
  </div>


  <script>



    const dev_faders = document.querySelectorAll(".card > .fader > div");
    var dev_fader_position = 0;
    function dev_fader() {
      for (let i = 0; i < dev_faders.length; i++) {
        dev_faders[i].classList.remove("active");
      }
      dev_faders[dev_fader_position].classList.add("active");
      dev_fader_position++;
      if (dev_fader_position >= dev_faders.length) {
        dev_fader_position = 0;
      }
      setTimeout(function () {
        dev_fader();
      }, 1000);
    }
    dev_fader();

    const dev_typers = document.querySelectorAll(".typing > div");
    var dev_typer_position = 0;
    function dev_typer() {
      for (let i = 0; i < dev_typers.length; i++) {
        dev_typers[i].classList.remove("active");
      }
      dev_typers[dev_typer_position].classList.add("active");
      dev_typer_position++;
      if (dev_typer_position >= dev_typers.length) {
        dev_typer_position = 0;
      }
      setTimeout(function () {
        dev_typer();
      }, 3000);
    }
    dev_typer();


  </script>