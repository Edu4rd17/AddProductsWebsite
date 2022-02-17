<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $pageTitle ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<form method="POST" action="/?action=delete_products">
    <div class="top-container">
        <div class="columns left-column">
            <p class="product-title">Product List</p>
        </div>

        <div class="columns right-column">
            <button type="submit" name="submit" id="delete-product-btn" class="buttons mass-delete-button">Mass Delete
            </button>
            <button type="button" id="add-btn" class="buttons add-button">Add</button>
        </div>

        <hr class="line-below">

    </div>

    <div class="page-wrapper">

        <div class="top-slider">
            <i class="fas fa-chevron-left top-prev"></i>
            <i class="fas fa-chevron-right top-next"></i>
            <div class="top-wrapper">
                <?php
                if ($dvds != null) {
                    foreach ($dvds as $dvd):
                        ?>
                        <div class="div-box">
                            <input type="checkbox" id="checkbox" class="delete-checkbox" name="checkedDvdId[]"
                                   value="<?= $dvd->getDvdId() ?>">
                            <p class="product-sku"><?= $dvd->getSku() ?></p>
                            <p class="product-name"><?= $dvd->getName() ?></p>
                            <p class="product-price"><?= $dvd->getPrice() ?> $</p>
                            <p class="product-attribute">Size: <?= $dvd->getDvdSize() ?>MB</p>
                        </div>
                    <?php
                    endforeach;
                } else { ?>
                    <div class="nothing-added">
                        <p>Nothing added</p>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>

        <div class="middle-slider">
            <i class="fas fa-chevron-left middle-prev"></i>
            <i class="fas fa-chevron-right middle-next"></i>
            <div class="middle-wrapper">
                <?php
                if ($furnitures != null) {
                    foreach ($furnitures as $furniture):
                        ?>
                        <div class="div-box">
                            <input type="checkbox" id="checkbox" class="delete-checkbox" name="checkedFurnitureId[]"
                                   value="<?= $furniture->getFurnitureId() ?>">
                            <p class="product-sku"><?= $furniture->getSku() ?></p>
                            <p class="product-name"><?= $furniture->getName() ?></p>
                            <p class="product-price"><?= $furniture->getPrice() ?> $</p>
                            <p class="product-attribute">Dimensions: <?= $furniture->getHeight() ?>x<?= $furniture->getWidth() ?>x<?= $furniture->getLength() ?></p>
                        </div>
                    <?php
                    endforeach;
                } else { ?>
                    <div class="nothing-added">
                        <p>Nothing added</p>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>

        <div class="bottom-slider">
            <i class="fas fa-chevron-left bottom-prev"></i>
            <i class="fas fa-chevron-right bottom-next"></i>
            <div class="bottom-wrapper">
                <?php
                if ($books != null) {
                    foreach ($books as $book):
                        ?>
                        <div class="div-box">
                            <input type="checkbox" id="checkbox" class="delete-checkbox" name="checkedBookId[]"
                                   value="<?= $book->getBookId() ?>">
                            <p class="product-sku"><?= $book->getSku() ?></p>
                            <p class="product-name"><?= $book->getName() ?></p>
                            <p class="product-price"><?= $book->getPrice() ?> $</p>
                            <p class="product-attribute">Weight: <?= $book->getBookWeight() ?>KG</p>
                        </div>
                    <?php
                    endforeach;
                } else { ?>
                    <div class="nothing-added">
                        <p>Nothing added</p>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>

    </div>

</form>

<hr class="line-below">

<div class="bottom-title">
    <h1 class="scandiweb-title">Scandiweb Test Assignment</h1>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/08cb3f657f.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="scripts/script.js"></script>

</body>
</html>