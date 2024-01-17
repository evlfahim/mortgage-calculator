<!-- resources/views/calculator.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Mortgage Loan Calculator</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- calculator form and result display here -->

    @isset($loanDetails)
        <div>
            <h2>Loan Setup Details</h2>
            <p>Loan Amount: ${{ number_format($loanDetails['loan_amount'], 2) }}</p>
            <p>Annual Interest Rate: {{ $loanDetails['annual_interest_rate'] }}%</p>
            <p>Loan Term: {{ $loanDetails['loan_term'] }} years</p>
            <p>Effective Interest Rate: {{ $loanDetails['effective_interest_rate'] }}%</p>
        </div>
    @endisset

    @isset($monthlyPayment)
        <div>
            <p>Monthly Payment: ${{ number_format($monthlyPayment, 2) }}</p>
        </div>
    @endisset

    <!-- Display the amortization schedule table -->
    @isset($amortizationSchedule)
        <h2>Amortization Schedule</h2>
        <!-- table code for amortization schedule here -->
        <table>
            <thead>
                <!-- Table header row -->
                <tr>
                    <th>Month</th>
                    <th>Starting Balance</th>
                    <th>Monthly Payment</th>
                    <th>Principal Component</th>
                    <th>Interest Component</th>
                    <th>Ending Balance</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table data rows -->
                @foreach ($amortizationSchedule as $row)
                    <tr>
                        <td>{{ $row['month_number'] }}</td>
                        <td>${{ number_format($row['starting_balance'], 2) }}</td>
                        <td>${{ number_format($row['monthly_payment'], 2) }}</td>
                        <td>${{ number_format($row['principal_component'], 2) }}</td>
                        <td>${{ number_format($row['interest_component'], 2) }}</td>
                        <td>${{ number_format($row['ending_balance'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endisset

    <!-- Display the extra repayment schedule table -->
    @isset($extraRepaymentSchedule)
        <h2>Extra Repayment Schedule</h2>
        <!-- table code for extra repayment schedule here -->
        <table>
            <thead>
                <!-- Table header row -->
                <tr>
                    <th>Month</th>
                    <th>Starting Balance</th>
                    <th>Monthly Payment</th>
                    <th>Principal Component</th>
                    <th>Interest Component</th>
                    <th>Extra Repayment Made</th>
                    <th>Ending Balance after Extra Repayment</th>
                    <th>Remaining Loan Term after Extra Repayment</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table data rows -->
                @foreach ($extraRepaymentSchedule as $row)
                    <tr>
                        <td>{{ $row['month_number'] }}</td>
                        <td>${{ number_format($row['starting_balance'], 2) }}</td>
                        <td>${{ number_format($row['monthly_payment'], 2) }}</td>
                        <td>${{ number_format($row['principal_component'], 2) }}</td>
                        <td>${{ number_format($row['interest_component'], 2) }}</td>
                        <td>${{ number_format($row['extra_repayment_made'], 2) }}</td>
                        <td>${{ number_format($row['ending_balance_after_extra_repayment'], 2) }}</td>
                        <td>{{ $row['remaining_loan_term_after_extra_repayment'] }} months</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endisset
@endsection
