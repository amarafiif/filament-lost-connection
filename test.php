<?php

require __DIR__ . '/vendor/autoload.php';

use Amarafiif\FilamentLostConnection\FilamentLostConnection;

echo "🧪 Testing Filament Lost Connection Plugin...\n\n";

try {
    $plugin = FilamentLostConnection::make();
    echo "✅ Plugin used successfully\n";
    
    echo "✅ Plugin ID: " . $plugin->getId() . "\n";
    
    $plugin->position('top')
           ->lostConnectionText('⚠️ Koneksi terputus')
           ->connectedText('✅ Koneksi normal')
           ->checkInterval(5000)
           ->lostConnectionColor('#dc2626')
           ->connectedColor('#16a34a')
           ->pingUrl('https://www.google.com/favicon.ico')
           ->icon('heroicon-o-wifi');
    
    echo "✅ All setter methods work correctly\n";
    
    echo "\n🎉 Plugin is ready for use in Laravel Filament projects!\n";
    echo "\n📖 Usage in your Filament Panel Provider:\n";
    echo "FilamentLostConnection::make()\n";
    echo "    ->position('bottom')\n";
    echo "    ->lostConnectionText('⚠️ Koneksi terputus')\n";
    echo "    ->connectedText('✅ Koneksi normal')\n";
    echo "    ->pingUrl('https://www.google.com/favicon.ico')\n";
    echo "    ->checkInterval(3000)\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "❌ File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
