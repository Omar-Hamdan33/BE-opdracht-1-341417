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

    public function GetLeverancierByProductId($id)
    {
        return DB::selectOne('CALL GetLeverancierByProduct(?)', [$id]);
    }

    public function GetProductLeveringGegevens($id)
    {
        return DB::select('CALL GetProductLeveringGegevens(?)', [$id]);
    }

    public function GetProductAllergeenById($id)
    {
        return DB::select('CALL GetProductAllergeenInfo(?)', [$id]);
    }

    public function GetProductInfoById($id)
    {
        return DB::selectOne('CALL GetProductInfoById(?)', [$id]);
    }

    public function GetAllergeenByProductId($id)
    {
        return DB::select('CALL GetAllergeenByProductId(?)', [$id]);
    }

    public function GetLeveranciersOverzicht()
    {
        return DB::select('CALL GetLeveranciersOverzicht()');
    }

    public function GetGeleverdeProductenByLeverancierId($id)
    {
        return DB::select('CALL GetGeleverdeProductenByLeverancierId(?)', [$id]);
    }

    public function AddProductLevering($leverancierId, $productId, $aantal, $datumEerstVolgendeLevering)
    {
        $result = DB::select('CALL AddProductLevering(?, ?, ?, ?, @resultMessage, @success)', 
            [$leverancierId, $productId, $aantal, $datumEerstVolgendeLevering]);
        
        $outputs = DB::select('SELECT @resultMessage as resultMessage, @success as success');
        return $outputs[0] ?? null;
    }
}