import http from 'http';
import socket from 'socket.io-client';

const socketIo = socket;





// Create the server
const server = http.createServer((req, res) => {
  res.statusCode = 200;
  res.setHeader('Content-Type', 'text/plain');
  res.end('Hello, world!');
});
const io = socketIo(server);

console.log(io.disconnected);

io.on('disconnected', (socket) => {
    console.log('A user connected');

    socket.on('disconnect', () => {
        console.log('A user disconnected');
    });


});

const PORT = process.env.PORT || 6001;
server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
