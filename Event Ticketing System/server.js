require("dotenv").config();
const express = require("express");
const app = express();
const mongoose = require("mongoose");
const connectDB = require("./config/dbConfig");

// Environment variables
const PORT = process.env.PORT || 3000;

// Connect to MongoDB
connectDB();

// Middleware
app.use(express.json());

// Routes
app.use("/api/auth", require("./routes/authRoutes"));
app.use("/api/events", require("./routes/eventRoutes"));
app.use("/api/bookings", require("./routes/bookingRoutes"));

// Welcome page (Root URL)
app.get("/", (req, res) => {
  res.send("<h1>Welcome to the Event Ticketing API</h1>");
});

const path = require("path");

// Catch-all for 404 errors
app.all("/*splat", (req, res) => {
  if (req.accepts("html") || req.accepts("text")) {
    res.status(404).sendFile(path.join(__dirname, "views", "404.html"));
  } else if (req.accepts("json")) {
    res.status(404).json({ error: "404 Not Found" });
  } else {
    res.status(404).type("txt").send("404 Not Found");
  }
});

// Start server only after MongoDB is connected
mongoose.connection.once("open", () => {
  console.log("Connected to MongoDB");
  app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
  });
});
