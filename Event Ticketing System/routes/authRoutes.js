const express = require("express");
const router = express.Router();
const { handleNewUser, handleLogin } = require("../controller/authController");

router.route("/register").post(handleNewUser);
router.route("/login").post(handleLogin);

module.exports = router;
