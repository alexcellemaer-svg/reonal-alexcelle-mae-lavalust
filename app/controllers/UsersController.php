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
            header('Location: /reonal-alexcelle-mae-lavalust/index.php/login');
            exit();
        }
    }

    // I-display ang listahan ng active users at register profile screen
    public function index()
    {
        $data['active_users'] = $this->UsersModel->get_active_users();
        $data['trashed_users'] = $this->UsersModel->get_trashed_users();
        $this->call->view('users_management', $data);
    }

    // Pagproseso ng bagong register register user item
   public function store()
  {
    $username = trim($this->io->post('username'));
    $password = trim($this->io->post('password'));

    // 1. Siguraduhing may laman ang mga fields
    if (empty($username) || empty($password)) {
        header('Location: /reonal-alexcelle-mae-lavalust/index.php/users?error=empty');
        exit();
    }

    // 2. I-check muna sa database kung may kaparehong username na umiiral
    $this->call->model('UsersModel');
    $existing = $this->db->table('user')->where('username', $username)->row();

    if ($existing) {
        // Kung may nahanap na kapareho, i-redirect pabalik na may dalang error configuration signal
        header('Location: /reonal-alexcelle-mae-lavalust/index.php/users?error=duplicate');
        exit();
    }

    // 3. Kung malinis at walang kapareho, ligtas na nating i-save!
    $data = [
        'username'   => $username,
        'password'   => $password,
        'is_deleted' => 0
    ];

    $this->UsersModel->insert_user($data);
    header('Location: /reonal-alexcelle-mae-lavalust/index.php/users?success=1');
    exit();
  }

    // Pindutan para sa pansamantalang pag-bura
    public function delete($id)
    {
        $this->UsersModel->soft_delete($id);
        header('Location: /reonal-alexcelle-mae-lavalust/index.php/users');
        exit();
    }

    // Pindutan para sa pag-recover/pag-restore
    public function recover($id)
    {
        $this->UsersModel->restore_user($id);
        header('Location: /reonal-alexcelle-mae-lavalust/index.php/users');
        exit();
    }
    public function delete_my_account()
  {
    // 1. Kunin ang ID ng kasalukuyang nakalog-in na user mula sa session cache
    $my_id = $this->session->userdata('logged_user_id');

    if ($my_id) {
        $this->call->model('UsersModel');
        
        // 2. I-soft delete ang kanyang sariling account
        $this->UsersModel->soft_delete($my_id);
        
        // 3. I-destroy ang session para mapilitan siyang lumabas
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('logged_user_id');
        
        // 4. Ibalik siya sa login page na may abiso
        header('Location: /reonal-alexcelle-mae-lavalust/index.php/login?error=length'); // o kahit anong error parameter notice
        exit();
    }
  }

}
