<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Settings </title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<a href="user/tricount">Back</a>
<div class="title">Settings</div>
<div class="main">

    <h4> Hey <?=  $user->full_name ?> ! </h5>
        <p> I know your email adress is   <?=  $user->mail ?></p>
        <p> What can Ido for you ?</p>
        <form id="settings" action="settings/edit_profile" method="post">
            <form action="main/Edite">
                <input type="submit" value="Edite Profile" />
            </form><br>
            <form action="settings/change_password">
                <input type="submit" value="Change password" />
            </form><br>
            <form action="user/logout">
                <input type="submit" value="Logout" />
            </form>
        </form>


</div>
</body>
</html>