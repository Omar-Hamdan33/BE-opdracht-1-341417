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
        $rawData = $this->warehouseModel->GetProductAllergeenById($id);
        
        $product = $rawData[0] ?? null;
        $allergenen = array_slice($rawData, 1);
        
        return view('alergeen.show', [
            'title' => 'Product Details',
            'product' => $product,
            'allergenen' => $allergenen
        ]);
    }

    public function leverancier($id) {
        $rawData = $this->warehouseModel->GetLeverancierByProductId($id);
        
        // Initialize arrays
        $product = [];
        $leverancier = [];
        
        // Check and sort data based on content
        if (!empty($rawData)) {
            foreach ($rawData as $item) {
                if (isset($item->DatumLevering) ) {
                    $product[] = $item;
                }
                else if (isset($item->LeverancierNummer) ) {
                    $leverancier[] = $item;
                }
            }
        }
        
        return view('leverancier.show', [
            'title' => 'leverancier Details',
            'product' => $product,
            'leverancier' => $leverancier
        ]);
    }
}