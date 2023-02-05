<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
      <title>users</title>

        <title>add tricount</title>

        <base href="<?= $web_root ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    </head>

    <body>





      <form id="addForm" action="tricount/addTricounts" method="post">
          <div style="background-color: lightsteelblue; padding: 10px;">
          <div class="d-flex justify-content-between mt-3">
              <button style="color:red; background-color:white;  border: 1px solid red;"">
                  <a href="" style="text-decoration: none; color: red;"> Cancel</a>
              </button>


              <div class="d-flex justify-content-center mt-3">
                  <div class="title">
                      <h3>Your Tricounts</h3>
                  </div>
              </div>

              <input type="submit" class="btn btn-primary" value="Save"/>


          </div>

          </div>

          <div class="form-group">
              <label class="form-control-label">Titre :</label><br>
          <div class="input-group mb-3">

              <input type="text" class="form-control" name="title"  aria-label="title" aria-describedby="basic-addon1">
              </div>

    </div>
          <div>
              <label class="form-control-label">Description (optionnelle) :</label><br>
              <textarea name="description" rows="10" cols="30" style="width: 100%; height: 100px;"></textarea>
          </div>

      </form>
    </div>

    <?php if (count($errors) != 0): ?>
        <div class='alert alert-danger'>
            <p><strong>Please correct the following error(s) :</strong></p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>




    </body>
</html>
