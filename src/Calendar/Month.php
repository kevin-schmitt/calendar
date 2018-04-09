<?php

namespace App\Calendar;

class Month
{
  public  $days  = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  private $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
  public $month;
  public $year;
  /*
  * @param int month betwwen 1 and 12
  * @param int $year
  * @throws \Exception
  */
  public function __construct(?int $month = null, ?int $year = null)
  {
    if($month === null || $month < 1  || $month > 12){
      $month = intval(Date('m'));
    }

    if($year === null){
      $year = intval(Date('Y'));
    }

    $this->month = $month;
    $this->year  = $year;
  }

  /*
  * Return beginin day of the month
  * @return \DateTime
  */
  public function getStartingDay (): \DateTime {
    return  new \DateTime("{$this->year}-{$this->month}-01");
  }

  /*
  * return month (13 mars)
  * @return String
  */
  public function toString() : string{
    return $this->months[$this->month - 1] . ' ' . $this->year;
  }

  public function getWeeks() : int{
     // begining month
     $start =  $this->getStartingDay();
     //last day in the month
     $end = (clone $start)->modify('+1  month -1 day');

     $weeks = intval($end->format('W')) - intval($start->format('W')) + 1;
     if($weeks < 0){
        $weeks = intval($end->format('W'));
     }

     return $weeks;
  }

  /*
  * test if Day exist in currently month
  * @param \DateTime  $date
  * @return bool
  */
  public function withinMonth(\DateTime  $date){
    return  $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
  }

  /*
  * next month
  * @return  Month
  */
  public function nextMonth() : Month{
     $month =  $this->month;
     $year  =  $this->year;
     $month += 1;
     if($month > 12){
         $month = 1;
         $year += 1;
     }
     return new Month($month, $year);
  }

  /*
  * previous month
  * @return  Month
  */
  public function previousMonth() : Month{
     $month =  $this->month;
     $year  =  $this->year;
     $month -= 1;
     if($month < 1){
         $month = 12;
         $year -= 1;
     }

     return new Month($month, $year);
  }

}
