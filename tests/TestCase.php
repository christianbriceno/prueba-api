<?php

namespace Tests;

use App\Traits\MakesJsonApiRequest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, MakesJsonApiRequest;
}
