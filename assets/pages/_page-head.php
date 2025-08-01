<?php 
function header_path($basepath) {
    echo '
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="' . $basepath . 'assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="' . $basepath . 'assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="' . $basepath . 'assets/img/favicon-16x16.png">
    <link rel="icon" href="' . $basepath . 'assets/img/favicon/favicon.ico">
    <link rel="manifest" href="' . $basepath . 'assets/img/favicon/site.webmanifest">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="' . $basepath . 'vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="' . $basepath . 'vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="' . $basepath . 'vendors/aos/aos.css" rel="stylesheet">
    <link href="' . $basepath . 'vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="' . $basepath . 'vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="' . $basepath . 'assets/css/main.css" rel="stylesheet">
    ';
}
?>