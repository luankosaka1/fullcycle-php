<?php

namespace Tests\Unit;

use Core\Teste;
use PHPUnit\Framework\TestCase;

class TesteUnitTest extends TestCase
{
    /**
     * @covers
     */
    public function testTesteRun(): void
    {
        $teste = new Teste();
        $result = $teste->run();

        $this->assertEquals('started', $result);
    }
}