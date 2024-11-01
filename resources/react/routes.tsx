import { createBrowserRouter } from "react-router-dom"
import App from "./App"
import PrivacyPolicy from "./components/PrivatPolicy/PrivacyPolicy"
import Questionnaire from "./components/Questionnaire/Questionnaire"
import Article from "./components/Article/Article"
import CalendarWrapper from "./components/Calendar/CalendarWrapper"
import RecordCheck from "./components/RecordCheck/RecordCheck"






const router = createBrowserRouter([
  {
    path: '/',
    element: <App />,
  },
  {

  },
  {
    path: '/privacy-policy',
    element: <PrivacyPolicy />,
  },
  {
    path: '*',
    element: <div className='not-found'>404</div>,
  },
  {
    path: '/questionnaire',
    element: <Questionnaire/>,
  },
  {
    path: '/article',
    element: <Article/>,
  },
  {
    path: '/calendar',
    element: <CalendarWrapper />,
  },
  {
    path: '/record-check',
    element: <RecordCheck />,
  }

])

export default router