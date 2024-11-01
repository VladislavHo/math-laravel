
import { useNavigate } from 'react-router-dom'

import './answer_popup_questionnaire.scss'

export default function AnswerPopupQuestionnaire() {
  const navigate = useNavigate()

  return (
    <div className='answer_popup--window'>
      <div className="answer_popup--container">
        <>
          <p className='answer_popup--text'>Спасибо большое! Мы
            предложим вам даты тестирования и
            консультации</p>

          <button onClick={() => {
            navigate('/calendar')
          }}>Записаться на тестирование и консультацию</button>
        </>

      </div>
    </div>
  )
}


