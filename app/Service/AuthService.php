<?php

namespace App\Service;

use App\Interface\AuthInterface;
use CodeIgniter\Model;
use Config\Encryption;
use Error;

/**
 * AUTH SERVICE CLASS 
 * CODED BY FARRIQ MFQ
 * token_name required
 */
class AuthService
{
    protected $session;
    protected $encryption;
    protected $db;
    protected string $token_name;
    protected $model;
    public function __construct(string $token_name, $model)
    {
        try {
            $this->model = new $model;
            if ($this->model instanceof AuthInterface) {
                $this->session = \Config\Services::session();
                $this->session->start();
                $this->encryption = \Config\Services::encrypter();
                $this->db = db_connect();
                $this->token_name = $token_name;
            } else {
                throw new Error("Invalid Implements Interface : try implement AuthInterface in your model");
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
    /**
     * make same key in database
     * ex : key email (same db)
     * ex : key password (same db)
     */
    public function attempt(array $credentials, string $password_key = "password"): bool
    {
        try {
            $db_field = array_column($this->model->getFieldData(), "name");
            $query_search = array_intersect(array_keys($credentials), $db_field);
            if (count($query_search) == count($credentials)) {
                if (in_array($password_key, $query_search)) { // check field password
                    $data_credential = array_diff_key($credentials, array_flip([$password_key])); // except password
                    $checkuser = $this->model->where($data_credential)->first();
                    if ($checkuser) {
                        $password_db = $checkuser->$password_key;
                        if (password_verify($credentials[$password_key], $password_db)) {
                            $data_user = array_diff_key((array) $checkuser, array_flip([$password_key]));
                            $this->setToken($data_user);
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function logout()
    {
        $this->session->remove($this->token_name);
    }
    public function setToken(array $data)
    {
        try {
            $this->session->set($this->token_name, $this->encryption->encrypt(http_build_query($data)));
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getSessionData(): ?array
    {
        // get session login
        try {
            if ($this->session->get($this->token_name)) {
                parse_str(urldecode($this->encryption->decrypt($this->session->get($this->token_name))), $output);
                if (count($output) || $output != null) {
                    return $output;
                } else {
                    return null;
                }
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
    public function authenticated(): bool
    {
        return $this->session->get($this->token_name) ? $this->getSessionData() == null ? false : true : false;
    }
    public function register($data,$table)
    {
        try {
            $query = "INSERT INTO `$table`(`name`, `email`, `password`) VALUES (?,?,?)";
            $insert = $this->db->query($query, [$data['name'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT)]);
            if ($insert) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
