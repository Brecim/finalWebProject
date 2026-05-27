<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>

<div class="container pb-5">
    <div class="hero-panel p-4 p-md-5 mb-4">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold section-title mb-2">Film management</h1>
                <p class="mb-0 text-white-75">You can add, edit, and delete films here.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="<?= site_url('admin/films/new') ?>" class="btn btn-warning btn-lg fw-semibold px-4">+ New film</a>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="admin-table-frame">
        <div class="admin-table-shell">
            <div class="table-responsive">
                <table class="table admin-table align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 90px;">ID</th>
                        <th>Film</th>
                        <th style="width: 120px;">Year</th>
                        <th style="width: 120px;">Length</th>
                        <th style="width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($films as $film): ?>
                        <tr>
                            <td><?= esc($film->id) ?></td>
                            <td>
                                <div class="fw-semibold"><?= esc($film->title) ?></div>
                                <small class="text-muted"><?= esc($film->poster_image) ?></small>
                            </td>
                            <td><?= esc($film->year) ?></td>
                            <td><?= esc($film->length) ?> minutes</td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="<?= site_url('admin/films/' . $film->id . '/edit') ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteFilmModal<?= esc($film->id) ?>">Delete</button>
                                </div>

                                <div class="modal fade" id="deleteFilmModal<?= esc($film->id) ?>" data-bs-backdrop="false" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.5);">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 rounded-4">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete film</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <strong><?= esc($film->title) ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <form action="<?= site_url('admin/films/' . $film->id . '/delete') ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>