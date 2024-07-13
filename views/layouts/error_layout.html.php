<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $_ENV['ASSETS_PATH'] ?>/images/icon1.png">
    <title>404</title>
    <link rel="stylesheet" href="<?= $_ENV['ASSETS_PATH'] ?>/css/styles.css">
</head>

<body>
    <div class=" mx-[30px] min-h-[calc(100vh-195px)] mb-[30px] ssm:mt-[30px] mt-[15px]">

        <div class="grid grid-cols-12 gap-5">
            <div class="col-span-12">

                <?= $content ?>

            </div>
        </div>

    </div>
</body>

</html>