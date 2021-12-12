'use strict';

app.service('Notification', function() {
    this.getMessage = function(messages) {
        if (messages.type == 'error') {
            return $.notify({
                icon: 'icmn-warning2',
                title: '<strong>Error</strong>',
                message: messages.text
            },{
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                }
            });
        }

        if (messages.type == 'success') {
            return $.notify({
                icon: 'icmn-checkmark',
                title: '<strong>Success</strong>',
                message: messages.text
            },{
                type: 'success',
                placement: {
                    from: "bottom",
                    align: "right"
                }
            });
        }

        if (messages.type == 'info') {
            return $.notify({
                icon: 'icmn-notification2',
                title: '<strong>Info</strong>',
                message: messages.text
            },{
                type: 'info',
                placement: {
                    from: "bottom",
                    align: "right"
                }
            });
        }

        if (messages.type == 'warning') {
            return $.notify({
                icon: 'icmn-notification2',
                title: '<strong>Warning</strong>',
                message: messages.text
            },{
                type: 'warning',
                placement: {
                    from: "bottom",
                    align: "right"
                }
            });
        }

    };

    return this;
});