<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'sku' => 'PFT-1235',
                'nombre' => 'Producto de prueba 1',
                'descripcion' => 'Este es un producto de prueba',
                'color' => 'rojo',
                'estado' => 1,
                'imagen' => 'default.png'
            ],
            [
                'sku' => 'PFT-1236',
                'nombre' => 'Producto de prueba 2',
                'descripcion' => 'Este es un producto de prueba',
                'color' => 'negro',
                'estado' => 1,
                'imagen' => 'default.png'
            ]
        ];

        $this->db->table('product')->insertBatch($data);
    }
}
