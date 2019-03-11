<?php
namespace Bees;
use Bees\Bee;

class Worker extends Bee  {

    protected $type;
    protected $lifespan;
    protected $damage;
    protected $fatality;

    public function __construct(){
        $this->type = 'Worker';
        $this->lifespan = 75;
        $this->damage = 10;
        $this->fatality = false;
    }
  }
