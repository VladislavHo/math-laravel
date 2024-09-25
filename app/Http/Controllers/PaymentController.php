<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use YooKassa\Client;
use App\Models\User;
use Illuminate\Support\Facades\Route;
class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        Log::info($request->all());

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
    public function home(){
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
                    Log::info('Payment succeeded');
                    // Логика успешной обработки платежа
                    break;
    
                case 'pending':
                    Log::info('Payment is pending');
                    User::where('id', $request->id)->update(['is_pay' => true]);
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
}