
import { useParams } from 'react-router-dom';
import './article.scss'
export default function Article() {
  const { user_id } = useParams();
  console.log(user_id)
  return (
    <section className='article'>

      <h2 className='title'>
        Как учить математике и программированию на иностранном языке,
        чтобы ребенок поразил достижениями. Без пушинга!

      </h2>
      <h3 className='subtitle'>
        От неакадемического ребенка в группу задач со звездочкой
      </h3>

      <article className='article--intro'>
        {/* img */}
        <div className="img-wrapper">
          <img src="../image/intro_article.png" alt="png" />
        </div>

        <p>9 из 10 родителей детей и подростков, учащихся или желающих учиться в иностранных школах и университетах, понятия не имеют, как выбирать частного тьютора. </p>
        <p>Зачастую родители не хотят заставлять ребенка учиться или «пушить» (англ. push – толкать, подталкивать), но понимают, что от хорошей учебы зависит будущее. Они думают, что правильно выбрать ту частоту занятий, рекомендации по которой они нашли в интернете или услышали от знакомых. В их голове происходит примерно следующее: "Нужно нанять тьютора. Тьютор должен ребенка заинтересовать. Будем заниматься 1-2 раза в неделю, как рекомендовано в среднем"</p>
        <p>В 90% случаев подход «средняя температура по больнице» не работает: ребенок занимается либо «из под палки», либо не достигает успеха. Тьютора меняют, основываясь на том же подходе, и с тем же предсказуемо неудовлетворительным результатом. Общий итог: деньги потрачены неэффективно. Что еще хуже, ребенок демотивирован. </p>

        <p> Мы считаем, что выбирать тьютора и график занятий, пока нет понимания, что знает <strong>именно ваш ребенок или вы лично</strong> , какие цели и в какие сроки именно <strong>вы</strong> перед собой ставите, как можно использовать <strong>открытия образовательной психологии именно для вас</strong>, какие <strong>современные IT решения помогут именно вам</strong>  - не самый эффективный подход. </p>

        <p>Здесь вы узнаете, как достигать академических целей в области математики и программирования в западных учебных заведениях. <strong>Без пушинга, без бесконечной череды тьюторов, в сочетании традиционных, научных и современных подходов. В конце концов -  с хорошим результатом и для вашего ребенка, и для вас.</strong></p>


        <p>Мы сами применили тот метод, что описан в статье, в своей семье. Результат – наш сын является успешным студентом Karlsruhe Institute of Technology, Германия по специальности «Информатика». </p>

      </article>

      <article className='article--about'>
        <div className="title--about">
          <h3><strong>Давайте узнаем друг друга получше</strong></h3>
          <p>Многосторонний и семейный подход. Немецкое качество</p>
        </div>


        <div className="about_info">
          <div className="img-wrapper">
            <img src="../image/person.png" alt="" />
          </div>
          <ul>
            <p>Меня зовут Жанна Бородаева. Я со своей командой помогаю родителям школьников и студентов в западных учебных заведениях достигать их академических и карьерных целей:
            </p>
            <li>12 лет работы со студентами и школьниками из западных стран: математика, программирование на английском, немецком, французском языке</li>
            <li>100% учеников достигли своих академических целей на западе</li>
            <li>MSc по Математике и Программированию. Диплом с отличием</li>
            <li>Сертификат по Data Science (Python, SQL, AI, ML) от WBS Coding School, Берлин, Германия </li>
            <li>Научный опыт и опыт лектора по образовательной и когнитивной психологии в <span>Университете Кемнитц, Германия</span> </li>
            <li>С 2023 года  помогаю студентам по статистике, обработке данных, программированию на R, Python в сотрудничестве со швейцарской компанией Statistik Nachhilfe </li>
          </ul>
        </div>

        <div className="about_country">
          <p>Со своей семьей, которая также входит в команду, я живу в Германии. Мы проникнуты тем лучшим, что содержит понятие «немецкое качество», в нашей помощи по достижению ваших целей. </p>
          {/* img */}
          <div className="img-wrapper">
            <img src="../image/ge_fin.png" alt="" />
          </div>
        </div>
      </article>
      <article className='article--about_students'>
        <h3><strong>Лучший кейс: 12 лет работы, блестящий результат</strong></h3>
        <p><strong>От ученика в казахской школе до лучшего студента в University of Bristol</strong></p>

        <div className="about_students">
          <div className="img-wrapper">
            <img src="../image/education.png" alt="" />
          </div>

          <div className="about_students--info">
            <p>Родители Алексея выбрали работу с нами, когда ребенку было всего 12 лет. Задача была непростая, но из тех, что мы любим: поступить из школы в Казахстане в престижные заведения Лондона. Ученик занимался с нами англоязычной математикой в течение 8 лет, пройдя путь от середнячка к звезде.
            </p>
            <br />
            <p>   На основе нашего метода, Леша успешно прошел все ступени в английской академической системе, от International Baccalaureate, Oxford, через University of Bristol, до Imperial College Business School.  Его достижения отмечены многочисленными наградами данных учебных заведений: Bristol Outstanding Award, Bristol Plus Award, Imperial Excellence Scholarship.</p>
          </div>


        </div>
      </article>
      <article className='article--methods'>
        <div className="title">
          <h3><strong>В чем суть метода?</strong></h3>

        </div>

        <div className="about_methods">
          <div className="img-wrapper">
            <img src="../image/childern.png" alt="" />
          </div>
          <ul>
            <p><strong>Как стать звездой по математике и программированию на западе</strong></p>
            <p>Ключевыми чертами нашего метода являются:</p>
            <li>Использование как задач страны обучения, так и задач СНГ</li>
            <li>Научно обоснованные подходы к развитию способностей</li>
            <li>Современные IT решения для мотивации ребенка</li>
            <li>Индивидуальный подход и долгосрочные отношения </li>
          </ul>
        </div>


      </article>
      <article className='article--math-achievements'>

        <div className="math-achievements">

          <div className="math-achievements--info">
            <h3><strong>Микс из задач страны обучения и стран СНГ: зачем?</strong></h3>
            <p>Чтобы быть лучшим по математике</p>
            <p>Россия остается на данный момент на 3-ем месте в медальном зачете в олимпиадах по математике. Признанием этого лидерства является тот факт, что 3 имеющиеся в Великобритании физико-математические школы используют метод лицея им. Колмогорова при МГУ, о чем открыто сообщается на их сайтах. </p>
            <p>По нашим многолетним наблюдениям, ученики со средними достижениями, которые ранее учились в СНГ и занимались с нами решением задач стран СНГ, легко входят в группу талантливых учеников по математике в школе страны эмиграции.</p>
            <p>Мы используем сочетание программ Великобритании, США, Германии и пр. с программой стран СНГ, <strong>чтобы ваш ребенок был лучшим по математике и программированию!</strong> </p>
          </div>

          <div className="img-wrapper">
            <img src="../image/childern_genius.png" alt="" />
          </div>
        </div>

      </article>
      <article className='article--education-insights'>
        <div className="title">
          <h3><strong>Научно обоснованные подходы: в чем?</strong></h3>
          <p>Рекомендации: длительность и факторы</p>
        </div>

        <div className="about_education-insights">
          <div className="img-wrapper">
            <img src="../image/bg.png" alt="" />
          </div>
          <div className="about_education-insights--info">
            <p>
              Благодаря немецкому научному опыту по образовательной и когнитивной психологии, я знаю, какие факторы способствуют познанию математики и программирования. Среди них есть и такие очевидные вещи, как минимальное количество часов для усвоения материала.
            </p>
            <p>
              Есть и более продвинутые факторы, например уровень развития пространственных способностей. Зная это, иногда мы рекомендуем родителям компьютерные программы с научно доказанным результатом трансформации пространственных скиллов в математическую успешность.
            </p>
            <p>
              Наши рекомендации зависят от вашей индивидуальной ситуации, которую мы изучаем во время первой встречи. <a href={`/${user_id}/questionnaire`}> Ждем!</a>
            </p>
          </div>
        </div>
      </article>
      <article className='article-ai'>
        <div className="article-ai--info">
          <div className="title">
            <h3> <strong>Цифровые AI решения: для самомотивации</strong></h3>
            <p>Используем увлечение гаджетами для мотивации ребенка и отдыха родителей</p>
          </div>
          <p><strong>Родитель:</strong> Ребенок постоянно торчит за компьютером, что делать?  Он не хочет вообще учиться!</p>
          <p><strong>Мы:</strong> Используем этот факт с пользой. Вы можете заниматься с использованием нашего цифрового приложения.</p>
          <p><strong>Родитель:</strong> Он же окончательно пропадет в компьютере тогда – и вообще никакой учебы!</p>
          <p><strong>Мы:</strong> Ребята повышают свою мотивацию на решение математики настолько, что переходят от grade F к grade A*. Пушить не нужно, т.к. ребенку интересно: вы отдыхаете, а ребенок учится 😊</p>
          <ul>
            <p>Наше приложение:</p>
            <li><p>Предлагает только те задачи, которые нужны <strong>именно вашему ребенку </strong> </p></li>
            <li><p>Проверяет <strong>не только ответы, но и решения</strong> </p></li>
            <li><p>Используется <strong>в комбинации с личными занятиями с тьютором</strong> </p></li>
            <li><p>Ребенок <strong>играет в математику</strong> , накапливая баллы и рейтинг</p></li>
          </ul>
          <p>Это ваш случай?  Мы определим оптимальную стратегию на индивидуальной консультации, на которую можно <a href={`/${user_id}/questionnaire`}>записаться уже сейчас</a> . </p>
        </div>
        <div className="img--wrapper">
          <img src="../image/Avior.png" alt="" />
        </div>
      </article>

      <article className='article--individual-approach'>
        <div className="title">
          <h3><strong>Индивидуальный подход и долгосрочные отношения</strong></h3>
          <p>От школы до поступления в Гарвард</p>
        </div>
        <div className="individual-approach">
          <div className="img--wrapper">
            <img src="../image/students.png" alt="" />
          </div>
          <div className="individual-approach--info">
            <p>Наш подход построен на доверительных, индивидуальных и зачастую долгосрочных отношениях с каждой семьей. Многие из наших учеников, приходят к нам в возрасте 11-12 лет, остаются с нами до 22-23 лет. </p>
            <p>Это объясняется тем, что мы обладаем экспертизой не только в школьной математике, но и глубокими знаниями и опытом ведения университетских курсов по математике, включая западные университеты. </p>
            <p>Немалый процент успеха в построении нами долгосрочных отношений приходится на нашу ориентацию на результат: повышение оценок, сдача экзамена, поступление в школу и университет. </p>
            <p>Со старшеклассниками мы практикуем вкрапления именно того материала, который может им пригодиться в выбранной профессии, зачастую заходя на 1-2 курс вуза в объяснении материала.</p>
            <p>
              <strong>Проверено: 100% наших студентов оказываются самыми продвинутыми по математическим предметам уже и в высших учебных заведениях.  </strong>
            </p>
            <p>Хотите так же? <a href={`/${user_id}/questionnaire`}>Ждем вас на индивидуальной консультации</a>. </p>
          </div>
        </div>

      </article>
      <article className="article-case">
        <h3><strong>До и после: Grade F vs. Grade A</strong></h3>
        <p>Еще несколько актуальных кейсов</p>
        <p>Внизу приведена часть отзывов по работе с нами. В целях конфиденциальности имена учеников изменены.</p>
        <table>
          <thead>
            <tr>
              <th>Ученик</th>
              <th>До</th>
              <th>После</th>
              <th>Страна</th>
              <th>Отзыв</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Виктория</td>
              <td>Правильно: 20%</td>
              <td>Правильно: 60%</td>
              <td>UK</td>
              <td>Мама: «Без пушинга делает домашки. Для нас это результат»</td>
            </tr>
            <tr>
              <td>Сергей</td>
              <td>Оценка: F</td>
              <td>Оценка: А</td>
              <td>USA</td>
              <td>Папа: «Повысил оценки. Есть результат»</td>
            </tr>
            <tr>
              <td>София</td>
              <td>Оценка: F</td>
              <td>Оценка: А</td>
              <td>Sweden</td>
              <td>Студентка: «Очень благодарна: достигла того, что хотела»</td>
            </tr>
          </tbody>
        </table>
      </article>
      <article className='article-consultation'>
        <div className="title">
          <h3><strong>Индивидуальная консультация</strong></h3>
          <p>Как попасть в мир вашей академической мечты</p>
        </div>
        <div className="img--bg">

        </div>
        <p className='suptitle--text'>Если вам понравился наш подход, то мы приглашаем вас на первую бесплатную встречу. Мы обсудим ваши академические цели и актуальное положение дел. </p>

        <ul className='list'>
          <p>
            Рекомендации по обучению вашего ребенка или вас лично: традиционные, научные и современные решения
          </p>
          <li>
            <p>Рекомендации по обучению вашего ребенка или вас лично: традиционные, научные и современные решения</p>
          </li>
          <li>
            <p>Статью, описывающую все факторы, влияющие на успех в области математики и программирования</p>
          </li>
          <li>
            <p>Приглашение на тестирование с целью определения уровня знаний </p>
          </li>
          <li>
            <p>После тестирования  вы получите:</p>
            <ul className='sublist'>
              <li><p>Индивидуальный план работ по темам для достижения цели</p></li>
              <li><p>Рекомендации по индивидуально подобранной для вас частоте занятий</p></li>
              <li><p>Рекомендации по оптимальной для вас программе и пакету</p></li>
            </ul>
          </li>
        </ul>
        <p>Длительность встречи – около 1 часа. Встреча проходит онлайн. </p>
        <p><strong>Мы ждем вас, чтобы помочь вам в достижении академических целей вашей мечты. </strong></p>
      </article>
      <div className="list-wrapper">
        <a href={`/${user_id}/questionnaire`}>Записаться на тестирование и консультацию</a>
      </div>
    </section>
  )
}


