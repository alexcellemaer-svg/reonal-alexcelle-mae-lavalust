<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductsController extends Controller
{
      public function index()
  {
    $this->call->model('ProductsModel');

    $products = $this->ProductsModel->get_all();

    $this->call->view('products/index', [
        'products' => $products
    ]);
  }
    

    public function create()
    {
        $this->call->view('products_create');
    }

     public function store()
  {
    $this->call->model('ProductsModel');

    $data = [
        'product_name' => $this->io->post('product_name'),
        'description'  => $this->io->post('description'),
        'price'        => $this->io->post('price'),
        'quantity'     => $this->io->post('quantity')
    ];

    $this->ProductsModel->insert($data);

    redirect(site_url('products'));
  }
}