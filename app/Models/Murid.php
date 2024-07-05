<?php

namespace App\Models;

use CodeIgniter\Model;

class Murid extends Model
{
    protected $table            = 'murid';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama', 'absen', 'email', 'alamat', 'gambar'];
    //  (field yg akan digunakan selanjutnya)

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
}
