// const express = require('express');
// const router = express.Router();
// const Joi = require('joi');

// // In-memory dummy data
// let users = [];
// let idCounter = 1;

// // Validation schema
// const userSchema = Joi.object({
//   username: Joi.string().min(3).required(),
//   email: Joi.string().email().required()
// });

// // POST /users
// router.post('/', (req, res) => {
//   const { error, value } = userSchema.validate(req.body);
//   if (error) {
//     return res.status(400).json({ error: error.details[0].message });
//   }

//   const newUser = { id: idCounter++, ...value };
//   users.push(newUser);
//   res.status(201).json(newUser);
// });

// // GET /users/:id
// router.get('/:id', (req, res) => {
//   const user = users.find(u => u.id === parseInt(req.params.id));
//   if (!user) {
//     return res.status(404).json({ error: "User not found" });
//   }
//   res.json(user);
// });

// module.exports = router;