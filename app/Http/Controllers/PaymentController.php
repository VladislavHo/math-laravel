<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use YooKassa\Client;
use App\Models\User;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;
class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {

        $client = new Client();
        $client->setAuth(env('YOOKASSA_SHOP_ID'), env('YOOKASSA_SECRET_KEY'));

        $paymentData = [
            'amount' => [
                'value' => '2600.00', // Сумма платежа
                'currency' => 'RUB',
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_back_url' => route('payment.home'),
                'return_url' => route('payment.success'),
            ],
            'description' => 'Оплата за консультацию',
        ];

        $payment = $client->createPayment($paymentData, uniqid());

        $url = $payment->getConfirmation()->getConfirmationUrl();
        Log::info($url);
        $payment = $client->createPayment($paymentData, uniqid());

        return response()->json([
            'url' => $url,
            'payment_id' => $payment->getId(),
            'id' => $request->id,
            'status' => $payment->getStatus(),
        ]);

    }

    public function success()
    {


        return view('payment.success');
    }

    public function successStripe(){

        return view('payment.successStripe');
    }
    public function home()
    {
        return view('payment.home');
    }
    public function failure()
    {
        return view('payment.failure');
    }

    public function checkPayment(Request $request)
    {
        Log::info($request->all());
        $client = new Client();
        $client->setAuth(env('YOOKASSA_SHOP_ID'), env('YOOKASSA_SECRET_KEY'));

        try {
            $payment = $client->getPaymentInfo($request->payment_id);
            Log::info('Payment status: ' . $payment->getStatus());

            switch ($payment->getStatus()) {
                case 'succeeded':
                    User::where('id', $request->id)->update(['is_pay' => true]);
                    Order::create(
                        [
                            'user_id' => $request->id,
                            'payment_name' => "YooKassa",
                            'status' => "Оплачено",
                            'date_payment' => now(),
                        ]
                    );

                    User::with('appointments')->find($request->id);
                    Log::info('Payment succeeded');
                    // Логика успешной обработки платежа
                    break;

                case 'pending':
                    Log::info('Payment is pending');
                    User::where('id', $request->id)->update(['is_pay' => true]);

                    Order::create(
                        [
                            'user_id' => $request->id,
                            'payment_name' => "YooKassa",
                            'status' => "Оплачено",
                            'date_payment' => now(),
                        ]
                    );

                    User::with('appointments')->find($request->id);
                    Log::info('Payment succeeded');
                    // Логика обработки ожидания
                    break;

                case 'canceled':
                    Log::info('Payment was canceled');
                    // Логика обработки отмены
                    break;

                case 'waiting_for_capture':
                    Log::info('Payment is waiting for capture');
                    // Логика обработки ожидания подтверждения
                    break;

                default:
                    Log::info('Payment failed or status unknown');
                    // Логика обработки неуспешного платежа
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Error fetching payment info: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to check payment status'], 500);
        }
    }


    public function createPaymentStripe(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {

            $paymentIntent = PaymentIntent::create([
                'amount' => 25 * 100,
                'currency' => 'eur',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'dpmCheckerLink' => "https://dashboard.stripe.com/settings/payment_methods/review?transaction_id={$paymentIntent->id}",
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function checkedPaymentStripe(Request $request)
    {


        if ($request->user_id) {

            User::where('id', $request->user_id)->update(['is_pay' => true]);
            
            Log::info('checkedPaymentStripe'. $request->user_id);
            Order::create(
                [
                    'user_id' => $request->user_id,
                    'payment_name' => "Stripe",
                    'status' => "Оплачено",
                    'date_payment' => now(),
                ]
            );

            User::with('appointments')->find($request->user_id);
            Log::info('Payment succeeded');
        }
        Log::info($request->all());

        return response()->json(['success' => true]);
    }


}