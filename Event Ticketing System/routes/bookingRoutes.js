const express = require("express");
const router = express.Router();
const {
  getAllBookings,
  getBookingById,
  createBooking,
} = require("../controller/bookingController");
const verifyJWT = require("../middleware/verifyJWT");

// All booking routes need user authentication
router.use(verifyJWT);

router.route("/").get(getAllBookings).post(createBooking);
router.route("/:id").get(getBookingById);

module.exports = router;
