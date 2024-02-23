<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach ($errores as $error):?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach; ?>
        <form action="/login" method="POST" class="formulario">
        <fieldset>
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" placeholder="correo@correo.com" required>
                <label for="password">Password:</label>
                <input id="password" name="password" type="password">
              
            <input type="submit" value="Iniciar Seseión" class="boton boton-verde" required>
        </form>
    </main>