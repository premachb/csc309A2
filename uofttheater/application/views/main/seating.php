
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="http://d3lp1msu2r81bx.cloudfront.net/kjs/js/lib/kinetic-v4.7.4.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/seating.js"></script>
    </head>
    <body>
        <h1>Seating Chart for <?php echo $movie->title ?> on <?php echo $showtime->date?> at <?php echo $showtime->time ?></h1>
        <h3>Seats available - <?php echo $showtime->available ?></h3>
        <?php
            for($i = 1; $i <= 3; $i++){
                if(!in_array($i, $seats_booked)){
                    echo "<p> Seat " . $i . " " . anchor('main/booking/' . $showtime->id . '/' . $i, 'Book Now');
                }
            }
        ?>
        <div id='container'>
            <script>

            </script>
        </div>
    </body>
</html>

