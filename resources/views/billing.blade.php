{{ $payLink }}
{{-- <!-- resources/views/billing.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Billing</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('billing') }}" method="POST" id="payment-form">
        @csrf
        <input id="card-holder-name" type="text" placeholder="Card Holder Name" required>
        <div id="card-element"></div>
        <button id="card-button" data-secret="{{ $intent->client_secret }}">Add Payment Method</button>
    </form>

    <h3>Make a One-Time Payment</h3>
    <form action="{{ route('pay') }}" method="GET">
        <button type="submit" class="btn btn-primary">Pay $14.99</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');

    cardElement.mount('#card-element');

    var cardButton = document.getElementById('card-button');
    var clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', function(ev) {
        ev.preventDefault();

        stripe.handleCardSetup(clientSecret, cardElement, {
            payment_method_data: {
                billing_details: { name: document.getElementById('card-holder-name').value }
            }
        }).then(function(result) {
            if (result.error) {
                // Display error.message in your UI
                alert(result.error.message);
            } else {
                // The payment method has been successfully set up
                document.getElementById('payment-form').submit();
            }
        });
    });
});
</script>
@endpush --}}
