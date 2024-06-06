<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Show the billing form
   // Add a payment method
public function addPaymentMethod(Request $request)
{
    $user = $request->user();
    $paymentMethod = $request->payment_method;

    $user->createOrGetStripeCustomer();
    $user->updateDefaultPaymentMethod($paymentMethod);

    return redirect()->route('billing')->with('success', 'Payment method added successfully');
}

// Make a one-time charge
// public function pay(Request $request)
// {
//     $user = $request->user();

//     // Ensure the user has a default payment method
//     if (!$user->hasPaymentMethod()) {
//         return redirect()->route('billing')->withErrors('You need to add a payment method first.');
//     }

//     try {
//         $amount = 1499; // $14.99 in cents
//         $paymentMethod = $user->defaultPaymentMethod()->id;

//         $charge = $user->charge($amount, $paymentMethod);

//         return view('billing', ['charge' => $charge]);
//     } catch (\Exception $e) {
//         return redirect()->route('billing')->withErrors('Payment failed: ' . $e->getMessage());
//     }
// }
public function pay(Request $request)
{
    // Retrieve the authenticated user
    $user = Auth::user();

    // try {
        // Charge the user
        $charge = $user->charge(14.99, 'Product description');

        // Get the payment URL
        $payLink = $charge->url();

        // Return the payment URL to the view
        return view('billing', ['payLink' => $payLink]);
    // } catch (\Exception $e) {
    //     // Handle any exceptions, such as invalid payment methods
    //     return back()->withErrors('Payment failed: ' . $e->getMessage());
    // }
}
public function showBilling()
{
    // Create a Payment Intent to use for adding a payment method
    $intent = auth()->user()->createSetupIntent();
    return view('billing', ['intent' => $intent]);
}
}
