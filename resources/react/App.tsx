import { useEffect } from 'react'

import Desc from './components/Desc/Desc'
import Intro from './components/Intro/Intro'
import { createUser } from './hook/createOrUpdateUser'
import './App.css'

function App() {

  useEffect(() => {
    console.log('rendered')
      createUser({ pages: 'is_leanding', id: localStorage.getItem('id') ?? '' })
  }, [])

  return (
    <>
      <main className="home">
        <Intro />
        <Desc />
      </main>

    </>
  )
}

export default App