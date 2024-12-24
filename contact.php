<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Aaradhya Consultancy Services</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <nav>
            <ul class="nav-list">
                <li class="nav-logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="Aaradhya Consultancy Services Logo" class="logo">
                    </a>
                </li>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="profile.php">Profile</a></li>
                <!-- <li class="nav-auth"><a href="logout.php">Logout</a></li> -->
            </ul>
        </nav>
    </header>

    <!-- Contact Content -->
    <section class="contact">
        <h1>Contact Us</h1>
        <p>If you have any questions or need further information, please feel free to contact us.</p>
        <p><strong>Address:</strong> Your Address Here</p>
        <p><strong>Phone:</strong> +91-XXXXXXXXXX</p>
        <p><strong>Email:</strong> info@aaradhya.com</p>

        <!-- Contact Form -->
        <form action="submit_form.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="tel" name="phone" placeholder="Your Phone Number">
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2024 Aaradhya Consultancy Services. All Rights Reserved.</p>
    </footer>
</body>
</html>
