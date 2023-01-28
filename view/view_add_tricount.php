<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
<<<<<<< HEAD
        <title>users</title>
=======
        <title>Members</title>
>>>>>>> feat_UC_Singup
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
<<<<<<< HEAD
        
    <div  class="title">
    <div  class="title"> <h3>Your Tricounts </h3>
    </div>
      <form id="addForm" action="tricount/addTricounts" method="post">
             <div>
        <label > title :</label><br>
        <input type="text" id="title" name="title"><br><br>
    </div>
    <div>
        <label >description(optional) :</label><br>
        <textarea name="description" rows="10" cols="30"></textarea>
<!--        <input type="text" id="description" name="description"><br><br>-->
    </div>


    <input type="submit" value="save"/>
     <button type="reset">Cancel</button>
      </form>
    </div>

    <?php if (count($errors) != 0): ?>
        <div class='errors'>
            <br><br><p>Please correct the following error(s) :</p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

=======
        <div  class="title">
        <div  class="title"><input type="submit" value="Cancel"/> <h3>Your Tricounts <h3/> <input type="submit" value="Add"/>
        </div>
            <form id="addForm" action="main/" method="post">
        <div>
                <label > title :</label><br>
                <input type="text" id="title"><br><br>
        </div>
        <div>
            <label >description(optional) :</label><br>
            <input type="text" id="title"><br><br>
        </div>
>>>>>>> feat_UC_Singup
    </body>
</html>
