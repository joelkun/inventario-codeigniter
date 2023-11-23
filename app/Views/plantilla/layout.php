<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap-4.0.0-dist/css/bootstrap.css">

  <title><?php echo $titulo ?></title>
</head>

<body>
  <?php echo $this->include('plantilla/menu'); ?>

  <?= $this->renderSection('contenido'); ?>
  <footer class="col-lg-12 d-flex justify-content-center">
    <p>Jonathan Villon <?php echo date('Y'); ?> &copy;</p>
  </footer>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?php echo base_url(); ?>js/jquery-3.6.4.js"></script>
  <script src="<?php echo base_url(); ?>js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>bootstrap-4.0.0-dist/js/bootstrap.js"></script>
  <?php echo $this->renderSection('scripts'); ?>
</body>

</html>