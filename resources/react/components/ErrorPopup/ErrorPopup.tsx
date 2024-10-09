import "./error_popup.scss"

export default function ErrorPopup({message}:{message:string}) {
  return (
    <div className="error-message--container">
      <div className="error-message--wrapper">
        <p className="error-message--text">{message}</p>
      </div>
    </div>
  )
}
