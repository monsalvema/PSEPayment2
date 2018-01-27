<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment page</title>

    <!-- Bootstrap core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/business-frontpage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Página de confirmación</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<!-- Header with Background Image -->
<div class="business-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="display-3 text-center text-white mt-4 mb-0">Pago de prueba</h1>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container heighbody">
    <?php if (isset($sMessage)) {
        ?>
        <div class="text-center col-sm-12 error mt-5">
            <p><?php echo $sMessage ?></p>
        </div>
    <?php } ?>
    <div class="row">
            <div class="text-center col-sm-12">
                <h5 class="mt-5 mb-5">Información de la transacción</h5>
                <table class="text-center col-sm-12 mt-4 mb-5" border="1">
                    <tr>
                        <th>Transacción</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                    <?php if (isset($oResponse)) { ?>
                    <tr>
                        <td><?php echo $oResponse->SystemTransaction->trn_id ?></td>
                        <td><?php echo $oResponse->SystemTransaction->trn_value ?></td>
                        <td><?php echo $oResponse->SystemTransaction->trn_date ?></td>
                        <td><?php echo $oResponse->PseTransasction->responseReasonText ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="text-center col-sm-12">
            <form action="index.php" method="post">
                <input type="submit" class="btn btn-primary" value="Realizar otra transacciòn"/>
            </form>
            </div>
    </div>
</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Jhonatan Monsalve 2018</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.bundle.min.js"></script>

</body>

</html>
