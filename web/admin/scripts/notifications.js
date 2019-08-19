
function initNotifications(options)
{
    getNotifications(options);

    setInterval(() => {
        
        getNotifications(options);

    }, 1000*30);

}

function getNotifications(options)
{
    $.ajax({
        url: options.get_url,
        method: 'POST',
        dataType: 'json',

    })
    .done((data) => {

        $('#NotificationsTimeline').html('');

        let ndisplayed_cnt = 0;

        data.forEach((notify) => {

            if(notify.level == 0) {
                classes = 'dot-info';
            }
            else if(notify.level == 1) {
                classes = 'dot-success';
            }
            else if(notify.level == 2) {
                classes = 'dot-danger';
            }
            else if(notify.level == 3) {
                classes = 'dot-warning';
            }
            
            $('#NotificationsTimeline').append(
               
                `<div class="vertical-timeline-item `+classes+` vertical-timeline-element">
                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                        <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">`+(notify.title?notify.title:notify.content)+((!notify.displayed || notify.displayed.indexOf(USER_ID) < 0)?`<span class="badge badge-danger ml-2">NEW</span>`:``)+`</h4>
                            <p>`+notify.created+`</p><span class="vertical-timeline-element-date"></span></div>
                    </div>
                </div>`
            );

            if(!notify.displayed || notify.displayed.indexOf(USER_ID) < 0) {
                let t;
                if(notify.level == 0) {
                    t = toastr.info(notify.content, (notify.title?notify.title:false));
                }
                else if(notify.level == 1) {
                    t = toastr.success(notify.content, (notify.title?notify.title:false));
                }
                else if(notify.level == 2) {
                    t = toastr.error(notify.content, (notify.title?notify.title:false));
                }
                else if(notify.level == 3) {
                    t = toastr.warning(notify.content, (notify.title?notify.title:false));
                }

                ndisplayed_cnt++;

                $(t).data('n-uid', notify.id);

                Push.create(notify.title?notify.title:notify.content, {
                    body: notify.title?notify.content:'',
                    //link: '#',
                    //icon: '',
                });
            }

        });

        $('#NotificationsCount').text(ndisplayed_cnt);

    })
    .fail(() => {
        console.log('NOTIFICATIONS INTERVAL ERROR');
    });

    toastr.options.onclick = (ev) => {

        let uid = $(ev.currentTarget).data('n-uid');

        $.ajax({
            url: options.displayed_url,
            method: 'POST',
            dataType: 'json',
            data: {
                'uid': uid,
                'userid': USER_ID
            }

        });

    }
}
