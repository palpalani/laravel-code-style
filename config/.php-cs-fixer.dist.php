<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap/app.php';

return (new Jubeki\LaravelCodeStyle\Config())
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(app_path())
            ->in(config_path())
            ->in(database_path('factories'))
            ->in(database_path('seeders'))
            ->in(function_exists('lang_path') ? lang_path() : resource_path('lang'))
            ->in(base_path('routes'))
            ->in(base_path('tests'))
    )
    ->setRules([
        '@Laravel' => true,
        // '@Laravel:risky' => true,
    ])
    // ->setRiskyAllowed(true)
    ;
