<?=$this->extend("Layouts/Master");?>

<?=$this->section("content");?>

<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card movie-card p-4 p-md-5">
                <h1 class="h3 fw-bold section-title mb-2 text-center">Login</h1>
                <p class="text-center text-muted mb-4">Use your username or email address.</p>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>

                <form action="<?= site_url('auth') ?>" method="post">
                    <?= csrf_field() ?>

                    <?= bs_form_group('identity', 'Username or email', 'text', old('identity'), 'Enter username or email', 'fa-user') ?>
                    <?= bs_password_group('password', 'Password', 'Enter password') ?>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="<?= site_url('register') ?>" class="text-decoration-none">Create account</a>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-app-accent btn-lg fw-semibold">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('click', function (event) {
    const toggle = event.target.closest('.js-password-toggle');
    if (! toggle) return;

    const field = document.querySelector(toggle.getAttribute('data-target'));
    if (! field) return;

    const isPassword = field.type === 'password';
    field.type = isPassword ? 'text' : 'password';
    toggle.textContent = isPassword ? 'Hide' : 'Show';
});
</script>

<?=$this->endSection();?>
