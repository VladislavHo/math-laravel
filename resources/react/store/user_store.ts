import { makeAutoObservable, runInAction } from "mobx";
import { addedWithUserAppointment } from "../api/userApi";
import { User } from "../types/types";



class UserStore {
  userData: User = {
    id: '',
    name: '',
    telegram_name: '',
    lastName: '',
    phone: '',
    email: '',
    tasks: '',
    deadline: '',
    plans: '',
    age: '',
    income: '',
  }

  errorUserData = false

  constructor() {
    makeAutoObservable(this);
  }

   addedWithUserAppointmentActions = async ({ date, time, id }: { date: Date, time: string, id: string })=> {
    try {
      const userResponse = await addedWithUserAppointment({ id, date, time })

      runInAction(() => {
        this.userData = { ...userResponse.data }
      userResponse.success ? this.errorUserData = false : this.errorUserData = true
      })
    } catch (error) {
      this.errorUserData = true
    }
  }
}


export default new UserStore()