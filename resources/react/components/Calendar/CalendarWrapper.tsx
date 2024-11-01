import { useEffect, useState } from 'react';
import Calendar from 'react-calendar';

import { MAX_CALENDAR_DATE } from '../../config/config';
import { observer } from 'mobx-react-lite';
import DateStore from '../../store/date_store';
import AnswerPopupCalendar from '../AnswerPopupCalendar/AnswerPopupCalendar';
import { useNavigate } from 'react-router-dom';

import generateTimeOptions from '../../hook/generateTimeOptions';
import { addedWithUserAppointment } from '../../api/userApi';

import { getAnalyticsCalendar } from '../../api/analyticsApi';

import { TelegramSendMessage } from '../../api/telegramApi';

type ValuePiece = Date | null;

type Value = ValuePiece | [ValuePiece, ValuePiece];
import 'react-calendar/dist/Calendar.css';
import './calendar.scss';


const CalendarWrapper = observer(() => {
  const id = localStorage.getItem('id')!;
  const navigation = useNavigate()

  // const { addedWithUserAppointmentActions, errorUserData } = UserStore
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
    const moundhPonel = document.querySelector(".react-calendar__navigation__label");
    moundhPonel?.setAttribute('disabled', 'true');

    getDatesActions()

    checkDataCalendar(id)

  }, [])






  async function checkDataCalendar(id: string) {
    const data = await getAnalyticsCalendar({ id })
    if (data.status === 400) {
      navigation('/questionnaire')
    }
  }


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

  async function handleClickSubmit(date: Date) {

    setIsLoading({ ...isLoading, success: true })
    await handleClickAppointment(date)
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
      console.log(value)
      await addedWithUserAppointment({ date: value, time: selectedTime, id: id ?? '' })

      await TelegramSendMessage({ date: value, time: selectedTime, user_id: id })



    } catch (error) {
      setIsLoading({ ...isLoading, error: true })
    }
  }



  const handleChangeTime = (event: React.ChangeEvent<HTMLSelectElement>) => {
    setSelectedTime(event.target.value);
  };


  return (
    <div className='calendar--wrapper'>

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
            <label htmlFor="time">Выберите время (Здесь и далее время GMT +3):</label>
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


