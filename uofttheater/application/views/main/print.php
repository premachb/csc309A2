<html>
    <h1>Your order has been placed, here is a confirmation: </h1>

    <h5>Movie : <?php echo $movie->title; ?></h5>
    <h5>Theater : <?php echo $theater->name; ?></h5>
    <h5>Date: <?php echo $showtime->date; ?></h5>
    <h5>Time: <?php echo $showtime->time; ?></h5>
    <h5>Seat #: <?php echo $ticket[0]->seat; ?></h5>

    <button onclick='window.print()'>Click Here to Print your Confirmation</button>
</html>