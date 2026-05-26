<?= $this->extend("Layouts/Master"); ?>


<?= $this->section("content"); ?>

    <div class="container">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body bg-primary">
                        <h1 class="card-title text-black mb-3"><?= esc($film->title) ?></h1>
                        <h4 class="card-title text-black mb-3"><?= esc($film->length) ?> minutes, <?= esc($film->year) ?></h4>
                        <p class="card-text"><?= esc($film->description) ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src=' <?= base_url() . "csfd_pictures/" . esc($film->poster_image) ?>" ' class="img-fluid rounded-end" alt="" style="object-fit: cover; height: 100%;">
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>