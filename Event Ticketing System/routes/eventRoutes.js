const express = require("express");
const router = express.Router();
const {
  getAllEvents,
  getEventById,
  createEvent,
  updateEvent,
  deleteEvent,
} = require("../controller/eventController");
const verifyJWT = require("../middleware/verifyJWT");
const verifyAdmin = require("../middleware/verifyAdmin");

router.route("/").get(getAllEvents).post(verifyJWT, verifyAdmin, createEvent);

router
  .route("/:id")
  .get(getEventById)
  .put(verifyJWT, verifyAdmin, updateEvent)
  .delete(verifyJWT, verifyAdmin, deleteEvent);

module.exports = router;
