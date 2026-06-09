<?=$this->extend("layouts/master");?>

<?=$this->section("content");?>

<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card movie-card p-4 p-md-5">
                <h1 class="h3 fw-bold section-title mb-4 text-center">Create account</h1>

                <?php if (isset($message)): ?>
                    <div class="alert alert-danger"><?= $message ?></div>
                <?php endif; ?>

                <form action="<?= site_url('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <?= bs_form_group('username', 'Username', 'text', set_value('username'), 'Choose a username', 'user') ?>
                    <?= bs_form_group('email', 'Email', 'email', set_value('email'), 'Enter email', 'envelope') ?>
                    <?= bs_form_group('first_name', 'First name', 'text', set_value('first_name'), 'Enter first name', 'id-card') ?>
                    <?= bs_form_group('last_name', 'Last name', 'text', set_value('last_name'), 'Enter last name', 'id-card') ?>
                    <?= bs_password_group('password', 'Password', 'Create password') ?>
                    <?= bs_password_group('password_confirm', 'Confirm password', 'Repeat password') ?>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning btn-lg fw-semibold">Register</button>
                        <a href="<?= site_url('login') ?>" class="btn btn-outline-secondary btn-lg">Back to login</a>
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
