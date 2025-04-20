const express = require("express");
const router = express.Router();
const {
  GetAllStudents,
  GetStudent,
  CreateNewStudent,
  UpdateStudent,
  DeleteStudent,
} = require("../controller/studentController");

router
  .route("/")
  .get(GetAllStudents)
  .post(CreateNewStudent)
  .put(UpdateStudent)
  .delete(DeleteStudent);

router.route("/:id").get(GetStudent);

module.exports = router;
