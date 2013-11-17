<html>
    <head>

    </head>

    <body>
    <h2>Showtimes for
        <?php echo $theater[0]->name; ?>
    </h2>
    <?php
        $this->table->set_heading(array('Movie', 'Date', 'Time', 'Seats Available', ''));
        foreach($showtimes->result() as $showtime){
            $this->table->add_row(array($movie_name[$showtime->movie_id], $showtime->date, $showtime->time, $showtime->available,  anchor('main/seating/' . $showtime->id, 'Check Seating')));
        }
        echo $this->table->generate();
    ?>
    </body>
</html>