<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.tiny.cloud/1/<?php echo (ENV["TINYMCE_KEY"]); ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Update User</title>
</head>
<body>
    <?php include("views/header.php"); ?>
    
    <div class="container padding-bottom">
        <div class="movieslideshow__header">
            <h2>Update User</h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <form class="review__form" method="POST" action="/admin/" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" class="admin__input" name="username" required value="<?php if($id) { echo $user["username"];} ?>">
            <label for="email">Email:</label>
            <input type="email" class="admin__input" name="email" required value="<?php if($id) { echo $user["email"];} ?>">
            <div class="admin__grid">
                <input type="hidden" name="id" value="<?php echo $id2 ?>">
                <input type="hidden" name="type" value="<?php echo $id ?>">
            </div>

            <div class="review__button_div">
                <button type="submit" class="button review__submit">
                    Update User
                </button>
                <a href="/admin/">
                    Cancel
                </a>
            </div>
            <?php if(isset($message)) { echo '<p class="login__message">'.$message.'</p>'; } ?>
        </form>

    </div>
    <?php include("views/footer.php"); ?>

</body>
</html>