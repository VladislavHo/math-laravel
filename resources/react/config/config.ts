export const SERVER_SITE: string = 'https://6bb3-151-249-233-115.ngrok-free.app';
export const MAX_CALENDAR_DATE: Date = new Date(2025, 1, 1)

export const CONTRY_CODES: { country: string; code: string }[] = [
  { country: 'Россия', code: '+7' },
  { country: 'Узбекистан', code: '+998' },
  { country: 'Великобритания', code: '+44' },
  { country: 'США', code: '+1' },
  { country: 'Швеция', code: '+46' },
  { country: 'Нидерланды', code: '+31' },
  { country: 'Норвегия', code: '+47' },
  { country: 'Германия', code: '+49' },
  { country: 'Франция', code: '+33' },
  { country: 'Испания', code: '+34' },
  { country: 'ОАЭ', code: '+971' },
  { country: 'Турция', code: '+90' },

];

export const OPTION_COUNTRY_CODES = CONTRY_CODES.map(({ country, code }) => ({
  value: country, 
  label: code, 
}))