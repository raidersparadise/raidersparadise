<?php

namespace Tests\Unit;

use App\Support\Formato;
use PHPUnit\Framework\TestCase;

class FormatoTest extends TestCase
{
    public function test_formatea_pesos_colombianos(): void
    {
        $this->assertSame('$ 1.250.000', Formato::cop(1250000));
        $this->assertSame('$ 0', Formato::cop(null));
    }
}
