<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta charset="UTF-8">
    <title>view_operation</title>
    <base href="<?= $web_root ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="./assets/img/fav_icon.png" rel="icon">
    <link href="./assets/img/touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="./assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="./assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./assets/css/styles.css" rel="stylesheet">
    <!-- Jquery-->
    <script src="./lib/jquery-3.6.3.min.js" type="text/javascript"></script>

    <script>
        let totalAmount,repartitions,totalWeight,partitionWeights;
        // Pass the PHP variable $operations to JavaScript
        repartitions = <?php echo json_encode($operation_amount); ?>;
        $(function () {
            // Set the focus on the first input element to start editing
            $(".form-control:first").focus();
            // Add the dynamicalCalcul to the amount input and to the changed Weight
            totalAmount = $("#amount");
            partitionWeights = $('input[name="weight[]"]');
            totalAmount.bind("input", dynamicalCalcul);
            partitionWeights.bind("input",dynamicalCalcul);
        });

        /**
         * Update the amount of repartitions for every participant by changing either
         * Weight or totalAmount
         */
        function dynamicalCalcul(){
            totalWeight = 0.0;
            // Sum up all weights to get the totalWeight
            for (let item of Object.values(partitionWeights) )
            {
                if (item.name === 'weight[]')
                    totalWeight += (item.value)?parseFloat(item.value):0.0;
            }
            // For every repartition set the newAmount
            for (let repartition of Object.values(repartitions))
            {
                let inputWeight = $(`#${repartition.id}Weight`);
                let weight = (inputWeight.val())? inputWeight.val(): 0.0 ;
                let newAmount = weight * (totalAmount.val() / totalWeight)
                let inputAmount = $(`#${repartition.id}Amount`);
                inputAmount.val(newAmount) ;
                // If the inputWeight is zero we uncheck the Checkbox accordingly
                let checkBox = $(`#${repartition.id}`);
                (inputWeight.val() == 0 || inputWeight.val() === undefined) ? checkBox.prop('checked',false):checkBox.prop('checked',true);
            }
        }
    </script>
</head>
<body>
<div class="card-header">
    <div class="d-flex w-100 justify-content-between">
        <a class="btn btn-outline-danger"  href="operation/view_operation/<?= $operation->id ?>">Cancel</a>
        <h5 style="align-self: center " class="card-title" ><?= $tricount->title ?> > Edit expense <h5/>
            <a class="btn btn-danger" href="operation/delete_opertation/<?= $operation->id ?>/<?= $id_user ?>">Delete</a>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <!-- Horizontal Form -->
        <form action="operation/edit_operation/<?= $operation->id ?>/<?= $id_user ?>" method="post" >
            <div class="row mb-3">
                <div class="col-sm-10">
                    <input  type="text" class="form-control" id="title" name="title" value="<?= $operation->title ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="amount" name="amount" value="<?= $operation->amount ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= $operation->operation_date ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <label class="form-label" for="initiator">Paid By</label>
                    <select class="form-select" name="initiator" id="initiator">
                        <?php foreach ($operation_amount as $o): ?>
                            <option  value="<?= $o->id ?>" <?php if ($o->id == $operation->initiator) echo 'selected'; ?> ><?= $o->full_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-sm-10">
                    <p>For Whom ? (select at least one ) </p>

                    <table class="table table-borderless datatable">
                        <tbody>
                        <?php foreach ($operation_amount as $o): ?>
                            <tr>
                                <td> <input  type="checkbox" id="<?= $o->id ?>" name="<?= $o->full_name ?>" checked/></td>
                                <td> <label class="form-label" for="<?= $o->full_name ?>"><?= $o->full_name ?></label></td>
                                <td>  <input type="text" disabled class="form-control" id="<?= $o->id?>Amount" name="amount" value="<?= $o->amount ?>"  min="0" max="99999"/></td>
                                <td>  <input type="number" class="form-control" id="<?= $o->id?>Weight" name="weight[]" value="<?= $o->weight ?>" min="0" max="10"/></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
        </form><!-- End Horizontal Form -->
    </div>
</div>


</body>
</html>
