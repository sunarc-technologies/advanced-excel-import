<?php

namespace Sunarc\ImportExcel\Tests;

use Orchestra\Testbench\TestCase;
use Sunarc\ImportExcel\ImportExcelServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ImportExcelServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
