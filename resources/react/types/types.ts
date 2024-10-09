export interface User{
  id?: string;
  name: string;
  lastName: string;
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