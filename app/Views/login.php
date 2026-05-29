<?=$this->extend("Layouts/Master");?>

<?=$this->section("content");?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Přihlášení</h4>
                </div>

                <div class="card-body">

                    <?= form_open("auth") ?>
                    
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <div class="form-floating">
                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                                <label for="username">Uživatelské jméno</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                                <label for="password">Heslo</label>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Přihlásit se</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection();?>
