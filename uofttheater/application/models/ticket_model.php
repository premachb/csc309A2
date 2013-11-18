<?php

    class Ticket_model extends CI_Model{
        function get_tickets()
        {
            $query = $this->db->query("select * from ticket");
            return $query;
        }

        function getTicketsByShowtime($showtime_id){
            $query = $this->db->query('select * from ticket t where t.showtime_id = ' . $showtime_id);
            return $query;
        }

        function getSeatsBookedByShowtime($showtime_id){
            $query = $this->db->query('select t.seat from ticket t where t.showtime_id = ' . $showtime_id);
            return $query;
        }

        function getTicketById($ticket_id){
            $query = $this->db->query('select t.seat from ticket t where t.id = ' . $ticket_id);
            return $query->result();
        }

        function addTicket($ticket){
            $this->db->query('insert into ticket values (');
        }
    }

?>