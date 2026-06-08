<?=$this->extend("layouts/master");?>


<?=$this->section("content");?>

    <div class="container pb-5">
    
        <div class="row g-4">
            <?php foreach ($films as $film): ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xxl-3">
                    <div class="card movie-card h-100">
                        <a href="<?= site_url('film/') . esc($film->id) ?>" class="text-decoration-none text-reset">
                            <img src='<?= "csfd_pictures/" . esc($film->poster_image) ?>' class="movie-poster" alt="<?= esc($film->title) ?>">
                        </a>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                <h5 class="card-title fw-bold mb-0 section-title"><?= esc($film->title) ?></h5>
                                <span class="badge text-bg-warning text-dark rounded-pill px-3 py-2"><?= esc($film->year) ?></span>
                            </div>
                            <p class="movie-meta mb-0"><?= esc($film->length) ?> minutes</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

            <?php if (! empty($pager)): ?>
                <div class="d-flex justify-content-center mt-5">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>
    </div>

<?=$this->endSection();?>
