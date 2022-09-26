<?php include APPROOT . "/views/inc/header.php"; ?>
<!-- register form -->
<a href="<?= URLROOT ?>/posts" class="btn btn-light"><i class="fas fa-arrow-circle-left"></i> Back</a>
<div class="card card-body bg-light mt-3">
  <h2>Add Post</h2>
  <p class="lead">Create a post with this form</p>
  <form action="<?= URLROOT ?>/posts/add" method="post">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" class="form-control <?= !empty(
        $data["title_err"]
      )
        ? "is-invalid"
        : "" ?> mt-1 mb-2" value="<?= $data["title"] ?>">
      <?php if (!empty($data["title_err"])): ?>
        <span class="invalid-feedback mb-2"><?= $data["title_err"] ?></span>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <label for="body">Body</label>
      <textarea type="body" name="body" id="body" class="form-control <?= !empty(
        $data["body_err"]
      )
        ? "is-invalid"
        : "" ?> mt-1 mb-2"><?= $data["body"] ?></textarea>
      <?php if (!empty($data["body_err"])): ?>
        <span class="invalid-feedback mb-2"><?= $data["body_err"] ?></span>
      <?php endif; ?>
    </div>
    <!-- submit / login -->
    <button type="submit" class="btn btn-success mt-3">Submit</button>
  </form>
</div>
<?php include APPROOT . "/views/inc/footer.php"; ?>
