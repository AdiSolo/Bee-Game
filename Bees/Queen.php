<?php
namespace Bees;
use Bees\Bee;

class Queen extends Bee  {

    protected $type;
    protected $lifespan;
    protected $damage;
    protected $fatality;

    public function __construct(){
        $this->type = 'Queen';
        $this->lifespan = 100;
        $this->damage = 8;
        $this->fatality = true;

    }
 }
