function onNotification(e) {
    switch (e.event) {
        case 'registered':
            if (e.regid.length > 0) {
                // Your GCM push server needs to know the registration ID before it can push to this device
                // here is where you might want to send it the reg_id for later use.
                $.ajax({
                    'url': 'http://wilianto.com/tutorial/gcm_php/server/api/gadget_new.php',
                    'method': 'POST',
                    'data': {reg_id: e.regid, type: 'android'}
                });
            }
            break;
        case 'message':
            console.log(e);
            window.location.href = e.payload.url;
            break;
        case 'error':
            console.log('Error: ' + e.msg);
            break;
        default:
            console.log('An unknown event was received');
            break;
    }
}

function successHandler(result) {
    console.log('Success: '+ result);
}

function errorHandler(error) {
    console.log('Error: '+ result);
}

var app = {
    initialize: function() {
        this.bindEvents();
    },
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    onDeviceReady: function() {
        app.receivedEvent('deviceready');

        var pushNotification;

        function onDeviceReady() {
            pushNotification = window.plugins.pushNotification;
            pushNotification.register(successHandler, errorHandler, {
                "senderID": "xxxxxxx", //replace with your project number
                "ecb": "onNotification"
            });
        }

        document.addEventListener('deviceready', onDeviceReady, true);
    },
    receivedEvent: function(id) {
        console.log('Received Event: ' + id);
    }
};


app.initialize();
