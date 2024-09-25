import { SERVER_SITE } from "../var/var";

export async function pay(userID: string | null) {
  try {
    const response = await fetch(`${SERVER_SITE}/api/payment/create`, {
      method: 'POST', 
      // mode: 'no-cors',
      headers: {
        'Content-Type': 'application/json',

      },
      body: JSON.stringify({
        id: userID
      })

    });
    

    if (!response.ok) {
      throw new Error('Ошибка при создании платежа');
    }



    const data = await response.json();
    console.log(data);
    
    return data
  } catch (error) {
    console.error('Ошибка:', error);
  }
}

export async function checkPayment(user_id: string, payment_id: string) {
  try {
    const response = await fetch(`${SERVER_SITE}/api/payment/check`, {
      method: 'POST', 
      // mode: 'no-cors',
      headers: {
        'Content-Type': 'application/json',

      },
      body: JSON.stringify({
        id: user_id,
        payment_id
      })

    });

    if (!response.ok) {
      throw new Error('Ошибка при проверке платежа');
    }


    const data = await response.json();
    
    return data
  } catch (error) {
    console.error('Ошибка:', error);
  }
}