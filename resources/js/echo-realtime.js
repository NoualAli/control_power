import Echo from 'laravel-echo';
import * as $swal from '~/plugins/swal'
import store from "~/store"

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.app_host + ":" + window.laravel_echo_port,
    auth: {
        headers: {
            Authorization: 'Bearer' + store.getters[ 'auth/token' ]
        }
    }
});


// Request permission to show desktop notifications
window.addEventListener('DOMContentLoaded', () => {
    Notification.requestPermission()
    if (!Notification) {
        $swal.alert_error('Your browser doesn\'t support notifications.')
    }
})

import './notifications/mission_report_generated'
