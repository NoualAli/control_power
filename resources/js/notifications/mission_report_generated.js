import { user } from '~/plugins/user'
import store from "~/store"
import * as $swal from '~/plugins/swal'

let missionsWithoutReports = user().missions_without_report

if (Array.isArray(missionsWithoutReports) && missionsWithoutReports.length !== 0) {
    // Subscribe to missions witout report channel
    missionsWithoutReports?.map((mission) => {
        window.Echo.private('mission.report.generated.' + mission)
            .listen('.MissionReportGenerated', (data) => {
                console.log('Event received:', data);

                // Show toast for success
                $swal.toast_success(data.message, data.title, data.link)

                // Update total notifications
                // store.dispatch('notifications/incrementTotal')
                store.commit('notifications/SET_TOTAL_UNREAD_NOTIFICATIONS', store.getters[ 'notifications/totalUnread' ].totalUnread + 1)

                // update missions without report list
                store.dispatch('auth/fetchUser').then(() => console.log('ok'))

                // Show desktop notification
                if (Notification.permission == 'granted') {
                    new Notification(data.title + ': Génération du rapport avec succès !')
                }

                // Play audio song for notification
                // try {
                //     const audio = new Audio('/songs/notification-std.wav')
                //     audio.play()
                // } catch (error) {
                //     console.log(error)
                // }

            });
    })
}
