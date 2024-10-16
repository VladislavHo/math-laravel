
import { User } from "../types/types"
import { SERVER_SITE } from "../config/config"

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

    if(!response.ok) {
      throw new Error('Error response')
    }
    
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

    console.log(response, 'RESPONSE');
    
    if(!response.ok) {
      throw new Error('Error response')
    }
    const data = await response.json()

    return {
      success: true,
      data
    }
  } catch (error) {
    return {
      success: false,
      error: error
    }
  }
}