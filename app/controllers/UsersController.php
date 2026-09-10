<?php
class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('session');
        $this->call->model('UsersModel');

        // Proteksyon: Dapat nakalog-in bago makita ang user panel modules
        if (!$this->session->has_userdata('user_logged_in')) {
            // Tumutugma sa: $router->get('/login', 'Product::login');
            redirect('login'); 
            exit();
        }
    }

       // I-display ang listahan ng active users at register profile screen
    public function index()
    {
        $data['active_users'] = $this->UsersModel->get_active_users();
        $data['trashed_users'] = $this->UsersModel->get_trashed_users();
        
        // Gumamit ng native PHP null coalescing operator upang maiwasan ang bug sa framework kernel
        $data['error'] = isset($_GET['error']) ? $_GET['error'] : null;
        $data['success'] = isset($_GET['success']) ? $_GET['success'] : null;

        $this->call->view('users_management', $data);
    }



    // Pagproseso ng bagong register user item
    public function store()
    {
        $username = trim($this->io->post('username'));
        $password = trim($this->io->post('password'));

        // 1. Siguraduhing may laman ang mga fields
        if (empty($username) || empty($password)) {
            // Tumutugma sa: $router->get('/users', 'UsersController::index');
            redirect('users?error=empty');
            exit();
        }

        // 2. I-check muna sa database kung may kaparehong username na umiiral
        $existing = $this->db->table('user')->where('username', $username)->row();

        if ($existing) {
            redirect('users?error=duplicate');
            exit();
        }

        // 3. Kung malinis at walang kapareho, ligtas na nating i-save!
        $data = [
            'username'   => $username,
            'password'   => password_hash($password, PASSWORD_BCRYPT),
            'is_deleted' => 0
        ];

        $this->UsersModel->insert_user($data);
        redirect('users?success=1');
        exit();
    }

    // Pindutan para sa pansamantalang pag-bura
    public function delete($id)
    {
        $this->UsersModel->soft_delete($id);
        redirect('users');
        exit();
    }

    // Pindutan para sa pag-recover/pag-restore
    public function recover($id)
    {
        $this->UsersModel->restore_user($id);
        redirect('users');
        exit();
    }

    // Pagbura ng sariling account segment
    public function delete_my_account()
    {
        $my_id = $this->session->userdata('logged_user_id');

        if ($my_id) {
            $this->UsersModel->soft_delete($my_id);
            
            $this->session->unset_userdata('user_logged_in');
            $this->session->unset_userdata('logged_user_id');
            $this->session->sess_destroy();
            
            redirect('login?error=length'); 
            exit();
        }
    }
}
