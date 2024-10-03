import "./error_popup.scss"

export default function ErrorPopup() {
  return (
    <div className="error-message--container">
      <div className="error-message--wrapper">
        <p className="error-message--text">Произошла ошибка. <br /> Пожалуйста, повторите попытку позже или обновите страницу.</p>
      </div>
    </div>
  )
}
