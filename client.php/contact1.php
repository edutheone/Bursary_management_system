<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .contact {
    padding: 60px 40px;
    text-align: center;
}

.contact form {
    max-width: 500px;
    margin: auto;
}

.contact input,
.contact textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}

.contact button {
    padding: 10px 20px;
    background: #00bcd4;
    border: none;
    color: white;
}

    </style>
</head>
<body>
    <body>
        <section class="contact" id="contact">
    <h2>Send inquirely</h2>

    <form method="POST" action="contact.php">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="phone" placeholder="Your phone no" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send me message</button>
        <button type="submit">whatsapp us</button>
    </form>
</section>
    </body>
</body>
</html>