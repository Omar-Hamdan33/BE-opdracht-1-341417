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

    public function alergeen($id) {
        $product = $this->warehouseModel->GetProductInfoById($id);
        $allergenen = $this->warehouseModel->GetAllergeenByProductId($id);
        
        return view('alergeen.show', [
            'title' => 'Product Details',
            'product' => $product,
            'allergenen' => $allergenen
        ]);
    }

    public function leveranciers() {
        $leveranciers = $this->warehouseModel->GetLeveranciersOverzicht();
        
        return view('leveranciers.index', [
            'title' => 'Overzicht leveranciers',
            'leveranciers' => $leveranciers
        ]);
    }

    public function geleverdeProducten($leverancierId) {
        $producten = $this->warehouseModel->GetGeleverdeProductenByLeverancierId($leverancierId);
        $leverancier = null;
        
        $allLeveranciers = $this->warehouseModel->GetLeveranciersOverzicht();
        foreach($allLeveranciers as $lev) {
            if($lev->Id == $leverancierId) {
                $leverancier = $lev;
                break;
            }
        }
        
        return view('leveranciers.geleverde-producten', [
            'title' => 'Geleverde producten',
            'producten' => $producten,
            'leverancier' => $leverancier,
            'leverancierId' => $leverancierId
        ]);
    }

    public function nieuweLevering($leverancierId, $productId) {
        $allLeveranciers = $this->warehouseModel->GetLeveranciersOverzicht();
        $leverancier = null;
        foreach($allLeveranciers as $lev) {
            if($lev->Id == $leverancierId) {
                $leverancier = $lev;
                break;
            }
        }
        
        $product = $this->warehouseModel->GetProductInfoById($productId);
        
        return view('leveranciers.nieuwe-levering', [
            'title' => 'Levering product',
            'leverancier' => $leverancier,
            'product' => $product,
            'leverancierId' => $leverancierId,
            'productId' => $productId
        ]);
    }

    public function storeLevering(Request $request) {
        $leverancierId = $request->input('leverancier_id');
        $productId = $request->input('product_id');
        $aantal = $request->input('aantal');
        $datumEerstVolgendeLevering = $request->input('datum_eerst_volgende_levering');

        $result = $this->warehouseModel->AddProductLevering(
            $leverancierId, 
            $productId, 
            $aantal, 
            $datumEerstVolgendeLevering
        );

        if($result && $result->success == 0) {
            return view('leveranciers.nieuwe-levering', [
                'title' => 'Levering product',
                'leverancier' => (object)['Id' => $leverancierId],
                'product' => (object)['Id' => $productId],
                'leverancierId' => $leverancierId,
                'productId' => $productId,
                'errorMessage' => $result->resultMessage
            ]);
        }

        return redirect()->route('warehouse.geleverde-producten', ['leverancierId' => $leverancierId]);
    }
}