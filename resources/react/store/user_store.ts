import { makeAutoObservable, runInAction } from "mobx";
import { addedWithUserAppointment, createUser } from "../api/userApi";
import { User } from "../types/types";



class UserStore {
  userData: User = {
    id: '',
    telegram_id: '',
    name: '',
    lastName: '',
    phone: '',
    email: '',
    tasks: '',
    deadline: '',
    plans: '',
    age: '',
    income: '',
  }

  constructor() {
    makeAutoObservable(this);
  }




   createUserActions = async (userDate: User) => {
    try {
      const userResponse = await createUser(userDate)


      console.log(userResponse)

      runInAction(() => {
        this.userData = userResponse.data
        localStorage.setItem('id', userResponse.data.id ?? '')
      })


      console.log(this.userData);

    } catch (error) {
      console.log(error)
    }
  }


   addedWithUserAppointmentActions = async ({ date, time }: { date: Date, time: string })=> {
    const id = localStorage.getItem('id') ?? ''
    try {
      const userResponse = await addedWithUserAppointment({ id, date, time })

      runInAction(() => {
        this.userData = { ...userResponse }

      })
      console.log(userResponse);
    } catch (error) {
      console.log(error)
    }
  }
}


export default new UserStore()