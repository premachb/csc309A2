<?php
date_default_timezone_set("Canada/Eastern");
class Main extends CI_Controller {

    
    function __construct() {
    	// Call the Controller constructor
    	parent::__construct();
    }
        
    function index() {
	    	$data['main']='main/index';
	    	$this->load->view('template', $data);
    }
    
	function showShowtimes()
    {

		//First we load the library and the model
		$this->load->library('table');
		$this->load->model('showtime_model');
		
		//Then we call our model's get_showtimes function
		$showtimes = $this->showtime_model->get_showtimes();

		//If it returns some results we continue
		if ($showtimes->num_rows() > 0){
		
			//Prepare the array that will contain the data
			$table = array();
			$table[] = array('Movie','Theater','Address','Date','Time','Available');
		
		   foreach ($showtimes->result() as $row){
				$table[] = array($row->title,$row->name,$row->address,$row->date,$row->time,$row->available);
		   }
			//Next step is to place our created array into a new array variable, one that we are sending to the view.
			$data['showtimes'] = $table; 		   
		}
		
		//Now we are prepared to call the view, passing all the necessary variables inside the $data array
		$data['main']='main/showtimes';
		$this->load->view('template', $data);
    }
    
    function populate()
    {
	    $this->load->model('movie_model');
	    $this->load->model('theater_model');
	    $this->load->model('showtime_model');
	     
	    $this->movie_model->populate();
	    $this->theater_model->populate();
	    $this->showtime_model->populate();
	     
	    //Then we redirect to the index page again
	    redirect('', 'refresh');
	     
    }
    
    function delete()
    {
	    $this->load->model('movie_model');
	    $this->load->model('theater_model');
	    $this->load->model('showtime_model');
    	
	    $this->movie_model->delete();
	    $this->theater_model->delete();
	    $this->showtime_model->delete();
	     
    	//Then we redirect to the index page again
    	redirect('', 'refresh');
    
    }

    function homepage(){
        $this->load->model('movie_model', '', TRUE);
        $this->load->model('theater_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);


        // Load the home page now
        $data['main'] = 'main/home';
        $data['title'] = "Home - UofT Cinema";
        $data['movies'] = $this->movie_model->get_movies()->result();
        $data['theaters'] = $this->theater_model->get_theaters()->result();
        $this->load->view('template', $data);
    }

    function movie(){
        // Find movie showtimes for a movie with id given
        $this->load->model('movie_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);
        $this->load->model('theater_model', '', TRUE);

        $this->load->library('table');
        $theater_name_array = array();
        $id = $this->uri->segment(2);
        // Sanity check the id, someone may tamper

        $movie = $this->movie_model->getMovieById($id);
        $showtimes = $this->showtime_model->getAvailableMovieShowtimes($id);
        $theaters = $this->theater_model->get_theaters()->result();

        // Easy name grabbing by id for the view
        foreach($theaters as $theatre){
            $theater_name_array[$theatre->id] = $theatre->name;
        }

        if(!empty($movie)){
            $data['movie'] = $movie;
            $data['showtimes'] = $showtimes;
            $data['theater_name'] = $theater_name_array;
            $data['main'] = 'main/movie';
            $data['title'] = "Showtimes for " . $movie[0]->title . "- UofT Cinema";
            $this->load->view('template', $data);
        }
        else{
            $data['main'] = '404.php';
            $this->load->view('template', $data);
        }

    }

    function theater(){
        $this->load->model('movie_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);
        $this->load->model('theater_model', '', TRUE);

        $this->load->library('table');
        $movie_name_array = array();
        $id = $this->uri->segment(2);

        $theater = $this->theater_model->getTheaterById($id);
        $movies = $this->movie_model->get_movies()->result();
        $showtimes = $this->showtime_model->getAvailableTheaterShowtimes($id);

        foreach($movies as $movie){
            $movie_name_array[$movie->id] = $movie->title;
        }

        if(!empty($theater)){
            $data['theater'] = $theater;
            $data['showtimes'] = $showtimes;
            $data['movie_name'] = $movie_name_array;
            $data['main'] = 'main/theater';
            $data['title'] = "Showtimes for " . $theater[0]->name . "- UofT Cinema";
            $this->load->view('template', $data);
        }
        else{
            $data['main'] = '404.php';
            $this->load->view('template', $data);
        }



    }

    function seating(){
        $this->load->model('movie_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);
        $this->load->model('theater_model', '', TRUE);
        $this->load->model('ticket_model', '', TRUE);

        $id = $this->uri->segment(3);

        // Get the showtime
        $showtime = $this->showtime_model->getShowtimeById($id);

        // Check the ticket database to see what seats are reserved
        $seats_booked = $this->ticket_model->getSeatsBookedByShowtime($id)->result();

        if(!empty($showtime)){
            $showtime = $showtime[0];
            $movie = $this->movie_model->getMovieById($showtime->movie_id);
            $data['title'] = "Current Seating";
            $data['main'] = 'main/seating';
            $data['showtime'] = $showtime;
            $data['movie'] = $movie[0];
            $data['seats_booked'] = $seats_booked;
            $this->load->view('template', $data);
        }
        else{
            $data['main'] = '404.php';
            $this->load->view('template', $data);
        }

    }

    function booking(){
        $this->load->model('movie_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);
        $this->load->model('theater_model', '', TRUE);
        $this->load->model('ticket_model', '', TRUE);

        $showtime_id = $this->uri->segment(3);
        $seat_id = $this->uri->segment(4);



    }

}

