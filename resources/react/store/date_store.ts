import { makeAutoObservable, runInAction } from "mobx";
import { getDates } from "../api/dateApi";

class DateStore {
  dateAppointement: string[] = []
  constructor() {
    makeAutoObservable(this);
  }


   getDatesActions = async () => {
    try {
      const dateResponse = await getDates()
      if (dateResponse && dateResponse.dates) {
        runInAction(() => {
          this.dateAppointement = dateResponse.dates
        })
      } else {
        console.error('Error: getDates API call returned undefined or null')
      }
    } catch (error) {
      console.log(error)
    }
  }


}


export default new DateStore()