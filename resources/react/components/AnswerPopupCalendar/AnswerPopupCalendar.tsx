import { useEffect } from 'react'
import './answer_popup_calendar.scss'

export default function AnswerPopupCalendar({date, time}: {date: string, time: string}) {

  useEffect(() => {
    localStorage.setItem('record', 'true')
    localStorage.setItem('date', date)
    localStorage.setItem('time', time)
  }, [])
  
  return (
    <div className='answer_popup--window'>
      <div className="answer_popup--container">
        <p className='answer_popup--text'>
          Спасибо за запись на консультацию, ваша дата: {date}, время: {time} <br /> <br />
          Мы отправим вам уведомление за один час, но вашу электронную почту
        </p>
        <a href="/">Ок</a>
      </div>
    </div>
  )
}
