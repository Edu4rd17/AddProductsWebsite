<?php

namespace Ediacob;

class Application
{
    private DvdRepository $dvdRepository;
    private FurnitureRepository $furnitureRepository;
    private BookRepository $bookRepository;

    public function __construct()
    {
        $this->dvdRepository = new DvdRepository();
        $this->furnitureRepository = new FurnitureRepository();
        $this->bookRepository = new BookRepository();
    }

    public function run()
    {

        $mainController = new MainController();

        $action = filter_input(INPUT_GET, 'action');
        switch ($action) {
            case 'add_product_form':
                $mainController->productForm();
                break;

            case 'delete_products':
                $checkedDvdId = $_POST['checkedDvdId'];
                $checkedFurnitureId = $_POST['checkedFurnitureId'];
                $checkedBookId = $_POST['checkedBookId'];

                if ($checkedDvdId != null) {
                    $this->dvdRepository->deleteD($checkedDvdId);
                }

                if ($checkedFurnitureId != null) {
                    $this->furnitureRepository->deleteF($checkedFurnitureId);
                }
                if ($checkedBookId != null) {
                    $this->bookRepository->deleteB($checkedBookId);
                }

                $mainController->index();
                break;


            case 'create_product':

                $typeSwitcher = filter_input(INPUT_POST, 'typeSwitcher');
                switch ($typeSwitcher) {
                    case "dvd":
                        $sku = filter_input(INPUT_POST, 'sku');
                        $name = filter_input(INPUT_POST, 'name');
                        $price = filter_input(INPUT_POST, 'price');
                        $dvdSize = filter_input(INPUT_POST, 'dvdSize');

                        $mainController->dvdNew($sku, $name, $price, $dvdSize);
                        break;

                    case 'furniture':
                        $sku = filter_input(INPUT_POST, 'sku');
                        $name = filter_input(INPUT_POST, 'name');
                        $price = filter_input(INPUT_POST, 'price');
                        $height = filter_input(INPUT_POST, 'height');
                        $width = filter_input(INPUT_POST, 'width');
                        $length = filter_input(INPUT_POST, 'length');

                        $mainController->furnitureNew($sku, $name, $price, $height, $width, $length);
                        break;

                    case 'book':
                        $sku = filter_input(INPUT_POST, 'sku');
                        $name = filter_input(INPUT_POST, 'name');
                        $price = filter_input(INPUT_POST, 'price');
                        $bookWeight = filter_input(INPUT_POST, 'bookWeight');

                        $mainController->bookNew($sku, $name, $price, $bookWeight);
                        break;

                }
                break;

            case 'homepage':
            default:
                $mainController->index();
        }
    }
}