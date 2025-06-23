<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
            <h1 class="mb-5">Most Popular Items</h1>
        </div>

        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <!-- Nav Pills -->
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <!-- All Tab -->
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="pill" href="#all">
                        <i class="fas fa-th-large fa-2x text-primary"></i> All
                    </a>
                </li>

                <?php
                $cat_res = mysqli_query($link, "SELECT * FROM food_category");
                while ($cat = mysqli_fetch_array($cat_res)) {
                    $category = $cat["food_category"];
                    $category_id = preg_replace('/[^a-zA-Z0-9_-]/', '', $category); // clean ID
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#<?= $category_id ?>">
                            <i class="fas fa-utensils fa-2x text-primary"></i> <?= $category ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
       

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- All Tab -->
                <div id="all" class="tab-pane fade show active">
                    <div class="row g-4">
                        <?php
                        $all_res = mysqli_query($link, "SELECT * FROM food");
                        if (mysqli_num_rows($all_res) > 0) {
                            while ($food = mysqli_fetch_array($all_res)) {
                        ?>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center">
                                  <a href="food_description.php?id=<?php echo    $food["id"]; ?>"><img class="flex-shrink-0 img-fluid rounded" src="../../admin/uploads/<?= $food["food_image"] ?>" alt="" style="width: 80px; height:80px;"></a>
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                       <a href="food_description.php?id=<?php echo    $food["id"]; ?>">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2" >
                                     
                                        <span><?= $food["food_name"] ?></span>
                                        <span class="text-primary"><?= $food["food_original_price"] ?></span>
                                       
                                    </h5>
                                    </a>
                                    <small class="fst-italic"><?= $food["food_description"] ?></small>
                                </div>
                            </div>
                        </div>
                        <?php }} else { ?>
                            <div class="col-12"><p class="text-muted text-center">No food items available.</p></div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Category Tabs -->
                <?php
                $cat_res = mysqli_query($link, "SELECT * FROM food_category");
                while ($cat = mysqli_fetch_array($cat_res)) {
                    $category = $cat["food_category"];
                    $category_id = preg_replace('/[^a-zA-Z0-9_-]/', '', $category); // clean ID
                ?>
                <div id="<?= $category_id ?>" class="tab-pane fade">
                    <div class="row g-4">
                        <?php
                        $food_res = mysqli_query($link, "SELECT * FROM food WHERE food_category='$category'");
                        if (mysqli_num_rows($food_res) > 0) {
                            while ($food = mysqli_fetch_array($food_res)) {
                        ?>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center">
                                                                       <a href="food_description.php?id=<?php echo    $food["id"]; ?>">

                                <img class="flex-shrink-0 img-fluid rounded" src="../../admin/uploads/<?= $food["food_image"] ?>" alt="" style="width: 80px; height:80px;">
                                                                       </a>
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                                                           <a href="food_description.php?id=<?php echo    $food["id"]; ?>">

                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span><?= $food["food_name"] ?></span>
                                        <span class="text-primary"><?= $food["food_original_price"] ?></span>
                                    </h5>
                                                                           </a>
                                    <small class="fst-italic"><?= $food["food_description"] ?></small>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                        ?>
                        <div class="col-12">
                            <p class="text-muted text-center">No items available in this category.</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Menu End -->
