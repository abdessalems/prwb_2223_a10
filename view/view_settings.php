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

    <h4> Hey <?= $user->full_name ?> ! </h5>
        <p> I know your email adress is <?= $user->mail ?></p>
        <p> What can Ido for you ?</p>

        <a href="settings/edit_profile">Edite Profile</a> <br>
        <a href="settings/change_password">Change password</a><br>
        <a href="user/logout">Logout</a>


</div>
</body>
</html>