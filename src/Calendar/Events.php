<?php
namespace App\Calendar;

require_once '../vendor/autoload.php';

use App\DAO\SPDO;

class Events
{

  /*
  * constructor
  */
  public function __construct()
  {
  }

  /*
  * get all events between two dates
  * @param int start begining date
  * @param int end end date
  * @return array of events
  */
  public function getEventsBetween (\DateTime  $start, \DateTime  $end): array {
    $pdo = SPDO::getInstance();

    $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND
            '{$end->format('Y-m-d 23:59:59')}' ";
    $statement = $pdo->query($sql);
    return $statement->fetchAll();
  }

  /*
  * get all events between two dates indexed by days
  * @param int start begining date
  * @param int end end date
  * @return array of events
  */
  public function getEventsBetweenDays(\DateTime  $start, \DateTime  $end): array {
    $events = $this->getEventsBetween($start, $end);
    $days = [];

    foreach ($events as $event) {
      $date = explode(' ', $event['start'])[0];

      if(!isset($days[$date])){
          $days[$date] = [$event];
      }else {
          $days[$date][] = $event;
      }
    }

    return $days;
  }

  /*
  * get event with id
  * @param int id of event
  * @return array contain event
  */
  public function find(int $id): array {
    $pdo = SPDO::getInstance();

    $sql = 'SELECT * FROM events WHERE id = '.$id;
    $statement = $pdo->query($sql);
    return $statement->fetch();
  }
}
