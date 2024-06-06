<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Assert;

class JsonApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        TestResponse::macro('assertJsonApiValidationErrors', function ($attribute) {

            /** @var TestResponse $this */

            try {
                $this->assertJsonFragment([
                    'source' => [
                        'pointer' => '/data/attributes/' . $attribute,
                    ]
                ]);
            } catch (\PHPUnit\Framework\ExpectationFailedException $e) {
                Assert::fail("Failed to find a JSON:API validation error for key: {$attribute}"
                    . PHP_EOL . PHP_EOL .
                    $e->getMessage());
            }

            try {
                $this->assertJsonStructure([
                    'errors' => [
                        [
                            'title',
                            'detail',
                            'source' => [
                                'pointer'
                            ]
                        ]
                    ]
                ]);
            } catch (\PHPUnit\Framework\ExpectationFailedException $e) {
                Assert::fail("Failed to find a valid JSON:API error response"
                    . PHP_EOL . PHP_EOL .
                    $e->getMessage());
            }

            $this->assertHeader(
                'content-type',
                'application/vnd.api+json'
            )->assertStatus(422);
        });
    }
}
