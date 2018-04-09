<?php

  require_once '../../vendor/autoload.php';
  require '../src/bootstrap.php';
  require '../src/Calendar/Events.php';
  require '../views/header.php';

  use App\Calendar\Events;
  $events = new Events();

  if(!@array_key_exists('id', $_GET))
  {
    location('location: 404.php');
  }
  $event = $events->find($_GET['id']);
  $name = $event['name'] ?? "";
  $description = $event['description'] ?? "";
  $start = $event['start'] ?? "";
  $end = $event['end'] ?? "";

?>

<article class="container col-sm-4">
  <aside class="card">
    <h1 class="card-title"><?= $name ?></h1>
    <p class="card-text"><?= $description ?></p>
    <i class="far fa-calendar-alt"></i><p class="card-text"><?= $start ?></p>
    <i class="far fa-calendar-alt"></i><p class="card-text"><?= $end ?></p>
  </aside>
</article>


<?php
  require '../views/footer.php';
?>
