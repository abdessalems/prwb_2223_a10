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
        <div class="d-flex justify-content-between mt-3">
            <a  class="btn btn-outline-danger" href="tricount/tricount">Back</a>
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


    <div class="row mb-3" >
        <div class="col-sm-10">
            <label class="form-label" for="Paid">Paid By</label>
            <select name="paid" id="paid"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"">
                <?php foreach ($paidBy as $user): ?>
                     <option value="<?=$user["full_name"]?>"><?= $user["full_name"] ?></option>
                <?php endforeach ;?>
                </select>
        </div>
    </div>
<!--    <div class="row mb-3">-->
<!--        <div class="col-sm-10">-->
<!--            <p>For Whom ? (select at least one ) </p>-->
<!--            <table class="table table-borderless datatable">-->
<!--             <form action="operation/add_operation" method="post">-->
<!--             --><?php //foreach ($paidBy as $index => $person): ?>
<!--                <tr>-->
<!--                 <td></td></T> <input type="checkbox" value="--><?php //= $person['full_name'] ?><!--" name="checkbox_--><?php //= $index ?><!--" ></td>-->
<!--                <td></td>  <label for="check">--><?php //=$person['full_name']  ?><!--</label></td>-->
<!--                 <td></td> <input type="number" id="weight_--><?php //= $index ?><!--" name="weight_--><?php //= $index ?><!--" min="1" max="10"></td>-->
<!--                </tr>-->
<!--              --><?php //endforeach; ?><!--<br>-->
<!--            </table>-->
<!---->
<!--             </form>-->
<!--        </div>-->
<!--    </div>-->


<div class="row mb-3">
    <div class="col-sm-10">
        <p>For Whom ? (select at least one ) </p>
        <table class="table table-borderless datatable" style="display:flex; flex-direction:column;">
            <form action="operation/add_operation" method="post">
                <?php foreach ($paidBy as $index => $person): ?>
                    <tr style="display:flex; flex-direction:row;">
                        <td style="margin-right:1em;">
                            <input type="checkbox" value="<?= $person['full_name'] ?>" name="checkbox_<?= $index ?>">
                        </td>
                        <td style="margin-right:1em;">
                            <label for="check"><?=$person['full_name']  ?></label>
                        </td>
                        <td>
                            <input type="number" id="weight_<?= $index ?>" name="weight_<?= $index ?>" min="1" max="10">
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
        </form>
    </div>
</div>





</form>

</body>
</html>

