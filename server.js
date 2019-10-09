var socket  = require('socket.io');
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen(server);
var port    = process.env.PORT || 3000;

// ROUTING WEB PORTAL
app.get('/', function(req, res){
    res.send('RS ANANDA WEBSOCKET :)');
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

    // WEBSOCKET ANTRIAN
    socket.on('antrian', function(msg){
        io.emit('antrian', {
            from: socket.request.connection.remoteAddress,
            poli_name: msg.poli_name
        });
        console.log('Push Antrian Poli '+msg.poli_name);
    });

    // WEBSOCKET LOST CONNECTION
    socket.on('disconnect', function(){
        console.log('user disconnected');
    });
});