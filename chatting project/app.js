// 서버
const express = require("express")
const http = require("http")
const app = express();
const path = require("path")
const server = http.createServer(app);
const socketIO = require("socket.io")
const moment = require("moment")

const io = socketIO(server);

app.use(express.static(path.join(__dirname, "src")))
const PORT = process.env.PORT || 5000;

io.on("connection",(socket)=> {
    // console.log('연결이 이루어 졌스빈다.')
    socket.on("chatting", (data)=>{
        //console.log(data)
        const {name, msg} = data;

        //const { } = data; //chat.js에서 click시 넘겨받는데이
        // console.log(data) //여기 터미널에 표시되는 내용
        // io.emit("chatting", `그래 반가워 ${data}`) //웹사이트에 표시되는 내용
        //io.emit("chatting", data) //웹사이트에 표시되는 내용
        io.emit("chatting", {
            name,
            msg,
            time: moment(new Date()).format("YYYY-MM-DD HH:mm:ss A")
        })
    })
})

server.listen(PORT, ()=>console.log(`server is running ${PORT}`))