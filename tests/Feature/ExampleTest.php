<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    #[Test]
    public function root_redirects_to_home(): void
    {
        $this->get('/')->assertRedirect('/home');
    }
}
