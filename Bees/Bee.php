<?php
namespace Bees;

    class Bee {

        protected $type;
        protected $lifespan;
        protected $damage;
        protected $fatality;
        protected $status;


        public function __construct(){
          $this->lifespan = $this->lifespan;
        }

// Get life status
    public function getHp()
    {
        return isset($this->lifespan) ? (int) $this->lifespan : 0;
    }

// Get bee Type
    public function getName()
    {
        return isset($this->type) ? $this->type : $this->type;
    }

// Hit bee and change lifespan
    public function hit()
    {
        if($this->lifespan <= 0){
            $this->lifespan = 0;
        }
        else{
            $this->lifespan = $this->lifespan - $this->damage;
        }

        return $this->lifespan;
    }

// Get bee damage
    public function getDamage()
    {
        return $this->damage;
    }

// Check if bee is alive or dead
    public function getStatus()
    {
        if($this->lifespan <= 0)
        {
             $this->status = 'dead';
        }
        else{
             $this->status = 'alive';
        }

        return $this->status;
    }

//Check if bee has fatality TRUE
    public function fatality()
    {
        return $this->fatality;
    }

//Kill all be and set lifespan zero
    public function zerolife()
    {
        $this->lifespan = 0;
    }
 }
