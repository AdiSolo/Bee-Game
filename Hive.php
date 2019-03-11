<?php
use Bees\Bee;
use Bees\Drone;
use Bees\Worker;
use Bees\Queen;

class Hive extends Bee
{

    protected $bees = [];

    public function __construct()
    {
        $this->lifespan = $this->lifespan;
    }

// Create new object for bees and add it into Array
    public function addBee($type, $count)
    {
        for ($i=0; $i < $count; $i++)
        {
            $this->bees[] = new $type;
        }

    return $this->bees;
    }
//Get All Bees
    public function getBees()
    {
          return $this->bees;
    }

    // Get Alive bees
    public function getActiveBees()
    {
        $bees = [];
        foreach ($this->bees as $bee) {
            if($bee->getStatus() !== "dead"){
                $bees[] = $bee;
            }
        }
        return $bees;
    }
//Get random Bee
    public function random()
    {
        $bees = $this->getActiveBees();
        return !empty($bees) ? $bees[array_rand($bees, 1)] : [];
    }
//Kill all bees
    public function killAll()
    {
        foreach ($this->bees as $bee) {
            $bee->zerolife();
        }
    }
}
