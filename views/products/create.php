<?php require_once('inc/header.php'); ?>

<div class="container p-5 py-5">
    <div class="row text-center">
        <div class="col-md-12">
            <a class="btn btn-primary" aria-current="page" href="<?= Core\Router::route("products") ?>">Back To Products</a>
            <h2 class="mb-4">Create Product</h2>
            <p>Explore our comprehensive range of medical equipment and solutions.</p>
        </div>
    </div>
    <div class="row">
        <div class="cal-md-8 mx-auto p-3">
            <?php
            if (Core\Session::has('success')): ?>
                <div class="alert alert-success">
                    <?= Core\Session::flash('success') ?>
                </div>
            <?php
            endif;
            $form = new Core\FormBuilder(Core\Router::route("products/store"), "POST", ["id" => "send", "class" => "border my-2 p-3"]);
            $form->input("text", "title", "", ["placeholder" => "Enter title", "class" => "form-control my-2"])
                ->input("number", "price", "", ["placeholder" => "Enter price", "class" => "form-control my-2"])
                ->textarea("description", "", ["placeholder" => "Enter description", "class" => "form-control my-2","rows"=> 3])
                ->submit("send",  ["class" => "form-control btn btn-primary"]);
            echo $form->build();
            ?>

        </div>
    </div>
</div>
<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 BioMed. All Rights Reserved.</p>
</footer>

<?php require_once('inc/footer.php'); ?>