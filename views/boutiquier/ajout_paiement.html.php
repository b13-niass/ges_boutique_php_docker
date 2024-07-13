<div class=" flex items-center justify-center mx-[30px] min-h-[calc(100vh-195px)] mb-[30px] ssm:mt-[30px] mt-[15px]">


    <div class="grid grid-cols-12 w-[50%] gap-[25px]">
        <div class="col-span-12">
            <div class="bg-white dark:bg-box-dark m-0 p-0 text-body dark:text-subtitle-dark text-[15px] rounded-10 relative">
                <div class="px-[25px] text-dark dark:text-title-dark font-medium text-[17px] flex flex-wrap items-center justify-between max-sm:flex-col max-sm:h-auto border-b border-regular dark:border-box-dark-up">
                    <h1 class="mb-0 inline-flex items-center py-[16px] overflow-hidden whitespace-nowrap text-ellipsis text-[18px] font-semibold text-dark dark:text-title-dark capitalize">
                        Ajouter Paiement
                    </h1>
                </div>

                <div class="p-[25px]">

                    <div class="overflow-x-auto scrollbar">
                        <table class="min-w-full text-sm font-light text-start">

                            <tbody>
                                <tr class="group border-b border-neutral-200 dark:border-neutral-500 transition ease-in-out duration-300 motion-reduce:transition-none">
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        Client:
                                    </td>
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        <?= $clientFound->prenom . ' ' . $clientFound->nom ?>
                                    </td>
                                </tr>

                                <tr class="group border-b border-neutral-200 dark:border-neutral-500 transition ease-in-out duration-300 motion-reduce:transition-none">
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        Téléphone:
                                    </td>
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        <?= $clientFound->telephone ?>
                                    </td>
                                </tr>

                                <tr class="group border-b border-neutral-200 dark:border-neutral-500 transition ease-in-out duration-300 motion-reduce:transition-none">
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        Montant Total:
                                    </td>
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        <?= $laDette->total_dette . " Fcfa" ?>
                                    </td>
                                </tr>
                                <tr class="group border-b border-neutral-200 dark:border-neutral-500 transition ease-in-out duration-300 motion-reduce:transition-none">
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        Montant Versé:
                                    </td>
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        <?= $laDette->montant_verse . " Fcfa" ?>
                                    </td>
                                </tr>
                                <tr class="group border-b border-neutral-200 dark:border-neutral-500 transition ease-in-out duration-300 motion-reduce:transition-none">
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        Montant Restant:
                                    </td>
                                    <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                        <?= $laDette->total_dette - $laDette->montant_verse . " Fcfa" ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form action="/dettes/paiement/add" method="POST">
                        <div class="pb-4">
                            <label for="nameVertical" class="inline-flex items-center w-[178px] mb-2 text-sm font-medium capitalize text-dark dark:text-title-dark">Montant à verser</label>
                            <div class="flex flex-col flex-1 md:flex-row">
                                <input type="hidden" name="dette_id" value="<?= $laDette->id ?>">
                                <input name="montant" type="text" id="nameVertical" class=" rounded-4 border-normal border-1 text-[15px] dark:bg-box-dark-up dark:border-box-dark-up px-[20px] py-[12px] min-h-[50px] outline-none placeholder:text-[#A0A0A0] text-body dark:text-subtitle-dark w-full focus:ring-primary focus:border-primary" placeholder="Montant" autocomplete="username">
                            </div>
                            <span class="text-danger text-sm <?php isset($errorPaiement['montant']) && !empty($errorPaiement['montant']) ? 'visible' : 'invisible' ?>"><?= isset($errorPaiement['montant']) && !empty($errorPaiement['montant']) ? $errorPaiement['montant'] : '' ?></span>
                        </div>
                        <button class="bg-primary hover:bg-primary-hbr border-solid border-1 border-primary text-white dark:text-title-dark text-[14px] font-semibold leading-[22px] inline-flex items-center justify-center rounded-[4px] px-[20px] h-[50px] shadow-btn transition duration-300 ease-in-out w-full"> Verser </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

use Boutique\Core\Session;

\Boutique\App\App::getSession()->unset('errorPaiement');
?>