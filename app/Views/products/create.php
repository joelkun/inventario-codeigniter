<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>
<div class="container">
    <h1><?= $titulo ?></h1>
    <?php if ($mensaje === '1') : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Producto creado correctamente</strong>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php elseif ($mensaje === '0') : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error al insertar los datos</strong>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif ?>
    <form action="<?php echo base_url('product/create-product') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="sku" class="col-sm-2 col-form-label col-form-label-sm">SKU</label>
            <div class="col-sm-10">
                <input type="text" name="sku" id="sku" class="form-control" placeholder="Ingrese el código SKU" require="required" value="<?php echo set_value('sku', '') ?>">
            </div>
            <p class="text-danger"><?php echo validation_show_error('sku'); ?> </p>
        </div>

        <div class="form-group row">
            <label for="nombre" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
            <div class="col-sm-10">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre" required="required" value="<?php echo set_value('nombre', '') ?>">
            </div>
            <p class="text-danger"><?php echo validation_show_error('nombre'); ?></p>
        </div>

        <div class="form-group row">
            <label for="descripcion" class="col-sm-2 col-form-label col-form-label-sm">Descripción</label>
            <div class="col-sm-10">
                <textarea name="descripcion" id="descripcion" placeholder="Ingresa una descripción" cols="100" rows="1" class="form-control"><?php echo set_value('descripcion', '') ?></textarea>
            </div>
            <p class="text-danger"><?php echo validation_show_error('descripcion'); ?></p>
        </div>

        <div class="form-group row">
            <label for="color" class="col-sm-2 col-form-label col-form-label-sm">Color</label>
            <div class="col-sm-10">
                <input type="text" id="color" name="color" class="form-control" placeholder="Ingrese el color" required="required" value="<?php echo set_value('color', '') ?>">
            </div>
            <p class="text-danger"><?php echo validation_show_error('color'); ?></p>
        </div>
        <div class="form-group row">
            <label for="imagen" class="col-sm-2 col-form-label col-form-label-sm">Imagen</label>
            <div class="col-sm-10">
                <input type="file" id="imagen" name="imagen" class="form control">
            </div>
            <p class="text-danger"><?php echo validation_show_error('imagen'); ?> </p>
        </div>
        <div class="form-group row justify-content-center">
            <input type="submit" value="Guardar" class="btn btn-success btn-lg">
        </div>
</div>
</form>
<?php echo $this->endSection(); ?>
<?php echo $this->section('scripts'); ?>
<?php echo $this->endSection(); ?>