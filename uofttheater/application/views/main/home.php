<html>
    <head>
        <script></script>
    </head>

    <body>
        <h1>Welcome to the UofT Cinema Ticket Booking System!</h1>
        <div id='homeListings'>
            <div id='movieSort'>
                <h3>Movies Been Shown</h3>
                <?php
                    foreach($movies as $movie){
                        echo anchor('/movie/' . $movie->id, $movie->title) . '<br />';
                    }
                ?>
            </div>
            <div id='theaterSort'>
                <h3>Theatres Nearby</h3>
                <?php
                    foreach($theaters as $theater){
                        echo anchor('/theater/' . $theater->id, $theater->name) . '<br />';
                    }
                ?>
            </div>
        </div>
    </body>
</html>
