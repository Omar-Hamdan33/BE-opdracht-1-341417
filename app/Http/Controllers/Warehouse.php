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
        $leverancier = $this->warehouseModel->GetLeverancierByProductId($id);
        $product = $this->warehouseModel->GetProductLeveringGegevens($id);
        
        $productOverview = $this->warehouseModel->GetProductMagazijnOverzicht();
        $currentProduct = collect($productOverview)->firstWhere('Id', $id);
        $hasStock = $currentProduct && $currentProduct->AantalAanwezig !== null;
        
        return view('leverancier.show', [
            'title' => 'Levering Informatie',
            'product' => $product,
            'leverancier' => $leverancier,
            'hasStock' => $hasStock,
            'productName' => $currentProduct->Naam ?? 'Onbekend product'
        ]);
    }
}