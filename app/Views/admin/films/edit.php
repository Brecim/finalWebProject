<?= $this->extend('layouts/master'); ?>

<?= $this->section('content'); ?>

<div class="container pb-5">
    <div class="hero-panel p-4 p-md-5 mb-4">
        <div class="row align-items-center g-3">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold section-title mb-2">Edit film</h1>
                <p class="mb-0 text-white-75">Update the film details or replace the poster image with a new file.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="<?= site_url('admin/films') ?>" class="btn btn-light btn-lg fw-semibold px-4">Back to list</a>
            </div>
        </div>
    </div>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <div class="card movie-card p-4 p-md-5">
        <form action="<?= site_url('admin/films/' . $film->id . '/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control form-control-lg" value="<?= esc(old('title') ?? $film->title) ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Year</label>
                    <input type="number" name="year" class="form-control form-control-lg" value="<?= esc(old('year') ?? $film->year) ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Length</label>
                    <input type="number" name="length" class="form-control form-control-lg" value="<?= esc(old('length') ?? $film->length) ?>" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" rows="10" class="form-control" required><?= esc(old('description') ?? $film->description) ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Poster image</label>
                    <input type="file" name="poster_image" class="form-control">
                    <?php if (! empty($film->poster_image)): ?>
                        <div class="mt-3">
                            <small class="text-muted d-block mb-2">Current image</small>
                            <img src="<?= base_url('csfd_pictures/' . esc($film->poster_image)) ?>" alt="<?= esc($film->title) ?>" style="max-width: 220px; border-radius: 1rem;" class="img-fluid">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 d-flex flex-wrap gap-2 justify-content-end">
                    <a href="<?= site_url('admin/films') ?>" class="btn btn-light btn-lg">Cancel</a>
                    <button type="submit" class="btn btn-warning btn-lg fw-semibold">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>