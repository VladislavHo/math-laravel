import { useEffect } from 'react'
import './answer_popup_calendar.scss'

export default function AnswerPopupCalendar({ date, time }: { date: string, time: string }) {

  useEffect(() => {
    localStorage.setItem('record', 'true')
    localStorage.setItem('date', date)
    localStorage.setItem('time', time)
  }, [])

  return (
    <div className='answer_popup--window'>
      <div className="answer_popup--container">
        <p className='answer_popup--text'>
          {/* Спасибо за запись на консультацию, ваша дата: {date}, время: {time} <br /> <br />
          Мы отправим вам уведомление за один час, но вашу электронную почту */}

          Спасибо за запись на тестирование и консультацию! 🙂

          Выбранная дата: {date}.
          Выбранное время: {time}.

          Мы отправим Вам ссылку на онлайн встречу за 1 час на Вашу электронную почту
        </p>
        <a href="/">Ок</a>
      </div>
    </div>
  )
}
