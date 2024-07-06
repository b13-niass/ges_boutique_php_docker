
<!--    <link rel="stylesheet" type="text/css" href="/--><?php //=ASSETS_PATH?><!--/css/styles.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">-->
<!--    <script src="--><?php //=ASSETS_PATH?><!--/js/ctrlRedirect.js"></script>-->
<!doctype html>
<html lang="en" dir="ltr" class="scroll-smooth focus:scroll-auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Meta Tags -->
    <meta name="description" content="This is a page about top memu.">
    <meta name="keywords" content="hexadash, web development, UI components">
    <meta name="author" content="dashboardmarket.com">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$_ENV['ASSETS_PATH']?>/images/icon1.png">
    <!-- Title -->
    <title>Top memu</title>

    <!-- inject:css-->
    <link rel="stylesheet" href="<?=$_ENV['ASSETS_PATH']?>/vendor_assets/css/apexcharts.min.css">
    <link rel="stylesheet" href="<?=$_ENV['ASSETS_PATH']?>/vendor_assets/css/datepicker.min.css">
    <link rel="stylesheet" href="<?=$_ENV['ASSETS_PATH']?>/vendor_assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?=$_ENV['ASSETS_PATH']?>/vendor_assets/css/nouislider.min.css">
    <link rel="stylesheet" href="<?=$_ENV['ASSETS_PATH']?>/vendor_assets/css/quill.snow.css">
    <link rel="stylesheet" href="<?=$_ENV['ASSETS_PATH']?>/vendor_assets/css/svgMap.min.css">
    <link rel="stylesheet" href="<?=$_ENV['ASSETS_PATH']?>/css/styles.css">
    <!-- endinject -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css">
</head>

<body class=" bg-white [&.dark]:bg-main-dark font-jost relative text-[15px] font-normal leading-[1.5] m-0 p-0">
<!-- Aside -->

<!-- Preloader -->

<!-- <div id="preloaderId" class="preloader fixed w-full h-full z-[9999] flex items-center justify-center top-0 bg-white dark:bg-black">
    <div class="animate-spin inline-block w-[50px] h-[50px] border-[3px] border-current border-t-transparent text-primary rounded-full" role="status" aria-label="loading">
        <span class="sr-only">Loading...</span>
    </div>
</div> -->

<!-- End: Preloader -->

