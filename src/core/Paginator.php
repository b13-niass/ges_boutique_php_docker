<?php
namespace Boutique\Core;

use Boutique\Core\Impl\IPaginator;

class Paginator implements IPaginator
{
    private $totalItems;
    private $itemsPerPage;
    private $currentPage;
    private $totalPages;
    private $items;

    public function initialize($items,$itemsPerPage, $currentPage){
        $this->totalItems = count($items);
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
        $this->totalPages = ceil( $this->totalItems / $itemsPerPage);
        $this->items = array_slice($items, $this->getOffset(), $this->itemsPerPage);
    }

    public function getItems(){
        return $this->items;
    }

    public function getTotalItems()
    {
        return $this->totalItems;
    }

    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getPages()
    {
        return range(1, $this->totalPages);
    }

    public function render($url)
    {
        $paginationHtml = '<div class="flex items-center md:justify-end pt-[40px]">';
        $paginationHtml .= '<nav aria-label="Page navigation example">';
        $paginationHtml .= '<ul class="flex items-center justify-center gap-2 list-style-none listItemActive">';

        if ($this->currentPage > 1) {
            $paginationHtml .= '<li>
                                    <a class="relative flex justify-center items-center rounded bg-transparent h-[30px] w-[30px] text-light transition-all duration-300 dark:text-white dark:hover:bg-box-dark-up dark:hover:text-white border border-regular dark:border-box-dark-up text-[13px] font-normal capitalize text-[rgb(64_64_64_/_var(--tw-text-opacity))] duration ease-in-out border-solid hover:bg-primary hover:text-white" href="'.$url. ($this->currentPage - 1) . '" aria-label="Previous">
                                        <i class="uil uil-angle-left text-[16px]"></i>
                                    </a>
                                </li>';
        } else {
            $paginationHtml .= '<li>
                                    <span class="relative flex justify-center items-center rounded bg-transparent h-[30px] w-[30px] text-light transition-all duration-300 dark:text-white dark:hover:bg-box-dark-up dark:hover:text-white border border-regular dark:border-box-dark-up text-[13px] font-normal capitalize text-[rgb(64_64_64_/_var(--tw-text-opacity))] duration ease-in-out border-solid hover:bg-primary hover:text-white">
                                        <i class="uil uil-angle-left text-[16px]"></i>
                                    </span>
                                </li>';
        }

        // Pages
        foreach ($this->getPages() as $page) {
            if ($page == $this->currentPage) {
                $paginationHtml .= '<li>
                                        <a class="relative flex justify-center items-center border border-regular dark:border-box-dark-up rounded bg-white text-dark h-[30px] w-[30px] text-sm transition-all duration-300 hover:bg-primary hover:text-white dark:text-white dark:bg-box-dark-up dark:hover:text-white [&.active]:bg-primary [&.active]:text-white active" href="'.$url . $page . '">' . $page . '</a>
                                    </li>';
            } else {
                $paginationHtml .= '<li>
                                        <a class="relative flex justify-center items-center border border-regular dark:border-box-dark-up rounded bg-white text-dark h-[30px] w-[30px] text-sm transition-all duration-300 hover:bg-primary hover:text-white dark:text-white dark:bg-box-dark-up dark:hover:text-white [&.active]:bg-primary [&.active]:text-white" href="'.$url . $page . '">' . $page . '</a>
                                    </li>';
            }
        }

        // Bouton "Suivant"
        if ($this->currentPage < $this->totalPages) {
            $paginationHtml .= '<li>
                                    <a class="relative flex justify-center items-center rounded bg-transparent h-[30px] w-[30px] text-light transition-all duration-300 dark:text-white dark:hover:bg-box-dark-up dark:hover:text-white border border-regular dark:border-box-dark-up text-[13px] font-normal capitalize text-[rgb(64_64_64_/_var(--tw-text-opacity))] duration ease-in-out border-solid hover:bg-primary hover:text-white" href="'.$url . ($this->currentPage + 1) . '" aria-label="Next">
                                        <i class="uil uil-angle-right text-[16px]"></i>
                                    </a>
                                </li>';
        } else {
            $paginationHtml .= '<li>
                                    <span class="relative flex justify-center items-center rounded bg-transparent h-[30px] w-[30px] text-light transition-all duration-300 dark:text-white dark:hover:bg-box-dark-up dark:hover:text-white border border-regular dark:border-box-dark-up text-[13px] font-normal capitalize text-[rgb(64_64_64_/_var(--tw-text-opacity))] duration ease-in-out border-solid hover:bg-primary hover:text-white">
                                        <i class="uil uil-angle-right text-[16px]"></i>
                                    </span>
                                </li>';
        }

        $paginationHtml .= '</ul>';
        $paginationHtml .= '</nav>';
        $paginationHtml .= '</div>';

        return $paginationHtml;
    }

}
