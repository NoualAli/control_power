/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function confirm({ icon = "question", title = "", message = "", showConfirmButton = true, showCancelButton = true }) {
  return Swal.fire({
    icon,
    title,
    position: 'center',
    confirmButtonColor: '#00C851',
    cancelButtonColor: '#CC0000',
    showConfirmButton,
    showCancelButton,
    cancelButtonText: "Annuler",
    text: message,
  })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function alert_success(message = "", title = "Succès") {
  return confirm({ icon: 'success', title, message, showCancelButton: false })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function alert_error(message = "Une erreur est survenue", title = "Erreur") {
  return confirm({ icon: 'error', title, message, showCancelButton: false })
}


/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function confirm_destroy(message = "Voulez-vous vraiment supprimer cette ressource ?") {
  return confirm({ icon: "question", title: "Confirmation", message })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function confirm_update(message = "Voulez-vous enregistrer vos modifications ?") {
  return confirm({ icon: "question", title: "Confirmation", message })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function toast({ icon = 'question', title = "", message = "" }) {
  Swal.fire({
    toast: true,
    icon,
    title,
    position: 'bottom-right',
    timer: 5000,
    timerProgressBar: true,
    showConfirmButton: false,
    text: message,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function toast_success(message = "") {
  return toast({ icon: 'success', title: 'Succès', message })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function toast_error(message = "Une erreur est survenue") {
  return toast({ icon: 'error', title: 'Erreur', message })
}

export function alert_status(error) {
  const code = error.response.status
  const statusText = error.response.statusText
  const title = code + ' ' + statusText
  const message = code != 422 ? error.response.data.message : 'Les données fournies sont invalides.'
  confirm({ icon: 'error', title, message, showCancelButton: false })
}
