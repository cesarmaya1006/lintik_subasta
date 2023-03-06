<?php
include './php/conexion_be.php';
//===========================================================
//===========================================================
//Categorias
//Trae las Categorias
$query = 'SELECT * FROM `categorias` ORDER BY `categorias`.`id_cat` ASC';
$result = mysqli_query($conexion, $query);
$categorias = $result->fetch_all(MYSQLI_ASSOC);

//===========================================================
//===========================================================
?>
<div class="row">
    <div class="col-12 col-md-3 mb-5 form-group">
        <label for="id_cat">Marca</label>
        <select class="form-control form-control-sm" name="id_cat" id="id_cat" required>
            <option value="">Seleccione</option>
            <?php foreach ($categorias as $categoria) {
                echo '<option value="' . $categoria['id_cat'] . '"';
                if (isset($producto)) {
                    if ($producto['id_cat'] == $categoria['id_cat']) {
                        echo ' selected';
                    }
                }
                echo '>' . $categoria['categoria'] . '</option>';
            } ?>
        </select>
    </div>
    <div class="col-12 col-md-3 mb-5 form-group">
        <label for="modelo_equipo">Modelo</label>
        <input type="text" class="form-control form-control-sm" name="modelo_equipo" id="modelo_equipo" aria-describedby="helpId"
        <?php if (isset($producto)) {
            echo ' value="' . $producto['modelo_equipo'] . '"';
        } ?>
        placeholder="Modelo" required>
    </div>
    <div class="col-12 col-md-3 mb-5 form-group">
        <label for="serie">Serie</label>
        <input type="text" class="form-control form-control-sm" name="serie" id="serie" aria-describedby="helpId"
        <?php if (isset($producto)) {
            echo ' value="' . $producto['serie'] . '"';
        } ?>
        placeholder="Serie" required>
    </div>
    <div class="col-12 col-md-3 mb-5 form-group">
        <label for="sist_op">Sistema Operativo</label>
        <input type="text" class="form-control form-control-sm" name="sist_op" id="sist_op" aria-describedby="helpId"
        <?php if (isset($producto)) {
            echo ' value="' . $producto['sist_op'] . '"';
        } ?>
        placeholder="Sistema Operativo" required>
    </div>
    <div class="col-12 col-md-3 mb-5 form-group">
        <label for="ram">Memoria Ram</label>
        <input type="text" class="form-control form-control-sm" name="ram" id="ram" aria-describedby="helpId"
        <?php if (isset($producto)) {
            echo ' value="' . $producto['ram'] . '"';
        } ?>
        placeholder="Memoria Ram" required>
    </div>
    <div class="col-12 col-md-3 mb-5 form-group">
        <label for="disco">Disco Duro</label>
        <input type="text" class="form-control form-control-sm" name="disco" id="disco" aria-describedby="helpId"
        <?php if (isset($producto)) {
            echo ' value="' . $producto['disco'] . '"';
        } ?>
        placeholder="Disco Duro" required>
    </div>
    <div class="col-12 col-md-3 mb-5 form-group">
        <label for="costo">Precio de aporte</label>
        <input type="text" class="form-control form-control-sm" name="costo" id="costo" aria-describedby="helpId"
        <?php if (isset($producto)) {
            echo ' value="' . $producto['costo'] . '"';
        } ?>
        placeholder="Precio de aporte" required>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 mb-5 form-group">
        <label for="costo">Notas o Comentarios del equipo</label>
        <textarea name="nota" id="nota" class="form-control form-control-sm" cols="30" rows="5"
            style="resize: none;" required>
            <?php if (isset($producto)) {
            echo ($producto['nota']);
            } ?>
        </textarea>
    </div>
    <!--
    <div class="col-12 col-md-6 mb-5 form-group">
        <label for="archivo">Imagen del Producto</label>
        <input type="file" class="form-control form-control-sm" name="archivo" id="archivo" accept="image/png,image/jpeg" 
        <?php 
        if (isset($producto)) {
            echo ' ';
        }else{
            echo(' required');
            
            }
        ?> >
    </div>
        -->
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-3 mb-5 form-group">
        <div class="d-grid gap-2">
            <button class="btn btn-info" type="submit">
            <?php 
                if (isset($producto)) {
                    echo ('Editar');
                }else{
                    echo ('Insertar');
                }
             ?>
            </button>
        </div>
    </div>
</div>
