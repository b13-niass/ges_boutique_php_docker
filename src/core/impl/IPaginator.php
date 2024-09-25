<?php

namespace Boutique\Core\Impl;

interface IPaginator
{
    public function initialize($items, $itemsPerPage, $currentPage);
    public function getItems();
    public function getTotalItems();

    public function getItemsPerPage();

    public function getCurrentPage();

    public function getTotalPages();

    public function getOffset();

    public function getPages();

    public function render($url);
}