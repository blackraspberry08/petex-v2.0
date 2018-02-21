<div class = "container">
    <div class = "row align-items-center">
        <div class = "col-xs-12 mx-auto text-center my-5">
            <?php if($status == "success"):?>
            <h1 class = "display-4">VERIFY YOUR EMAIL NOW!</h1>
            <?php elseif($status == "failed"):?>
            <h1 class = "display-4">SOMETHING WENT WRONG IN REGISTRATION</h1>
            <?php endif;?>
            <img src ="<?= base_url()?>images/main/dog.png" class = "img-circle" height = "300"/><br>
            <a href ="<?= base_url()?>main" class = "btn btn-primary mt-4">Back to main page</a>
        </div>
    </div>
</div>