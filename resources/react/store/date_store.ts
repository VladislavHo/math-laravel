import { makeAutoObservable, runInAction } from "mobx";
import { getDates } from "../api/dateApi";

class DateStore {
  dateAppointement: string[] = ['2024-10-19']
  constructor() {
    makeAutoObservable(this);
  }


   getDatesActions = async () => {
    try {
      const dateResponse = await getDates()
      if (dateResponse && dateResponse.dates) {
        runInAction(() => {
          this.dateAppointement = this.dateAppointement.concat(dateResponse.dates)
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