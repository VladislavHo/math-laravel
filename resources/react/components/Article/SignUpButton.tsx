export default function SignUpButton({ id }: { id: string }) {
  return (
    <>
      <div className="signup--button">
        <a href={`/${id}/questionnaire`}>Записаться!</a>
      </div>
    </>
  )
}
