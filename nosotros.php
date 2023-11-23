<?php
    require './includes/app.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" width="200" height="300" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis voluptates necessitatibus optio recusandae iure libero dolor sequi ipsa magni, a aut, architecto corporis sapiente sit exercitationem eum, nam ipsum eius?
                </p>

                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem praesentium labore enim incidunt impedit quas natus.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, odio? Nisi cumque autem sequi laboriosam quod maxime cupiditate quas, facilis in? Ullam, ipsa laborum. Voluptate nisi facilis culpa veritatis blanditiis!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, odio? Nisi cumque autem sequi laboriosam quod maxime cupiditate quas, facilis in? Ullam, ipsa laborum. Voluptate nisi facilis culpa veritatis blanditiis!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, odio? Nisi cumque autem sequi laboriosam quod maxime cupiditate quas, facilis in? Ullam, ipsa laborum. Voluptate nisi facilis culpa veritatis blanditiis!</p>
            </div>
        </div>
    </section>


<?php
    incluirTemplate('footer');
?>