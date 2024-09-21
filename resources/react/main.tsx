import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App.tsx'
import './index.css'
import { createBrowserRouter, RouterProvider } from 'react-router-dom'
import PrivacyPolicy from './components/PrivatPolicy/PrivacyPolicy.tsx'
import Questionnaire from './components/Questionnaire/Questionnaire.tsx'
import Article from './components/Article/Article.tsx'

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
    path: '/:user_id/questionnaire',
    element: <Questionnaire />,
  },
  {
    path: '/:user_id/article',
    element: <Article/>,
  }

])


ReactDOM.createRoot(document.getElementById('root')!).render(
  <React.StrictMode>
    <RouterProvider router={router} />
  </React.StrictMode>,
)
