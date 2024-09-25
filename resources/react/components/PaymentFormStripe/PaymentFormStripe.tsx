import React, { useState } from 'react';

// import {CardElement,PaymentElement, useStripe, useElements } from '@stripe/react-stripe-js';
import {PaymentElement } from '@stripe/react-stripe-js';
import { Stripe, StripeElements } from '@stripe/stripe-js';
import {SERVER_SITE} from "../../var/var";
import './payment--stripe.scss';


const CheckoutForm: React.FC<{ stripe:Stripe | null; elements:StripeElements | null }> = ({stripe, elements}) => {
  // const stripe = useStripe();
    // const elements = useElements();

    const [error, setError] = useState<string | null>(null);
    const [success, setSuccess] = useState<string | null>(null);

  
    const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        if (!stripe || !elements) {
            setError('Stripe.js has not loaded yet. Please try again later.');
            return;
        }

        // Подтверждение платежа с использованием PaymentElement
        const result = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: `${SERVER_SITE}/calendar`, // Укажите URL для перенаправления после успешного платежа
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
            <h2>Payment Form</h2>
            <PaymentElement />
            <button className='pay' type="submit" disabled={!stripe}>
                Pay
            </button>
            {error && <div>{error}</div>}
            {success && <div>{''}</div>}
        </form>
    );
};

export default CheckoutForm;