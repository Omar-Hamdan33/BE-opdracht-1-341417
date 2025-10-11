<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WarehouseModel extends Model
{
    public function GetProductMagazijnOverzicht()
    {
        return DB::select('CALL GetProductMagazijnOverzicht()');
    }

    public function GetProductAllergeenById($id)
    {
        return DB::select('CALL GetProductAllergeenInfo(?)', [$id]);
    }

    public function GetLeverancierByProductId($id)
    {
        $connection = DB::connection()->getPdo();
        $stmt = $connection->prepare('CALL GetLeverancierByProduct(?)');
        $stmt->execute([$id]);
        $leverancierInfo = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $stmt->nextRowset();
        $productInfo = $stmt->fetchAll(\PDO::FETCH_OBJ);
        
        return [
            'product' => $productInfo,
            'leverancier' => $leverancierInfo
        ];
    }
}