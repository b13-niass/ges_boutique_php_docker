<div class=" mx-[30px] min-h-[calc(100vh-195px)] mb-[30px] ssm:mt-[30px] mt-[15px]">

    <div class="grid grid-cols-12 gap-[25px]">
        <div class="col-span-12 xl:col-span-5">
            <div class="bg-white dark:bg-box-dark m-0 p-0 text-body dark:text-subtitle-dark text-[15px] rounded-10 relative">
                <div class="px-[25px] text-dark dark:text-title-dark font-medium text-[17px] flex flex-wrap items-center justify-between max-sm:flex-col max-sm:h-auto border-b border-regular dark:border-box-dark-up">
                    <h1 class="mb-0 inline-flex items-center py-[5px] overflow-hidden whitespace-nowrap text-ellipsis text-[18px] font-semibold text-dark dark:text-title-dark capitalize">
                        Nouveau Client
                    </h1>
                </div>
                <div class="p-[25px]">
                    <form action="/dettes/client" method="POST" enctype="multipart/form-data">
                        <div class="flex flex-col md:flex-row pb-4 gap-[8px]">
                            <label for="name" class="inline-flex items-center w-[100px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Nom</label>
                            <div class="flex flex-col flex-1 md:flex-col">
                                <input type="text" name="nom" id="name" value="<?= isset($validValues['nom']) && !empty($validValues['nom']) ? $validValues['nom'] : '' ?>" class=" rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="Nom" autocomplete="username">
                                <span class="text-danger text-sm <?php isset($errorForm['nom']) && !empty($errorForm['nom']) ? 'visible' : 'invisible' ?>"><?= isset($errorForm['nom']) && !empty($errorForm['nom']) ? $errorForm['nom'] : '' ?></span>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row pb-4 gap-[8px]">
                            <label for="prenom" class="inline-flex items-center w-[100px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Prenom</label>
                            <div class="flex flex-col flex-1 md:flex-col">
                                <input type="text" name="prenom" value="<?= isset($validValues['prenom']) && !empty($validValues['prenom']) ? $validValues['prenom'] : '' ?>" id="prenom" class="w-full rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark  focus:ring-primary focus:border-primary" placeholder="Prenom" autocomplete="username">

                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row pb-4 gap-[8px]">
                            <label for="email" class="inline-flex items-center w-[100px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Email</label>
                            <div class="flex flex-col flex-1 md:flex-col">
                                <input type="text" name="email" id="email" value="<?= isset($validValues['email']) && !empty($validValues['email']) ? $validValues['email'] : '' ?>" class="rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="email@exemple.com" autocomplete="current-password">
                                <span class="text-danger text-sm <?php isset($errorForm['email']) && !empty($errorForm['email']) ? 'visible' : 'invisible' ?>"><?= isset($errorForm['email']) && !empty($errorForm['email']) ? $errorForm['email'] : '' ?></span>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row pb-4 gap-[8px]">
                            <label for="telephone" class="inline-flex items-center w-[100px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Telephone</label>
                            <div class="flex flex-col flex-1 md:flex-col">
                                <input type="text" name="telephone" id="telephone" value="<?= isset($validValues['telephone']) && !empty($validValues['telephone']) ? $validValues['telephone'] : '' ?>" class="rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="Téléphone" autocomplete="current-password">
                                <span class="text-danger text-sm <?php isset($errorForm['telephone']) && !empty($errorForm['telephone']) ? 'visible' : 'invisible' ?>"><?= isset($errorForm['telephone']) && !empty($errorForm['telephone']) ? $errorForm['telephone'] : '' ?></span>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row pb-4 gap-[8px]">
                            <label for="photo" class="inline-flex items-center w-[100px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Photo</label>
                            <div class="flex flex-col flex-1 md:flex-col">
                                <!-- <input type="text" name="photo" id="photo" class="rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="photo" autocomplete="current-password"> -->
                                <div class="h-[62px] w-full">
                                    <div class="h-[62px] flex items-center justify-center w-full">
                                        <label for="dropzone-file" class="h-[62px] flex flex-col items-center justify-center w-full ssm:h-[62px] transition-all duration-300 ease-linear bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer dark:hover:bg-bray-800 dark:bg-box-dark-up hover:bg-gray-100 dark:border-box-dark-up dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                            <div class="flex flex-col items-center justify-center py-5">
                                                <p class="text-[15px] text-light font-medium dark:text-subtitle-dark">Drop files here to
                                                    upload
                                                </p>
                                            </div>
                                            <input id="dropzone-file" name="photo" type="file" class="hidden" />
                                        </label>
                                    </div>
                                    <span class="text-danger text-sm <?php isset($errorForm['photo']) && !empty($errorForm['photo']) ? 'visible' : 'invisible' ?>"><?= isset($errorForm['photo']) && !empty($errorForm['photo']) ? $errorForm['photo'] : '' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="sm:ms-[186px] flex items-center gap-[15px] mt-[14px]">
                            <button type="submit" class="px-[30px] h-[44px] text-white bg-primary border-primary hover:bg-primary-hbr font-medium rounded-4 text-sm w-full sm:w-auto text-center inline-flex items-center justify-center capitalize transition-all duration-300 ease-linear" data-te-ripple-init="" data-te-ripple-color="light">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <div class="<?= (isset($success) && !empty($success)) ? '' : 'hidden' ?> p-[25px] pt-0 flex flex-col gap-[15px]">
                    <div class="hidden w-full data-[te-alert-show]:inline-flex px-[20px] py-[10px] text-[14px] rounded-lg bg-success/10 text-success border-1 border-success/10 capitalize justify-between flex-wrap items-center  transition-all duration-300 ease-linear " role="alert" data-te-alert-init="" data-te-alert-show="">
                        <div class="flex items-baseline flex-wrap gap-[8px]">
                            <div>
                                <p class="font-normal text-[14px]"><?= $success ?></p>
                            </div>
                        </div>
                        <button type="button" class="box-content border-none rounded-none opacity-50 ms-auto hover:text-warning-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none text-dark dark:text-title-dark" data-te-alert-dismiss="" aria-label="Close">
                            <span class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&amp;.disabled]:pointer-events-none [&amp;.disabled]:select-none [&amp;.disabled]:opacity-25 capitalize text-[12px]">
                                <i class="uil uil-multiply text-[14px]"></i>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="<?= (isset($error) && !empty($error)) ? '' : 'hidden' ?> p-[25px] pt-0 flex flex-col gap-[15px]">
                    <div class="hidden w-full data-[te-alert-show]:inline-flex px-[20px] py-[10px] text-[14px] rounded-lg bg-danger/10 text-danger border-1 border-success/10 capitalize justify-between flex-wrap items-center  transition-all duration-300 ease-linear " role="alert" data-te-alert-init="" data-te-alert-show="">
                        <div class="flex items-baseline flex-wrap gap-[8px]">
                            <div>
                                <p class="font-normal text-[14px]"><?= $error ?></p>
                            </div>
                        </div>
                        <button type="button" class="box-content border-none rounded-none opacity-50 ms-auto hover:text-warning-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none text-dark dark:text-title-dark" data-te-alert-dismiss="" aria-label="Close">
                            <span class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&amp;.disabled]:pointer-events-none [&amp;.disabled]:select-none [&amp;.disabled]:opacity-25 capitalize text-[12px]">
                                <i class="uil uil-multiply text-[14px]"></i>
                            </span>
                        </button>
                    </div>
                </div>
                <?php

