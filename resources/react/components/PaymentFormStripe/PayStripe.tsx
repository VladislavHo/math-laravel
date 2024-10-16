import React, { useEffect, useState } from 'react';
import { loadStripe } from '@stripe/stripe-js';
import { Elements, ElementsConsumer } from '@stripe/react-stripe-js';
import PaymentFormStripe from './PaymentFormStripe'; // Импортируйте ваш компонент PaymentForm
import './payment--stripe.scss';


const stripePromise = loadStripe('pk_test_51Q2XSjAKi4iOG7DN44sinvtNhZxnbZ3ruIGgqvLSkzGk0dVWEdk5eBsjvwte8cfzX1KPwj2YnJ1mQjOs60AB4E0o00cvOtpGD1'!);


const PayStripe: React.FC = () => {
    const [clientSecret, setClientSecret] = useState<string | null>(null);

    useEffect(() => {
        const fetchClientSecret = async () => {
            const response = await fetch('api/payment/create-stripe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ amount: 25, currency: 'eur' }), // Пример суммы
            });

            const data = await response.json();
            setClientSecret(data.clientSecret);
        };

        fetchClientSecret();
    }, []);

    return (
        <div className='payment--stipe'>
            {clientSecret && (
                <Elements stripe={stripePromise} options={{ clientSecret }}>
                    <ElementsConsumer>
                        {({ stripe, elements }) => (
                            <PaymentFormStripe stripe={stripe} elements={elements} />
                        )}
                    </ElementsConsumer>
                </Elements>
            )}
        </div>
    );
};

export default PayStripe;