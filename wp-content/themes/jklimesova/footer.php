<?php
/**
 * The template for displaying the footer
 */
?>

<div id="wrapper-footer-full">
    <div class="container">
        <div class="row">
            <!-- První sloupec -->
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
            
            <!-- Druhý sloupec -->
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
            
            <!-- Třetí sloupec -->
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>
            
            <!-- Čtvrtý sloupec -->
            <div class="col-md-3">
                <?php dynamic_sidebar('footer-4'); ?>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Všechna práva vyhrazena.</p>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
