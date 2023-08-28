<?php
    adminOnly(); 

    $sql1 = "SELECT users.email, survey.answer 
            FROM user_answer 
            INNER JOIN users ON users.id = user_answer.user_id 
            INNER JOIN survey ON survey.id = user_answer.answer_id 
            ORDER BY user_answer.id DESC";

    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $results1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);


   
 
//Access
    $accessLog = "data/access.log";
    if (file_exists($accessLog)) {
        $logContent = file_get_contents($accessLog);
    } else {
        $logContent = "Nema dostupnih podataka o pristupima.";
    }
    
    // Paginacija
    $strana = isset($_GET['strana']) ? intval($_GET['strana']) : 1;
    $limit = 10;
    $logLines = explode("\n", $logContent);
    $totalLines = count($logLines);
    $totalPages = ceil($totalLines / $limit);
    $offset = ($strana - 1) * $limit;
    $logLines = array_slice($logLines, $offset, $limit);
    $paginatedLogContent = implode("\n", $logLines);
    

    $pageStatistics = getPageAccessStatistics($accessLog);
    $logFile = "data/login.log";
    $totalLoggedInUsers = getTotalLoggedInUsersCount($logFile);
?>
<section class="vh-100 gradient-custom" style="margin-bottom:20%;">
  <div class="py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="tabelaCreate">
          <h2 class="page-title">Dashboard</h2>

          <?php include "models/messages.php"; ?>

          <div class="table-responsive" style="margin-top:10rem;">
            <h5 class="page-title" style="margin:2rem;">Survey answers from users:</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Email</th>
                  <th>Answer</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($results1 as $result1) : ?>
                  <tr>
                    <td><?= $result1['email'] ?></td>
                    <td><?= $result1['answer'] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <?php
          $answerCounts = array();
          foreach ($results1 as $result1) {
            $answer = $result1['answer'];
            if (isset($answerCounts[$answer])) {
              $answerCounts[$answer]++;
            } else {
              $answerCounts[$answer] = 1;
            }
          }

          $maxCount = 0;
          $mostSelectedAnswer = '';
          foreach ($answerCounts as $answer => $count) {
            if ($count > $maxCount) {
              $maxCount = $count;
              $mostSelectedAnswer = $answer;
            }
          }
          ?>

          <div class="statistics" style="background-color: #8ec98e;
                                         border-radius: 4px;
                                        padding: 1rem;
                                        font-weight: bold;">

            <h5 class="page-title" style="margin:2rem;">Survey Answer Statistics:</h5>
            <p>Most selected answer: <?= $mostSelectedAnswer ?></p>
            <p>Number of selections: <?= $maxCount ?></p>
          </div>
        </div>
                <div class="statistics" style="background-color: #f5f5f5;
                                border-radius: 4px;
                                padding: 1rem;
                                margin-top: 2rem;">
    <h5 class="page-title" style="margin-bottom: 1rem;">Page access:</h5>
    <pre><?= $paginatedLogContent ?></pre>

    <?php if ($totalPages > 1) : ?>
        <div class="pagination" style="margin-top: 1rem;">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <?php if ($i === $strana) : ?>
                    <span class="current page-link"><?= $i ?></span>
                <?php else : ?>
                    <a href="index.php?page=dashboard&strana=<?= $i ?>" class="page-link"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <h5 class="page-title" style="margin: 2rem 0;">Page Access Statistics:</h5>
    <div class="statistics">
        <?php foreach ($pageStatistics as $page => $percentage) : ?>
            <p><?= $page ?>: <?= $percentage ?>%</p>
        <?php endforeach; ?>
    </div>

    <section class="logged-in-users" style="margin-top: 2rem;">
        <h5 class="page-title">The number of users who logged in during the day:</h5>
        <p><?php  echo "Total number of logged in users: " . $totalLoggedInUsers; ?></p>
    </section>
</div>
    </div>
  </div>
</section>
