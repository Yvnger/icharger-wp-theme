<?php include("header.php"); ?>

<main class="main page">
    <?php do_action('page_heading'); ?>
    <div class="container">
        <?php the_content() ?>
    </div>
</main>

<?php include('footer.php');
