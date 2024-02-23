

<fieldset>
        <legend>Información Personal</legend>

        <label for="nombre">Nombre:</label>
        <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre" value="<?php echo s($vendedor->nombre); ?>">
        <label for="apellido">Apellido:</label>
        <input type="text" name="vendedor[apellido]" id="apellido" placeholder="apellido" value="<?php echo s($vendedor->apellido); ?>">
        
        
    </fieldset>
    
    <fieldset>
        <legend>Información de contacto</legend>
        
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Teléfono" min="0" value="<?php echo s($vendedor->telefono); ?>">

    </fieldset>

    