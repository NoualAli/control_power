import { user } from '~/plugins/user'
import store from "~/store"

// Subscribe to missions witout report channel
user().missions_without_report?.map((mission) => {
    window.Echo.private('mission.report.generated.' + mission)
        .listen('.MissionReportGenerated', (data) => {
            console.log('Event received:', data);

            // Show toast for success
            $swal.toast_success({ message: data.message, title: data.title })

            // Update total notifications
            store.commit('notifications/SET_UNREAD_NOTIFICATIONS', store.getters[ 'notifications/totalUnread' ] + 1)

            // Play audio song for notification
            const audio = new Audio('/songs/notification-std.wav')
            audio.play()

            // Show desktop notification
            if (Notification.permission == 'granted') {
                new Notification(data.title + ': Génération du rapport avec succès !')
            }

        });
})
