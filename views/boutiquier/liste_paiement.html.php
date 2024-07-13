<div class=" mx-[30px] min-h-[calc(100vh-195px)] mb-[30px] ssm:mt-[30px] mt-[15px]">


    <div class="grid grid-cols-12 gap-[25px]">
        <div class="col-span-12">
            <div class="bg-white dark:bg-box-dark m-0 p-0 text-body dark:text-subtitle-dark text-[15px] rounded-10 relative">
                <div class="px-[25px] text-dark dark:text-title-dark font-medium text-[17px] flex flex-wrap items-center justify-between max-sm:flex-col max-sm:h-auto border-b border-regular dark:border-box-dark-up">
                    <h1 class="mb-0 inline-flex items-center py-[16px] overflow-hidden whitespace-nowrap text-ellipsis text-[18px] font-semibold text-dark dark:text-title-dark capitalize">
                        Liste Dettes
                    </h1>
                    <div class="w-[80%] flex gap-[10px] justify-between flex-row items-center">
                        <div class="flex flex-col md:flex-row gap-[8px]">
                            <div class="text-20 underline font-semibold text-dark dark:text-title-dark">Client: <span><?= isset($clientFound) && !empty($clientFound) ? $clientFound->prenom . ' ' . $clientFound->nom : '' ?></span></div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-[8px]">
                            <div class="text-20 underline font-semibold text-dark dark:text-title-dark">M: <span><?= $laDette->total_dette . " Fcfa" ?></span></div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-[8px]">
                            <div class="text-20 underline font-semibold text-dark dark:text-title-dark">Mr: <span><?= $laDette->total_dette - $laDette->montant_verse . " Fcfa" ?></span></div>
                        </div>
                    </div>
                </div>

                <div class="p-[25px]">

                    <div class="overflow-x-auto scrollbar">
                        <table class="min-w-full text-sm font-light text-start">
                            <thead class="font-medium">
                                <tr>
                                    <th scope="col" class="bg-[#f8f9fb] dark:bg-box-dark-up px-4 py-3.5 text-start text-body dark:text-title-dark text-[15px] font-medium border-none before:hidden capitalize">
                                        Date</th>
                                    <th scope="col" class="bg-[#f8f9fb] dark:bg-box-dark-up px-4 py-3.5 text-start text-body dark:text-title-dark text-[15px] font-medium border-none before:hidden capitalize">
                                        Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // dd($listePaiement);
                                if (isset($listePaiement) && !empty($listePaiement)) {
                                    foreach ($listePaiement as $p) {
                                ?>
                                        <tr class="group border-b border-neutral-200 dark:border-neutral-500 transition ease-in-out duration-300 motion-reduce:transition-none">
                                            <td class="px-4 py-2.5 font-normal last:text-end capitalize text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                                <?= $p->date ?>
                                            </td>
                                            <td class="px-4 py-2.5 font-normal last:text-end lowercase text-[14px] text-dark dark:text-title-dark border-none group-hover:bg-transparent  whitespace-nowrap">
                                                <?= $p->montant ?></td>
                                        </tr>

                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="flex items-center md:justify-end pt-[40px]">
                            <div class="text-20 underline font-semibold text-dark dark:text-title-dark">Mv: <span><?= $laDette->montant_verse . " Fcfa" ?></span></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>