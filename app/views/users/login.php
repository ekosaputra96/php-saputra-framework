<?php include APPROOT . "/views/inc/header.php"; ?>
<!-- register form -->
<div class="row">
  <div class="col-lg-6 mx-auto">
    <div class="card card-body bg-light mt-4">
      <?php if ($flash = flash("login_message")): ?>
        <div class="<?= $flash[
          "class"
        ] ?> alert-dismissible fade show" role="alert"><?= $flash["message"] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <h2>Login</h2>
      <p class="lead">Please fill in your credentials for login</p>
      <form action="<?= URLROOT ?>/users/login" method="post">
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
        <!-- submit / login -->
        <div class="row my-3">
          <div class="col">
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success">Login</button>
            </div>
          </div>
          <div class="col">
            <div class="d-grid gap-2">
              <a href="<?= URLROOT ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include APPROOT . "/views/inc/footer.php"; ?>
