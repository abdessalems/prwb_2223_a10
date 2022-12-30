<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>Members</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
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
    </body>
</html>
