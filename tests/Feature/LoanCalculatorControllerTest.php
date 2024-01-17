<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanCalculatorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testLoanCalculationEndpoint()
    {
        $response = $this->post('/calculate-loan', [
            'loan_amount' => 100000,
            'interest_rate' => 5,
            'loan_term' => 10,
            'monthly_extra_payment' => 0,
        ]);

        $response->assertStatus(200)
            ->assertJson([
            
            ]);
    }
}
