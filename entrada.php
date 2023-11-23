<?php
    require './includes/app.php';
    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Guía para la decoración de tu hogar</h1>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" width="200" height="300" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>
        <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, optio ab! Distinctio ipsum quos esse eligendi, nulla vero! Commodi ea eaque, assumenda porro id voluptate odio nesciunt est labore hic!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui, cupiditate et veritatis maiores distinctio libero aut, perferendis quasi dolores at nihil eius, similique consequatur voluptatibus ea architecto hic. Accusamus, rem.</p>
        </div>
    </main>


<?php
    incluirTemplate('footer');
?>