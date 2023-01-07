<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>users</title>
        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        
    <div  class="title">
    <div  class="title"><button type="reset">Cancel</button> <h3>Your Tricounts <h3/> 
    </div>
      <form id="addForm" action="tricount/addTricounts" method="post">
             <div>
        <label > title :</label><br>
        <input type="text" id="title"><br><br>
    </div>
    <div>
        <label >description(optional) :</label><br>
        <input type="text" id="description"><br><br>
    </div>

    <input type="submit" value="save"/>
    </body>
</html>
