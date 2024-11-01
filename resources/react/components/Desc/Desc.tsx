import { useNavigate } from "react-router-dom";
import "./desc.scss"
// import { TelegramSvg } from '../Svg/Svg'
import { useState } from "react";
export default function Desc() {
  const [isChecked, setIsChecked] = useState(false);
  const navigate = useNavigate();
  const handleCheckboxChange = () => {
    setIsChecked(!isChecked);
  };
  return (
    <section className='desc'>
      <h2>Методика достижения целей по математике и физике в западных школах: дорога к поступлению в Оксфорд </h2>
      <p>
      Я со своей командой помогаю школьникам из западных стран и их родителям достигать учебных целей по математике и  физике.

      </p>
      <p>
        Лучший кейс включает работу со школьником и далее студентом в течение 12 лет, от  поступления в St.Clare's, Oxford до University of Bristol и Imperial College Business School, London.</p>
      <p>
        Недавно мы создали пошаговый план, как достичь академических и карьерных успехов на  западе, повысив при этом собственную мотивацию ребенка. По этой методике я сама учила  своего сына, студента 1-ого курса факультета "Информатика" в Karlsruhe Institute of Technology,  Германия.</p>
      <p>
        Сотни моих учеников уже достигли своих академических и карьерных целей, уже зарабатывая  не менее 70 000 USD в год.
      </p>

      <p>
        Чтобы узнать подробнее о методе и получить индивидуальный план для достижения цели, переходите в Телеграм.
      </p>
      <div className="agreement">
        <label>
          <input
            checked={isChecked} onChange={handleCheckboxChange} type="checkbox" required />
          Я соглашаюсь с условиями <a href="/privacy-policy" target="_blank">Политика конфиденциальности</a>
        </label>
      </div>


      <div className="link">

        <button disabled={!isChecked} onClick={() => navigate('/questionnaire')}>

          <div className="title">
            <p>Записаться на консультацию</p>
          </div>
        </button>

      </div>
    </section>
  )
}
