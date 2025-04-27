const Event = require("../model/Event");
const Booking = require("../model/Booking");

// GET /api/events
const getAllEvents = async (req, res) => {
  try {
    const events = await Event.find();
    if (!events || events.length === 0) {
      return res.status(404).json({ message: "No events yet!" });
    }
    res.json(events);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

// GET /api/events/:id
const getEventById = async (req, res) => {
  const { id } = req.params;
  if (!id) {
    return res.status(400).json({ message: "An event ID is required!" });
  }
  try {
    const event = await Event.findById(id).exec();
    if (!event)
      return res
        .status(404)
        .json({ message: `Event with ID ${id} is not found.` });
    res.json(event);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

// POST /api/events (Admin only)
const createEvent = async (req, res) => {
  const {
    title,
    description,
    category,
    venue,
    date,
    time,
    seatCapacity,
    bookedSeats,
    price,
  } = req.body;
  if (!title || !date || !seatCapacity || !price) {
    return res.status(400).json({
      message:
        "Please enter all the required fields (Title, Date, Seat Capacity, Price).",
    });
  }
  try {
    const result = await Event.create({
      title,
      description,
      category,
      venue,
      date,
      time,
      seatCapacity,
      bookedSeats,
      price,
    });
    res.status(201).json(result);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

// PUT /api/events/:id (Admin only)
const updateEvent = async (req, res) => {
  const { id } = req.params;
  const {
    title,
    description,
    category,
    venue,
    date,
    time,
    seatCapacity,
    bookedSeats,
    price,
  } = req.body;

  if (!id) {
    return res.status(400).json({ message: "Event ID is required!" });
  }
  try {
    const event = await Event.findById(id).exec();
    if (!event) {
      return res
        .status(404)
        .json({ message: `Event with ID ${id} is not found.` });
    }

    // Check seatCapacity cannot be less than bookedSeats
    if (seatCapacity !== undefined && seatCapacity < event.bookedSeats) {
      return res.status(400).json({
        message: "Seat capacity cannot be lower than booked seats!",
      });
    }

    if (title) event.title = title;
    if (description) event.description = description;
    if (category) event.category = category;
    if (venue) event.venue = venue;
    if (date) event.date = date;
    if (time) event.time = time;
    if (seatCapacity) event.seatCapacity = seatCapacity;
    if (bookedSeats) event.bookedSeats = bookedSeats;
    if (price) event.price = price;

    const result = await event.save();
    res.json(result);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

// DELETE /api/events/:id (Admin only)
const deleteEvent = async (req, res) => {
  const { id } = req.params;
  if (!id) {
    return res.status(400).json({ message: "Event ID is required!" });
  }
  try {
    const event = await Event.findById(id).exec();
    if (!event) {
      return res
        .status(404)
        .json({ message: `Event with ID ${id} is not found.` });
    }

    // Check if any bookings exist for this event
    const bookingExists = await Booking.exists({ event: id });
    if (bookingExists) {
      return res.status(400).json({
        message: "Cannot delete event with existing bookings.",
      });
    }

    const result = await Event.deleteOne({ _id: id });
    res.json({ message: "Event deleted", result });
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

module.exports = {
  getAllEvents,
  getEventById,
  createEvent,
  updateEvent,
  deleteEvent,
};
