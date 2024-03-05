<?php
session_start();
function isLoggedIn()
{
  return isset($_SESSION['username']);
}
function canLogin($username, $password)
{
  if ($username === "test" && $password === "123") {
    return true;
  } else {
    return false;
  }
}

if (!empty($_POST)) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (canLogin($username, $password)) {
    $_SESSION['username'] = $username;
  } else {
    // ERROR
    $error = true;
  }
}

$pages = [
  "browser" => "Browse some games",
  "getdesktop" => "Get desktop",
  "tryprime" => "Try prime"
];

$page = isset($_GET["page"]) ? $_GET["page"] : "";

$title = isset($pages[$page]) ? $pages[$page] : "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet">
  <title>Twitch</title>
</head>

<body>
  <?php if (isLoggedIn()) : ?>
    <header>
      <nav class="nav">
        <a href="?page=browser">Browse</a>
        <a href="?page=getdesktop">Get desktop</a>
        <a href="?page=tryprime">Try prime</a>
        <a href="#" class="loggedIn">
          <div class="user--avatar"><img src="https://images.unsplash.com/photo-1502980426475-b83966705988?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=ddcb7ec744fc63472f2d9e19362aa387" alt=""></div>

          <?php if (isLoggedIn()) : ?>
            <h3 class="user--name"><?php echo $_SESSION['username']; ?></h3>
          <?php else : ?>
            <h3 class="user--name">Username here</h3>
          <?php endif; ?>

          <span class="user--status">Watching dakotaz</span>
        </a>
        <a href="logout.php">Log out?</a>
      </nav>
    </header>
  <?php endif ?>

  <div id="app">
    <?php if (!isLoggedIn()) : ?>
      <form action="" method="post">
        <h1>Log in to Twitch</h1>
        <nav class="nav--login">
          <a href="#" id="tabLogin">Log in</a>
          <a href="#" id="tabSignIn">Sign up</a>
        </nav>

        <?php if (isset($error)) : ?>
          <div class="alert">That password was incorrect. Please try again</div>
        <?php endif; ?>

        <div class="form form--login">
          <label for="username">Username</label>
          <input type="text" id="username" name="username">

          <label for="password">Password</label>
          <input type="password" id="password" name="password">
        </div>

        <div class="form form--signup hidden">
          <label for="username2">Username</label>
          <input type="text" id="username2">

          <label for="password2">Password</label>
          <input type="password" id="password2">

          <label for="email">Email</label>
          <input type="text" id="email">
        </div>

        <input type="submit" value="Log in" class="btn" id="btnSubmit">
      </form>
    <?php else : ?>
      <h1 class="maincontent"><?php echo isset($pages[$page]) ? $pages[$page] : ""; ?></h1>
    <?php endif ?>
  </div>

</body>

</html>