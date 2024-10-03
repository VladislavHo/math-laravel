import { useForm, SubmitHandler } from "react-hook-form"

import "./questionnaire.scss"
import { useParams } from "react-router-dom";

import { FormValues } from "../../types/types";
import { useEffect, useState } from "react";
import AnswerPopupQuestionnaire from "../AnswerPopupQuestionnaire/AnswerPopupQuestionnaire";
import { observer } from "mobx-react-lite";
import UserStore from "../../store/user_store";
import ErrorPopup from "../ErrorPopup/ErrorPopup";
import Select from "react-select";
import { OPTION_COUNTRY_CODES } from "../../config/config";
import { customStyles } from "./styles";

// import { useNavigate } from 'react-router-dom';



const Questionnaire = observer(() => {

  const { createUserActions, userData, errorUserData } = UserStore
  const [isActive, setIsActive] = useState(false);
  const [isPayment, setIsPayment] = useState(false); //false
  const [isLoading, setIsLoading] = useState({
    success: false,
    error: false
  });
  const [selectedOption, setSelectedOption] = useState<string | null>(null);

  const [inputValueTask, setInputValueTask] = useState('Иное')


  function setCountryNumber(newValue: unknown) {
    const option = newValue as { value: string; label: string };
    setSelectedOption(option.label)
  }

  useEffect(() => {
    setIsPayment(Math.random() < 0.5)
  }, [])

  const { user_id } = useParams();

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<FormValues>(
    {
      defaultValues: {

        tasks: 'Подготовить к поступлению в западное учебное заведение',
        age: 'Старше 18 лет',
        investment: 'До $449',
        

      }
    }
  );
  const onSubmit: SubmitHandler<FormValues> = async (data) => {
    const fullPhoneNumber = `${selectedOption} ${data.phone}`;

    const user = { ...data, telegram_id: user_id, phone: fullPhoneNumber }

    console.log(user);
    
    setIsLoading({ ...isLoading, success: true })
    await createUserActions(user)
      .then(() => setIsLoading({ ...isLoading, success: false }))
      .catch(() => setIsLoading({ ...isLoading, error: true }))
    setIsActive(true)

    console.log(isLoading.error, "this is error")
  };

  return (
    <>
      {
        errorUserData && (
          <ErrorPopup />
        )
      }
      {
        isActive && !isLoading.success && !errorUserData && (
          <AnswerPopupQuestionnaire isPayment={isPayment} userID={userData.id ?? ''} telegram_id={userData.telegram_id ?? ''} />
        )
      }
      <section className="questionnaire">
        <h2>Анкета для записи на консультацию и тестирование от команды «Foreign Math-Успех в учебе на западе» Жанны Бородаевой.</h2>
        <p className="description-red">Анкета предназначена для родителей школьников</p>


        <p className="description">
          Это займет всего 5 минут вашего времени. Ответы помогут понять, как наша команда сможет вам помочь в достижении ваших учебных целей по математике и программированию на западе и подготовить материал для теста. Пожалуйста, проявите искренность и открытость.
        </p>

        <p className="description-field--info">Поля обязательны к заполнению *</p>
        <form onSubmit={handleSubmit(onSubmit)}>

          <div className="name-field field">
            <label className="label-title">
              Ваше имя*
            </label>
            <input
              type="text"
              {...register('name', { required: 'Это поле обязательно', minLength: 2, maxLength: 15, pattern: /^[a-zA-Zа-яА-Я]+$/i })}
              placeholder="Поле ввода"
            />
            {errors.name && <span className="error-message">{errors.name.message}</span>}

          </div>
          <div className="lastName-field field">
            <label className="label-title">
              Ваша фамилия*
            </label>
            <input
              type="text"
              {...register('lastName', { required: 'Это поле обязательно', minLength: 2, maxLength: 15, pattern: /^[a-zA-Zа-яА-Я]+$/i })}
              placeholder="Поле ввода"
            />
            {errors.lastName && <span className="error-message">{errors.lastName.message}</span>}

          </div>

          <div className="country-field field">
            <label className="label-title">В какой западной стране ваш ребенок учится или будет учиться?*</label>
            <input
              type="text"
              {...register('country', { required: 'Это поле обязательно', minLength: 3, maxLength: 30, pattern: /^[a-zA-Zа-яА-Я]+$/i })}
              placeholder="Поле ввода"
            />
            {errors.country && <span className="error-message">{errors.country.message}</span>}
          </div>

          <div className="phone-field field">
            <label className="label-title">Номер телефона с префиксом страны (на котором есть WhatsApp)*</label>
            <div className="field--number">
              <Select onChange={setCountryNumber} defaultValue={OPTION_COUNTRY_CODES[0]} styles={customStyles} options={OPTION_COUNTRY_CODES} />

              <input
                type="tel"
                {...register('phone', { required: 'Это поле обязательно', minLength: 10, maxLength: 15, pattern: /^[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s./0-9]*$/g })}
                placeholder="(999) 999-99-99"
              />
              {errors.phone && <span className="error-message">{errors.phone.message}</span>}
            </div>
          </div>

          <div className="email-field field">
            <label className="label-title">Электронная почта*</label>
            <input
              {...register('email', { required: 'Это поле обязательно', minLength: 8, maxLength: 30, pattern: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i })}
              type="email"
              placeholder="Поле ввода"
            />
            {errors.email && <span className="error-message">{errors.email.message}</span>}
          </div>



          {/* tasks */}
          <div className="tasks-field field">
            <label className="label-title">Какие задачи в области математики, физики и программирования стоят на данный момент?*</label>
            <label>
              <input
                type="radio"
                value={'Повысить оценки'}
                style={{ marginRight: "5px" }}
                {...register('tasks', { required: 'Это поле обязательно' })}
                placeholder="Поле ввода"
              />
              Повысить оценки
            </label>
            <label>
              <input
                type="radio"
                value={'Сдать вступительный экзамен'}
                style={{ marginRight: "5px" }}
                {...register('tasks', { required: 'Это поле обязательно' })}
                placeholder="Поле ввода"
              />
              Сдать вступительный экзамен
            </label>
            <label>
              <input
                type="radio"
                value={'Победить в олимпиаде'}
                style={{ marginRight: "5px" }}
                {...register('tasks', { required: 'Это поле обязательно' })}
                placeholder="Поле ввода"
              />
              Победить в олимпиаде
            </label>
            <label>
              <input
                type="radio"
                value={'Подготовить к поступлению в западное учебное заведение'}
                style={{ marginRight: "5px" }}
                {...register('tasks', { required: 'Это поле обязательно' })}
                placeholder="Поле ввода"
              />
              Подготовить к поступлению в западное учебное заведение
            </label>
            <label>
              <input
                type="radio"
                value={inputValueTask}
                style={{ marginRight: "5px" }}
                {...register('tasks', { required: 'Это поле обязательно' })}
              />
              Иное
              <input
                type="text"
                placeholder="Уточните, что именно"
                style={{ marginLeft: "5px", padding: "9px 15px", width:"200px" }}
                onChange={(e) => {
                  setInputValueTask(e.target.value);
                }}
              />
            </label>

            {errors.tasks && <span className="error-message">{errors.tasks.message}</span>}
          </div>





          <div className="deadline-field field">
            <label className="label-title">В какой срок необходимо решить задачи предыдущего пункта?*</label>
            <input
              type="text"
              {...register('deadline', { required: 'Это поле обязательно', minLength: 3, maxLength: 50 })}
              placeholder="Поле ввода"
            />
            {errors.deadline && <span className="error-message">{errors.deadline.message}</span>}
          </div>

          {/* <div className="plans-field field">
            <label className="label-title">Дальнейшие академические и карьерные планы для вашего ребенка</label>
            <input
              type="text"
              {...register('plans', { minLength: 3, maxLength: 50 })}
              placeholder="Поле ввода"
            />
            {errors.plans && <span className="error-message">{errors.plans.message}</span>}
          </div> */}


          <div className="age-field field">
            <label className="label-title">Возраст вашего ребенка/ваш*</label>

            <label>
              <input
                type="radio"
                value="до 10 лет"
                style={{ marginRight: "5px" }}
                {...register('age', { required: 'Это поле обязательно' })}
              />
              До 10 лет
            </label>
            <label>
              <input
                type="radio"
                value="11-14 лет"
                style={{ marginRight: "5px" }}
                {...register('age', { required: 'Это поле обязательно' })}
              />
              11-14 лет
            </label>
            <label>
              <input
                type="radio"
                value="15-18 лет"
                style={{ marginRight: "5px" }}
                {...register('age', { required: 'Это поле обязательно' })}
              />
              15-18 лет
            </label>
            <label>
              <input
                type="radio"
                value="Старше 18 лет"
                style={{ marginRight: "5px" }}
                {...register('age', { required: 'Это поле обязательно' })}
              />
              Старше 18 лет
            </label>
            {errors.age && <span className="error-message">{errors.age.message}</span>}

          </div>


          <div className="investment-field field">
            <label className="label-title">Сколько вы готовы вкладывать в месяц в достижение академических целей по математике и программированию?*</label>
            <label htmlFor="">
              <input
                type="radio"
                value="не готов"
                style={{ marginRight: "5px" }}
                {...register('investment', { required: 'Это поле обязательно' })}
              />
              Не готов(а) сейчас вкладываться
            </label>
            <label>
              <input
                type="radio"
                value="До $449"
                style={{ marginRight: "5px" }}
                {...register('investment', { required: 'Это поле обязательно' })}
              />
              До $449
            </label>
            <label>
              <input
                type="radio"
                value="$450 - $699"
                style={{ marginRight: "5px" }}
                {...register('investment', { required: 'Это поле обязательно' })}
              />
              $450 - $699
            </label>
            <label>
              <input
                type="radio"
                value="Свыше $700"
                style={{ marginRight: "5px" }}
                {...register('investment', { required: 'Это поле обязательно' })}
              />
              Свыше $700
            </label>

            {errors.investment && <span className="error-message">{errors.investment.message}</span>}
          </div>

          <div className="btn-wrapper">

            <button type="submit">{isLoading.success ? 'Загрузка...' : 'Отправить анкету'}</button>
          </div>




        </form>
      </section>
    </>

  );

})


export default Questionnaire