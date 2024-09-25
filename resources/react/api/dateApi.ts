import { SERVER_SITE } from "../var/var"

export async function getDates() {
  console.log(`${SERVER_SITE}/api/users/dates`)
  try {
    const response = await fetch(`${SERVER_SITE}/api/users/dates`, {
      method: 'POST',

    })
    if(!response.ok) throw new Error('Error response')
    const data = await response.json()
    return data
    
    // return data
  } catch (error) {
    console.log(error)
  }
}