<?php
include '../actions/action-server.php';

//Display Validation error message
if (count($errors) > 0) { ?>
    <div class="alert alert-danger">
        <?php
        foreach ($errors as $err) {
            ?>
            <p><?= $err ?></p>
            <?php
        }
        ?>
    </div>
    <?php
}
?>