<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>add_operation</title>
    <base href="<?=$web_root?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


</head>
<body>


<form  action="operation/add_operation/<?= $tricount->id ?>" method="post">
    <div style="background-color: lightsteelblue; padding: 10px;">
        <!--    <button> <a href='tricount/tricount/--><?php //= $tricount->id ?><!--'>Back</a> </button>-->
        <button style="color:red; border: 1px solid red;">
            <a href='tricount/tricount/<?= $tricount->id ?>' style="text-decoration: none; color: red;">Back</a>
        </button>
        <div class="d-flex justify-content-center mt-3">
            <div class="title" style="text-align: right;">

                <h3 style="color: gray;"><?= $tricount->title ?> > Edit </h3>
            </div>
        </div>
        <div class="d-flex flex-row">
            <input class="btn btn-primary " type="submit" value="Save">
        </div>

    </div>




    <div class="input-group mb-3">

        <input  class="form-control" id="title" name="title" type="text"  placeholder="Title" aria-label="Amount (to the nearest dollar)">

    </div>


    <div class="input-group mb-3">

         <input  class="form-control" type="number" id="amount" name="amount" placeholder="Amount" aria-label="Amount (to the nearest dollar)">
        <span class="input-group-text">euro</span>
    </div>


    <p>Date</p>
    <div class="input-group mb-3">

        <input  class="form-control" type="date" id="date" name="date"  aria-label="Amount (to the nearest dollar)">

    </div>

    <p>paid by </p>
    <div >
        <select name="paid" id="paid"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"">
            <?php foreach ($paidBy as $user): ?>
                 <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
             <?php endforeach ;?>
        </select>
    </div>

    <p>For whom? (select at least one)</p>

       <form action="operation/add_operation" method="post">
             <?php foreach ($paidBy as $index => $person): ?>
                  <input type="checkbox" value="<?= $person['full_name'] ?>" name="checkbox_<?= $index ?>" >
                  <label for="check"><?=$person['full_name']  ?></label>
                  <input type="number" id="weight_<?= $index ?>" name="weight_<?= $index ?>" min="1" max="10"><br>
             <?php endforeach; ?><br>

       </form>


</form>

</body>
</html>

