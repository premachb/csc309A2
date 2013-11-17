<html>
    <head>

    </head>
    <body>
        <h2>Showtimes for
            <?php echo $movie[0]->title; ?>
        </h2>
        <?php
            $this->table->set_heading(array('Theater', 'Date', 'Time', 'Seats Available', ''));
            foreach($showtimes->result() as $showtime){
                $this->table->add_row(array($theater_name[$showtime->theater_id], $showtime->date, $showtime->time, $showtime->available,  anchor('main/seating/' . $showtime->id, 'Check Seating')));
            }
            echo $this->table->generate();
        ?>
    </body>

</html>