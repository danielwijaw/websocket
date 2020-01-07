<html>
    <head>
        <!-- Call css toaster for notification -->
        <link rel="stylesheet" href="assets/pusher/toastr.min.css">
        <!-- Call Jquery javascript library -->
        <script type="text/javascript" src="assets/jeasyui/jquery.min.js"></script>
        <!-- Call Javascript toaster -->
        <script type="text/javascript" src="assets/pusher/toastr.min.js"></script>
        <!-- Call javascript socketio -->
        <script type="text/javascript" src="assets/socket.io-client/dist/socket.io.js"></script>
        <!-- Call javascript speak -->
        <script type="text/javascript" src="assets/plugins/speak.js"></script>
        <script>
            // Connect to socket io (localhost use by ip:port)
            var socket      = io('http://localhost:3000',{ transports: [ 'websocket' ] });
            // Notification if connected to websocket
            socket.on( 'connect', function( data ) {
                console.log("connected to ananda-websocket");
            });
            // Notification if disconnected from websocket
            socket.on( 'disconnect', function( data ) {
                alert("Disconnect from ananda-websocket please restart browser (f5) or contact team IT {Error : "+data+"}");
            });
        </script>
    </head>
    <body>
        <input type="text" id="textsenddata">
        <button id="senddata" onclick="senddata()" type="button">Send Data</button>
    </body>
    <script>

        // Starting sample by send data
        function senddata(){
            var val = $('#textsenddata').val();
            socket.emit('rekan_and', { message: val });
        }
    </script>
</html>