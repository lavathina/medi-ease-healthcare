const http = require("http");
const { Server } = require("socket.io");

const server = http.createServer();
const io = new Server(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"]
  }
});

let nextId = 1; // unique message IDs

io.on("connection", (socket) => {
  console.log("A user connected");

  // Send message with ID
  socket.on("chat message", (msg) => {
    const message = { id: nextId++, ...msg };
    io.emit("chat message", message);
  });

  // Handle delete request by ID
  socket.on("delete message", (id) => {
    io.emit("delete message", id);
  });

  socket.on("disconnect", () => {
    console.log("A user disconnected");
  });
});

server.listen(3000, () => {
  console.log("Server running at http://localhost:3000");
});
