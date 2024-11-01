import { SERVER_SITE } from "../config/config";

// export async function getAnalyticsQuestionnaire(id: string) {
//   const response = await fetch(`${SERVER_SITE}/api/analytics/questionnaire`, {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/json',
//     },
//     body: JSON.stringify({ id })
//   })
//   const data = await response.json()

//   return {
//     success: true,
//     data: data.data
//   }
// }

export async function getAnalyticsCalendar({ id }: { id: string }) {
  try {
    const response = await fetch(`${SERVER_SITE}/api/analytics/calendar`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id })
    })
    if (!response.ok) {
      throw new Error('Error response')
    }
    const data = await response.json()

    console.log(data)
    return {
      success: true,
      status: data.status
    }
  } catch (error) {
    return {
      success: false,
      data: null
    }
  }
}