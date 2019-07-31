
function initNotifications(options)
{
    setInterval(() => {
        
        $.ajax({
            url: options.get_url,
            method: 'POST',
            dataType: 'json',

        })
        .done((data) => {

            data.forEach((notify) => {

                if(!notify.displayed || notify.displayed.indexOf(USER_ID) < 0) {
                    let t;
                    if(notify.level == 0)
                        t = toastr.info(notify.content, (notify.title?notify.title:false));
                    else if(notify.level == 1)
                        t = toastr.success(notify.content, (notify.title?notify.title:false));
                    else if(notify.level == 2)
                        t = toastr.error(notify.content, (notify.title?notify.title:false));
                    else if(notify.level == 3)
                        t = toastr.warning(notify.content, (notify.title?notify.title:false));

                    $(t).data('n-uid', notify.id);

                    Push.create(notify.title?notify.title:notify.content, {
                        body: notify.title?notify.content:'',
                        //link: '#',
                        //icon: '',
                    });
                }

            });

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

    }, 1000*30);

}
