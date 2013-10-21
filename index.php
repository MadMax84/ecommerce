<?php require "include/functions.php"; ?>
<?php require "include/header.php"; ?>

<section id="conteneur">
    <div id="myCarousel" class="carousel slide hidden-phone">
        <!-- Carousel items -->
        <div id="slideshow" class="carousel-inner">
            <?php
            $backgrounds = $bdd->query('SELECT adrSlides FROM slideshow');
            foreach ($backgrounds as $background) {
                echo '<div class="item"><img src="' . $background['adrSlides'] . '"/></div>';
            }
            ?>
        </div>
    </div>
</section>

<script>
    $('.carousel').carousel({
        interval: 20000
    })
</script>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>