<?php

    function dd(...$vars){
      foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
      }
    }
