<div class=" mx-[30px] min-h-[calc(100vh-195px)] mb-[30px] ssm:mt-[30px] mt-[15px]">
    <div class="grid grid-cols-12 gap-[25px]">
        <div class="col-span-12">
            <div class="bg-white dark:bg-box-dark m-0 p-0 text-body dark:text-subtitle-dark text-[15px] rounded-10 relative">
                <div class="px-[25px] text-dark dark:text-title-dark font-medium text-[17px] flex flex-wrap items-center justify-between max-sm:flex-col max-sm:h-auto border-b border-regular dark:border-box-dark-up">
                    <h1 class="flex-1 mb-0 inline-flex items-center py-[5px] overflow-hidden whitespace-nowrap text-ellipsis text-[18px] font-semibold text-dark dark:text-title-dark capitalize">
                        Suivie Dette
                    </h1>
                    <div class="flex-1 text-20 underline font-semibold text-dark dark:text-title-dark">Client: <span><?= isset($clientFound) && !empty($clientFound) ? $clientFound->prenom . ' ' . $clientFound->nom : '' ?></span></div>
                    <div class="flex-1  text-20 underline font-semibold text-dark dark:text-title-dark">Téléphone: <span><?= isset($clientFound) && !empty($clientFound) ? $clientFound->telephone : '' ?></span></div>
                </div>
                <div class="px-[25px] py-[5px]">
                    <form action="/dettes/add/search" method="POST">
                        <div class="pb-4">
                            <label for="nameVertical" class="inline-flex items-center w-[108px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Reference</label>
                            <div class="flex flex-col md:w-[37%] gap-3 flex-1 md:flex-row">
                                <input type="text" name="reference" value="<?= isset($current_article) && !empty($current_article) ? $current_article->reference : '' ?>" id="nameVertical" class="rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="Reference" autocomplete="username">
                                <button type="submit" class="px-[30px] h-[44px] text-white bg-primary border-primary hover:bg-primary-hbr font-medium rounded-4 text-sm w-full sm:w-auto text-center inline-flex items-center justify-center capitalize transition-all duration-300 ease-linear" data-te-ripple-init="" data-te-ripple-color="light">OK</button>
                            </div>
                            <span class="text-danger text-sm <?php isset($errorSearchRef) && !empty($errorSearchRef) ? 'visible' : 'invisible' ?>"><?= isset($errorSearchRef) && !empty($errorSearchRef) ? $errorSearchRef : '' ?></span>
                        </div>
                    </form>
                    <form action="/dettes/add/article" method="POST" class="bg-primary/10 px-3 flex flex-row flex-wrap gap-3 items-center">
                        <div class="pb-4 flex-1">
                            <label for="nameVertical" class="inline-flex items-center w-[108px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Libelle</label>
                            <div class="flex flex-col md:w-[100%] gap-3 flex-1 md:flex-row">
                                <input type="text" value="<?= isset($current_article) && !empty($current_article) ? $current_article->libelle : '' ?>" disabled name="libelle" id="nameVertical" class=" rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="Libelle" autocomplete="username">
                            </div>
                        </div>
                        <div class="pb-4 flex-1">
                            <label for="nameVertical" class="inline-flex items-center w-[108px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Prix</label>
                            <div class="flex flex-col md:w-[100%] gap-3 flex-1 md:flex-row">
                                <input type="text" value="<?= isset($current_article) && !empty($current_article) ? $current_article->prix : '' ?>" disabled name="prix" id="nameVertical" class=" rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="Prix" autocomplete="username">
                            </div>
                        </div>
                        <div class="pb-4 flex-1">
                            <label for="nameVertical" class="inline-flex items-center w-[108px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Quantite</label>
                            <div class="flex flex-col md:w-[100%] gap-3 flex-1 md:flex-row">
                                <input type="text" name="quantite" id="nameVertical" class=" rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="Quantité" autocomplete="username">
                            </div>
                            <span class="text-danger text-sm <?php isset($errorAdd['quantite']) && !empty($errorAdd['quantite']) ? 'visible' : 'invisible' ?>"><?= isset($errorAdd['quantite']) && !empty($errorAdd['quantite']) ? $errorAdd['quantite'] : '' ?></span>
                        </div>
                        <button type="submit" class="flex-1/2 px-[30px] h-[44px] text-white bg-primary border-primary hover:bg-primary-hbr font-medium rounded-4 text-sm w-full sm:w-auto text-center inline-flex items-center justify-center capitalize transition-all duration-300 ease-linear" data-te-ripple-init="" data-te-ripple-color="light">Ajouter</button>
                    </form>
                </div>
                <div class="p-[25px]">

                    <div class="overflow-x-auto scrollbar">
                        <table class="min-w-full text-sm font-light text-start">
                            <thead class="font-medium">
                                <tr>
                                    <th scope="col" class="bg-[#f8f9fb] dark:bg-box-dark-up px-4 py-3.5 text-start text-body dark:text-title-dark text-[15px] font-medium border-none before:hidden capitalize">
                                        Article</th>
                                    <th scope="col" class="bg-[#f8f9fb] dark:bg-box-dark-up px-4 py-3.5 text-start text-body dark:text-title-dark text-[15px] font-medium border-none before:hidden capitalize">
                                        Prix</th>
                                    <th scope="col" class="bg-[#f8f9fb] dark:bg-box-dark-up px-4 py-3.5 text-start text-body dark:text-title-dark text-[15px] font-medium border-none before:hidden capitalize">
                                        Quantité</th>
                                    <th scope="col" class="bg-[#f8f9fb] dark:bg-box-dark-up px-4 py-3.5 text-start text-body dark:text-title-dark text-[15px] font-medium border-none before:hidden capitalize">
                                        Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($panier) && !empty($panier)) {
                                    foreach ($panier as $p) {
                                ?>

                                        <tr class="group">
                                            <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                                <?= $p->libelle ?></td>
                                            <td class="px-4 py-2.5 font-normal last:text-end lowercase text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                                <?= $p->prix ?></td>
                                            <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                                <?= $p->qte ?></td>
                                            <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                                <?= $p->prix * $p->qte ?></td>
                                        </tr>

                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="flex items-center md:justify-end pt-[40px] mr-10">
                            <div class="underline text-xl">Total: <span><?= isset($montant_total) && !empty($montant_total) ? $montant_total . ' Fcfa' : '0 Fcfa' ?></span></div>
                        </div>

                        <!-- <div class="flex items-center md:justify-end pt-[40px]">
                            <nav aria-label="Page navigation example">
                                <ul class="flex items-center justify-center gap-2 list-style-none listItemActive">
                                    <li>
                                        <a class="relative flex justify-center items-center rounded bg-transparent h-[30px] w-[30px]  text-light transition-all duration-300 dark:text-white dark:hover:bg-box-dark-up dark:hover:text-white  border border-regular dark:border-box-dark-up  text-[13px] font-normal capitalize text-[rgb(64_64_64_/_var(--tw-text-opacity))] duration ease-in-out border-solid hover:bg-primary hover:text-white" href="#" aria-label="Previous">
                                            <i class="uil uil-angle-left text-[16px]"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="relative flex justify-center items-center border border-regular dark:border-box-dark-up rounded bg-white text-dark h-[30px] w-[30px] text-sm transition-all duration-300 hover:bg-primary hover:text-white dark:text-white dark:bg-box-dark-up dark:hover:text-white [&.active]:bg-primary [&.active]:text-white active" href="#">1</a>
                                    </li>
                                    <li aria-current="page">
                                        <a class="relative flex justify-center items-center border border-regular dark:border-box-dark-up rounded bg-white text-dark h-[30px] w-[30px] text-sm transition-all duration-300 hover:bg-primary hover:text-white dark:text-white dark:bg-box-dark-up dark:hover:text-white [&.active]:bg-primary [&.active]:text-white" href="#">2</a>
                                    </li>
                                    <li>
                                        <a class="relative flex justify-center items-center border border-regular dark:border-box-dark-up rounded  bg-white text-dark h-[30px] w-[30px] text-sm transition-all duration-300 hover:bg-primary hover:text-white dark:text-white dark:bg-box-dark-up dark:hover:text-white [&.active]:bg-primary [&.active]:text-white" href="#">3</a>
                                    </li>
                                    <li>
                                        <a class="relative flex justify-center items-center rounded bg-transparent h-[30px] w-[30px]  text-light transition-all duration-300 dark:text-white dark:hover:bg-box-dark-up dark:hover:text-white  border border-regular dark:border-box-dark-up text-[13px] font-normal capitalize text-[rgb(64_64_64_/_var(--tw-text-opacity))] duration ease-in-out border-solid hover:bg-primary hover:text-white cursor-pointer" href="#" aria-label="Next">
                                            <i class="uil uil-angle-right text-[16px]"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->

                    </div>

                </div>
            </div>
        </div>
        <div class="col-span-12 flex items-center md:justify-end pt-[40px] mr-10">
            <a href="/dettes/add/new" class="bg-primary hover:bg-primary-hbr border-solid border-1 border-primary text-white dark:text-title-dark 
        text-[14px] font-semibold leading-[22px] inline-flex items-center justify-center rounded-[4px] px-[20px] h-[50px]
         shadow-btn transition duration-300 ease-in-out w-[40%]"> Enregistrer </a>
        </div>
    </div>
</div>

<?php

use Boutique\Core\Session;

Session::unset('errorSearchRef');
Session::unset('errorAdd');
// Session::unset('panier');
// Session::unset('current_article');
?>