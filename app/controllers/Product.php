<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model('Product_model');
        $this->call->library('session');
    }

    // Helper method para harangan ang unauthenticated users
    private function check_auth() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            exit;
        }
    }

    // --- AUTHENTICATION MECHANISMS ---
    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('products');
        }
        $this->call->view('auth/login');
    }

    public function authenticate() {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        // Simple hardcoded credentials para mabilis kang makapasa bago mag-5PM
        if ($username === 'admin' && $password === 'password123') {
            $this->session->set_userdata(['logged_in' => true, 'user' => $username]);
            redirect('products');
        } else {
            $this->session->set_flashdata('error', 'Invalid Credentials');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user');
        redirect('login');
    }

    // --- CRUD OPERATIONS ---
    public function index() {
        $this->check_auth();
        $data['products'] = $this->Product_model->get_all();
        $this->call->view('products/index', $data);
    }

    public function create() {
        $this->check_auth();
        $this->call->view('products/create');
    }

    public function store() {
        $this->check_auth();
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];
        $this->Product_model->insert($data);
        redirect('products');
    }

    public function edit($id) {
        $this->check_auth();
        $data['product'] = $this->Product_model->get_by_id($id);
        $this->call->view('products/edit', $data);
    }

    public function update($id) {
        $this->check_auth();
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];
        $this->Product_model->update($id, $data);
        redirect('products');
    }

    public function delete($id) {
        $this->check_auth();
        $this->Product_model->delete($id);
        redirect('products');
    }

    // Pang-execute para automatic magawa ang table mo sa Aiven kahit walang DBeaver
    public function init_db() {
        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR(100) NOT NULL,
            description TEXT,
            price DECIMAL(10,2) NOT NULL,
            quantity INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        
        if($this->db->query($sql)) {
            echo "Table 'products' created successfully sa Aiven!";
        } else {
            echo "Connection failed or error occurred.";
        }
    }
}
