<main class="contenedor seccion">
        <h1>Contacto</h1>
        <?php 
        
            if ($mensaje) :?>
                <p class="alerta exito"><?php echo $mensaje; ?></p>;
        <?php endif;    ?>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpeg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form action="/contacto" method="POST" class="formulario">
            <fieldset>
                <legend>Información personal</legend>
                <label for="nombre">Nombre</label>
                <input required name="contacto[nombre]" id="nombre " type="text" placeholder="Tu nombre">
                
                
                <label  for="textarea">Mensaje</label>
                <textarea required name="contacto[mensaje]" id="textarea">

                </textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende o compra</label>
                <select required name="contacto[tipo]" id="opciones">

                    <option value="" disabled selected>--Selecione--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>
                <label for="precio">Precio o Presupuesto</label>
                <input required type="number" name="contacto[precio]" id="precio" placeholder="Tu precio o presupuesto" min="0">

            </fieldset>
            <fieldset>
                <legend>Contacto</legend>
                <p>Cómo desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="telefono">Teléfono</label>
                    <input required type="radio" name="contacto[contacto]" value="telefono" id="telefono">
                    <label for="email">E-mail</label>
                    <input required type="radio" name="contacto[contacto]" value="email" id="email">
                </div>
                <div id="contacto"></div>
                
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>

    </main>