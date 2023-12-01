<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio propiedad"  value="<?php echo sanitizar($propiedad->precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" name="propiedad[imagen]" id="imagen" accept="image/jpeg, image/png">

                <?php if($propiedad->imagen): ?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen de la propiedad" class="imagen-small">

                <?php endif; ?>

                <label for="descripcion">Descripción:</label>
                <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej: 3", min="1" max="9" value="<?php echo sanitizar($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej: 3", min="1" max="15" value="<?php echo sanitizar($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" placeholder="Ej: 3", min="1" max="9" value="<?php echo sanitizar($propiedad->estacionamiento); ?>">
            </fieldset>
 
            <fieldset>
                <legend>Vendedor</legend>

                <label for="vendedor">Nombre Vendedor</label>
                <select name="propiedad[vendedores_id]" id="vendedor">
                    <option seleceted value="">-- Seleccione --</option>
                    <?php foreach ($vendedores as $vendedor){ ?>
                        <option 
                            <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selelected' : ''; ?>
                            value="<?php echo sanitizar($vendedor->id);?>"><?php echo sanitizar($vendedor->nombre) . " " . sanitizar($vendedor->apellido);?>
                        </option>
                    <?php }?>
                </select>
            </fieldset>