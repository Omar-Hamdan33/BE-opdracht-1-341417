<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Drop and recreate the stored procedure
    DB::unprepared('DROP PROCEDURE IF EXISTS AddProductLevering;');
    
    $procedure = "
    CREATE PROCEDURE AddProductLevering(
        IN leverancierId INT, 
        IN productId INT, 
        IN aantal INT, 
        IN datumEerstVolgendeLevering DATE,
        OUT resultMessage VARCHAR(255),
        OUT success BOOLEAN
    )
    BEGIN
        DECLARE productActief BIT DEFAULT 0;
        DECLARE leverancierNaam VARCHAR(100);
        DECLARE productNaam VARCHAR(100);
        DECLARE huidigAantal INT DEFAULT 0;
        
        -- Get product info
        SELECT IsActief, Naam INTO productActief, productNaam
        FROM Product 
        WHERE Id = productId
        LIMIT 1;
        
        -- Get leverancier info
        SELECT Naam INTO leverancierNaam
        FROM Leverancier 
        WHERE Id = leverancierId
        LIMIT 1;
        
        IF productActief = 0 THEN
            SET resultMessage = CONCAT('Het product ', COALESCE(productNaam, 'Onbekend'), ' van de leverancier ', COALESCE(leverancierNaam, 'Onbekend'), ' wordt niet meer geproduceerd');
            SET success = FALSE;
        ELSE
            -- Get current stock
            SELECT COALESCE(AantalAanwezig, 0) INTO huidigAantal 
            FROM Magazijn 
            WHERE ProductId = productId AND IsActief = 1
            LIMIT 1;
            
            -- Add new delivery record
            INSERT INTO ProductPerLeverancier (LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering) 
            VALUES (leverancierId, productId, CURDATE(), aantal, datumEerstVolgendeLevering);
            
            -- Update stock in magazine
            UPDATE Magazijn 
            SET AantalAanwezig = COALESCE(AantalAanwezig, 0) + aantal,
                DatumGewijzigd = NOW(6)
            WHERE ProductId = productId AND IsActief = 1;
            
            SET resultMessage = 'Levering succesvol toegevoegd';
            SET success = TRUE;
        END IF;
    END
    ";
    
    DB::unprepared($procedure);
    
    echo "Stored procedure succesvol bijgewerkt!\n";
    
} catch (Exception $e) {
    echo "Fout bij het updaten van stored procedure: " . $e->getMessage() . "\n";
}