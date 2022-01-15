<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Oprav-to</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="public/script.js"></script>

    <link href="public/css.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">
    <div class="container-fluid">
        <a class="navbar-brand" href="?c=home">
            <img src="public/obrazky/logo.png" alt="logo" class="d-inline-block align-text-top logo">
            OPRAV-TO
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo \App\NavbarPrvky::$navDomov ?>" aria-current="page" href="?c=home">Domov</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo \App\NavbarPrvky::$navForum ?>" href="?c=forum">Fórum</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo \App\NavbarPrvky::$navNavody ?>" href="?c=navody">Návody</a>
                </li>

                <?php if(!\App\Prihlasenie::jePrihlaseny()) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo \App\NavbarPrvky::$navPrihlasenie ?>" href="?c=prihlasenie&a=prihlasovaciFormular">Prihlásenie</a>
                </li>

                <li class="nav-item">
                        <a class="nav-link <?php echo \App\NavbarPrvky::$navRegistracia ?>" href="?c=prihlasenie&a=registracnyFormular">Registrácia</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?c=prihlasenie&a=odhlasMa">Odhlásiť sa</a>
                </li>
                <?php }?>


            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Vyhľadať" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Hľadať</button>
            </form>
        </div>
    </div>
</nav>
<div class="container pt-4 mt-3">
</div>

<div class="container">
    <?= $contentHTML ?>

</div>

<div class="container-fluid footer pt-3 pb-3">
    <a class="text-decoration-none footer kontakty" href="?c=home&a=kontakty">Kontakty</a>
    <p>V prípade potreby nás kontaktujte</p>
</div>

</body>
</html>























