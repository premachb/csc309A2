<html>
    <body>
        <h1>Sorry, somebody has already bought that ticket</h1>
        <?php echo anchor('/seating/' . $this->uri->segment(2), 'Click here to see if there any other seats available for this show'); ?>
    </body>
</html>