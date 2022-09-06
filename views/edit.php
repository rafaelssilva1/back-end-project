<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.tiny.cloud/1/<?php echo (ENV["TINYMCE_KEY"]); ?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script language="javascript" type="text/javascript" src="tinymce/tinymce.min.js"></script>
    <title>Edit Comment - <?php echo $userComment["title"]; ?></title>
</head>
<body>
    <?php include("views/header.php"); ?>

    <div class="container card">
        <div class="movieslideshow__header">
            <h2><?php echo $userComment["title"]; ?></h2>
            <div class="movieslideshow__bar"></div>
        </div>
        <div class="reviews__formsection">
            <?php
                if(!empty($userPayload)) {
                    ?>
                        <form class="review__form" method="POST" action="/edit/<?php echo $id; ?>">
                            <label for="comment_text">Edit your review:</label>
                            <textarea id="review__textarea" name="comment_text"><?php echo $userComment["comment_text"]; ?></textarea>
                            <div class="review__rating">
                                <p>Update your rating here:</p>
                                <input type="radio" id="1" name="rating" value="1" <?php if($userComment["rating"] == 1) { echo "checked"; } ?> required/>
                                <label for="1">1</label>
                                <input type="radio" id="2" name="rating" value="2" <?php if($userComment["rating"] == 2) { echo "checked"; } ?>/>
                                <label for="2">2</label>
                                <input type="radio" id="3" name="rating" value="3" <?php if($userComment["rating"] == 3) { echo "checked"; } ?>/>
                                <label for="3">3</label>
                                <input type="radio" id="4" name="rating" value="4" <?php if($userComment["rating"] == 4) { echo "checked"; } ?>/>
                                <label for="4">4</label>
                                <input type="radio" id="5" name="rating" value="5" <?php if($userComment["rating"] == 5) { echo "checked"; } ?>/>
                                <label for="5">5</label>
                                <input type="radio" id="6" name="rating" value="6" <?php if($userComment["rating"] == 6) { echo "checked"; } ?>/>
                                <label for="6">6</label>
                                <input type="radio" id="7" name="rating" value="7" <?php if($userComment["rating"] == 7) { echo "checked"; } ?>/>
                                <label for="7">7</label>
                                <input type="radio" id="8" name="rating" value="8" <?php if($userComment["rating"] == 8) { echo "checked"; } ?>/>
                                <label for="8">8</label>
                                <input type="radio" id="9" name="rating" value="9" <?php if($userComment["rating"] == 9) { echo "checked"; } ?>/>
                                <label for="9">9</label>
                                <input type="radio" id="10" name="rating" value="10" <?php if($userComment["rating"] == 10) { echo "checked"; } ?>/>
                                <label for="10">10</label>
                            </div>
                            <button type="submit" class="button review__submit"><?php if(!$id) { echo "Submit review";} else { echo "Update review"; } ?></button>
                            
                            <?php if(isset($message)) { echo '<p class="login__message">'.$message.'</p>'; } ?>

                        </form>
                    <?php
                } else {
                    ?>
                        <h3>You must be logged in if you want to edit your reviews</h3>
                    <?php
                }
            ?>
            
        </div>
        </div>
    </div>

    <?php include("views/footer.php"); ?>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'autolink lists table',
            toolbar: 'undo redo | styles | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            menubar: false,
            content_style: '@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap");',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name'
        });
    </script>
</body>
</html>