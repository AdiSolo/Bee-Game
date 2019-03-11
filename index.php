<?php
session_start();
$game_start = 'start';
$_SESSION['game_start'] = $game_start;

if($_SESSION['game_start'] === 'start' && isset($_POST['hit'])){
    $_SESSION['game_start'] = 'stop';
}
 ?>


<?php
spl_autoload_register();

use Bees\Bee;
use Bees\Drone;
use Bees\Worker;
use Bees\Queen;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee game</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<style>
    body{
        background-color: #eee;
        height: 100vh;
    }
    .alive {
        color: green;
    }
    .dead {
        color: red;
    }

    .wrapper{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>
  </head>
  <body>
    <div class="container wrapper">
        <div class="text-center">
            <?php
                if($_SESSION['game_start'] === 'start' ){
                    $hive = new Hive();
                    $hive->addBee(Worker::class, 5);
                    $hive->addBee(Drone::class, 8);
                    $hive->addBee(Queen::class, 1);
                    $_SESSION['game_hive'] = serialize($hive); 

                    $bees = $hive->getBees();

                    foreach ($bees as $bee)
                    {

                        echo "<br>" . $bee->getName() . " lifespan: " . $bee->getHp().'';
                    }
                }
                else
                {
                    if(isset($_POST['hit'])){

                        if(isset($_SESSION['game_hive'])){
                            $hive = unserialize($_SESSION['game_hive']);
                        }

                        if(!$hive instanceof Hive){
                            throw new \Exception("Error could not get game data from session.", 1);

                        }
                        $randomBee = $hive->random();
                        if(!$randomBee){
                            echo "";
                        }else{
                            $remaining = $randomBee->hit();
                            $damage = $randomBee->getDamage();
                            $check_status = $randomBee->getStatus();
                            $check_fatality = $randomBee->fatality();


                            if($check_status  === 'dead' && $check_fatality ){
                                $hive->killAll();
                                echo "<h2 class='mb-1 status dead'>Game is finished</h2>";
                                include('inc/restart.php');
                            }
                            else{
                                echo"<h2 class='mb-1 status alive'>Game is started</h2>";
                            }

                            $_SESSION['game_hive'] = serialize($hive);

                            if($check_status === 'alive')
                            {
                                echo '<br><div>Random bee: <b>'.$randomBee->getName() .'</b> was hited with: ' .$damage. ' and remaining lifespan is: '. $remaining.'</div>';

                            }
                            else {

                                echo '<br><div>Random bee: <b>'.$randomBee->getName() .'</b> are '.$check_status.'</div>';
                            }

                            $bees = $hive->getBees();
                            foreach ($bees as $bee)
                            {
                                echo "<br> " . $bee->getName() . " lifespan: " . ($bee->getHp() >= 0 ? $bee->getHp() : ' ').' status '.($bee->getStatus()==='alive'? '<span class="alive">'.$bee->getStatus().'</span>': '<span class="dead">'.$bee->getStatus().'</span>');
                            }
                        }
                    }

                }

                if(isset($_POST['destroy']))
                {
                    session_destroy();
                    header("Refresh:0");
                }
                 include('inc/hit.php');
                ?>
        </div>
    </div>
</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
            let status = $('.status').hasClass('dead');

            if(status){
                $('#hit').remove();
            }
        });
    </script>
</footer>
</html>
