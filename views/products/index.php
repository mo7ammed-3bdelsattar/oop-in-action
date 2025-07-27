<?php require_once('inc/header.php'); 

// var_dump($products);
?>


<!-- Products Section -->
<div class="container py-5">
    <div class="row text-center">
        <div class="col-md-12">
            <a class="btn btn-primary" aria-current="page" href="<?= Core\Router::route("products/create") ?>">Add Product</a>
            <h2 class="mb-4">Our Products</h2>
            <p>Explore our comprehensive range of medical equipment and solutions.</p>
        </div>
    </div>
    <div class="row">
        <!-- Product Card 1 -->
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="assets/Qt_Medical_Devices_Ultra_01_650px.webp" class="card-img-top" width="100%" height="350" alt="Product 2">
                <div class="card-body">
                    <h5 class="card-title">Product 3</h5>
                    <p class="card-text">Reliable solutions for modern medical practices.</p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <?php foreach($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="assets/ImageForArticle_22588_16539156642301393.webp" width="100%" height="350" class="card-img-top" alt="Product 1">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['title'] ?></h5>
                    <p class="card-text"><?= $product['description'] ?></p>
                    <p class="card-text"><?= $product['price'] ?></p>
                    <a href="#" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 BioMed. All Rights Reserved.</p>
</footer>

<?php require_once('inc/footer.php'); ?>