<?php
// Template pour afficher des pages seules

get_header();
?>
<main class="page">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <h1 class="page-title"><?php the_title() ?></h1> <!-- Fait référence au post courant -->
                <div class="page-content">
                    <?php the_content() ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer();
