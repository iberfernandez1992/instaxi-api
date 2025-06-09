const path = require('path');
const express = require('express');
const SocketIO = require('socket.io');
const cors = require('cors')
const bodyParser = require('body-parser');

const app = express();
var socketId = null;

// settings 
app.set('port', process.env.PORT || 3220);
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// start the server
const server = app.listen(app.get('port'), () => {
    console.log( 'Server on prot', app.get('port') );
});

// websokets
const io = SocketIO(server, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

// Changels structure
const typeUsers = [
    'taxi',
    'cliente',
];

const modules = [
    'viaje-ofertar',
    'viaje-aplicar',
    'viaje-aceptar',
    'viaje-recojer',
    'viaje-llegar',
    'viaje-iniciar',
    'viaje-finalizar',
    'viaje-descartar',
    'viaje-cancelar',
];

// sockets conections
io.on('connection', (socket) => {
    socketId = socket.id;
    console.log('new connection', socketId);
    typeUsers.forEach(typeUser => {
        modules.forEach(module => {
            socket.on(`${typeUser}:${module}`, (data)=>{
                io.sockets.emit(`${typeUser}:${module}`, data);
            });
        });
    });
});

// Express routers
app.get('/', cors(), function (req, res, next) {
    res.send('Socket is runing with ID '+socketId);
});

typeUsers.forEach(typeUser => {
    modules.forEach(module => {
        // Use for ejm: taxi:viaje-ofertar
        app.post(`/${typeUser}/${module}`, (requestData, response) => {
            io.sockets.emit(`${typeUser}:${module}`, requestData.body);
            response.send(requestData.body);
        });
        app.get(`/${typeUser}/${module}`, (requestData, response) => {
            io.sockets.emit(`${typeUser}:${module}`, requestData.body);
            response.send(`/${typeUser}/${module}`);
        });
    });
});