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
        return DB::select('CALL GetLeverancierByProduct(?)', [$id]);
    }
}