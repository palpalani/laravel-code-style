<?php

declare(strict_types=1);

namespace Jubeki\LaravelCodeStyle;

use Illuminate\Foundation\Application as Laravel;
use PhpCsFixer\Console\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class FormattingTest extends TestCase
{
    public function test_formatting_matches_laravel()
    {
        if (version_compare(Laravel::VERSION, '8.59.0') < 0) {
            $this->markTestSkipped('Formatting is not up to date for old Laravel versions');
        }

        $application = tap(new Application())->setAutoExit(false);
        $exitCode = $application->run(
            new ArrayInput([
                'command' => 'fix',
                'path' => [__DIR__.'/../vendor/laravel/framework'],
                '--config' => __DIR__.'/fixtures/.php-cs-fixer.dist.php',
                '--dry-run' => true,
                '--diff' => true,
                '--verbose' => true,
            ]),
            $output = new BufferedOutput()
        );

        $this->assertEquals(
            0,
            $exitCode,
            implode(PHP_EOL, [
                'Existing Laravel files should not need to be fixed.',
                'Output:',
                $output->fetch(),
            ])
        );
    }
}
