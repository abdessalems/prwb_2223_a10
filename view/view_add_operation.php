<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>add_operation</title>
    <base href="<?=$web_root?>"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>



<form class="col-7 mx-auto my-2" action="operation/add_operation/<?= $tricount->id ?>" method="post">

    <div class="card-header" style="background-color: #00b3ff; padding: 10px;">
        <div class="d-flex justify-content-between mt-3">
            <a  class="btn btn-outline-danger" href="tricount/view_tricount/<?= $tricount->id ?>/<?= $idUser?>">Back</a>
            <div class="d-flex justify-content-center mt-3">
                <div class="title">
                    <h3 style="color: gray;"><?= $tricount->title ?> > new Expense </h3>
                </div>
            </div>

            <div class="d-flex flex-row">
                <input class="btn btn-primary " type="submit" value="Save">
            </div>


        </div>

    </div>



    <div class="row mb-3">
        <div class="col-sm-10">

            <input  class="form-control" id="title" name="title" type="text"  placeholder="Title" value="<?php if(isset($title)) { echo $title; } ?>"  aria-label="Amount (to the nearest dollar)">

        </div>
    </div>



    <div class="form-inline">
        <div class="form-group mb-3">
            <label for="amount" class="sr-only">Amount</label>
            <div class="input-group col-md-70">
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" value="<?php if(isset($amount)) { echo $amount; } ?>" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text">euro</span>
                </div>
            </div>
        </div>
    </div>









    <p>Date</p>
    <div class="input-group mb-3">

        <input  class="form-control" type="date" id="date" name="date" value="<?= $date ?>" aria-label="Amount (to the nearest dollar)">

    </div>


    <div class="row mb-3" >
        <div class="col-sm-10">
            <label class="form-label" for="Paid">Paid By</label>
            <select name="paid" id="paid" value="<?= $itr ?>" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"">
                <?php foreach ($paidBy as $user): ?>
                     <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
                <?php endforeach ;?>
                </select>
        </div>
    </div>



<div class="row mb-3">
    <div class="col-sm-10">
        <p>For Whom ? (select at least one ) </p>
        <table class="table table-borderless datatable" style="display:flex; flex-direction:column;">
            <form action="operation/add_operation" method="post">
                <?php foreach ($paidBy as $index => $person): ?>
                    <tr style="display:flex; flex-direction:row;">
                        <td class="border p-4 rounded-start-1">
                            <input type="checkbox" value="<?= $person['full_name'] ?>" name="checkbox_<?= $index ?>">
                        </td>
                        <td class="border p-4 flex-grow-1">
                            <label for="check"><?=$person['full_name']  ?></label>
                        </td>
                        <td class="form-control bg-transparent w-50">
                            <input type="number" id="weight_<?= $index ?>" name="weight_<?= $index ?>" min="1" max="10">
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
        </form>
    </div>
</div>





</form>
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
<script>
    $(document).ready(function() {
        $('form').submit(function() {
            var title = $('#title').val();
            var amount = $('#amount').val();
            var isValid = true;

            
            if (title.length < 3) {
                $('#title').addClass('is-invalid');
                isValid = false;
            } else {
                $('#title').removeClass('is-invalid');
            }


            if (amount <= 0) {
                $('#amount').addClass('is-invalid');
                isValid = false;
            } else {
                $('#amount').removeClass('is-invalid');
            }

            return isValid;
        });
    });
</script>

