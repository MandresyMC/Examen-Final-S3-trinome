<?php /* header.php — fragment PHP, à inclure DANS le <body> de chaque vue */

    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $navLinks = [
        ['href' => '/dashboard',         'label' => 'Tableau de bord'],
        ['href' => '/formulaire_besoin',  'label' => 'Besoins'],
        ['href' => '/formulaire_stock',   'label' => 'Stocks'],
        ['href' => '/formulaire_dons',    'label' => 'Dons'],
        ['href' => '/achat',              'label' => 'Achats'],
        ['href' => '/recapitulation',     'label' => 'Récapitulation'],
    ];
?>
<link rel="stylesheet" href="css/header.css">

<header class="site-header mb-4">
    <div class="site-header__inner">

        <a href="/dashboard" class="site-header__brand">
            <div class="site-header__brand-mark">
                <svg viewBox="0 0 16 16" fill="none" stroke="#fff" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 1.5C6.07 1.5 4.5 3.07 4.5 5c0 2.5 3.5 7 3.5 7s3.5-4.5 3.5-7c0-1.93-1.57-3.5-3.5-3.5z"/>
                    <circle cx="8" cy="5" r="1" fill="white" stroke="none"/>
                </svg>
            </div>
            <span class="site-header__brand-name">AideHumanitaire</span>
        </a>

        <div class="site-header__divider"></div>

        <nav>
            <ul class="site-header__nav" id="site-main-nav">
                <?php foreach ($navLinks as $link): ?>
                    <li>
                        <a href="<?= htmlspecialchars($link['href']) ?>"
                           class="site-header__nav-link<?= $currentPath === $link['href'] ? ' is-active' : '' ?>">
                            <?= htmlspecialchars($link['label']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <button class="site-header__burger" id="site-burger"
                aria-label="Menu" aria-expanded="false">
            <svg viewBox="0 0 20 20" fill="currentColor">
                <rect x="2" y="5"  width="16" height="1.5" rx="1"/>
                <rect x="2" y="9"  width="16" height="1.5" rx="1"/>
                <rect x="2" y="13" width="16" height="1.5" rx="1"/>
            </svg>
        </button>

    </div>
</header>

<script>
    (function () {
        var burger = document.getElementById('site-burger');
        var nav    = document.getElementById('site-main-nav');
        if (!burger || !nav) return;

        burger.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('is-open');
            burger.setAttribute('aria-expanded', String(isOpen));
        });

        document.addEventListener('click', function (e) {
            if (!burger.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('is-open');
                burger.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>