import { useEffect, useState } from 'react';
import Calendar from 'react-calendar';

import 'react-calendar/dist/Calendar.css';
import './calendar.scss';
import { MAX_CALENDAR_DATE } from '../../config/config';
import { observer } from 'mobx-react-lite';
import UserStore from '../../store/user_store';
import DateStore from '../../store/date_store';
import AnswerPopupCalendar from '../AnswerPopupCalendar/AnswerPopupCalendar';
// import { useNavigate } from 'react-router-dom';
import { checkPayment, checkPaymentStripe } from '../../api/payApi';
import { useNavigate } from 'react-router-dom';
import { TelegramSendMessage } from '../../api/telegramApi';
import ErrorPopup from '../ErrorPopup/ErrorPopup';


type ValuePiece = Date | null;

type Value = ValuePiece | [ValuePiece, ValuePiece];

const CalendarWrapper = observer(() => {
  const navigation = useNavigate()
  const id = localStorage.getItem('id') ?? '';
  const payment_id = localStorage.getItem('payment_id') ?? '';
  const paymethod = localStorage.getItem('paymethod') ?? '';
  const { addedWithUserAppointmentActions } = UserStore
  const { getDatesActions, dateAppointement } = DateStore

  const [isOpenPopup, setIsOpenPopap] = useState(false);
  const [selectedTime, setSelectedTime] = useState('');
  const [isLoading, setIsLoading] = useState({
    success: false,
    error: false
  });
  const [date, onChangeDate] = useState<Value>(new Date());
  const [newValue, setNewValue] = useState<Value | null>(null);


  useEffect(() => {

    if (!paymethod) {
      navigation('/')
    }


    const moundhPonel = document.querySelector(".react-calendar__navigation__label");
    moundhPonel?.setAttribute('disabled', 'true');

    getDatesActions()



    if (!!String(id) && !!String(payment_id)) {
      checkPayment(id, payment_id)
    }

    if (!!String(id) && !!String(paymethod) && paymethod === 'stripe') {
      checkPaymentStripe({ userID: id })
    }

  }, [])



  function onClickDay() {
    setNewValue(date);
  }

  const tileDisabled = ({ date }: { date: Date }) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    if (date <= today) {
      return true;
    }

    // Отключить заданные даты
    return dateAppointement.map(date => new Date(date)).some(disabledDate =>
      date.getDate() === disabledDate.getDate() &&
      date.getMonth() === disabledDate.getMonth() &&
      date.getFullYear() === disabledDate.getFullYear()
    );
  };

  function handleClickSubmit(date: Date) {


    localStorage.removeItem('paymethod')

    setIsLoading({ ...isLoading, success: true })
    handleClickAppointment(date)
      .then(() => {
        setIsLoading({ ...isLoading, success: false })
      })
      .catch(() => {
        setIsLoading({ ...isLoading, error: true })
      })

    setIsOpenPopap(true)

  }



  async function handleClickAppointment(value: Date) {
    try {

      await addedWithUserAppointmentActions({ date: value, time: selectedTime, id })
      await TelegramSendMessage({ date: value, time: selectedTime, user_id: id})

    } catch (error) {
      console.log(error)
    }
  }

  const generateTimeOptions = () => {
    const options = [];
    for (let hour = 9; hour <= 16; hour++) {
      for (const minute of [0, 30]) {
        const time = `${hour}:${minute < 10 ? '0' : ''}${minute}`;
        options.push(time);
      }
    }
    return options;
  };

  const handleChangeTime = (event: React.ChangeEvent<HTMLSelectElement>) => {
    setSelectedTime(event.target.value);
  };


  return (
    <div className='calendar--wrapper'>

      {
        isLoading.error && (
          <ErrorPopup message='Произошла ошибка. Обнавитье страницу или напишите на почту: zhborodaeva@gmail.com'/>
        )
      }

      {isOpenPopup && !isLoading.success && (
        <AnswerPopupCalendar date={new Date(date as Date).toLocaleDateString()} time={selectedTime} />
      )}
      <div className="title">

        <h2>Спасибо большое! Выберите, пожалуйста, удобную дату</h2>

      </div>

      <Calendar

        onClickDay={onClickDay}
        onChange={onChangeDate}
        value={date}
        tileDisabled={(tileDisabled)}
        defaultView="month"

        showNeighboringCentury={false}
        showNeighboringDecade={false}
        maxDate={MAX_CALENDAR_DATE}
        minDate={new Date()}
        navigationAriaLabel="Выберите дату"



      />

      {
        newValue && (
          <div className='time'>
            <label htmlFor="time">Выберите время:</label>
            <select id="time" value={selectedTime} onChange={handleChangeTime}>
              <option value="">-- Выберите время --</option>
              {generateTimeOptions().map((time) => (
                <option key={time} value={time}>
                  {time}
                </option>
              ))}
            </select>
          </div>
        )
      }

      {selectedTime ? <p>Вы выбрали: <span>{new Date(date as Date).toLocaleDateString()} {selectedTime}</span>, эта дата свободна</p> : <p>Выберите дату и время</p>}

      <button className='btn' disabled={!selectedTime} onClick={() => handleClickSubmit(date as Date)}>{isLoading.success ? 'Загрузка...' : 'Записаться'}</button>
    </div>
  );
})


export default CalendarWrapper