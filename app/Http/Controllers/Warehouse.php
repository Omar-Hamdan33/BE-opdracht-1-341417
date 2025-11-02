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

    public function leverancier($id) {
        $rawData = $this->warehouseModel->GetLeverancierByProductId($id);
        
        $leverancier = null;
        $product = [];
        
        if (!empty($rawData)) {
            $leverancier = $rawData[0] ?? null;
            
            $product = array_slice($rawData, 1);
        }
        
        return view('leverancier.show', [
            'title' => 'Leverancier Details',
            'product' => $product,
            'leverancier' => $leverancier
        ]);
    }
}