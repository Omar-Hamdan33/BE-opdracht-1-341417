<?php

namespace App\Http\Controllers;

use App\Models\WarehouseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Warehouse extends Controller
{
    private $warehouseModel;

    public function __construct() {
        $this->warehouseModel = new WarehouseModel();
    }

    public function index() {
        $data = $this->warehouseModel->GetProductMagazijnOverzicht();
        return view('warehouse.index', [
            'title' => 'Warehouse',
            'data' => $data
        ]);
    }

    public function alergeen($id) {
        $product = $this->warehouseModel->GetProductInfoById($id);
        $allergenen = $this->warehouseModel->GetAllergeenByProductId($id);
        
        return view('alergeen.show', [
            'title' => 'Product Details',
            'product' => $product,
            'allergenen' => $allergenen
        ]);
    }
}