<aside id="asideBar" class="asidebar dark:bg-box-dark fixed start-0 top-0 z-[1035] h-screen overflow-hidden bg-white  xl:[&.collapsed]:!w-[80px] [&.collapsed]:!w-[250px] !transition-all !duration-[0.2s] ease-linear delay-[0s] !w-0 xl:[&.collapsed>.logo-wrapper]:w-[80px]">
    <div class="flex w-[280px] border-e border-[#edf2f9] dark:border-box-dark-up logo-wrapper items-center h-[71px] dark:bg-box-dark-up max-xl:hidden">
        <a href="/dashboard" class="block text-center">
            <div class="logo-full">
                <img class="ps-[27px] dark:hidden" src="<?=$_ENV['ASSETS_PATH']?>/images/logos/l4.png" alt="Logo">
                <img class="ps-[27px] hidden dark:block" src="<?=$_ENV['ASSETS_PATH']?>/images/logos/l4.png" alt="Logo">
            </div>
            <div class="hidden logo-fold">
                <img class="p-[27px] max-w-[80px]" src="<?=$_ENV['ASSETS_PATH']?>/images/logos/l4.png" alt="Logo">
            </div>
        </a>
    </div>
    <nav id="navBar" class="navBar dark:bg-box-dark start-0 max-xl:top-[80px] z-[1035] h-full overflow-y-auto bg-white xl:!w-[280px] xl:[&.collapsed]:!w-[80px] [&.collapsed]:!w-[250px] xl:[&.TopCollapsed]:!w-[0px] [&.TopCollapsed]:!w-[250px] !transition-all !duration-[0.2s] ease-linear delay-[0s] !w-0 pb-[100px] scrollbar xl:[&.collapsed]:ps-[7px] relative">
        <ul class="relative m-0 list-none px-[0.2rem] ">
            <li class="relative sub-item-wrapper group ">
                <a class="group-[.open]:bg-primary/10 rounded-e-[20px] hover:bg-primary/10 focus:bg-primary/10 active:bg-primary/10 dark:text-subtitle-dark flex h-12 cursor-pointer items-center gap-[16px] truncate px-6 py-4 text-[14px] font-medium text-body outline-none transition duration-300 ease-linear hover:text-primary dark:hover:text-title-dark hover:outline-none focus:text-primary dark:focus:text-title-dark focus:outline-none active:text-primary dark:active:text-title-dark active:outline-none [&.active]:text-primary dark:[&.active]:text-title-dark motion-reduce:transition-none dark:hover:bg-box-dark-up dark:focus:bg-box-dark-up dark:active:bg-box-dark-up group capitalize ">
                  <span class="nav-icon dark:text-subtitle-dark text-[18px] text-light-extra group-hover:text-current group-[&.active]:text-current group-focus:text-current">
                     <i class="uil uil-apps"></i>
                  </span>
                    <span class="capitalize title">Dashboard</span>
                    <span class=" arrow-down text-gray-600 dark:text-subtitle-dark absolute end-0 me-[0.8rem] ms-auto text-[18px] transition-transform duration-300 ease-linear motion-reduce:transition-none group-hover:text-current">
                     <i class="uil uil-angle-down"></i>
                  </span>
                </a>
                <ul class="sub-item !visible m-0 hidden list-none p-0 [&.show]:block scrollbar overflow-y-scroll ">
                    <li class="relative">
                        <a href="index.html" class="capitalize rounded-e-[20px] text-gray-600 hover:bg-primary/10 hover:text-primary dark:hover:text-title-dark focus:bg-primary/10 focus:text-inherit active:bg-primary/10 active:text-inherit [&.active]:text-primary dark:[&.active]:text-title-dark dark:text-subtitle-dark flex cursor-pointer items-center truncate py-[10px] pe-6 ps-[60px] text-[14px] outline-none transition duration-300 ease-linear hover:outline-none focus:outline-none active:outline-none motion-reduce:transition-none dark:hover:bg-box-dark-up dark:focus:bg-box-dark-up dark:active:bg-box-dark-up ">
                            <span>Sidebar</span>
                        </a>
                    </li>
                    <li class="relative">
                        <a href="top-menu.html" class="capitalize rounded-e-[20px] text-gray-600 hover:bg-primary/10 hover:text-primary dark:hover:text-title-dark focus:bg-primary/10 focus:text-inherit active:bg-primary/10 active:text-inherit [&.active]:text-primary dark:[&.active]:text-title-dark dark:text-subtitle-dark flex cursor-pointer items-center truncate py-[10px] pe-6 ps-[60px] text-[14px] outline-none transition duration-300 ease-linear hover:outline-none focus:outline-none active:outline-none motion-reduce:transition-none dark:hover:bg-box-dark-up dark:focus:bg-box-dark-up dark:active:bg-box-dark-up ">Top Menu</a>
                    </li>
                </ul>
            </li>
            <li class="relative">
                <a href="change-log.html" class="rounded-e-[20px] hover:bg-primary/10 focus:bg-primary/10 active:bg-primary/10 dark:text-subtitle-dark flex h-12 cursor-pointer items-center gap-[16px] truncate px-6 py-4 text-[14px] font-medium text-body outline-none transition duration-300 ease-linear hover:text-primary dark:hover:text-title-dark hover:outline-none focus:text-primary dark:focus:text-title-dark focus:outline-none active:text-primary active:outline-none [&.active]:text-primary dark:[&.active]:text-title-dark  motion-reduce:transition-none dark:hover:bg-box-dark-up dark:focus:bg-box-dark-up dark:active:bg-box-dark-up group capitalize ">
                  <span class="nav-icon dark:text-subtitle-dark text-[18px] text-light-extra group-hover:text-current group-[&.active]:text-current group-focus:text-current">
                     <i class="uil uil-arrow-growth"></i>
                  </span>
                    <span class="capitalize title">Change log</span>
                    <span class=" arrow-down absolute end-0 me-[0.8rem] ms-auto inline-flex items-center whitespace-nowrap rounded-full bg-info/10 px-[0.65em] pb-[0.25em] pt-[0.30em] text-center align-baseline text-[10px] font-bold leading-none text-info group-[&.active]:hidden">
                     1.0.1
                  </span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- End: Aside -->

