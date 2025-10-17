import './echo.js';

window.Echo.private('App.Models.User.'+id).notification(
    (event) => {
        $("#notification-list-id").prepend(`
              <div class="dropdown-item d-flex justify-content-between align-items-center notification-class ">
                    <span style="max-width: 200px; "><a
                                href="${event.link}?notifiy=${event.id}"> New Comment Post: ${event.post_title.substring(0, 10)}</a></span>
            </div>
        `);
        let count = $("#notificationCount").text();
        $("#notificationCount").text(++count);
    }
);