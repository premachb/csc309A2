<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brien
 * Date: 11/16/2013
 * Time: 8:24 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<html>
    <head>
        <script src="http://d3lp1msu2r81bx.cloudfront.net/kjs/js/lib/kinetic-v4.7.4.min.js"></script>

    </head>
    <body>
        <h1>Seating Chart for <?php echo $movie->title ?> - Pick a seat</h1>
        <h3>Seats available - <?php echo $showtime->available ?></h3>
        <?php
            for($i = 1; $i <= 3; $i++){
                if(!in_array($i, $seats_booked)){
                    echo "<p> Seat " . $i . " " . anchor('main/booking/' . $showtime->id . '/' . $i, 'Book Now');
                }
            }
        ?>

    </body>
</html>

