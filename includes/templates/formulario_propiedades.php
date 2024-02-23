

<fieldset>
        <legend>Información General</legend>

        <label for="titulo">Titulo:</label>
        <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Título propiedad" value="<?php echo s($propiedad->titulo); ?>">
        <label for="precio">Precio:</label>
        <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio propiedad" min="0" step="10" value="<?php echo s($propiedad->precio); ?>">
        <label for="image">Imagen:</label>
        <input type="file" name="propiedad[imagen]" id="image" accept="image/jpeg, image/png">
        <?php if ($propiedad->imagen) : ?>
        <img class="imagen-small" src="/bienesraices/imagenes/<?php echo $propiedad->imagen ?>">
        <?php endif; ?>
        <label for="descripcion">Descripción:</label>
        <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>

    </fieldset>

    <fieldset>
        <legend>Información Propiedad</legend>

        <label for="habitaciones">Habitaciones</label>
        <input type="number" name="propiedad[habitaciones]" id="habitaciones" min="1" max="9" placeholder="Ej: 3" step="1" value="<?php echo s($propiedad->habitaciones); ?>">
        <label for="wc">Baños:</label>
        <input type="number" name="propiedad[wc]" id="wc" min="1" max="9" placeholder="Ej: 3" step="1" value="<?php echo s($propiedad->wc); ?>">
        <label for="estacionamiento">Estacionamiento:</label>
        <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" min="1" max="9" placeholder="Ej: 3" step="1" value="<?php echo s($propiedad->estacionamiento); ?>">
    </fieldset>

    <fieldset>
        <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
        <select name="propiedad[vendedores_id]" id="vendedor">
            <option value=""  >--Seleccione--</option>
            <?php foreach($vendedores as $vendedor): ?>

                <option <?php echo $propiedad->vendedores_id === $vendedor->id  ? 'selected' : '' ; ?> value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre)." ".s($vendedor->apellido); ?></option>
                

            <?php endforeach; ?>

        </select>
    </fieldset>