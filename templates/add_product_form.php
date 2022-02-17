<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $pageTitle ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/add_product.css">
</head>
<body>
<div class="top-container">
    <div class="columns left-column">
        <p class="product-title">Product Add</p>
    </div>
    <div class="columns right-column">
        <button id="cancel-btn" class="buttons cancel-button">Cancel</button>
    </div>
    <hr class="line-below">
</div>

<div class="page-wrapper">
    <div class="title">
        Fill in the details to add a product
    </div>
    <form id="product_form" method="POST" action="/?action=create_product">
        <div class="input-field">
            <label for="sku">SKU</label>
            <input type="text" class="input" id="sku" name="sku" pattern="[A-Za-z0-9]{2,30}"
                   title="30 max length! Only letters and numbers allowed!" required>
        </div>
        <div class="input-field">
            <label for="name">Name</label>
            <input type="text" class="input" id="name" name="name" pattern="{3,30}"
                   title="30 max length! Only letters allowed!" required>
        </div>
        <div class="input-field">
            <label for="price">Price($)</label>
            <input class="input" id="price" name="price" pattern="{2,4}"
                   title="Please enter in float format e.g 1$ as 1.00! Only letters allowed!" required>
        </div>
        <div class="input-field">
            <label>Type Switcher</label>
            <div class="switcher-select">
                <select id="productType" name="typeSwitcher">
                    <option value="dvd" id="DVD" name="typeDvd">Dvd</option>
                    <option value="furniture" id="Furniture" name="typeFurniture">Furniture</option>
                    <option value="book" id="Book" name="typeBook">Book</option>
                </select>
            </div>
        </div>

        <div id="dvd" class="extra_input-field">
            <div class="label-input">
                <label for="size">Size(MB)</label>
                <input type="number" class="input" id="size" name="dvdSize" min="0" pattern="{1,5}"
                       title="Please enter size as a whole number e.g 5. Only numbers allowed!">
            </div>
            <div class="product-description">
                <p class="product-description">Please provide the size of the DVD in MB.</p>
            </div>
        </div>

        <div id="furniture" class="furniture-field">
            <div class="label-input">
                <label for="height">Height(CM)</label>
                <input type="number" class="input" id="height" name="height" min="0" pattern="[0-9]{1,3}"
                       title="Please enter height as a whole number e.g 5. Only numbers allowed!">
            </div>
            <div class="label-input">
                <label for="width">Width(CM)</label>
                <input type="number" class="input" id="width" name="width" min="0" pattern="[0-9]{1,3}"
                       title="Please enter width as a whole number e.g 5. Only numbers allowed!">
            </div>
            <div class="label-input">
                <label for="length">Length(CM)</label>
                <input type="number" class="input" id="length" name="length" min="0" pattern="[0-9]{1,3}"
                       title="Please enter length as a whole number e.g 5. Only numbers allowed!">
            </div>
            <div class="product-description">
                <p class="product-description">Please provide the dimensions of the furniture in HxWxL format.</p>
            </div>
        </div>

        <div id="book" class="extra_input-field">
            <div class="label-input">
                <label for="weight">Weight(KG)</label>
                <input type="number" class="input" id="weight" name="bookWeight" min="0" pattern="[0-9]{1,3}"
                       title="Please enter weight as a whole number e.g 5. Only numbers allowed!">
            </div>
            <div class="product-description">
                <p class="product-description">Please provide the weight of the book in KG.</p>
            </div>
        </div>
        <div class="save-btn">
            <button type="submit" name="submit" id="save-btn" class="save-button">Save</button>
        </div>
    </form>
</div>

<hr class="line-below">

<div class="bottom-title">
    <h1 class="scandiweb-title">Scandiweb Test Assignment</h1>
</div>

<script type="text/javascript" src="scripts/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#productType").on('change', function () {
            $(".extra_input-field, .furniture-field").hide();
            $("#" + $(this).val()).fadeIn(100);
        }).change();
    });

    document.getElementById("cancel-btn").onclick = function () {
        location.href = "/";
    };

</script>
</body>
</html>


