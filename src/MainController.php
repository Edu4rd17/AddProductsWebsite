<?php

namespace Ediacob;

class MainController
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

    public function productForm()
    {
        $pageTitle = 'Add Products';

        require_once __DIR__ . "/../templates/add_product_form.php";
    }

    public function index()
    {
        $pageTitle = 'Homepage';

        $dvds = $this->dvdRepository->findAll();
        $furnitures = $this->furnitureRepository->findAll();
        $books = $this->bookRepository->findAll();

        require_once __DIR__ . "/../templates/homepage.php";
    }

    public function dvdNew(string $sku, string $name, float $price, int $dvdSize)
    {
        $dvd = new Dvd();
        $dvd->setSku($sku);
        $dvd->setName($name);
        $dvd->setPrice($price);
        $dvd->setDvdSize($dvdSize);

        $this->dvdRepository->insertDvd($dvd);
        $this->index();
    }

    public function furnitureNew(string $sku, string $name, float $price, int $height, int $width, int $length)
    {
        $furniture = new Furniture();
        $furniture->setSku($sku);
        $furniture->setName($name);
        $furniture->setPrice($price);
        $furniture->setHeight($height);
        $furniture->setWidth($width);
        $furniture->setLength($length);

        $this->furnitureRepository->insertFurniture($furniture);
        $this->index();
    }

    public function bookNew(string $sku, string $name, float $price, int $bookWeight)
    {
        $book = new Book();
        $book->setSku($sku);
        $book->setName($name);
        $book->setPrice($price);
        $book->setBookWeight($bookWeight);

        $this->bookRepository->insertBook($book);
        $this->index();
    }
}