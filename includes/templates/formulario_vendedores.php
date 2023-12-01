<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre del Vendedor:</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre del Vendedor" value="<?php echo sanitizar($vendedores->nombre); ?>">

    <label for="apellido">Apellido del Vendedor:</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido del Vendedor" value="<?php echo sanitizar($vendedores->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra:</legend>

    <label for="telefono">Teléfono del Vendedor:</label>
    <input type="text" name="vendedor[telefono]" id="telefono" placeholder="Teléfono del Vendedor" value="<?php echo sanitizar($vendedores->telefono); ?>">
</fieldset>