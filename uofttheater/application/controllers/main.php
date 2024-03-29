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


        $movie = $this->movie_model->getMovieById($id);
        $theaters = $this->theater_model->get_theaters()->result();

        // Easy name grabbing by id for the view
        foreach($theaters as $theatre){
            $theater_name_array[$theatre->id] = $theatre->name;
        }

        // Get date range for date selector
        $date_query = $this->db->query('select distinct date from showtime');
        $data['dates'] = $date_query->result();

        // Check if this movie is actually in our db
        if(!empty($movie)){
            // User has chosen a specific date
            if(isset($_GET['date_selected']) && $_GET['date_selected'] != '0'){
                $showtimes = $this->showtime_model->getAvailableMovieShowtimesByDate($id, $_GET['date_selected']);
                $data['header'] = "Showtimes for " . $movie[0]->title . " on " . $_GET['date_selected'] . " - UofT Cinema";
            }
            else{
                $showtimes = $this->showtime_model->getAvailableMovieShowtimes($id);
                $data['header'] = "Showtimes for " . $movie[0]->title . "- UofT Cinema";

            }

            $data['movie'] = $movie;
            $data['showtimes'] = $showtimes;
            $data['theater_name'] = $theater_name_array;
            $data['main'] = 'main/movie';
            $data['title'] = "Showtimes for " . $movie[0]->title . "- UofT Cinema";
            $this->load->view('template', $data);
        }
        // If the id doesn't return an object, send a 404
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

        // Store a id -> name value pair for easy access in view
        foreach($movies as $movie){
            $movie_name_array[$movie->id] = $movie->title;
        }

        $date_query = $this->db->query('select distinct date from showtime');
        $data['dates'] = $date_query->result();

        // Check if the theater id supplied was real
        if(!empty($theater)){
            // Check if we have a date selected
            if(isset($_GET['date_selected']) && $_GET['date_selected'] != '0'){
                $showtimes = $this->showtime_model->getAvailableTheaterShowtimesByDate($id, $_GET['date_selected']);
                $data['header'] = "Showtimes for " . $theater[0]->name . " on " . $_GET['date_selected'] . " - UofT Cinema";
            }
            else{
                $showtimes = $this->showtime_model->getAvailableTheaterShowtimes($id);
                $data['header'] = "Showtimes for " . $theater[0]->name . "- UofT Cinema";
            }
            $data['theater'] = $theater;
            $data['showtimes'] = $showtimes;
            $data['movie_name'] = $movie_name_array;
            $data['main'] = 'main/theater';
            $data['title'] = 'Showtimes for ' . $theater[0]->name . "- UofT Cinema";
            $this->load->view('template', $data);
        }
        // If its not return a 404
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

        $id = $this->uri->segment(2);

        // Get the showtime
        $showtime = $this->showtime_model->getShowtimeById($id);

        // Check the ticket database to see what seats are reserved
        $seats_booked_query = $this->ticket_model->getSeatsBookedByShowtime($id)->result();
        $seats_booked_array = array();

        foreach($seats_booked_query as $seat){
            $seats_booked_array[] = $seat->seat;
        }

        // Check if the showtime given is real
        if(!empty($showtime)){
            $showtime = $showtime[0];
            $movie = $this->movie_model->getMovieById($showtime->movie_id);
            $theater = $this->theater_model->getTheaterById($showtime->theater_id);
            $data['title'] = "Current Seating";
            $data['main'] = 'main/seating';
            $data['showtime'] = $showtime;
            $data['movie'] = $movie[0];
            $data['theater'] = $theater[0];
            $data['seats_booked'] = $seats_booked_array;
            $this->load->view('template', $data);
        }
        // If its not 404
        else{
            $data['main'] = '404.php';
            $this->load->view('template', $data);
        }

    }

    function booking(){
    	
		$this->load->model('ticket_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);
		
		$tickets =$this->ticket_model->get_tickets()->result();

        $showtime_id = $this->uri->segment(2);
        $seat_id = $this->uri->segment(3);

        // Check if a ticket already exists
        $this->db->select('ticket')->from('ticket')->where('showtime_id', $showtime_id)->where('seat', $seat_id);
        $query = $this->db->get();
        $ticket_full = $query->result();

        // If someone already booked this ticket (the only way we could've reached this page is if someone manually entered this URL)
        if(empty($ticket_full)){
             // Load the data for the booking page
            $data['title'] = "Ticket Booking";
            $data['showtime_id_pass'] = $showtime_id;
            $data['seat_pass'] = $seat_id;

            $this->load->helper(array('form', 'url'));
            $this->load->helper('date');

            $this->load->library('form_validation');

            // Set the form rules
            $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha_dash|xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha_dash|xss_clean');
            $this->form_validation->set_rules('creditcardNumber', 'Credit Card Number', 'required|exact_length[16]|numeric');
            $this->form_validation->set_rules('expireDate', 'Credit Card Expiration Date', 'required|exact_length[4]|numeric|callback_check_date');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('form', $data);
            }
            else
            {
                $data = array(
                   'first' => $_POST['firstname'] ,
                   'last' =>  $_POST['lastname'] ,
                   'creditcardnumber' => $_POST['creditcardNumber'],
                   'creditcardexpiration' => $_POST['expireDate'],
                   'showtime_id' => intval($_POST['showtime_id']),
                   'seat' => intval($_POST['seat'])
                );

                $this->db->insert('ticket', $data);

                // Gotta get the id for the ticket so gotta get the object back.
                $this->db->select('ticket')->from('ticket')->where('showtime_id', intval($_POST['showtime_id']))->where('seat', intval($_POST['seat']));
                $query = $this->db->get();
                $ticket_full = $query->result();
                $ticket_id = $ticket_full[0]->ticket;

                // We then need to update the amount available on the showtime
                $this->db->query("UPDATE showtime SET available = available - 1 WHERE id= " . $showtime_id . ' AND available >= 0');



                redirect('/print/' . $ticket_id );
            }
        }
        // Someone entered a URL for a ticket that was already booked, give them the option to pick seats for that showtime again
        else{
            $data['main'] = 'main/ticket_exists';
            $data['title'] = 'Sorry, ticket exists';
            $this->load->view('template', $data);
        }
        
    }

    function confirmation(){
        $id = $this->uri->segment(2);
        $this->load->model('ticket_model', '', TRUE);
        $this->load->model('theater_model', '', TRUE);
        $this->load->model('movie_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);

        // Grab the ticket object for this booking
        $ticket = $this->ticket_model->getTicketById($id);


        if(!empty($ticket)){
            $showtime = $this->showtime_model->getShowtimeById($ticket[0]->showtime_id);
            $data['ticket'] = $ticket;
			
			$movie_full = $this->movie_model->getMovieById($showtime[0]->movie_id);
			$theatre_full = $this->theater_model->getTheaterById($showtime[0]->theater_id);

            // Fill data to show on confirmation page
            $data['movie'] = $movie_full[0];
            $data['theater'] = $theatre_full[0];
            $data['showtime'] = $showtime[0];
            $data['title'] = 'Ticket Confirmation';
            $data['main'] = 'main/print';
            $this->load->view('template', $data);
        }
        // No ticket exists with this id
        else{
            $data['main'] = '404.php';
            $this->load->view('template', $data);
        }

    }



    public function check_date($str){
		//we will assume it is already in numbers
	if (intval(substr($str, 2, 2)) < intval(date('y'))) {
			$this->form_validation->set_message('check_date', 'The %s credit card has expired');
			return FALSE;
		}
	elseif((intval(substr($str, 2, 2)) == intval(date('y'))) && (intval(substr($str, 0, 2)) < intval(date('m'))) ){
		$this->form_validation->set_message('check_date', 'The %s credit card has expired');
		return FALSE;
	}

	elseif(intval(substr($str, 0, 2)) > 12){
		$this->form_validation->set_message('check_date', 'The %s month is invalid');
		return FALSE;
	}
	
	else{
			return TRUE;
	}
	}

}

