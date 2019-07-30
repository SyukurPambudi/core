var socket  = require('socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 19391;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});

io.on('connection', function (socket) {

  socket.on( 'new_count_message', function( data ) {
    
    Object.keys(data.new_count_message).forEach(function(key) {
      console.log('new_count_message_'+key);
      ss=data.new_count_message;
      io.sockets.emit( 'new_count_message_'+key, { 
      	new_count_message: ss[key]    
      });
    });
  });

  socket.on ('update_count_erp_message',function(data){
    nip=data.nip_erp;
    console.log(nip);
    io.sockets.emit('update_count_erp_inbox_'+nip, {
      count_inbox_erp_new:data.new_count_erp
    });
  });
  
  socket.on('show_pop_up', function(data){
    Object.keys(data.datadet_inbox).forEach(function(key){
      ss1=data.datadet_inbox;
      console.log('Send Notif '+ss1[key]);
      io.sockets.emit('show_notif_new_message_erp_'+key,{
        data_details: ss1[key]
      });
    });
  });
  
});
