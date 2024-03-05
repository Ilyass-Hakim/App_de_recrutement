<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'projetrh';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database! ');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Album example · Bootstrap v5.0</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
        <!--Import File CSS-->
        <!-- Bootstrap core CSS -->
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link href="materialdesignicons.css" rel="stylesheet">
        <link href="nice-select.min.css" rel="stylesheet">
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>
        <!--Import File JS-->
        <script type="text/javascript" src="assets/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <script type="text/javascript" src="jquery.nice-select.min.js"></script>
    </head>
    <body>
        <header>
            <div class="collapse bg-dark" id="navbarHeader">
              <div class="container">
                <div class="row">
                  <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                  </div>
                  <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                      <li><a href="#" class="text-white">Follow on Twitter</a></li>
                      <li><a href="#" class="text-white">Like on Facebook</a></li>
                      <li><a href="#" class="text-white">Email me</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="navbar navbar-dark bg-dark shadow-sm">
              <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                  <strong>Album</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              </div>
            </div>
        </header>
EOT;
}
function template_footer() {
echo <<<EOT
            <footer class="text-muted py-5" style="color: white !important;">
                <div class="container">
                    <p class="float-end mb-1">
                        <a href="#">Back to top</a>
                    </p>
                    <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
                    <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
                </div>
            </footer>
        </body>
    </html>
EOT;
}
?>