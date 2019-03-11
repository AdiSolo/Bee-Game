<?php
namespace Bees;
use Bees\Bee;

class Drone extends Bee
{

    protected $type;
    protected $lifespan;
    protected $damage;
    protected $fatality;

    public function __construct()
    {
        $this->type = 'Drone';
        $this->lifespan = 50;
        $this->damage = 12;
        $this->fatality = false;
    }
}
