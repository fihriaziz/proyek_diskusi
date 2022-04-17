// Setup basic express server
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var mysql = require('mysql');
var port = process.env.PORT || 3000;

app.get("/", function(req,res){
  res.send('running');
});

io.on('connection', function(socket){

  //cek user online ke group / diskusi
  socket.on('cek_online',function(id_diskusi){
    socket.join(id_diskusi);
    console.log("ada user baru di forum diskusi : "+ id_diskusi);
    //sebenarnya ngga terlalu penting, tapi buat debugging saja
  });



  // array = ('id_diskusi','id_user','isi_komentar','tgl_komentar','lampiran',is_image)
  socket.on('kirim_komentar',function(array){
    socket.join(array[0]);
    socket.nsp.to(array[0]).emit('response_komentar',array[1],array[2],array[3]);
    console.log('komentar terkirim: '+array[1]);
  });




  /// Notifikasi
  // public_key = isiterserah.
  // socket.on('notifikasi', function(public_key){
  //   socket.join(public_key);
  //   // nah ng kne handle notif'e
  //   get_notifikasi(function(callback){
  //     socket.emit('response_notifikasi',callback);
  //   });
  // })
});

// var get_notifikasi = function(callback){
//   var notifikasi = "contoh notif";
//   callback(notifikasi);
// }

http.listen(port,function(){
  console.log("server berjalan...")
});

// // Routing
// app.use(express.static(path.join(__dirname, 'public')));

// // Chatroom

// var numUsers = 0;

// io.on('connection', (socket) => {
//   var addedUser = false;

//   // when the client emits 'new message', this listens and executes
//   socket.on('new message', (data) => {
//     // we tell the client to execute 'new message'
//     socket.broadcast.emit('new message', {
//       username: socket.username,
//       message: data
//     });
//   });

//   // when the client emits 'add user', this listens and executes
//   socket.on('add user', (username) => {
//     if (addedUser) return;

//     // we store the username in the socket session for this client
//     socket.username = username;
//     ++numUsers;
//     addedUser = true;
//     socket.emit('login', {
//       numUsers: numUsers
//     });
//     // echo globally (all clients) that a person has connected
//     socket.broadcast.emit('user joined', {
//       username: socket.username,
//       numUsers: numUsers
//     });
//   });

//   // when the client emits 'typing', we broadcast it to others
//   socket.on('typing', () => {
//     socket.broadcast.emit('typing', {
//       username: socket.username
//     });
//   });

//   // when the client emits 'stop typing', we broadcast it to others
//   socket.on('stop typing', () => {
//     socket.broadcast.emit('stop typing', {
//       username: socket.username
//     });
//   });

//   // when the user disconnects.. perform this
//   socket.on('disconnect', () => {
//     if (addedUser) {
//       --numUsers;

//       // echo globally that this client has left
//       socket.broadcast.emit('user left', {
//         username: socket.username,
//         numUsers: numUsers
//       });
//     }
//   });
// });