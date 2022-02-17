<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Ediacob\DvdRepository;
use Ediacob\FurnitureRepository;
use Ediacob\BookRepository;

$dvdRepository = new DvdRepository();
$furnitureRepository = new FurnitureRepository();
$bookRepository = new BookRepository();

$dvdRepository->resetTable();
$furnitureRepository->resetTable();
$bookRepository->resetTable();