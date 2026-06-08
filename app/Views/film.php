<?= $this->extend("layouts/master"); ?>


<?= $this->section("content"); ?>

    <div class="container pb-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Films</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($film->title) ?></li>
            </ol>
        </nav>

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
                        <span class="info-chip"><?= esc($filmCastCount) ?> cast members</span>
                    </div>
                    <h1 class="display-5 fw-bold section-title mb-3"><?= esc($film->title) ?></h1>
                    
                    <div class="card border-0 rounded-4 bg-light-subtle p-4 mb-4">
                        <p class="card-text mb-0 fs-5 lh-lg"><?= esc($film->description) ?></p>
                    </div>

                    <?php if (!empty($filmPeople)): ?>
                    <div class="row g-3">
                        <?php 
                            $peopleByRole = [];
                            foreach ($filmPeople as $person) {
                                if (!isset($peopleByRole[$person->role_name])) {
                                    $peopleByRole[$person->role_name] = [];
                                }
                                $peopleByRole[$person->role_name][] = $person;
                            }
                        ?>
                        <?php foreach ($peopleByRole as $roleName => $people): ?>
                        <div class="col-md-6">
                            <div class="card border-0 rounded-3 bg-light-subtle p-3">
                                <h6 class="fw-bold text-info mb-2"><?= esc($roleName) ?></h6>
                                <div class="d-flex flex-column gap-1">
                                    <?php foreach ($people as $person): ?>
                                    <small><?= esc($person->first_name . ' ' . $person->last_name) ?></small>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>