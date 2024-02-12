/* eslint-disable camelcase */
import Swal from 'sweetalert2'

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function confirm({ icon = 'question', title = '', message = '', cancelButtonText = 'Non', confirmButtonText = "Oui", showConfirmButton = true, showCancelButton = true }) {
    return Swal.fire({
        icon,
        title,
        position: 'center',
        confirmButtonColor: '#00C851',
        cancelButtonColor: '#CC0000',
        confirmButtonText,
        cancelButtonText,
        showConfirmButton,
        showCancelButton,
        html: message,
        backdrop: `rgb(18, 87, 65, .4)`,
        animation: true,
        denyButtonColor: "#CC0000",
        confirmButtonColor: "#007E33",
    })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function routeLeaveConfirm({ icon = 'question', title = '', message = 'Vous n\'avez pas enregistré vos changements, êtes-vous sûr de vouloir quitter la page ?', showConfirmButton = true, showCancelButton = true }) {
    return Swal.fire({
        icon,
        title,
        position: 'center',
        confirmButtonColor: '#00C851',
        cancelButtonColor: '#CC0000',
        showConfirmButton,
        showCancelButton,
        cancelButtonText: 'Annuler',
        confirmButtonText: 'Oui',
        text: message
    })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function alert_success(message = '', title = 'Succès') {
    return confirm({ icon: 'success', title, message, showCancelButton: false })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function alert_error(message = 'Une erreur est survenue', title = 'Erreur') {
    return confirm({ icon: 'error', title, message, showCancelButton: false })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function confirm_destroy(message = 'Êtes-vous sûr de vouloir supprimer cette ressource ?') {
    return confirm({ icon: 'question', title: 'Confirmation', message, confirmButtonText: "D'accord" })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function confirm_update(message = 'Êtes-vous sûr de vouloir enregistrer vos modifications ?') {
    return confirm({ icon: 'question', title: 'Confirmation', message, confirmButtonText: "D'accord" })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function toast({ icon = 'question', title = '', message = '', target = '' }) {
    Swal.fire({
        toast: true,
        icon,
        title,
        position: 'bottom-right',
        timer: 5000,
        showCloseButton: true,
        timerProgressBar: true,
        showConfirmButton: false,
        html: message,
        width: '27rem',
        didOpen: (toast) => {
            if (target) {
                toast.classList.add('is-clickable')
            }
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            toast.addEventListener('click', () => {
                if (target !== '' && target !== null) {
                    // window.location.href = target
                    this.$router.push({ name: 'login' })
                    toast.remove(); // Remove the toast after it's clicked
                }
            });
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
export function toast_success(message = '', title = 'Succès', target = '') {
    return toast({ icon: 'success', title, message, target })
}

/**
 * @param string icon
 * @param string title
 * @param string message
 *
 * @return {any}
 */
export function toast_error(message = 'Une erreur est survenue', title = 'Erreur', target = '') {
    return toast({ icon: 'error', title, message, target })
}

export function alert_status(error) {
    const code = error?.response?.status
    const statusText = error?.response?.statusText
    const title = statusText || code ? code + ' ' + statusText : 'Erreur'
    const message = code !== 422 ? error?.response?.data?.message : 'Les données fournies sont invalides.'
    confirm({ icon: 'error', title, message, showCancelButton: false })
}

export function loading(progress, message = 'Chargement en cours...') {
    Swal.fire({
        // title: 'Auto close alert!',
        html: message + ' <b></b>',
        // timer: 2000,
        // timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            setInterval(() => {
                b.textContent = progress + ' %'
            }, 100)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
}

export function catchError(error, silent = false) {
    const { errorMessage, status } = handleServerError(error);
    handleNetworkError(error)
    showAlertIfError(status, errorMessage, silent);
}

function handleServerError(error) {
    const { response, request, code } = error;
    let errorMessage = "Quelque chose s'est mal passé.";
    let status = response?.status || code;

    if (response) {
        if (status > 299 && status < 400) {
            errorMessage = response.data?.message || errorMessage;
            console.error(response.data);
            console.error(status);
            console.error(response.headers);
        } else if (status === 422) {
            errorMessage = response.data?.message || errorMessage;
            console.log(errorMessage);
            console.error(response);
        } else {
            errorMessage = response.data?.message || errorMessage;
            console.error('Error', errorMessage);
        }
    } else if (request && status !== 422) {
        console.log(request);
    }

    return { errorMessage, status };
}

function showAlertIfError(status, errorMessage, silent) {
    const title = "Erreur";
    if (status == 422) {
        silent = true
    }

    if (!silent && status > 299) {
        alert_error(errorMessage, title);
    }
    if (!silent && status <= 299 && status >= 200) {
        alert_error(errorMessage, title);
    }
}

function handleNetworkError(error) {
    if (error.code === 'ECONNABORTED') {
        alert_error('Une demande a expiré. Si vous ne pouvez pas résoudre le problème, veuillez contacter votre administrateur réseau.', error.message);
    } else if (error.code === 'ENOTFOUND') {
        alert_error('Serveur non trouvé. Si vous ne pouvez pas résoudre le problème, veuillez contacter votre administrateur réseau.', error.message);
    } else if (error.code === 'ECONNREFUSED') {
        alert_error('Connexion refusée par le serveur. Si vous ne pouvez pas résoudre le problème, veuillez contacter votre administrateur réseau.', error.message);
    } else if (error.code === 'ETIMEDOUT') {
        alert_error(error.message, 'Connexion expirée');
    } else if (error.code == 'ERR_INTERNET_DISCONNECTED') {
        alert_error(error.message, 'Réseau indisponible');
    } else if (error.code == 'ERR_NETWORK') {
        this.alert_error('Réseau indisponible. Si vous ne pouvez pas résoudre le problème, veuillez contacter votre administrateur réseau.', error.message);
    } else if (error.response) {
        if (error?.response?.status !== 422) {
            alert_error('Le serveur a répondu avec un code de statut non réussi : ' + error.response.status);
        }
    } else {
        alert_error('Une erreur inattendue s\'est produite. Si vous ne pouvez pas résoudre le problème, veuillez contacter votre administrateur réseau.', error.message);
    }
}
