<?php


usersOnly(); 


if (!isset($_GET['u_id'])) {
  echo "<script>window.location.href = 'index.php?page=index';</script>";

  exit;
}

$user_id = $_GET['u_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $answer_id = $_POST["answer"];
  $data = array('user_id' => $user_id, 'answer_id' => $answer_id);
  $id = insertOperation("user_answer", $data);

  if ($id) {
    $_SESSION['message'] = 'You have successfully sent a reply!';
    $_SESSION['type'] = 'alert alert-success';
      echo "<script>window.location.href = 'index.php?page=index';</script>";

    exit();
  } else {
    $_SESSION['message'] = 'An error occurred while sending the response. Please try again later.';
    $_SESSION['type'] = 'alert alert-danger';
  }
}

$answers = selectAll("survey");
?>




<div class="container my-5">
  <div class="card">
    <div class="card-body">
      <div class="text-center">
        <i class="far fa-file-alt fa-4x mb-3 text-primary"></i>
        <p class="fs-4">
          <strong>Your opinion matters</strong>
        </p>
        <p class="fs-5">
          Have some ideas how to improve our product?
          <strong>Give us your feedback.</strong>
        </p>
      </div>

      <hr />

      <form method="POST" action="index.php?page=survey&u_id=<?php echo $user_id; ?>">
          <p class="text-center fs-5"><strong>Your rating:</strong></p>
        <?php foreach ($answers as $answer) : ?>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="answer" id="answer<?= $answer['id'] ?>" value="<?= $answer['id'] ?>" />
                <label class="form-check-label" for="answer<?= $answer['id'] ?>">
                <?= $answer['answer'] ?>
                </label>
            </div>
        <?php endforeach; ?>
        <div class="card-footer text-end">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
  </div>
</div>


