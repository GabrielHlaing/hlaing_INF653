require("dotenv").config();
const express = require("express");
const app = express();
const PORT = 3000;
const connectDB = require("./config/dbConfig.js");
const mongoose = require("mongoose");

//ConnectDB
connectDB();

app.use(express.json());

app.use("/students", require("./routes/student.js"));

mongoose.connection.once("open", () => {
  console.log("Connected to MongoDB");
  app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
  });
});
