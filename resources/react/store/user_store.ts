import { makeAutoObservable, runInAction } from "mobx";
import { addedWithUserAppointment, createUser } from "../api/userApi";
import { User } from "../types/types";



class UserStore {
  userData: User = {
    id: '',
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

  errorUserData: boolean = false

  constructor() {
    makeAutoObservable(this);
  }




   createUserActions = async (userDate: User) => {
    try {
      const userResponse = await createUser(userDate)


      runInAction(() => {
        this.userData = userResponse.data
      })


      console.log(this.userData);

    } catch (error) {
      this.errorUserData = true
    }
  }


   addedWithUserAppointmentActions = async ({ date, time, id }: { date: Date, time: string, id: string })=> {
    try {
      const userResponse = await addedWithUserAppointment({ id, date, time })

      runInAction(() => {
        this.userData = { ...userResponse }

      })
      console.log(userResponse);
    } catch (error) {
      this.errorUserData = true
    }
  }
}


export default new UserStore()