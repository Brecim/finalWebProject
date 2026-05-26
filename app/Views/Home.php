<?=$this->extend("Layouts/Master");?>


<?=$this->section("content");?>

    <div class="container">
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <?php foreach ($films as $x): ?>
                <div class="card">
                    <div class="card-body rounded bg-primary">
                    <a href="<?= site_url('film/') . esc($x->id) ?>">
                        <img src='<?= "csfd_pictures/" . esc($x->poster_image) ?>' class="w-100 object-fit-cover rounded" style="height: 400px;" alt="">
                    </a>
                    <h5 class="card-title fw-bold text-center mt-3"><?= esc($x->title) ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?=$this->endSection();?>
