<div class="h-[calc(var(--vh,1vh)_*_100)] w-full overflow-y-auto scrollbar">

    <!-- Login form container -->
    <div class="flex flex-col justify-center w-full max-w-[516px] px-[30px] mx-auto my-[150px]">

        <!-- Login form background -->
        <div class="rounded-6 mt-[25px] shadow-regular dark:shadow-xl bg-white dark:bg-[#111726]">
            <div class="p-[25px] text-center border-b border-regular dark:border-white/[.05] top">
                <!-- Heading for the login form -->
                <h2 class="text-18 font-semibold leading-[1] mb-0 text-dark dark:text-title-dark">Connectez-vous</h2>
            </div>

            <!-- Login form inputs and elements -->
            <div class="py-[30px] px-[40px]">
                <form action="/login" method="POST">

                    <div class="mb-6">
                        <label for="email-usernameId" class="text-[14px] w-full leading-[1.4285714286] font-medium text-dark dark:text-gray-300 mb-[8px] capitalize inline-block">Email
                            Email</label>
                        <input type="text" value="<?= !empty($emailValid) ? $emailValid : "" ?>" name="email" id="email-usernameId" class="flex items-center shadow-none py-[10px] px-[20px] h-[48px] border-1 border-regular rounded-4 w-full text-[14px] font-normal leading-[1.5] placeholder:text-[#A0A0A0] focus:ring-primary focus:border-primary" placeholder="nom@example.com" autocomplete="off">
                        <span class="text-danger text-sm <?php isset($errors['email']) && !empty($errors['email']) ? 'visible' : 'invisible' ?>"><?= isset($errors['email']) && !empty($errors['email']) ? $errors['email'] : '' ?></span>
                    </div>

                    <!-- Password input -->
                    <div class="mb-6">
                        <label for="passwordId" class="text-[14px] w-full leading-[1.4285714286] font-medium text-dark dark:text-gray-300 mb-[8px] capitalize inline-block">
                            Mot de passe</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 end-0 flex items-center px-[15px]">
                                <input class="hidden js-password-toggle" id="toggle" type="checkbox">
                                <label class=" rounded cursor-pointer text-light text-[15px] js-password-label dark:text-subtitle-dark" for="toggle"><i class="uil uil-eye-slash"></i></label>
                            </div>
                            <input name="password" id="passwordId" class="flex items-center shadow-none py-[10px] px-[20px] h-[48px] border-1 border-regular rounded-4 w-full text-[14px] font-normal leading-[1.5] placeholder:text-[#A0A0A0] focus:ring-primary focus:border-primary" type="text" value="" placeholder="Password">
                        </div>
                        <span class="text-danger text-sm <?php isset($errors['password']) && !empty($errors['password']) ? 'visible' : 'invisible' ?>"><?= isset($errors['password']) && !empty($errors['password']) ? $errors['password'] : '' ?></span>
                    </div>

                    <button type="submit" class="inline-flex items-center justify-center w-full h-[48px] text-14 rounded-6 font-medium bg-primary text-white cursor-pointer hover:bg-primary-hbr border-primary transition duration-300" value="submit">Login</button>
                </form>

            </div>

        </div>
        <div class="<?= (isset($connectionError) && !empty($connectionError)) ? '' : 'hidden' ?> p-[25px] pt-0 flex flex-col gap-[15px]">
            <div class="hidden w-full data-[te-alert-show]:inline-flex px-[20px] py-[10px] text-[14px] rounded-lg bg-danger/10 text-danger border-1 border-success/10 capitalize justify-between flex-wrap items-center  transition-all duration-300 ease-linear " role="alert" data-te-alert-init="" data-te-alert-show="">
                <div class="flex items-baseline flex-wrap gap-[8px]">
                    <div>
                        <p class="font-normal text-[14px]"><?= $connectionError ?></p>
                    </div>
                </div>
                <button type="button" class="box-content border-none rounded-none opacity-50 ms-auto hover:text-warning-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none text-dark dark:text-title-dark" data-te-alert-dismiss="" aria-label="Close">
                            <span class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&amp;.disabled]:pointer-events-none [&amp;.disabled]:select-none [&amp;.disabled]:opacity-25 capitalize text-[12px]">
                                <i class="uil uil-multiply text-[14px]"></i>
                            </span>
                </button>
            </div>
        </div>
    </div>

</div>

<?php
//    $session->unset('errors');
?>