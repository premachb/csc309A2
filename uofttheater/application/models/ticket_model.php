<?php

    class Ticket_model extends CI_Model{
        function get_tickets()
        {
            $query = $this->db->query("select * from ticket");
            return $query;
        }
    }

?>