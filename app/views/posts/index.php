<?php include APPROOT . "/views/inc/header.php"; ?>
<?php if ($flash = flash("post_message")): ?>
        <div class="<?= $flash[
          "class"
        ] ?> alert-dismissible fade show" role="alert"><?= $flash["message"] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
<div class="row mb-3">
  <div class="col-md-6">
    <div class="d-grid gap-2">
      <h1>Posts</h1>
    </div>
  </div>
  <div class="col-md-6">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
      <a href="<?= URLROOT ?>/posts/add" class="btn btn-primary"><i class="fas fa-plus-circle pe-2"></i> Add Post</a>
    </div>
  </div>
</div>

<?php foreach ($data["posts"] as $post): ?>
<div class="card card-body mb-3">
  <h2 class="card-title"><?= $post->title ?></h4>
  <div class="bg-light">
    <p class="mb-0 lead fs-6">Written by <?= $post->name ?> on <?= $post->created_at ?></p>
  </div>
  <p class="card-text mt-3"><?= $post->body ?></p>
  <a href="<?= URLROOT ?>/posts/show/<?= $post->postId ?>" class="btn btn-dark">More</a>
</div>
<?php endforeach; ?>
<?php include APPROOT . "/views/inc/footer.php"; ?>
