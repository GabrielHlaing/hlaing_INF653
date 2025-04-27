const Booking = require("../model/Booking");
const Event = require("../model/Event");

// GET /api/bookings
const getAllBookings = async (req, res) => {
  try {
    const bookings = await Booking.find({ user: req.user.userId }).populate(
      "event"
    );
    if (!bookings || bookings.length === 0) {
      return res.status(404).json({ message: "No bookings found." });
    }
    res.json(bookings);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

// GET /api/bookings/:id
const getBookingById = async (req, res) => {
  const { id } = req.params;
  if (!id) {
    return res.status(400).json({ message: "Booking ID is required!" });
  }
  try {
    const booking = await Booking.findById(id).populate("event").exec();
    if (!booking) {
      return res
        .status(404)
        .json({ message: `Booking with ID ${id} not found.` });
    }

    if (booking.user.toString() !== req.user.userId) {
      return res.status(403).json({ message: "Access denied." });
    }

    res.json(booking);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

// POST /api/bookings
const createBooking = async (req, res) => {
  const { eventId, quantity } = req.body;
  if (!eventId || !quantity) {
    return res
      .status(400)
      .json({ message: "Event ID and quantity are required!" });
  }
  try {
    const event = await Event.findById(eventId).exec();
    if (!event) {
      return res.status(404).json({ message: "Event not found." });
    }

    if (event.seatCapacity - event.bookedSeats < quantity) {
      return res.status(400).json({ message: "Not enough seats available." });
    }

    event.bookedSeats += quantity;
    await event.save();

    const booking = await Booking.create({
      user: req.user.userId,
      event: eventId,
      quantity,
    });

    res.status(201).json(booking);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

module.exports = { getAllBookings, getBookingById, createBooking };