<!-- Wrapping Content -->
<div class="relative flex flex-col flex-1 !transition-all !duration-[0.2s] ease-linear delay-[0s] bg-normalBG dark:bg-main-dark" id="content">
    <!-- Header -->
    <header class="sticky top-0 flex w-full bg-white xl:z-[999] max-xl:z-[9999] drop-shadow-1 dark:bg-box-dark dark:drop-shadow-none min-h-[70px]">
        <!-- Navigation -->
        <div class="flex flex-1 nav-wrap md:ps-[20px] ps-[30px] pe-[30px] max-xs:ps-[15px] max-xs:pe-[15px] bg-white dark:bg-box-dark">
            <!-- Header left menu -->

            <ul class="flex items-center mb-0 list-none nav-left ps-0 gap-x-[14px] gap-y-[9px]">
                <!-- Navigation Items -->
                <li class="flex" id="topMenu-logo">
                    <div class="flex md:w-[190px] xs:w-[170px] max-xs:w-[100px] max-md:pe-[30px] max-xs:pe-[15px] border-e border-[#edf2f9] dark:border-box-dark-up logo-wrapper items-center h-[71px] dark:bg-box-dark-up">
                        <a href="index.html" class="block text-center">
                            <div class="logo-full">
                                <img class="md:ps-[15px] dark:hidden" src="<?=$_ENV['ASSETS_PATH']?>/images/logos/l4.png" alt="Logo">
                                <img class="md:ps-[15px] hidden dark:block" src="<?=$_ENV['ASSETS_PATH']?>/images/logos/l4.png" alt="Logo">
                            </div>
                        </a>
                    </div>
                </li>
                <li class="hidden max-xl:flex">
                    <a class="flex items-center justify-center sm:min-w-[40px] sm:w-[40px] sm:h-[40px] min-w-[34px] h-[34px] rounded-full bg-transparent hover:bg-primary/10 hover:text-primary dark:hover:text-title-dark dark:hover:bg-box-dark-up group transition duration-200 ease-in-out text-[#525768] dark:text-subtitle-dark max-md:dark:hover:bg-box-dark-up sm:text-[20px] text-[19px] cursor-pointer xl:[&.hide]:hidden max-md:bg-normalBG max-md:dark:bg-box-dark-up max-md:dark:hover:text-subtitle-dark" id="slim-toggler">
                        <i class="uil uil-align-center-alt text-current [&.is-folded]:hidden flex items-center"></i>
                    </a>
                </li>
            </ul>

            <!-- Header Center menu -->

            <div class="relative ps-[30px] hexadash-top-menu xl:flex hidden">
                <ul class="flex flex-wrap items-center 2xl:gap-y-[15px] gap-x-[34px]">
                    <li class="has-subMenu">
                        <a href="#" class="">Vente</a>
                        <ul class="subMenu" style="top:40px!important;">
                            <li>
                                <a href="/vente/add" class="">
                                    <span class="menu-text">Ajouter</span>
                                </a>
                            </li>
                            <li>
                                <a href="/vente/liste" class="">
                                    <span class="menu-text">Lister</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-subMenu">
                        <a href="#" class="">Dette</a>
                        <ul class="subMenu" style="top:40px!important;">
                            <li>
                                <a href="/dette/liste" class="">
                                    <span class="menu-text">Liste</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-subMenu">
                        <a href="#" class="">Client</a>
                        <ul class="subMenu" style="top:40px!important;">
                            <li>
                                <a href="/client/liste" class="">
                                    <span class="menu-text">Liste</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-subMenu">
                        <a href="#" class="">Paiement</a>
                        <ul class="subMenu" style="top:40px!important;">
                            <li>
                                <a href="/paiement/add" class="">
                                    <span class="menu-text">Ajouter</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Header right menu -->

            <div class="flex items-center ms-auto py-[15px] sm:gap-x-[25px] max-sm:gap-x-[15px] gap-y-[15px] relative">

                <div class="relative">
                    <button type="button" class="transition-all theme-dropdown-trigger text-[20px] text-light dark:text-subtitle-dark [&.close>.uil-search]:hidden [&.close>.uil-multiply]:block">
                        <i class="uil uil-search "></i>
                        <i class="hidden uil uil-multiply "></i>
                    </button>
                    <input type="search" placeholder="search here" id="searchInput" name="search" class="theme-dropdown absolute end-0 transition-[opacity,margin] duration [&.visible]:opacity-100 [&.visible]:block opacity-0 hidden min-w-[15rem] mt-2 dark:bg-box-dark-down p-1.5 h-[48px] px-[20px] dark:shadow-none border-1 border-regular dark:border-box-dark-up rounded-6 capitalize bg-white text-body dark:text-title-dark placeholder:text-body dark:placeholder:text-subtitle-dark text-ellipsis outline-none search-close-icon:appearance-none search-close-icon:w-[20px] search-close-icon:h-[23px] search-close-icon:bg-[url(<?=$_ENV['ASSETS_PATH']?>/images/svg/x.svg)] search-close-icon:cursor-pointer">
                </div>

                <button type="button" class="flex xl:hidden items-center text-[22px] text-[#a0a0a0] dark:text-subtitle-dark min-h-[40px]" id="author-dropdown">
                    <i class="uil uil-ellipsis-v text-[18px]"></i>
                </button>
                <ul id="right-ellipsis-trigger" class="xl:flex hidden items-center justify-end flex-auto mb-0 list-none ps-0 sm:gap-x-[25px] max-sm:gap-x-[15px] gap-y-[15px] max-xl:absolute max-xl:z-[1000] max-xl:m-0 max-xl:rounded-lg max-xl:border-none max-xl:bg-white max-xl:bg-clip-padding max-xl:text-left max-xl:shadow-lg max-xl:dark:bg-neutral-700 max-xl:[&.active]:flex max-xl:end-0 max-xl:px-[20px] max-sm:px-[15px] max-xl:py-[10px] max-xl:top-[70px]">
                    <li>

                        <div class="relative" data-te-dropdown-ref>
                            <button type="button" id="author-dropdown" data-te-dropdown-toggle-ref aria-expanded="false" class="flex items-center me-1.5 text-body dark:text-subtitle-dark text-sm font-medium capitalize rounded-full md:me-0 group whitespace-nowrap">
                                <span class="sr-only">Open user menu</span>
                                <img class="min-w-[32px] w-8 h-8 rounded-full xl:me-2" src="<?=$_ENV['ASSETS_PATH']?>/images/avatars/thumbs.png" alt="user photo">
                                <span class="hidden xl:block">Vendeur</span>
                                <i class="uil uil-angle-down text-light dark:text-subtitle-dark text-[18px] hidden xl:block"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div class="absolute z-[1000] ltr:float-left rtl:float-right m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:shadow-boxLargeDark dark:bg-box-dark-down  [&[data-te-dropdown-show]]:block" aria-labelledby="author-dropdown" data-te-dropdown-menu-ref>
                                <div class="min-w-[310px] max-sm:min-w-full pt-4 px-[15px] py-[12px] bg-white dark:bg-box-dark shadow-[0_2px_8px_rgba(0,0,0,.15)] dark:shadow-[0_5px_30px_rgba(1,4,19,.60)] rounded-4">
                                    <figure class="flex items-center text-sm rounded-[8px] bg-section dark:bg-box-dark-up py-[20px] px-[25px] mb-[12px] gap-[15px]">
                                        <img class="w-8 h-8 rounded-full bg-regular" src="<?=$_ENV['ASSETS_PATH']?>/images/avatars/thumbs.png" alt="user">
                                        <figcaption>
                                            <div class="text-dark dark:text-title-dark mb-0.5 text-sm">Shamim Ahmed</div>
                                            <div class="mb-0 text-xs text-body dark:text-subtitle-dark">Software Engineer</div>
                                        </figcaption>
                                    </figure>
                                    <ul class="m-0 pb-[10px] overflow-x-hidden overflow-y-auto scrollbar bg-transparent max-h-[230px]">
                                        <li class="w-full">
                                            <div class="p-0 dark:hover:text-white hover:bg-primary/10 dark:hover:bg-box-dark-up rounded-4">
                                                <button class="inline-flex items-center text-light dark:text-subtitle-dark hover:text-primary hover:ps-6 w-full px-2.5 py-3 text-sm transition-[0.3s] gap-[10px]">
                                                    <i class="text-[16px] uil uil-user"></i>
                                                    Profile
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                    <a class="flex items-center justify-center text-sm font-medium bg-normalBG dark:bg-box-dark-up h-[50px] text-light hover:text-primary dark:hover:text-subtitle-dark dark:text-title-dark mx-[-15px] mb-[-15px] rounded-b-6 gap-[6px]" href="log-in.html">
                                        <i class="uil uil-sign-out-alt"></i> Déconnexion</a>
                                </div>
                            </div>
                        </div>


                    </li>
                </ul>
            </div>

        </div>
        <!-- End: Navigation -->
    </header>
    <!-- End: Header -->

    <!-- Main Content -->
    <main class="bg-normalBG dark:bg-main-dark">
