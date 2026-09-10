<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
        $this->call->model('ProductsModel');
        $this->call->library('session');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATION & MIDDLEWARE
    |--------------------------------------------------------------------------
    */

    private function check_auth()
    {
        if (!$this->session->has_userdata('user_logged_in')) {
            redirect('login');
            exit;
        }
    }

    private function check_admin()
    {
        // Piliting mag-authenticate muna bago i-verify ang role privileges
        $this->check_auth();

        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Access Denied: Only Administrators can modify products.');
            redirect('products');
            exit;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATE ENTRIES
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        if ($this->session->has_userdata('user_logged_in')) {
            redirect('products');
            exit;
        }

        $error = $this->session->flashdata('error');
        $this->call->view('auth/login', ['error' => $error]);
    }

    public function authenticate()
    {
        $username = trim($this->io->post('username'));
        $password = $this->io->post('password');

        // Kunin ang active profile row gamit ang username string target
        $user = $this->db->table('user')
                         ->where('username', $username)
                         ->where('is_deleted', 0)
                         ->row();

        if ($user && $password === $user->password) {

            $this->session->set_userdata([
                'user_logged_in' => true,
                'logged_user_id' => $user->id,
                'username'       => $user->username,
                'role'           => $user->role // Sine-save ang 'admin' o 'user' string tag
            ]);

            redirect('products');
            exit;
        }

        $this->session->set_flashdata('error', 'Invalid username or password.');
        redirect('login');
        exit;
    }

    public function logout()
    {
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('logged_user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->sess_destroy();

        redirect('login');
        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCTS CRUD OPERATIONS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $this->check_auth();
        $products = $this->ProductsModel->get_all();

        $this->call->view('products/index', [
            'products' => $products,
            'username' => $this->session->userdata('username'),
            'role'     => $this->session->userdata('role'), 
            'error'    => $this->session->flashdata('error')
        ]);
    }

    public function create()
    {
        $this->check_admin();
        $this->call->view('products/create');
    }

    public function store()
    {
        $this->check_admin();

        $data = [
            'product_name' => trim($this->io->post('product_name')),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductsModel->insert($data);
        redirect('products');
        exit;
    }

    public function edit($id)
    {
        $this->check_admin();
        $product = $this->ProductsModel->get_by_id($id);

        if (!$product) {
            redirect('products');
            exit;
        }

        $this->call->view('products/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $this->check_admin();

        $data = [
            'product_name' => trim($this->io->post('product_name')),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductsModel->update($id, $data);
        redirect('products');
        exit;
    }

    public function delete($id)
    {
        $this->check_admin();
        $this->ProductsModel->delete($id);
        redirect('products');
        exit;
    }
}
