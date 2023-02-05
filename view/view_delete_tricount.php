<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>add_operation</title>-->
<!--    <base href="--><?php //=$web_root?><!--"/>-->
<!---->
<!---->
<!--</head>-->
<!--<body>-->
<!---->
<!--<button> <a href='tricount/tricount'>Cancel</a> </button>-->
<!---->
<!--<button> <a href='tricount/deleteTricount/--><?php //= $tricount->id ?><!--'>Delete </a> </button>-->
<!--</body>-->
<!--</html>-->



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>add_operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <base href="<?=$web_root?>"/>
</head>
<body>



<div style="display: flex; justify-content: center; width: 100%;">
    <i class="fas fa-trash" aria-hidden="true" style="color: red; font-size: 100px;"></i>
</div>

<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
    <p style="color: red;">Are you sure?</p>
</div>
<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
    <p style="color: red;">Do you really want to delete this operation "<strong style="color:red;"><?= $tricount->title ?></strong>" and all of its dependencies?</p>

</div>

<div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;">
      <p style="color:red;">This process cannot be undone.</p>
</div>



<div style="display: flex; justify-content: center; width: 100%; padding: 10px;">
    <button class="btn btn-primary w-100" style="background-color: grey; color: white; margin: auto;">
        <a href='tricount/tricount'  style="color:white;">Cancel</a>
    </button>
    <button class="btn btn-primary w-100"  style="background-color: red; color: white; margin: auto;">
        <a href='tricount/deleteTricount/<?= $tricount->id ?>' style="color:white;">Delete</a>
    </button>
</div>

</body>
</html>