<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class BackupController extends BaseController
{
    public $path;
    public $filename;
    public $dbname;
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->path = ROOTPATH . 'backup_db/';
        $this->dbname = $this->db->database;
        $this->filename = $this->dbname . '_' . date('dMY_Hi') . '.sql';
    }
    public function index()
    {
        $data['path'] = $this->path;
        $data['dbname'] = $this->dbname;
        $data['filename'] = $this->filename;
        return view('admin/backup/index', add_data("Backup Database", 'backup/index', $data));
    }
    public function do_backup()
    {
        if ($this->request->getVar('replace_backup') != null) {
            $files = glob($this->path . "*");
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
        $prefs = ['filename' => $this->filename];
        $util = (new \CodeIgniter\Database\Database())->loadUtils($this->db);
        $backup = $util->backup($prefs, $this->db);
        write_file($this->path . $this->filename . '.zip', $backup);
        $this->response->download($this->path . $this->filename . '.zip', null);
        alert("Backup Success", 'success');
        return redirect()->to(admin_url('/backup'));
    }
}
