import { SERVER_SITE } from "../config/config";

export async function getAnalyticsArticle(id: string) {
  const response =  await fetch(`${SERVER_SITE}/api/analytics/article`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id })
  })
  const data = await response.json()

  return data
}

export async function getAnalyticsQuestionnaire(id: string) {
  const response =  await fetch(`${SERVER_SITE}/api/analytics/questionnaire`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id })
  })
  const data = await response.json()

  return data
}

export async function getAnalyticsIsPay(id: string, is_pay: boolean) {
  const response =  await fetch(`${SERVER_SITE}/api/analytics/is_pay`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id, is_pay })
  })
  const data = await response.json()

  return data
}


export async function getAnalyticsCalendar(id: string) {
  const response =  await fetch(`${SERVER_SITE}/api/analytics/calendar`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id })
  })
  const data = await response.json()

  return data
}