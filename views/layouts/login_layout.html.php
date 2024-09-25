<!--    <link rel="stylesheet" type="text/css" href="/--><?php //=ASSETS_PATH
?><!--/css/styles.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">-->
<!--    <script src="--><?php //=ASSETS_PATH
?><!--/js/ctrlRedirect.js"></script>-->
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
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $_ENV['ASSETS_PATH'] ?>/images/icon1.png">
    <!-- Title -->
    <title>Top memu</title>

    <!-- inject:css-->
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/css/apexcharts.min.css">
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/css/datepicker.min.css">
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/css/nouislider.min.css">
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/css/quill.snow.css">
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/css/svgMap.min.css">
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/css/styles.css">
    <!-- endinject -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css">
</head>

<body class="bg-white [&.dark]:bg-main-dark font-jost relative text-[15px] font-normal leading-[1.5] m-0 p-0">
    <!-- Main Content -->
    <main class="relative bg-topdark:bg-[#1e2836] bg-contain bg-normalBG">

        <?= $content ?>

    </main>

<!-- inject:js-->
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/apexcharts.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/datepicker-full.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/fslightbox.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/index.global.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/mixitup.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/moment.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/nouislider.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/quill.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/svg-pan-zoom.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/svgMap.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/tw-elements.umd.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/vendor_assets/js/yscountdown.min.js"></script>
<script src="<?= $_ENV['ASSETS_PATH'] ?>/theme_assets/js/main.js"></script>
</body>

</html>