<html>
    <head>

    </head>
    <body>
        <h2>
            <?php echo $header; ?>
        </h2>
        <p>Select a date: </p>
        <form method='GET' action='<?php echo base_url()?>/index.php/movie/<?php echo $movie[0]->id?>'>
            <select name='date_selected' id='date_selector' onchange="if(this.value != -1){this.form.submit()}">
                <option value='-1'>Select a value</option>
                <option value='0'>Show All</option>
                <?php
                    foreach($dates as $date){
                        echo '<option value=' . $date->date . '>' . $date->date . "</option>";
                    }
                ?>
            </select>
        </form>
        <?php
            $this->table->set_heading(array('Theater', 'Date', 'Time', 'Seats Available', ''));
            foreach($showtimes->result() as $showtime){
                $this->table->add_row(array($theater_name[$showtime->theater_id], $showtime->date, $showtime->time, $showtime->available,  anchor('seating/' . $showtime->id, 'Check Seating')));
            }
            echo $this->table->generate();
        ?>
    </body>
</html>