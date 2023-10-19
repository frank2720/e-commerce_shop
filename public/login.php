<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/login.php';
?>

<?php view('page_header', ['title' => 'Login']) ?>

<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        
                        <?php if (isset($errors['login'])) : ?>
                        <div class="error mb-4">
                            <i><?= $errors['login'] ?></i>
                        </div>
                        <?php endif ?>
                        <form action="login.php" method="post">
                            <h3>Sign in</h3>
                            <br>

                            <div class="mb-4">
                                <div class="form-outline">
                                    <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>" class="form-control form-control-lg" />
                                    <label class="form-label" for="username">Username</label>
                                </div>
                                <small class="error"><?= $errors['username'] ?? '' ?></small>
                            </div>

                            <div class="mb-4">
                                <div class="form-outline">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <small class="error"><?= $errors['password'] ?? '' ?></small>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a href="#!">Forgot password?</a></p>

                            <button class="btn btn-dark btn-rounded btn-lg px-5" type="submit">Login</button>

                            <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                <a href="#!" style="color: #3b5998;"><i class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="#!" style="color: #55acee;"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                <a href="#!" style="color: #dd4b39;"><i class="fab fa-google fa-lg"></i></a>
                            </div>

                            <div class="mt-5">
                                <p class="mb-0">Don't have an account? <a href="register.php" class="fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php view('footer') ?>