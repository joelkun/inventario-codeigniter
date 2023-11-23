<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>
<div class="container" id="container">
    <?php if ($mensaje === '1') : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Producto actualizado correctamente</strong>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php elseif ($mensaje === '0') : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error al actualizar los datos</strong>
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif ?>
    <div class="row" id="box">
        <?php if (!empty($productos)) : ?>
            <?php foreach ($productos as $producto) : ?>
                <div class="col-sm-4 pt-5">
                    <div class="card col p-0 me-3">
                        <img class="card-img-top img-fluid w-75 mx-auto" src="<?= base_url() ?>uploads/img/<?= $producto['imagen'] ?>">
                        <div class="card-body">
                            <p><strong>SKU:</strong><?php echo $producto['sku'] ?></p>
                            <h3 class="card-title"><?php echo $producto['nombre'] ?></h3>
                            <p class="card-text">
                                <?php echo $producto['descripcion'] ?>
                            </p>
                            <a href="#" class="btn btn-info abrirmodal" id="<?php echo $producto['id']; ?>" onclick="modalEdit(this)" data-toggle="modal" data-target="#modal_producto">Editar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <div id="modal_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalProductoLabel" aria-hidden="true">
        <!-- Modal content -->
        <div class="modal-dialog" align="center">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalProductoLabel">Editar Producto</h4>
                    <button type="button" class=" close1" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="formEdit" action="<?php echo base_url('product/edit-product') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div>
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="form-group row">
                            <label for="sku" class="col-sm-2 col-form-label col-form-label-sm">SKU</label>
                            <div class="col-sm-10">
                                <input type="text" name="sku" id="sku" class="form-control" placeholder="Ingrese el código SKU" require="required">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre" required="required">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-sm-2 col-form-label col-form-label-sm">Descripción</label>
                            <div class="col-sm-10">
                                <textarea name="descripcion" id="descripcion" placeholder="Ingresa una descripción" cols="100" rows="1" class="form-control"></textarea>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="color" class="col-sm-2 col-form-label col-form-label-sm">Color</label>
                            <div class="col-sm-10">
                                <input type="text" id="color" name="color" class="form-control" placeholder="Ingrese el color" required="required">
                            </div>

                        </div>
                        <div class="from-group row">
                            <label for="estado" class="col-sm-2 col-form-label col-form-label-sm">Estado</label>
                            <div class="col-sm-10">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="1" selected>Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imagen" class="col-sm-2 col-form-label col-form-label-sm">Imagen</label>
                            <div class="col-sm-10">
                                <input type="file" id="imagen" name="imagen" class="form control">
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="EnviarFormulario()">Editar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>

</div>
</div>


<?php echo $this->endSection(); ?>
<?php echo $this->section('scripts'); ?>
<script src="<?php echo base_url(); ?>js/search.js"></script>
<script src="<?php echo base_url(); ?>js/modal.js"></script>
<?php echo $this->endSection(); ?>