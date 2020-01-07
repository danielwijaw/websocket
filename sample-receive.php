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
        <!-- declare sound -->
        <audio id="audioKasir" style="display: none">
            <source src="assets/upload/to-the-point.ogg" type="audio/ogg">
        </audio>
        <audio id="audioFarmasi" style="display: none">
            <source src="assets/upload/plucky.ogg" type="audio/ogg">
        </audio>
        <ul id="messages"></ul>
    </body>
    <script>
        // declare audio notification
        var audioFarmasi = document.getElementById("audioFarmasi");
        var audioKasir = document.getElementById("audioKasir");
        
        // Starting sample by getting data
        // GET DATA
        socket.on( 'rekan_and', function( data ) {
            // Push notification visual
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "30000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success(data['message']);
            // Append Receive Data
            $('#messages').append($('<li>').text(data['message']));
            // Playing audio notifation
            audioFarmasi.play();
            // Playing speaking sound
            responsiveVoice.speak(data['message'], "Indonesian Female", {pitch: 1}); 
        });
    </script>
</html>