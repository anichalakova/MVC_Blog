<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/content/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/content/styles.css" />
    <title><?= htmlspecialchars($this->title) ?></title>
</head>
<body>
<!--<nav class="navbar navbar-default navbar-fixed-top">-->
 <nav class="navbar navbar-default ">
    <div class="col-md-2">
        <a href="/"><img src="/content/images/site-logo.png" id="logo"></a>
    </div>
    <ul class="menu col-md-4">
        <li><a href="/">Home</a></li>
        <?php if($this->isAdmin()):?>
            <li><a href="/posts">My Posts</a></li>
        <?php endif ?>
        <li><a href="/account/login">Login</a></li>
        <li><a href="/account/register">Register</a></li>
        </ul>
    </ul>
     <div class="col-md-3">
         <form method="POST" action="/home/search">
            <input type="text" name="search-field" id="search-field" placeholder="Enter tag to search...">
         </form>
     </div>
    <?php if($this->isLoggedIn()) :?>
        <div id="logged-in-user" class="col-md-3 row">
            <div class="col-md-8">
                <p >User: <?php echo ($_SESSION['username']); ?></p>
            </div>
            <div  class="col-md-4" id="logoutHolder">
                <form method="post" action="/account/logout">
                    <input type="submit" value="Logout" id="logout">
                </form>
            </div>
        </div>
    <?php endif ?>
</nav>
<?php include_once('views/layouts/messages.php'); ?>

