import { useEffect, useState } from 'react'
import './answer_popup_questionnaire.scss'
import { useNavigate } from 'react-router-dom'
import {pay} from '../../api/payApi'

export default function AnswerPopupQuestionnaire({ isPayment, userID }: { isPayment: boolean, userID: string | null }) {
  const [urlForPay, setUrlForPay] = useState('')

  const navigate = useNavigate()

  async function handleSendPay() {
    console.log(userID, 'userID');
    const {url, id, payment_id} = await pay(userID)
    
    localStorage.setItem('id', id)
    localStorage.setItem('payment_id', payment_id)

    if (url) {
      setUrlForPay(url);
    } else {
      console.error('Error: pay API call returned undefined');
    }
  }


  useEffect(() => {
    if (urlForPay) {
      // Optional: Validate the URL if needed
      try {
        window.open(urlForPay, '_self');
      } catch (error) {
        console.error('Invalid URL:', urlForPay);
      }
    }
  }, [urlForPay, navigate]);


  return (
    <div className='answer_popup--window'>
      <div className="answer_popup--container">
        {isPayment ? (
          <>
            <p className='answer_popup--text'>Спасибо за запись. Для разработки
              индивидуального плана занятий только для вашего ребенка
              просим оплатить тестирование в размере 25евро</p>
            {/* <a href="/pay">Оплатить</a> */}
            <button onClick={handleSendPay}>YooMooney</button>
            <button onClick={handleSendPay}>Stripe</button>
          </>
        ) : (
          <>
            <p className='answer_popup--text'>Спасибо большое! Мы
              предложим вам даты тестирования и
              консультации</p>
            <a href="/calendar">Записаться на тестирование и консультацию</a>
          </>
        )}
                  <>
            <p className='answer_popup--text'>Спасибо за запись. Для разработки
              индивидуального плана занятий только для вашего ребенка
              просим оплатить тестирование в размере 25евро</p>
            {/* <a href="/pay">Оплатить</a> */}
            <button onClick={handleSendPay}>YooMooney</button>
            <button onClick={handleSendPay}>Stripe</button>
          </>
      </div>
    </div>
  )
}