//                use Boutique\Core\Session;

                \Boutique\App\App::getSession()->unset('success');
                \Boutique\App\App::getSession()->unset('error');
                \Boutique\App\App::getSession()->unset('errorForm');
                \Boutique\App\App::getSession()->unset('validValues');
                ?>
            </div>
        </div>
        <div class="col-span-12 xl:col-span-7">
            <div class="bg-white dark:bg-box-dark m-0 p-0 text-body dark:text-subtitle-dark text-[15px] rounded-10 relative">
                <div class="px-[25px] text-dark dark:text-title-dark font-medium text-[17px] flex flex-wrap items-center justify-between max-sm:flex-col max-sm:h-auto border-b border-regular dark:border-box-dark-up">
                    <h1 class="mb-0 inline-flex items-center py-[5px] overflow-hidden whitespace-nowrap text-ellipsis text-[18px] font-semibold text-dark dark:text-title-dark capitalize">
                        Suivie Dette
                    </h1>
                </div>
                <div class="p-[5px]">
                    <form action="/dettes/client/search" method="POST">
                        <div class="flex flex-col justify-center pl-1 pb-3 md:flex-row">
                            <label for="nameIcon" class="inline-flex items-center w-[50px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Téléphone</label>
                            <div class="flex items-center justify-center flex-1 gap-x-3">
                                <div class="w-[80%] rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[15px] py-[12px] min-h-[50px] focus:ring-primary focus:border-primary gap-[12px]  flex items-center">
                                    <span class="inline-flex items-center text-sm text-light dark:text-subtitle-dark me-[8px]">
                                        <i class="uil uil-phone text-[16px]"></i>
                                    </span>
                                    <input type="text" name="telephone_search" value="<?= isset($clientFound) && !empty($clientFound) ? $clientFound->telephone : '' ?>" id="nameIcon" class="outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full bg-transparent" placeholder="Rechercher client par téléphone" autocomplete="username">
                                </div>
                                <button type="submit" class="px-[30px] h-[44px] text-white bg-primary border-primary hover:bg-primary-hbr font-medium rounded-4 text-sm w-full sm:w-auto text-center inline-flex items-center justify-center capitalize transition-all duration-300 ease-linear" data-te-ripple-init="" data-te-ripple-color="light">OK</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="px-[25px] py-[16px] flex items-center">
                    <div class="grid w-full grid-cols-1">
                        <div>
                            <ul class="flex flex-row flex-wrap pl-0 mb-5 list-none border-b-0" role="tablist" data-te-nav-ref>
                                <li role="presentation">
                                    <a href="#tabs-home-one" class="block border-x-0 border-b-2 border-t-0 border-transparent px-3 py-2 me-4 text-14 font-normal capitalize leading-tight text-dark hover:isolate hover:border-transparent focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400" data-te-toggle="pill" data-te-target="#tabs-home-one" data-te-nav-active role="tab" aria-controls="tabs-home-one" aria-selected="true">Client</a>
                                </li>
                                <li>
                                    <a href="/dettes/add" class="block border-x-0 border-b-2 border-t-0 border-transparent px-3 py-2 me-4 text-14 font-normal capitalize leading-tight text-dark hover:isolate hover:border-transparent focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">Nouvelle</a>
                                </li>
                                <li>
                                    <a href="/dettes/liste" class="block border-x-0 border-b-2 border-t-0 border-transparent px-3 py-2  text-14 font-normal capitalize leading-tight text-dark hover:isolate hover:border-transparent focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400">Dettes</a>
                                </li>
                            </ul>

                            <!--Tabs content-->
                            <div class="mb-[18px]">
                                <div class="hidden opacity-100 text-breadcrumbs text-14 transition-opacity duration-150 ease-linear data-[te-tab-active]:block" id="tabs-home-one" role="tabpanel" aria-labelledby="tabs-home-tab" data-te-tab-active>
                                    <div class="p-[25px] flex flex-row gap-[20px]">
                                        <div class="flex items-center gap-[15px]">
                                            <div class="w-[150px] h-[150px] rounded-md bg-[#e7e8e9] inline-flex items-center justify-center">
                                                <img class="w-[80px] h-[80px]" src="<?= isset($clientFound) && !empty($clientFound) ? $_ENV['ASSETS_PATH'] . '/images/mes_images/' . $clientFound->photo : '' ?>" alt="Rounded avatar">
                                            </div>
                                        </div>
                                        <div class="flex flex-col justify-center gap-[15px]">
                                            <div class="text-20 font-semibold text-dark dark:text-title-dark">Nom: <span><?= isset($clientFound) && !empty($clientFound) ? $clientFound->nom : '' ?></span></div>
                                            <div class="text-20 font-semibold text-dark dark:text-title-dark">Prenom: <span><?= isset($clientFound) && !empty($clientFound) ? $clientFound->prenom : '' ?></span></div>
                                            <div class="text-20 font-semibold text-dark dark:text-title-dark">Email: <span><?= isset($clientFound) && !empty($clientFound) ? $clientFound->email : '' ?></span></div>
                                            <!-- <span class="text-sm text-gray-400 dark:text-subtitle-dark">Email</span> -->
                                        </div>
                                    </div>
                                    <div class="p-[15px] flex flex-row gap-[20px]">
                                        <div class="flex flex-col justify-center gap-[15px]">
                                            <div class="text-20 underline font-semibold text-dark dark:text-title-dark">Total Dette: <span><?= isset($total_dette) && !empty($total_dette) ? $total_dette . ' Fcfa' : '0 Fcfa' ?></span></div>
                                            <div class="text-20 underline font-semibold text-dark dark:text-title-dark">Montant Versé: <span><?= isset($montant_verse) && !empty($montant_verse) ? $montant_verse . ' Fcfa' : '0 Fcfa' ?></span></div>
                                            <div class="text-20 underline font-semibold text-dark dark:text-title-dark">Montant Restant: <span><?= isset($montant_restant) && !empty($montant_restant) ? $montant_restant . ' Fcfa' : '0 Fcfa' ?></span></div>
                                            <!-- <span class="text-sm text-gray-400 dark:text-subtitle-dark">Email</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ends: tab-basic-->


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>