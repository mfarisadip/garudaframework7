<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Garuda Framework
  </title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="http://localhost/GF/app/view/asset/blk/css/blk-design-system.css?v=1.0.0" rel="stylesheet" />
  <link href="http://localhost/GF/app/view/asset/blk/css/nucleo-icons.css" rel="stylesheet" />
</head>

<body class="index-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent" color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="" rel="tooltip" title="Garuda Framework" data-placement="bottom" target="_blank">
          <span style="color:black">Garuda Framework</span>
        </a>
      </div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link btn btn-danger d-none d-lg-block" href="http://dokumentasi.mfaris16.com/" onclick="scrollToDownload()">
              <i class="tim-icons icon-paper"></i> Documentation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-danger d-none d-lg-block" href="jhttps://github.com/mfaris16/" onclick="scrollToDownload()">
              <i class="fab fa-github"></i> Github
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header header-filter">
      <div class="squares square1"></div>
      <div class="squares square2"></div>
      <div class="squares square3"></div>
      <div class="squares square4"></div>
      <div class="squares square5"></div>
      <div class="squares square6"></div>
      <div class="squares square7"></div>
      <div class="container">
        <div class="content-center brand">
          <h1 style="color:black; font-size:50px;">Garuda Framework</h1>
          <span style="color:black">[[
				$end    = _startMicroTime();
				$result = $end - __Time_Start__;

				echo " Rendering Page  : <strong>".$result."</strong> seconds";
				
				]]</span>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      blackKit.initDatePicker();
      blackKit.initSliders();
    });

    function scrollToDownload() {

      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
  </script>
</body>

</html>
