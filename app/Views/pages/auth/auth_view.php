<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>Vítejte v Chat Roomu<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="card border-primary shadow-lg" style="border-radius: 1.5rem;">
                <div class="card-body p-5">

                    <ul class="nav nav-pills nav-justified mb-4" id="authTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-content" type="button" role="tab">
                                <i class="fa-solid fa-right-to-bracket me-2"></i>Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="register-tab" data-bs-toggle="tab" data-bs-target="#register-content" type="button" role="tab">
                                <i class="fa-solid fa-user-plus me-2"></i>Register
                            </button>
                        </li>
                    </ul>

                    <?= $this->include('alerts/alerts') ?>

                    <div class="tab-content" id="authTabsContent">

                        <div class="tab-pane fade show active" id="login-content" role="tabpanel">
                            <form action="<?= base_url('login') ?>" method="POST">
                                <?= csrf_field() ?>

                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" id="loginUser" placeholder="Uživatelské jméno" value="<?= old('username') ?>" required>
                                    <label for="loginUser">Uživatelské jméno</label>
                                </div>
                                <input type="hidden" name="form_form" value="login">

                                <div class="form-floating mb-4">
                                    <input type="password" name="password" class="form-control" id="loginPass" placeholder="Heslo" required>
                                    <label for="loginPass">Heslo</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Vstoupit do chatu</button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="register-content" role="tabpanel">
                            <form action="<?= base_url('register') ?>" method="POST">
                                <?= csrf_field() ?>

                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" id="regUser" placeholder="Uživatelské jméno" required>
                                    <label for="regUser">Uživatelské jméno</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="regPass" placeholder="Heslo" required>
                                    <label for="regPass">Heslo</label>
                                </div>

                                <input type="hidden" name="form_form" value="register">

                                <div class="form-floating mb-4">
                                    <input type="password" name="password_confirm" class="form-control" id="regPassConfirm" placeholder="Potvrzení hesla" required>
                                    <label for="regPassConfirm">Potvrzení hesla</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Vytvořit účet</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>