import React, { useState } from 'react';

// import {CardElement,PaymentElement, useStripe, useElements } from '@stripe/react-stripe-js';
import {PaymentElement } from '@stripe/react-stripe-js';
import { Stripe, StripeElements } from '@stripe/stripe-js';


import {SERVER_SITE} from "../../config/config";
import './payment--stripe.scss';


const CheckoutForm: React.FC<{ stripe:Stripe | null; elements:StripeElements | null }> = ({stripe, elements}) => {


    const [error, setError] = useState<string | null>(null);
    const [success, setSuccess] = useState<string | null>(null);

  
    const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        if (!stripe || !elements) {
            setError('Please try again later.');
            return;
        }


        const result = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: `${SERVER_SITE}/api/payment/successStripe`, 
            },
        });

        if (result.error) {
            // Если произошла ошибка при подтверждении платежа
            setError(result.error.message ?? 'Something went wrong. Please try again.');
        } else {
            // Платеж успешен




            setSuccess('Payment successful!');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <h2 style={{textAlign:'center', marginBottom:'20px'}}>Оплатите 25 евро чтобы записаться на консультацию!</h2>
            <h3>4242424242424242</h3>
            <PaymentElement />
            <button className='pay' type="submit" disabled={!stripe}>
                Pay
            </button>
            {error && <div> <p style={{color:'red'}}>{error}</p> <br /> <p style={{color:'#333'}}><strong>Если ваша оплата не прошла, напишите нам на нашу почту <a href="zhborodaeva@gmail.com">zhborodaeva@gmail.com</a> или в телеграм <a href="https://t.me/zhborodaeva">@zhborodaeva</a> </strong></p> </div>}
            {success && <div>{''}</div>}
        </form>
    );
};

export default CheckoutForm;