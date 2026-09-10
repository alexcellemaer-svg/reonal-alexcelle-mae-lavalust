<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
      public function __construct()
    {
        parent::__construct();
        $this->call->library('session');
        $this->call->model('UsersModel');

        // 1. Proteksyon: Dapat nakalog-in muna
        if (!$this->session->has_userdata('user_logged_in')) {
            redirect('login'); 
            exit();
        }

        // 2. Proteksyon: Dapat ay ADMIN upang makita o mabago ang mga user accounts
        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Access Denied: Only Administrators can access the User Console.');
            redirect('products');
            exit();
        }
    }


    public function index()
    {
        $data['active_users'] = $this->UsersModel->get_active_users();
        $data['trashed_users'] = $this->UsersModel->get_trashed_users();
        
        // Native array key confirmation structure para hindi mag-crash ang kernel
        $data['error'] = isset($_GET['error']) ? $_GET['error'] : null;
        $data['success'] = isset($_GET['success']) ? $_GET['success'] : null;

        $this->call->view('users_management', $data);
    }

    public function store()
    {
        $username = trim($this->io->post('username'));
        $password = trim($this->io->post('password'));

        if (empty($username) || empty($password)) {
            redirect('users?error=empty');
            exit();
        }

        $existing = $this->db->table('user')->where('username', $username)->row();

        if ($existing) {
            redirect('users?error=duplicate');
            exit();
        }

        $data = [
            'username'   => $username,
            'password'   => password_hash($password, PASSWORD_BCRYPT),
            'is_deleted' => 0,
            'role'       => 'user' // Pinipilit ang safe regular status tag para sa mga karaniwang signup
        ];

        $this->UsersModel->insert_user($data);
        redirect('users?success=1');
        exit();
    }

    public function delete($id)
    {
        $this->UsersModel->soft_delete($id);
        redirect('users');
        exit();
    }

    public function recover($id)
    {
        $this->UsersModel->restore_user($id);
        redirect('users');
        exit();
    }

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

        // I-display ang edit view form para sa isang partikular na user ID
    public function edit($id)
    {
        // Kukunin ang row data gamit ang query target array match structure
        $user = $this->db->table('user')->where('id', $id)->row();

        if (!$user) {
            redirect('users');
            exit();
        }

        // I-convert ang stdClass object patungong array para sa view variables
        $this->call->view('users_edit', ['user' => (array) $user]);
    }

    // Pagproseso ng pag-update sa database matapos isumite ang edit form
    public function update($id)
    {
        $username = trim($this->io->post('username'));
        $password = trim($this->io->post('password'));
        $role     = $this->io->post('role');

        if (empty($username) || empty($password) || empty($role)) {
            redirect('users?error=empty');
            exit();
        }

        $data = [
            'username' => $username,
            'password' => $password, 
            'role'     => $role
        ];

        // I-commit ang pagbabago sa db table partition cluster array
        $this->db->table('user')->where('id', $id)->update($data);
        
        redirect('users?success=updated');
        exit();
    }

}
