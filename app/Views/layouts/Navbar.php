<nav class="navbar navbar-expand-lg app-navbar sticky-top mb-5">
    <div class="container py-2">
        <a class="navbar-brand d-flex align-items-center gap-3 fw-bold" href="<?= site_url() ?>">
            <span class="brand-mark">MD</span>
            <span>MovieDB</span>
        </a>
        <div class="ms-auto d-flex align-items-center gap-2">
            <?php $ionAuth = new \IonAuth\Libraries\IonAuth(); ?>
            <?php if ($ionAuth->loggedIn()): ?>
                <a href="<?= site_url('profile') ?>" class="btn btn-app-accent rounded-pill px-4 fw-semibold">Profile</a>
                <?php if ($ionAuth->isAdmin()): ?>
                    <a href="<?= site_url('admin/films') ?>" class="btn btn-outline-warning rounded-pill px-4 fw-semibold">Admin Panel</a>
                <?php endif; ?>
                <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-danger rounded-pill px-4 fw-semibold">Logout</a>
            <?php else: ?>
                <a href="<?= site_url('login') ?>" class="btn btn-app-accent rounded-pill px-4 fw-semibold">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>