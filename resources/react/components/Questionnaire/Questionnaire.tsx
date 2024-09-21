import { useForm, SubmitHandler } from "react-hook-form"

import "./questionnaire.scss"
interface FormValues {
  fullName: string;
  country: string;
  phone: string;
  email: string;
  tasks: string;
  deadline: string;
  plans: string;
  age: string;
  income: string;
  investment: string;
}
export default function Questionnaire() {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<FormValues>();
  const onSubmit: SubmitHandler<FormValues> = (data) => {
    console.log(data);
  };
  return (
    <section className="questionnaire">
      <h2>Анкета для записи на консультацию и тестирование от команды «Foreign Math-Успех в учебе на западе» Жанны Бородаевой.</h2>
      <p className="description-red">Анкета предназначена для родителей школьников</p>


      <p className="description">
        Это займет всего 5 минут вашего времени. Ответы помогут понять, как наша команда сможет вам помочь в достижении ваших учебных целей по математике и программированию на западе и подготовить материал для теста. Пожалуйста, проявите искренность и открытость.
      </p>

      <p className="description-field--info">Поля обязательны к заполнению</p>
      <form onSubmit={handleSubmit(onSubmit)}>

        <div className="fullname-field field">
          <label className="label-title">
            Ваше имя и фамилия*
          </label>
          <input
            type="text"
            {...register('fullName', { required: 'Это поле обязательно', minLength: 3, maxLength: 30, pattern: /^[a-zA-Zа-яА-Я]+$/i })}
            placeholder="Поле ввода"  
          />
          {errors.fullName && <span className="error-message">{errors.fullName.message}</span>}

        </div>

        <div className="country-field field">
          <label className="label-title">В какой западной стране ваш ребенок учится или будет учиться?*</label>
          <input
            type="text"
            {...register('country', { required: 'Это поле обязательно' })}
            placeholder="Поле ввода"
          />
          {errors.country && <span className="error-message">{errors.country.message}</span>}
        </div>

        <div className="phone-field field">
          <label className="label-title">Номер телефона с префиксом страны (на котором есть WhatsApp)*</label>
          <input
            type="text"
            {...register('phone', { required: 'Это поле обязательно' })}
            placeholder="+7"
          />
          {errors.phone && <span className="error-message">{errors.phone.message}</span>}
        </div>

        <div className="email-field field">
          <label className="label-title">Электронная почта*</label>
          <input
            {...register('email', { required: 'Это поле обязательно' })}
            type="email"
            placeholder="Поле ввода"
          />
          {errors.email && <span className="error-message">{errors.email.message}</span>}
        </div>

        <div className="tasks-field field">
          <label className="label-title">Какие задачи в области математики и программирования стоят на данный момент?*</label>
          <input
            type="text"
            {...register('tasks', { required: 'Это поле обязательно' })}
            placeholder="Поле ввода"
          />
          {errors.tasks && <span className="error-message">{errors.tasks.message}</span>}
        </div>

        <div className="deadline-field field">
          <label className="label-title">В какой срок необходимо решить задачи предыдущего пункта?*</label>
          <input
            type="text"
            {...register('deadline', { required: 'Это поле обязательно' })}
            placeholder="Поле ввода"
          />
          {errors.deadline && <span className="error-message">{errors.deadline.message}</span>}
        </div>

        <div className="plans-field field">
          <label className="label-title">Дальнейшие академические и карьерные планы для вашего ребенка</label>
          <input
            type="text"
            {...register('plans', { required: 'Это поле обязательно' })}
            placeholder="Поле ввода"
          />
          {errors.plans && <span className="error-message">{errors.plans.message}</span>}
        </div>
        <div className="age-field field">
          <label className="label-title">Возраст вашего ребенка/ваш*</label>

          <label>
            <input
              type="radio"
              value="до 10 лет"
              {...register('age', { required: 'Это поле обязательно' })}
            />
            До 10 лет
          </label>
          <label>
            <input
              type="radio"
              value="11-14 лет"
              {...register('age', { required: 'Это поле обязательно' })}
            />
            11-14 лет
          </label>
          <label>
            <input
              type="radio"
              value="15-18 лет"
              {...register('age', { required: 'Это поле обязательно' })}
            />
            15-18 лет
          </label>
          <label>
            <input
              type="radio"
              value="старше 18 лет"
              {...register('age', { required: 'Это поле обязательно' })}
            />
            Старше 18 лет
          </label>
          {errors.age && <span className="error-message">{errors.age.message}</span>}

        </div>

        <div className="income-field field">
          <label className="label-title">Ваш доход в месяц, USD*</label>
          <label>
            <input
              type="radio"
              value="500 и меньше"
              {...register('income', { required: 'Это поле обязательно' })}
            />
            $500 и меньше
          </label>
          <label>
            <input
              type="radio"
              value="1501-3000"
              {...register('income', { required: 'Это поле обязательно' })}
            />
            $1501-$3000
          </label>
          <label>
            <input
              type="radio"
              value="3001-5000"
              {...register('income', { required: 'Это поле обязательно' })}
            />
            $3001-$5000
          </label>
          <label>
            <input
              type="radio"
              value="5001-10000"
              {...register('income', { required: 'Это поле обязательно' })}
            />
            $5001-$10000
          </label>
          <label >
            <input
              type="radio"
              value="свыше 10000"
              {...register('income', { required: 'Это поле обязательно' })}
            />
            Свыше $10000
          </label>

          {errors.income && <span className="error-message">{errors.income.message}</span>}
        </div>

        <div className="investment-field field">
          <label className="label-title">Сколько вы готовы вкладывать в месяц в достижение академических целей по математике и программированию?*</label>
          <label htmlFor="">
            <input
              type="radio"
              value="не готов"
              {...register('investment', { required: 'Это поле обязательно' })}
            />
            Не готов(а) сейчас вкладываться
          </label>
          <label>
            <input
              type="radio"
              value="до 449"
              {...register('investment', { required: 'Это поле обязательно' })}
            />
            До $449
          </label>
          <label>
            <input
              type="radio"
              value="450-699"
              {...register('investment', { required: 'Это поле обязательно' })}
            />
            $450 - $699
          </label>
          <label>
            <input
              type="radio"
              value="свыше 700"
              {...register('investment', { required: 'Это поле обязательно' })}
            />
            Свыше $700
          </label>

          {errors.investment && <span className="error-message">{errors.investment.message}</span>}
        </div>
        <div className="btn-wrapper">

          <button type="submit">Отправить анкету</button>
        </div>
      </form>
    </section>
  );

}
