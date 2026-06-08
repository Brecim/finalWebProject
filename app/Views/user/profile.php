<?=$this->extend("layouts/master");?>

<?=$this->section("content");?>

<div class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-8 mx-auto">
            <div class="hero-panel p-4 p-md-5 mb-4">
                <div class="row align-items-center g-3">
                    <div class="col-lg-8">
                        <h1 class="display-6 fw-bold section-title mb-2">User Profile</h1>
                        <p class="mb-0 text-white-75">View and manage your profile information.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="<?= site_url() ?>" class="btn btn-light btn-lg fw-semibold px-4">Back to Home</a>
                    </div>
                </div>
            </div>

            <div class="card movie-card p-4 p-md-5 mb-4">
                <h2 class="fw-bold section-title mb-4">Account Information</h2>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Username</label>
                            <p class="fs-5"><?= esc($user->username) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Email</label>
                            <p class="fs-5"><?= esc($user->email) ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">First Name</label>
                            <p class="fs-5"><?= esc($user->first_name ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">Last Name</label>
                            <p class="fs-5"><?= esc($user->last_name ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted">User ID</label>
                            <p class="fs-5"><?= esc($user->id) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card movie-card p-4 p-md-5">
                <h2 class="fw-bold section-title mb-4">User Groups</h2>
                
                <?php if (count($groups) > 0): ?>
                    <div class="row g-3">
                        <?php foreach ($groups as $group): ?>
                        <div class="col-md-6">
                            <div class="card border-0 rounded-3 bg-light-subtle p-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="badge bg-warning p-3 fs-5">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0"><?= esc($group->description) ?></h5>         
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> No groups assigned to this account.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection();?>