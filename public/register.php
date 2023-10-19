<?php
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
?>

<?php view('page_header', ['title' => 'Register']) ?>
<section>
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-center mb-5">Sign Up</h2>

              <form action="register.php" method="post">

                <div class="mb-4">
                <div class="form-outline">
                  <input type="text" id="username" name="username" class="form-control form-control-lg" value="<?= $inputs['username'] ?? '' ?>"
                    class="<?= error_class($errors, 'username') ?>"/>
                  <label class="form-label" for="username">Username</label>
                </div>
                <small class="error"><?= $errors['username'] ?? '' ?></small>
                </div>

                <div class="mb-4">
                <div class="form-outline">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?= $inputs['email'] ?? '' ?>"
                    class="<?= error_class($errors, 'email') ?>"/>
                  <label class="form-label" for="email">Email</label>
                </div>
                <small class="error"><?= $errors['email'] ?? '' ?></small>
                </div>

                <div class="mb-4">
                <div class="form-outline">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" value="<?= $inputs['password'] ?? '' ?>"
                    class="<?= error_class($errors, 'password') ?>"/>
                  <label class="form-label" for="password">Password</label>
                </div>
                <small class="error"><?= $errors['password'] ?? '' ?></small>
                </div>

                <div class="mb-4">
                <div class="form-outline">
                  <input type="password" id="password2" name="password2" class="form-control form-control-lg" value="<?= $inputs['password2'] ?? '' ?>"
                    class="<?= error_class($errors, 'username') ?>" />
                  <label class="form-label" for="password2">Repeat your password</label>
                </div>
                <small class="error"><?= $errors['password2'] ?? '' ?></small>
                </div>

                <div class="mb-5 justify-content-center">
                <div class="form-check d-flex">
                  <input class="form-check-input me-2" type="checkbox" name="agree" value="checked" <?= $inputs['agree'] ?? '' ?> id="agree" />
                  <label class="form-check-label" for="agree">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div>
                <small class="error"><?= $errors['agree'] ?? '' ?></small>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-dark btn-rounded btn-block btn-lg">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php view('footer') ?>
