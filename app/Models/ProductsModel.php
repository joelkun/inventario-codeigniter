<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //object
    protected $useSoftDeletes = true;

    protected $allowedFields = ['sku', 'nombre', 'descripcion', 'color', 'estado', 'imagen'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; //date //int
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
