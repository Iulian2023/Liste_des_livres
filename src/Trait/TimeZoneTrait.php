<?php

    namespace App\Trait;


    /**
     * Ce trait permmet de changer le fuseau horaire prédéterminé(UTC:0)
     */
    Trait TimeZoneTrait
    {
        public function changeTimeZone(string $newTimeZone)
        {
            date_default_timezone_set($newTimeZone);
        }
    }