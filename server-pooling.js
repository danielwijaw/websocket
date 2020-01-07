var socket  = require('socket.io');
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen(server);
var port    = process.env.PORT || 3001;
var io_client    = require('socket.io-client');
var socket_client = io_client('http://localhost:3000', {transports : [ 'websocket' ]});

// ROUTING WEB PORTAL
app.get('/', function(req, res){
    res.send('RS ANANDA WEBSOCKET (Transport Pooling):)');
});

socket_client.on( 'connect', function( data ) {
    console.log("connected to ananda-websocket");
});

// ON SERVER UP THEN
server.listen(port, function () {
    console.log('Server listening at port %d', port);
});

// WEBSOCKET CONFIGURATION
io.on('connection', function(socket){

    // WEBSOCKET GET CONNECTION
    var address = socket.request.connection.remoteAddress;
    console.log('New connection from ' + address);

    // WEBSOCKET REKAN
    socket.on('rekan_and', function(msg){
        socket_client.emit('rekan_and', { message: msg.message , sound: msg.sound });
        io.emit('rekan_and', {
            from: address,
            message: msg.message,
            sound: msg.sound
        });
        console.log('Push Rekan Notification '+msg.message+' || '+msg.sound);
    });

    // WEBSOCKET KASIR
    socket.on('kasir_and', function(msg){
        socket_client.emit('kasir_and', { message: msg.message });
        io.emit('kasir_and', {
            from: address,
            message: msg.message
        });
        console.log('Push Kasir Notification '+msg.message);
    });

    // WEBSOCKET LOST CONNECTION
    socket.on('disconnect', function(){
        console.log('user '+ address +' disconnected');
    });
});