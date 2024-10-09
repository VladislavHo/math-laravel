import { SERVER_SITE } from "../config/config";

export async function TelegramSendMessage({ date, time, user_id }: { date: Date, time: string, user_id: string }) {
  try {
    const response = await fetch(`${SERVER_SITE}/api/sendmessage`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        date,
        user_id,
        time
      }),
    });


    if(!response.ok) {
      throw new Error('Error response')
    }
    const data = await response.json();

    return {
      success: true,
      data
    }
  } catch (error) {
    return {
      success: false,
      error: error
    }
  }
}


export async function checkTelegram(id: string) {
  console.log(id)
  try {
    const response = await fetch(`${SERVER_SITE}/api/checktelegram`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        id
      }),
    });


    // if(!response.ok) {
    //   throw new Error('Error response')
    // }
    const data = await response.json();

    return data
  } catch (error) {
    console.log(error)
  }
}