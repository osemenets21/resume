require('dotenv').config(); 

const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');

const app = express();
const PORT = process.env.PORT || 3000;

// Дозволяє обробку даних форми
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Налаштовуємо транспортер Nodemailer
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: process.env.EMAIL_USER,
        pass: process.env.EMAIL_PASS,
    },
});

// Обробка POST-запиту з форми
app.post('/send-email', (req, res) => {
  const { name, email, message } = req.body;

  const mailOptions = {
    to: 'oleg.min.vin@gmail.com',
    subject: 'New Message from Contact Form',
    text: `Name: ${name}\nEmail: ${email}\nMessage: ${message}`,
  };

  // Відправляємо електронний лист
  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      return res.status(500).send(error.toString());
    }
    res.status(200).send('Email sent: ' + info.response);
  });
});

// Запускаємо сервер
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
