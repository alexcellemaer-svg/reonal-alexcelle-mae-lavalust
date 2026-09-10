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
    | AUTHENTICATION
    |--------------------------------------------------------------------------
    */

    private function check_auth()
    {
        if (!$this->session->userdata('user_logged_in')) {
            redirect('login');
            exit;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        // If already logged in, go to products
        if ($this->session->userdata('user_logged_in')) {
            redirect('products');
            exit;
        }

        $error = $this->session->flashdata('error');

        $this->call->view('auth/login', [
            'error' => $error
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATE
    |--------------------------------------------------------------------------
    */

    public function authenticate()
    {
        $username = trim($this->io->post('username'));
        $password = $this->io->post('password');

        $user = $this->UsersModel->check_login(
            $username,
            $password
        );

        if ($user) {

            $this->session->set_userdata([
                'user_logged_in' => true,
                'logged_user_id' => $user->id,
                'username' => $user->username
            ]);

            redirect('products');
            exit;
        }

        $this->session->set_flashdata(
            'error',
            'Invalid username or password.'
        );

        redirect('login');
        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        // Remove current authentication session
        $this->session->unset_userdata('user_logged_in');
        $this->session->unset_userdata('logged_user_id');
        $this->session->unset_userdata('username');

        // Also remove the old session keys we previously used
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user');

        redirect('login');
        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | PRODUCTS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $this->check_auth();

        $products = $this->ProductsModel->get_all();

        $this->call->view('products/index', [
            'products' => $products
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $this->check_auth();

        $this->call->view('products/create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->check_auth();

        $data = [
            'product_name' => trim($this->io->post('product_name')),
            'description' => $this->io->post('description'),
            'price' => $this->io->post('price'),
            'quantity' => $this->io->post('quantity')
        ];

        $this->ProductsModel->insert($data);

        redirect('products');
        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUCT
    |--------------------------------------------------------------------------
    */

      public function edit($id)
  {
    $this->check_auth();

    $product = $this->ProductsModel->get_by_id($id);

    if (!$product) {
        redirect('products');
        exit;
    }

    $this->call->view('products/edit', [
        'product' => $product
    ]);
   }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $this->check_auth();

        $data = [
            'product_name' => trim($this->io->post('product_name')),
            'description' => $this->io->post('description'),
            'price' => $this->io->post('price'),
            'quantity' => $this->io->post('quantity')
        ];

        $this->ProductsModel->update($id, $data);

        redirect('products');
        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->check_auth();

        $this->ProductsModel->delete($id);

        redirect('products');
        exit;
    }
}