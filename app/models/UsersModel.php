<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model
{
    protected $table = 'user';

    public function get_active_users()
    {
        return $this->db
            ->table($this->table)
            ->where('is_deleted', 0)
            ->get_all();
    }

    public function get_trashed_users()
    {
        return $this->db
            ->table($this->table)
            ->where('is_deleted', 1)
            ->get_all();
    }

    public function insert_user($data)
    {
        return $this->db
            ->table($this->table)
            ->insert($data);
    }

    public function soft_delete($id)
    {
        return $this->db
            ->table($this->table)
            ->where('id', $id)
            ->update([
                'is_deleted' => 1
            ]);
    }

    public function restore_user($id)
    {
        return $this->db
            ->table($this->table)
            ->where('id', $id)
            ->update([
                'is_deleted' => 0
            ]);
    }

    public function check_login($username, $password)
    {
        return $this->db
            ->table($this->table)
            ->where('username', $username)
            ->where('password', $password)
            ->where('is_deleted', 0)
            ->row();
    }
}