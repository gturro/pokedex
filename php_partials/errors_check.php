
<?php if (isset($_SESSION["error"])) { ?>
        <div class='alert alert-danger alert-dismissible fade show mt-3 mx-5' role='alert'>
            <?php 
            echo $_SESSION["error"]; 
            unset($_SESSION["error"]);
            ?>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
<?php } ?>
            
<?php if (isset($_SESSION["success"])) { ?>
        <div class='alert alert-success alert-dismissible fade show mt-3 mx-5' role='alert'>
            <?php 
            echo $_SESSION["success"]; 
            unset($_SESSION["success"]);
            ?>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
<?php } ?>
