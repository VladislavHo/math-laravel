import { useEffect, useState } from 'react'
import './answer_popup_questionnaire.scss'
import { useNavigate } from 'react-router-dom'
import { pay } from '../../api/payApi'

export default function AnswerPopupQuestionnaire({ isPayment, userID, telegram_id }: { isPayment: boolean, userID: string | null, telegram_id: string | null }) {
  const [urlForPay, setUrlForPay] = useState('')

  const navigate = useNavigate()
  console.log(isPayment, userID, telegram_id)
  async function handleSendPay() {
    const { url, id, payment_id } = await pay(userID)
    localStorage.setItem('id', id)
    localStorage.setItem('payment_id', payment_id)
    localStorage.setItem('paymethod', "yookassa")
    if (url) {
      setUrlForPay(url);

    } else {
      console.error('Error: pay API call returned undefined');
    }
  }

  function handleSendPayStripe() {
    localStorage.setItem('paymethod', "stripe")
    navigate(`/pay-stripe?${userID}`)
  }


  useEffect(() => {
    localStorage.setItem('paymethod', "dontknow")
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
        <>
          <p className='answer_popup--text'>
          Разработка индивидуального плана обучения. <br />
          Для записи на занятия - оплатите 25 €.
          </p>
          {/* <a href="/pay">Оплатить</a> */}
          <button onClick={handleSendPay}>YooMooney</button>
          <button onClick={handleSendPayStripe}>Stripe</button>
          <br /><br /><br />

          <p style={{fontSize: '18px'}}>Не забудьте забрать полезную <a className='article_link' href={`/article/${telegram_id}`}>статью</a> для обучения вашего ребенка</p>
        </>

      </div>
    </div>
  )
}


// {isPayment ? (
//   <>
//     <p className='answer_popup--text'>Спасибо за запись. Для разработки
//       индивидуального плана занятий только для вашего ребенка
//       просим оплатить тестирование в размере 25 евро</p>
//     {/* <a href="/pay">Оплатить</a> */}
//     <button onClick={handleSendPay}>YooMooney</button>
//     <button onClick={handleSendPayStripe}>Stripe</button>
//   </>
// ) : (
//   <>
//     <p className='answer_popup--text'>Спасибо большое! Мы
//       предложим вам даты тестирования и
//       консультации</p>
//     {/* <a className="text" href="/calendar">Записаться на тестирование и консультацию</a> */
//     }
//     <button onClick={() => {
//       navigate('/calendar')
//       localStorage.setItem('record', 'true')
//     }}>Записаться на тестирование и консультацию</button>
//   </>
// )}