export interface User{
  id?: string;
  name: string;
  lastName: string;
  telegram_name: string;
  phone: string;
  email: string;
  tasks: string;
  deadline: string;
  plans: string;
  age: string;
  income: string;
}

export interface FormValues {
  id: string | null;
  name: string;
  lastName: string;
  telegram_name: string;
  country: string;
  phone: string;
  email: string;
  tasks: string;
  deadline: string;
  plans: string;
  age: string;
  income: string;
  investment: string;
}