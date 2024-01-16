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

    <!-- Your calculator form and result display here -->

    @isset($monthlyPayment)
        <div>
            <p>Monthly Payment: ${{ number_format($monthlyPayment, 2) }}</p>
        </div>
    @endisset
@endsection
