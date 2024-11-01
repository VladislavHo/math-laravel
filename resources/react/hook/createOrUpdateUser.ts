import { createUserByApi } from "../api/userApi"

export const createUser = async ({ pages, id }: { pages: string, id: string }) => {
  try {
    await createUserByApi({ pages, id }).then((data) => {

      if (data?.success) {
        localStorage.setItem("id", data?.data?.id)
      }
    })

  } catch (error) {
    console.log(error)
  }
}