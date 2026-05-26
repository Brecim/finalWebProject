<?= $this->extend("layouts/master"); ?>


<?= $this->section("content"); ?>

    <div class="container pb-5">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-4">
                <div class="poster-card h-100">
                    <img src="<?= base_url() . 'csfd_pictures/' . esc($film->poster_image) ?>" class="poster-image" alt="<?= esc($film->title) ?>">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="film-panel h-100 p-4 p-md-5">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="info-chip"><?= esc($film->year) ?></span>
                        <span class="info-chip"><?= esc($film->length) ?> minutes</span>
                    </div>
                    <h1 class="display-5 fw-bold section-title mb-3"><?= esc($film->title) ?></h1>
                    
                    <div class="card border-0 rounded-4 bg-light-subtle p-4">
                        <p class="card-text mb-0 fs-5 lh-lg"><?= esc($film->description) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>