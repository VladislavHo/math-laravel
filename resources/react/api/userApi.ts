

import { SERVER_SITE } from "../config/config"
import { User } from "../types/types"

export async function createUserByApi({ pages, id }: { pages: string, id: string }) {
  try {
    const response = await fetch(`${SERVER_SITE}/api/user`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ pages, id })
    })

    const data = await response.json()

    if (!response.ok) {
      throw new Error('Error response')
    }

    return {
      success: true,
      data: data.data
    }
  } catch (error) {
    console.log(error)
  }
}
export async function updateUserByApi(dataUser: User) {
  try {
    const response = await fetch(`${SERVER_SITE}/api/user/${dataUser.id}/update`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ ...dataUser })
    })
    if (!response.ok) {
      throw new Error('Error response')
    }
    const data = await response.json()



    return {
      success: true,
      data: data.data
    }
  } catch (error) {
    return {
      success: false,
      error: error
    }
  }
}






export async function addedWithUserAppointment({ id, date, time }: { id: string, date: Date, time: string }) {

  try {
    const response = await fetch(`${SERVER_SITE}/api/user/${id}/update/appointment`, {
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


    if (!response.ok) {
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