<?php

namespace App\Models\Traits;

use App\Models\Locations\Location;

use Response;

trait LocationableTrait {

    /**
     *
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class)->withPivot('use');
    }

    public function getMainLocation()
    {
        return $this->getLocationTo("main");
    }

    public function getLocationTo($use)
    {
        return $this->locations()->wherePivot("use",$use)->get()->first();
    }


    public function updateLocationToUse(array $location_args, $use)
    {
        $main_location = $this->getLocationTo($use);

        $continue = !$main_location ? true : false ;

        while ($continue) {
            $main_location = Location::create($location_args) ;
            if ($main_location) {
                $continue = !$this->locations()->save($main_location, ["use"=>$use ]);
            }
        }

        foreach ($location_args as $key => $value) {
            $main_location->$key = $value;
        }

        return $main_location->save();

    }

}
