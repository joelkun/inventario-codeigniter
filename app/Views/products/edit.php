<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>
<h1><?= $titulo ?></h1>
<div>
    <div class="cards">
        <?php print_r($producto) ?>
    </div>
</div>

<?php echo $this->endSection(); ?>
<?php echo $this->section('scripts'); ?>
<?php echo $this->endSection(); ?>