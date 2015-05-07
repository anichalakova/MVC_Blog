<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/content/styles.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title><?php echo htmlspecialchars($this->title) ?></title>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="col-md-2">
        <a href="/"><img src="/content/images/site-logo.png" id="logo"></a>
    </div>
    <ul class="menu col-md-6">
        <li><a href="/">Home</a></li>
        <?php if($this->isAdmin()):?>
            <li><a href="/posts">My Posts</a></li>
        <?php endif ?>
        <?php if(!$this->isLoggedIn()):?>
        <li><a href="/account/login">Login</a></li>
        <?php endif ?>
        <li><a href="/account/register">Register</a></li>
        </ul>
    </ul>
    <?php
    if($this->isLoggedIn()) :?>
    <div id="logged-in-user" class="col-md-4 row">
        <div class="col-md-8">
            <p >User: <?php echo ($_SESSION['username']); ?></p>
        </div>
        <div  class="col-md-4">
            <form method="post" action="/account/logout">
                <input type="submit" value="Logout" id="logout">
            </form>
        </div>
    </div>
    <?php endif ?>
</nav>
<?php include_once('views/layouts/messages.php'); ?>
