<?php 
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); 

class StudentController extends Controller 
{ 
    public function index()
    {
        $this->call->view('studentHome');
    }

    public function profile() 
    { 
        $student = [ 
            'student_id' => 'MCC2024-00179',
            'name'       => 'Alexcelle Mae B. Reonal',
            'course'     => 'BS Information Technology',
            'year'       => '3rd Year',
            'section'    => '3-F4',
            'email'      => 'alexcellemaer@gmail.com'
        ];

        $this->call->view('studentinfo', $student);
    } 
}
