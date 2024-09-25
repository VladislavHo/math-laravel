
import { redirect } from 'react-router-dom'
import './record_check.scss'
export default function RecordCheck() {
  const record = localStorage.getItem('record')

  // checked record
  if (!record) {
    redirect('/')
  }


  return (
    <div className='record_check'>
      <div className="record_check--wrapper">
        <p>Спасибо вы уже записанны</p>
        <p>Ваша дата: {localStorage.getItem('date')}</p>
        <p>Ваше время: {localStorage.getItem('time')}</p>

        <p>Мы отправим вам уведомление заранее</p>

        <a href="https://t.me/foreignmath">Перейти в телеграм канал</a>
      </div>

    </div>
  )
}
