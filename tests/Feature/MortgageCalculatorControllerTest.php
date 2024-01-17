<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MortgageCalculatorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_calculator_page_loads()
    {
        $response = $this->get('/calculator');

        $response->assertStatus(200);
    }

    public function test_calculator_with_valid_input()
    {
        $response = $this->post('/calculator', [
            'loan_amount' => 100000,
            'interest_rate' => 5,
            'loan_term' => 20,
            'monthly_extra_payment' => 100,
        ]);

        $response->assertStatus(200)
            ->assertSee('Monthly Payment')
            ->assertSee('Amortization Schedule')
            ->assertSee('Extra Repayment Schedule');
    }
}
