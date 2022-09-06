<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Login</title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <div class="container padding-bottom">
        <div class="login__div">
            <div>
                <h2 class="genres__title">Login</h2>
                <form class="login__form" method="POST" action="/login/">
                    <input type="text" name="usernameLogin" class="login__input" placeholder="Username" min="3" max="32"> 
                    <input type="password" name="passwordLogin" class="login__input" placeholder="Password" min="9" max="1000">
                    <button type="submit" class="button review__submit">Login</button> 
                </form>
            </div>
            <div>
                <h2 class="genres__title">Register</h2>
                <form class="login__form" method="POST" action="/login/">
                    <input type="text" name="usernameRegister" class="login__input" placeholder="Username"> 
                    <input type="email" name="emailRegister" class="login__input" placeholder="Email"> 
                    <input type="password" name="passwordRegister" class="login__input" placeholder="Password">
                    <button type="submit" class="button review__submit">Register</button> 
                </form>
            </div>
        </div>
        <?php if(isset($message)) { echo '<p class="login__message">'.$message.'</p>'; } ?>
    </div>
  
    <?php include("views/footer.php"); ?>
</body>
</html>