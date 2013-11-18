<?php
class Showtime_model extends CI_Model {

	function get_showtimes()
	{
		$query = $this->db->query("select m.title, t.name, t.address, s.date, s.time, s.available
								from movie m, theater t, showtime s
								where m.id = s.movie_id and t.id=s.theater_id");
		return $query;	
	}  

	function populate() {
		
		$movies = $this->movie_model->get_movies();
		$theaters = $this->theater_model->get_theaters();
		
		//If it returns some results we continue
		if ($movies->num_rows() > 0 && $theaters->num_rows > 0){
			foreach ($movies->result() as $movie){
				foreach ($theaters->result() as $theater){
					for ($i=1; $i < 15; $i++) {
						for ($j=20; $j <= 22; $j+=2) {
							$this->db->query("insert into showtime (movie_id,theater_id,date,time,available)
									values ($movie->id,$theater->id,adddate(current_date(), interval $i day),'$j:00',3)");
								
						}
					}		
				}				
			}
		}		
	}

	function delete() {
		$this->db->query("delete from showtime");
	}

    function showUpcomingMovies($num_movies){
        $query = $this->db->query("select m.title, t.name, t.address, s.date, s.time, s.available
								from movie m, theater t, showtime s
								where m.id = s.movie_id and t.id=s.theater_id order by s.date desc limit $num_movies");
        return $query;
    }

    function getAvailableMovieShowtimes($movie_id, $order_by = 's.theater_id'){
        // Select showtimes where m.id = $movie_id and return

        $query = $this->db->query("select distinct
        s.id, s.theater_id, s.date, s.time, s.available from movie m, showtime s where s.movie_id =" . $movie_id . " order by " . $order_by . ', s.date');
        return $query;
    }

    function getAvailableMovieShowtimesByDate($movie_id, $date, $order_by = 's.theater_id'){
        $this->db->where('movie_id', $movie_id);
        $this->db->where('date', $date);
        $query = $this->db->get('showtime');
        return $query;
    }

    function getAvailableTheaterShowtimes($theater_id, $order_by = 's.movie_id'){
        $query = $this->db->query('select distinct s.id, s.movie_id, s.date, s.time, s.available from showtime s where s.theater_id = ' . $theater_id . ' order by ' . $order_by . ', s.date');
        return $query;
    }

    function getAvailableTheaterShowtimesByDate($theater_id, $date, $order_by = 's.theater_id'){
        $this->db->where('theater_id', $theater_id);
        $this->db->where('date', $date);
        $query = $this->db->get('showtime');
        return $query;
    }

    function getShowtimeById($showtime_id){
        $query = $this->db->query("select * from showtime s where s.id = " . $showtime_id);
        return $query->result();
    }

	
	
}