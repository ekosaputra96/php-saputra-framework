<?php include APPROOT . "/views/inc/header.php"; ?>
<!-- register form -->
<div class="row">
  <div class="col-lg-6 mx-auto">
    <div class="card card-body bg-light mt-4">
      <h2>Create An Account</h2>
      <p class="lead">Please fill out this form to register with us</p>
      <form action="<?= URLROOT ?>/users/register" method="post">
        <div class="form-group">
          <label for="name">Name<sup>*</sup></label>
          <input type="text" name="name" id="name" class="form-control <?= !empty(
            $data["name_err"]
          )
            ? "is-invalid"
            : "" ?> mt-1 mb-2" value="<?= $data["name"] ?>">
          <?php if (!empty($data["name_err"])): ?>
            <span class="invalid-feedback mb-2"><?= $data["name_err"] ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="email">Email<sup>*</sup></label>
          <input type="text" name="email" id="email" class="form-control <?= !empty(
            $data["email_err"]
          )
            ? "is-invalid"
            : "" ?> mt-1 mb-2" value="<?= $data["email"] ?>">
          <?php if (!empty($data["email_err"])): ?>
            <span class="invalid-feedback mb-2"><?= $data["email_err"] ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="password">Password<sup>*</sup></label>
          <input type="password" name="password" id="password" class="form-control <?= !empty(
            $data["password_err"]
          )
            ? "is-invalid"
            : "" ?> mt-1 mb-2" value="<?= $data["password"] ?>">
          <?php if (!empty($data["password_err"])): ?>
            <span class="invalid-feedback mb-2"><?= $data[
              "password_err"
            ] ?></span>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password<sup>*</sup></label>
          <input type="password" name="confirm_password" id="confirm_password" class="form-control <?= !empty(
            $data["confirm_password_err"]
          )
            ? "is-invalid"
            : "" ?> mt-1 mb-2" value="<?= $data["confirm_password"] ?>">
          <?php if (!empty($data["confirm_password_err"])): ?>
            <span class="invalid-feedback mb-2"><?= $data[
              "confirm_password_err"
            ] ?></span>
          <?php endif; ?>
        </div>
        <!-- submit / login -->
        <div class="row my-3">
          <div class="col">
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success">Register</button>
            </div>
          </div>
          <div class="col">
            <div class="d-grid gap2">
              <a href="<?= URLROOT ?>/users/login" class="btn btn-light">Have an account? Login</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include APPROOT . "/views/inc/footer.php"; ?>
