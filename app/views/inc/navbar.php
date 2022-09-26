<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= URLROOT ?>"><i class="fas fa-mail-bulk"></i> <?= SITENAME ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?= $data["path"] === "index" ||
          $data["path"] === "posts/index"
            ? "active"
            : "" ?>" aria-current="page" href="<?= URLROOT ?>"><i class="fas fa-home pe-1"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $data["path"] === "pages/about"
            ? "active"
            : "" ?>" href="<?= URLROOT ?>/pages/about"><i class="fas fa-passport pe-2"></i> About</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto mb-2 mb-md-0">
        <?php if (isset($_SESSION["user_name"])): ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= URLROOT ?>/posts"><i class="fas fa-user pe-2"></i> <?= ucwords(
  $_SESSION["user_name"]
) ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= URLROOT ?>/users/logout"><i class="fas fa-sign-out-alt pe-2"></i> Logout</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link <?= $data["path"] === "users/register"
            ? "active"
            : "" ?>" aria-current="page" href="<?= URLROOT ?>/users/register"><i class="fas fa-user-plus pe-1"></i> Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $data["path"] === "users/login"
            ? "active"
            : "" ?>" href="<?= URLROOT ?>/users/login"><i class="fas fa-sign-in-alt pe-2"></i> Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
