<?php
/**
 * @var string $content
 */
use App\System\Auth;
$user = Auth::getUser(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/03f36d3c54.js" crossorigin="anonymous"></script>
    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <link href="/assets/css/style.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <header>
                <nav class="nav-nav">
                    <a class="logo" href="/home/default">
                        <span>LOGO</span>
                    </a>
                    <div class="nav-toggle"><span></span></div>
                    <ul id="menu">
                        <?php
                        if ($user==null): ?>
                            <li><a href="/users/form" id="menu-unregistered">Registration</a></li>
                            <li>or</li>
                            <li><a href="/users/loginForm" id="menu-unregistered">log in</a></li>
                        <?php elseif($user['admin']): ?>
                            <li><a href="/articles/form" class="btn  btn-sm" id="menu-adding">Add article</a></li>
                            <li><a href="/users/logout" class="btn  btn-sm" id="menu-exit">Exit</a></li>
                        <?php else: ?>
                            <li><a href="/users/logout" class="btn  btn-sm" id="menu-exit">Exit</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </header>
        </div>
    </div>
</div>

<?= $content ?>
</body>
</html>
