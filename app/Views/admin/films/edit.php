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
                    <textarea id="film-description" name="description" rows="10" class="form-control"><?= esc(old('description', $film->description ?? '')) ?></textarea>
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

    <!-- People and Roles Section -->
    <div class="mt-5">
        <h2 class="fw-bold section-title mb-4">People & Roles</h2>

        <!-- Add Person Form -->
        <div class="card movie-card p-4 p-md-5 mb-4">
            <h3 class="mb-4">Add Person to Film</h3>
            <form action="<?= site_url('admin/films/' . $film->id . '/add-person') ?>" method="post">
                <?= csrf_field() ?>
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Select Person</label>
                        <select name="person_id" class="form-select form-select-lg" required>
                            <option value="">-- Choose a person --</option>
                            <?php foreach ($availablePeople as $person): ?>
                                <option value="<?= esc($person->id) ?>">
                                    <?= esc($person->first_name . ' ' . $person->last_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Select Role</label>
                        <select name="role_id" class="form-select form-select-lg" required>
                            <option value="">-- Choose a role --</option>
                            <?php foreach ($availableRoles as $role): ?>
                                <option value="<?= esc($role->id) ?>">
                                    <?= esc($role->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success btn-lg w-100 fw-semibold">Add</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Current People List -->
        <div class="card movie-card p-4 p-md-5">
            <h3 class="mb-4">People in This Film</h3>
            <?php if (count($people) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($people as $person): ?>
                                <tr>
                                    <td><?= esc($person->first_name . ' ' . $person->last_name) ?></td>
                                    <td><span class="badge bg-info"><?= esc($person->role_name) ?></span></td>
                                    <td>
                                        <form action="<?= site_url('admin/films/' . $film->id . '/remove-person/' . $person->id) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this person from the film?');">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    No people assigned to this film yet. Use the form above to add people.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- 1. Load TinyMCE from CDN -->
<script src=" https://cdn.jsdelivr.net/npm/tinymce@8.5.1/tinymce.min.js "></script>

<!-- 2. Initialize the editor -->
<script>
    tinymce.init({
        selector: '#film-description',
        license_key: 'gpl',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 400,
        // Optional: match your site's theme
        skin: 'oxide',
        content_css: 'default',
        // Ensure data is synced before form submission
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });
</script>

<?= $this->endSection(); ?>