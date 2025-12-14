<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;

// Initialize database connection (using Laravel's config)
$app = require_once 'bootstrap/app.php';

try {
    // Check current Winegums amount before
    echo "=== VOOR DE TEST ===\n";
    $before = DB::table('Magazijn')->where('ProductId', 10)->select('AantalAanwezig')->first();
    echo "Winegums aantal voor levering: " . ($before->AantalAanwezig ?? 'NULL') . "\n";

    // Try to add Winegums delivery (should fail)
    echo "\n=== POGING WINEGUMS LEVERING ===\n";
    DB::statement('CALL AddProductLevering(4, 10, 100, "2024-12-20", @message, @success)');
    $result = DB::select('SELECT @message as message, @success as success');
    
    echo "Result message: " . $result[0]->message . "\n";
    echo "Success: " . ($result[0]->success ? 'TRUE' : 'FALSE') . "\n";

    // Check Winegums amount after
    echo "\n=== NA DE TEST ===\n";
    $after = DB::table('Magazijn')->where('ProductId', 10)->select('AantalAanwezig')->first();
    echo "Winegums aantal na levering: " . ($after->AantalAanwezig ?? 'NULL') . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>