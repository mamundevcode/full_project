<?php
require_once("function/function.php");
needLogged();
get_header();
get_sidebar();
?>
<div class="row">
    <div class="col-md-12 welcome_part">
        <p><span>Assalamualicum Mr.</span> <?= $_SESSION['name']; ?></p>
    </div>
</div>

<?php
get_footer();

?>