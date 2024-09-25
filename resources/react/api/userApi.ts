
import { User } from "../types/types"
import { SERVER_SITE } from "../var/var"

export async function createUser(user: User) {
  try {
    const response = await fetch(`${SERVER_SITE}/api/users`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(user)
    })

    const data = await response.json()

    
    return data
  } catch (error) {
    console.log(error)
  }
}

export async function addedWithUserAppointment({id, date, time}: {id: string, date: Date, time: string}) {
  
  try {
    const response = await fetch(`${SERVER_SITE}/api/users/${id}/update`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        id,
        date,
        time
      })
    })

    const data = await response.json()

    return data
  } catch (error) {
    console.log(error)
  }
}