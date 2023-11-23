<?php

namespace App\Controllers;

use App\Models\ProductsModel;
//use CodeIgniter\Files\File;

class Product extends BaseController
{
    private $productModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->productModel = new ProductsModel();
    }

    public function index()
    {
        $mensaje = session('mensaje');
        $resultado = $this->productModel->where('estado', 1)->findAll();
        $data = ['titulo' => 'Producto', 'productos' => $resultado, 'mensaje' => $mensaje,];
        return view('products/index', $data);
    }

    public function create()
    {
        $mensaje = session('mensaje');

        $data = [
            'titulo' => 'Crear producto',
            'mensaje' => $mensaje,
        ];
        return view('products/create', $data);
    }

    public function saveProduct()
    {
        $validationRule = [
            'sku' => [
                'label' => 'sku',
                'rules' => 'required|is_unique[product.sku]|max_length[15]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!',
                    'is_unique' => 'El campo {field} debe ser único!!',
                    'max_length' => 'El campo {field} debe ser de máximo 15 caracteres!!'
                ],
            ],
            'nombre' => [
                'label' => 'nombre',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!',
                    'max_length' => 'El campo {field} debe ser de máximo 150 caracteres!!'
                ],
            ],
            'color' => [
                'label' => 'color',
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!',
                    'max_length' => 'El campo {field} debe ser de máximo 50 caracteres!!'
                ],
            ],
            'imagen' => [
                'label' => 'imagen',
                'rules' => [
                    'is_image[imagen]',
                    'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[imagen,100]',
                    'max_dims[imagen,1024,768]',
                ],
                'errors' => [
                    'is_image' => 'El archivo no es una imagen!!',
                    'mime_in' => 'El archivo no tiene extensión jpg, jpeg, gif, png, webp!!',
                    'max_size' => 'La imagen debe pesar menos de 100KB!!',
                    'max_dims' => 'La imagen debe ser hasta 1024 x 768!!'
                ]
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput();
        }

        $img = $this->request->getFile('imagen');
        $post = $this->validator->getValidated();
        $descripcion = isset($post['descripcion']) ? $post['descripcion'] : '';

        if ($img->isValid() && !$img->hasMoved()) {

            $originalName = $img->getClientName();
            $fechaActual = date("YmdHis");
            $newName = $fechaActual . '_' . $originalName;
            $img->move(ROOTPATH . 'public/uploads/img', $newName);
            //$path = $this->request->getFile('imagen')->store('img/', $newName);

            $producto = [
                'sku' => $post['sku'],
                'nombre' => $post['nombre'],
                'descripcion' => $descripcion,
                'color' => $post['color'],
                'estado' => 1,
                'imagen' => $newName
            ];
        } else {
            $producto = [
                'sku' => $post['sku'],
                'nombre' => $post['nombre'],
                'descripcion' => $descripcion,
                'color' => $post['color'],
                'estado' => 1,
                'imagen' => "default.png"
            ];
        }
        $respuesta = $this->productModel->insert($producto);

        if ($respuesta > 0) {
            return redirect()->to(base_url() . 'product/create')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . 'product/create')->with('mensaje', '0');
        }

        /*$db = \Config\Database::connect();
        $condicion =['estado' => 1, 'stock >' =>5];

        $query = $db->table('product')
        ->select('nombre, descripcion')
        ->where('estado',1)
        ->where('stock >',5)
        ->where($condicion)
        ->orderBy('sku','asc')
        ->limit(1)
        ->get(); //AND

        $resultado = $query->getResult();
        echo $db->getLastQuery();*/
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        $data = [
            'titulo' => 'Editar producto',
            'producto' => $product
        ];
        return json_encode($data);
    }

    public function saveEdit()
    {
        $validationRule = [
            'id' => [
                'label' => 'id',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!'
                ],
            ],
            'sku' => [
                'label' => 'sku',
                'rules' => 'required|is_unique[product.sku,id,{id}]|max_length[15]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!',
                    'is_unique' => 'El campo {field} debe ser único!!',
                    'max_length' => 'El campo {field} debe ser de máximo 15 caracteres!!'
                ],
            ],
            'nombre' => [
                'label' => 'nombre',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!',
                    'max_length' => 'El campo {field} debe ser de máximo 150 caracteres!!'
                ],
            ],
            'color' => [
                'label' => 'color',
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!',
                    'max_length' => 'El campo {field} debe ser de máximo 50 caracteres!!'
                ],
            ],
            'estado' => [
                'label' => 'estado',
                'rules' => 'required|max_length[1]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio!!',
                    'max_length' => 'El campo {field} solo admite 1 caracter!!'
                ]
            ],
            'imagen' => [
                'label' => 'imagen',
                'rules' => [
                    'is_image[imagen]',
                    'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[imagen,100]',
                    'max_dims[imagen,1024,768]',
                ],
                'errors' => [
                    'is_image' => 'El archivo no es una imagen!!',
                    'mime_in' => 'El archivo no tiene extensión jpg, jpeg, gif, png, webp!!',
                    'max_size' => 'La imagen debe pesar menos de 100KB!!',
                    'max_dims' => 'La imagen debe ser hasta 1024 x 768!!'
                ]
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->to(base_url() . 'product')->with('mensaje', '0');
        }

        $img = $this->request->getFile('imagen');
        $post = $this->validator->getValidated();

        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $id = isset($post['id']) ? intval($post['id']) : 0;

        $estado = isset($post['estado']) ? intval($post['estado']) : 1;
        if ($id > 0) {
            if ($img->isValid() && !$img->hasMoved()) {

                $originalName = $img->getClientName();
                $fechaActual = date("YmdHis");
                $newName = $fechaActual . '_' . $originalName;
                $img->move(ROOTPATH . 'public/uploads/img', $newName);
                //$path = $this->request->getFile('imagen')->store('img/', $newName);

                $producto = [
                    'id' => $id,
                    'sku' => $post['sku'],
                    'nombre' => $post['nombre'],
                    'descripcion' => $descripcion,
                    'color' => $post['color'],
                    'estado' => $estado,
                    'imagen' => $newName
                ];
            } else {
                $producto = [
                    'id' => $id,
                    'sku' => $post['sku'],
                    'nombre' => $post['nombre'],
                    'descripcion' => $descripcion,
                    'color' => $post['color'],
                    'estado' => $estado,
                ];
            }
        }

        if ($estado === 1) {

            $respuesta = $this->productModel->save($producto);
        } else {
            $this->productModel->save($producto);
            $respuesta = $this->productModel->delete($id);
        }


        if ($respuesta > 0) {
            return redirect()->to(base_url() . 'product')->with('mensaje', '1');
        } else {
            return redirect()->to(base_url() . 'product')->with('mensaje', '0');
        }
    }

    public function findProduct($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('product')
            ->like('sku', $id)
            ->orLike('nombre', $id)
            ->get();
        $resultado = $query->getResult();
        return json_encode($resultado);
    }
}
