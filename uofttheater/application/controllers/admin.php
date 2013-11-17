<?php
    class Admin extends CI_Controller{

    function __construct() {
        // Call the Controller constructor
        parent::__construct();
    }
        
    function index() {
            $data['title'] = "Administrator Page";
            $data['main'] = 'admin/index';
            $this->load->view('admin/template', $data);
    }
    
    function showShowtimes()
    {
        $data['title'] = "Display Showtimes";  
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
        $data['main']='admin/showtimes';
        $this->load->view('admin/template', $data);
    }
    
    function populate()
    {
        $data['title'] = "Populate Database";
        $this->load->model('movie_model');
        $this->load->model('theater_model');
        $this->load->model('showtime_model');
         
        $this->movie_model->populate();
        $this->theater_model->populate();
        $this->showtime_model->populate();
         
        //Then we redirect to the index page again
        redirect('admin/index', 'refresh');
         
    }

    function soldtickets()
    {
        $data['title'] = "Tickets Sold";  
        //First we load the library and the model
        $this->load->library('table');
        $this->load->model('Ticket_model');
        
        //Then we call our model's get_showtimes function
        $sales = $this->Ticket_model->get_tickets();

        //If it returns some results we continue
        if ($sales->num_rows() > 0){
        
            //Prepare the array that will contain the data
            $table = array();
            $table[] = array('Ticket Number','First Name','Last Name','Credit Card Number','Credit Card Expiration','Showtime', 'Seat Number');
        
           foreach ($sales->result() as $row){
                $table[] = array($row->ticket,$row->first,$row->last,$row->creditcardnumber,$row->creditcardexpiration,$row->showtime_id,$row->seat);
           }
            //Next step is to place our created array into a new array variable, one that we are sending to the view.
            $data['salestable'] = $table;           
        }
        
        //Now we are prepared to call the view, passing all the necessary variables inside the $data array
        $data['main']='admin/showtimes';
        $this->load->view('admin/template', $data);       

         
    }
    
    function delete()
    {
        $data['title'] = "Delete Database";
        $this->load->model('movie_model');
        $this->load->model('theater_model');
        $this->load->model('showtime_model');
        
        $this->movie_model->delete();
        $this->theater_model->delete();
        $this->showtime_model->delete();
         
        //Then we redirect to the index page again
        redirect('admin/index', 'refresh');
    
    }

    function homepage(){
        $this->load->model('movie_model', '', TRUE);
        $this->load->model('theater_model', '', TRUE);
        $this->load->model('showtime_model', '', TRUE);

        $data['title'] = "Administrator Page";

        $data['showtimes'] = $this->showtime_model->showUpcomingMovies(5);

        // Load the home page now
        $data['main'] = 'admin/home';
        $this->load->view('admin/template', $data);
    }

    }

?>