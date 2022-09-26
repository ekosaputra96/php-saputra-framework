<?php include APPROOT . "/views/inc/header.php"; ?>
<!-- detail post -->
<a href="<?= URLROOT ?>/posts" class="btn btn-light"><i class="fas fa-arrow-circle-left"></i> Back</a>
<h1 class="h1 mt-3"><?= $data["post"]->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Written by <?= $data["post"]->name ?> on <?= $data["post"]->created_at ?>
</div>
<p class="display-3"><?= $data["post"]->body ?></p>
<?php if ($data["post"]->userId === $_SESSION["user_id"]): ?>
  <hr>
  <div class="row justify-content-between">
    <div class="col-4">
      <a href="<?= URLROOT ?>/posts/edit/<?= $data["post"]
  ->postId ?>" class="btn btn-dark">Edit</a>
    </div>
    <div class="col-4">
      <div class="d-grid gap-2 justify-content-end">
        <form action="<?= URLROOT ?>/posts/delete/<?= $data["post"]
  ->postId ?>" method="post">
          <input type="submit" value="Delete" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php include APPROOT . "/views/inc/footer.php"; ?>
