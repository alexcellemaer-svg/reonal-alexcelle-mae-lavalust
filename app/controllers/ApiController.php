<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('api');
        $this->call->database();
    }

    /**
     * CORS preflight endpoint.
     */
    public function cors()
    {
        // CORS is handled by the API library constructor.
    }

    /**
     * Read request data without sanitizing the password.
     *
     * @return array
     */
    private function get_api_input()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $rawBody = file_get_contents('php://input');

        if (stripos($contentType, 'application/json') !== false) {
            $input = json_decode($rawBody, true);
            return is_array($input) ? $input : [];
        }

        if (!empty($_POST)) {
            return $_POST;
        }

        $input = [];
        parse_str($rawBody, $input);
        return is_array($input) ? $input : [];
    }

    /**
     * POST /api/login
     */
    public function login()
    {
        $this->api->require_method('POST');

        $input = $this->get_api_input();

        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        if ($username === '' || $password === '') {
            $this->api->respond_error(
                'Username and password are required.',
                422
            );
        }

        // Use the exact same table and conditions as Lab 4.
        $user = $this->db->table('user')
                         ->where('username', $username)
                         ->where('is_deleted', 0)
                         ->row();

        // Preserve the exact Lab 4 plaintext-password behavior.
        if (!$user || !isset($user->password) || $password !== (string) $user->password) {
            $this->api->respond_error(
                'Invalid username or password.',
                401
            );
        }

        $tokens = $this->api->issue_tokens([
            'id'       => $user->id,
            'role'     => $user->role,
            'username' => $user->username
        ]);

        $this->api->respond([
            'message' => 'Login successful',
            'user' => [
                'id'       => $user->id,
                'username' => $user->username,
                'role'     => $user->role
            ],
            'tokens' => $tokens
        ]);
    }

    /**
     * POST /api/logout
     */
    public function logout()
    {
        $this->api->require_method('POST');

        $input = $this->get_api_input();
        $refreshToken = (string) ($input['refresh_token'] ?? '');

        if ($refreshToken !== '') {
            $this->api->revoke_refresh_token($refreshToken);
        }

        $this->api->respond([
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * POST /api/refresh
     */
    public function refresh()
    {
        $this->api->require_method('POST');

        $input = $this->get_api_input();
        $refreshToken = (string) ($input['refresh_token'] ?? '');

        if ($refreshToken === '') {
            $this->api->respond_error(
                'Refresh token is required.',
                422
            );
        }

        $this->api->refresh_access_token($refreshToken);
    }

    /**
     * GET /api/products
     */
    public function products()
    {
        $this->api->require_jwt();
        $this->api->require_method('GET');

        $products = $this->db->table('products')
                             ->select(
                                 'id, product_name, description, price, quantity, created_at'
                             )
                             ->order_by('id', 'DESC')
                             ->get_all();

        $this->api->respond($products);
    }

    /**
     * POST /api/products
     */
    public function create_product()
    {
        $this->api->require_jwt();
        $this->api->require_method('POST');

        $input = $this->api->body();

        $productName = trim((string) ($input['product_name'] ?? ''));
        $description = (string) ($input['description'] ?? '');
        $price = $input['price'] ?? null;
        $quantity = $input['quantity'] ?? null;

        if ($productName === '') {
            $this->api->respond_error(
                'Product name is required.',
                422
            );
        }

        if ($price === null || !is_numeric($price)) {
            $this->api->respond_error(
                'Price must be a valid number.',
                422
            );
        }

        if (
            $quantity === null ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false
        ) {
            $this->api->respond_error(
                'Quantity must be a valid integer.',
                422
            );
        }

        $id = $this->db->table('products')->insert([
            'product_name' => $productName,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => $quantity,
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        $this->api->respond([
            'message' => 'Product created successfully',
            'id'      => $id
        ], 201);
    }

    /**
     * PUT /api/products/{id}
     */
    public function update_product($id)
    {
        $this->api->require_jwt();
        $this->api->require_method('PUT');

        $input = $this->api->body();

        $productName = trim((string) ($input['product_name'] ?? ''));
        $description = (string) ($input['description'] ?? '');
        $price = $input['price'] ?? null;
        $quantity = $input['quantity'] ?? null;

        if ($productName === '') {
            $this->api->respond_error(
                'Product name is required.',
                422
            );
        }

        if ($price === null || !is_numeric($price)) {
            $this->api->respond_error(
                'Price must be a valid number.',
                422
            );
        }

        if (
            $quantity === null ||
            filter_var($quantity, FILTER_VALIDATE_INT) === false
        ) {
            $this->api->respond_error(
                'Quantity must be a valid integer.',
                422
            );
        }

        $existing = $this->db->table('products')
                             ->where('id', $id)
                             ->row();

        if (!$existing) {
            $this->api->respond_error(
                'Product not found.',
                404
            );
        }

        $this->db->table('products')
                 ->where('id', $id)
                 ->update([
                     'product_name' => $productName,
                     'description'  => $description,
                     'price'        => $price,
                     'quantity'     => $quantity
                 ]);

        $this->api->respond([
            'message' => 'Product updated successfully'
        ]);
    }

    /**
     * DELETE /api/products/{id}
     */
    public function delete_product($id)
    {
        $this->api->require_jwt();
        $this->api->require_method('DELETE');

        $existing = $this->db->table('products')
                             ->where('id', $id)
                             ->row();

        if (!$existing) {
            $this->api->respond_error(
                'Product not found.',
                404
            );
        }

        $this->db->table('products')
                 ->where('id', $id)
                 ->delete();

        $this->api->respond([
            'message' => 'Product deleted successfully'
        ]);
    }
}
