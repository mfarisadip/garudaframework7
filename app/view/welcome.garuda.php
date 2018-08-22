[[ defined('sys_run_app') OR exit('403 - Access Forbidden'); ]]

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="og:image" 			content="" />
	<meta property="og:image"     	content="" />
	<link rel="shortcut icon" type="image/png" href="icon.png"/>
	<meta name="ROBOTS" 			content="index"/>
	<meta name="Author" 			content="@mfaris16" />
	<meta name="copyright" 			content="Copyright@2018 | All Right Reserved" />
	<meta property="og:title" 		content="" />
	<meta property="og:description" content="" />
	<meta property="og:name"      	content="" />
	<meta name="language" 		  	content="Indonesian, English" />
	<meta name="distribution" 	  	content="Global" />
	<meta name="rating" 		  	content="General" />
	<meta name="expires" 		  	content="1800" />
	<meta name="theme-color"      	content="#E43539"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Selamat Datang di Garuda Framework 7.0</title>
	{{ _importBootstrap4(); }}
	<style>
		html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
	</style>
</head>
<body>
		
	<div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Garuda
                </div>

                <div class="links">
                    <a href="#">Documentation</a>
                    <a href="#">Laracasts</a>
                    <a href="#">News</a>
                    <a href="#">Forge</a>
                    <a href="#">GitHub</a>
                </div><br>
                [[
				$end    = _startMicroTime();
				$result = $end - __Time_Start__;

				echo " Rendering Page  : <strong>".$result."</strong> seconds";
				
				]]
            </div>
        </div>

</body>

</html>