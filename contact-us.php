<?php
// Apply a page-specific body class so the shared head include can load contact-page styles.
$pageClass = 'mc-contact-body';
// Reuse the central connection helper to obtain a configured PDO instance.
require __DIR__ . '/includes/connection.php';

// Persist form values between submissions so users do not lose their input after validation errors.
$formData = [
    'name' => '',
    'company' => '',
    'email' => '',
    'telephone' => '',
    'message' => '',
    'marketing_preference' => false,
];
$errors = [];
$successMessage = '';

// Validate and process submissions only when the contact form is posted.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['name'] = trim($_POST['name'] ?? '');
    $formData['company'] = trim($_POST['company'] ?? '');
    $formData['email'] = trim($_POST['email'] ?? '');
    $formData['telephone'] = trim($_POST['telephone'] ?? '');
    $formData['message'] = trim($_POST['message'] ?? '');
    $formData['marketing_preference'] = isset($_POST['marketing_preference']);

    if ($formData['name'] === '') {
        $errors['name'] = 'Please enter your name.';
    }

    if ($formData['company'] === '') {
        $errors['company'] = 'Please enter your company name.';
    }

    if ($formData['email'] === '') {
        $errors['email'] = 'Please enter your email address.';
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if ($formData['telephone'] === '') {
        $errors['telephone'] = 'Please enter your telephone number.';
    }

    if ($formData['message'] === '') {
        $errors['message'] = 'Please enter your message.';
    }

    // Proceed to storage only if all required fields have passed server-side validation.
    if (empty($errors)) {
        try {
            // Create the enquiries table on demand so the form can run in a fresh local environment.
            $pdo->exec(
                "CREATE TABLE IF NOT EXISTS enquiries (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(150) NOT NULL,
                    company VARCHAR(150) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    telephone VARCHAR(50) NOT NULL,
                    message TEXT NOT NULL,
                    marketing_preference TINYINT(1) NOT NULL DEFAULT 0,
                    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )"
            );

            $insertEnquiry = $pdo->prepare(
                "INSERT INTO enquiries (name, company, email, telephone, message, marketing_preference)
                VALUES (:name, :company, :email, :telephone, :message, :marketing_preference)"
            );

            // Save the enquiry payload and normalise checkbox state to 0/1 for MySQL storage.
            $insertEnquiry->execute([
                ':name' => $formData['name'],
                ':company' => $formData['company'],
                ':email' => $formData['email'],
                ':telephone' => $formData['telephone'],
                ':message' => $formData['message'],
                ':marketing_preference' => $formData['marketing_preference'] ? 1 : 0,
            ]);

            $successMessage = 'Thanks for your enquiry. Your message has been sent successfully.';
            // Reset the form after success to avoid showing stale details on refresh.
            $formData = [
                'name' => '',
                'company' => '',
                'email' => '',
                'telephone' => '',
                'message' => '',
                'marketing_preference' => false,
            ];
        } catch (PDOException $exception) {
            // Show a safe generic error instead of exposing low-level database failure details.
            $errors['form'] = 'We could not submit your enquiry right now. Please try again later.';
        }
    }
}
?>
<!-- Pull in shared head, consent modal, sidebar, and header fragments used across the site. -->
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/cookies.php'; ?>
<?php include __DIR__ . '/includes/menu.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>

<main class="mc-contact-page">
    <section class="mc-contact-breadcrumb d-none d-sm-block">
        <div class="mc-container">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>Our Offices</span>
        </div>
    </section>

    <section class="mc-contact-hero">
        <div class="mc-container">
            <h1>Let's Connect</h1>
            <p>Our team are based in offices across East Anglia.</p>
            <p class="mc-contact-hours">Business Hours: Mon to Fri 07:00 - 18:00</p>
            <div class="mc-contact-support-accordion" data-accordion>
                <button class="mc-contact-support-btn" type="button" aria-expanded="false" aria-controls="mc-out-of-hours-panel" id="mc-out-of-hours-trigger">
                    OUT OF HOURS IT SUPPORT
                </button>
                <div class="mc-contact-support-panel" id="mc-out-of-hours-panel" role="region" aria-labelledby="mc-out-of-hours-trigger" hidden>
                    <p>If your IT issue cannot wait until standard business hours, our out of hours engineers are available:</p>
                    <ul>
                        <li>Monday - Friday: 18:00 - 22:00</li>
                        <li>Saturday: 08:00 - 16:00</li>
                        <li>Sunday: 10:00 - 18:00</li>
                    </ul>
                    <p>Call us on <a href="tel:01603515283">01603 51 52 83</a>.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mc-contact-offices">
        <div class="mc-container mc-contact-grid">
            <article class="mc-office-card">
                <img src="img/contact-us/wymondham-new.jpg" alt="Wymondham Office">
                <div class="mc-office-card-content">
                    <h2>Wymondham Office</h2>
                    <p>Unit 15,<br>Penfold Drive,<br>Gateway 11 Business Park,<br>Wymondham, Norfolk,<br>NR18 0WZ</p>
                    <a class="mc-office-phone" href="tel:01603515283">01603 51 52 83</a>
                    <a class="mc-office-view-more" href="#">VIEW MORE</a>
                </div>
            </article>

            <article class="mc-office-card">
                <img src="img/contact-us/cambridge-new.jpg" alt="Cambridge Office">
                <div class="mc-office-card-content">
                    <h2>Cambridge Office</h2>
                    <p>Unit 1.13,<br>St John's Innovation Centre,<br>Cowley Road, Milton,<br>Cambridge,<br>CB4 0WS</p>
                    <a class="mc-office-phone" href="tel:01223375772">01223 37 57 72</a>
                    <a class="mc-office-view-more" href="#">VIEW MORE</a>
                </div>
            </article>

            <article class="mc-office-card">
                <img src="img/contact-us/yarmouth-new.jpg" alt="Great Yarmouth Office">
                <div class="mc-office-card-content">
                    <h2>Great Yarmouth Office</h2>
                    <p>Suite F23,<br>Beacon Innovation Centre,<br>Beacon Park, Gorleston,<br>Great Yarmouth, Norfolk,<br>NR31 7RA</p>
                    <a class="mc-office-phone" href="tel:01493603204">01493 60 32 04</a>
                    <a class="mc-office-view-more" href="#">VIEW MORE</a>
                </div>
            </article>
        </div>
    </section>

    <section class="mc-contact-form-wrap" id="enquiry-form">
        <div class="mc-container">
            <h2>Let's Discuss Your Project</h2>
            <p>Connect with us, and we'll call to find out how we can help.</p>

            <?php if ($successMessage !== ''): ?>
                <p class="mc-form-message mc-form-message-success" role="status"><?php echo htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <?php if (!empty($errors['form'])): ?>
                <p class="mc-form-message mc-form-message-error" role="alert"><?php echo htmlspecialchars($errors['form'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <form class="mc-contact-form" action="contact-us.php#enquiry-form" method="post" novalidate id="mc-contact-form">
                <div class="mc-contact-form-image">
                    <img src="img/contact-us/contact-new.png" alt="Let's Discuss Your Project">
                </div>

                <div class="mc-contact-form-fields">
                    <h3>Get In Touch</h3>
                    <div class="mc-contact-fields-row">
                        <label>Your Name <span>*</span>
                            <input type="text" name="name" required value="<?php echo htmlspecialchars($formData['name'], ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo isset($errors['name']) ? 'mc-field-error' : ''; ?>">
                            <small class="mc-input-error"><?php echo isset($errors['name']) ? htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') : ''; ?></small>
                        </label>
                        <label>Company Name <span>*</span>
                            <input type="text" name="company" required value="<?php echo htmlspecialchars($formData['company'], ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo isset($errors['company']) ? 'mc-field-error' : ''; ?>">
                            <small class="mc-input-error"><?php echo isset($errors['company']) ? htmlspecialchars($errors['company'], ENT_QUOTES, 'UTF-8') : ''; ?></small>
                        </label>
                        <label>Your Email <span>*</span>
                            <input type="email" name="email" required value="<?php echo htmlspecialchars($formData['email'], ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo isset($errors['email']) ? 'mc-field-error' : ''; ?>">
                            <small class="mc-input-error"><?php echo isset($errors['email']) ? htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') : ''; ?></small>
                        </label>
                        <label>Your Telephone Number <span>*</span>
                            <input type="tel" name="telephone" required value="<?php echo htmlspecialchars($formData['telephone'], ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo isset($errors['telephone']) ? 'mc-field-error' : ''; ?>">
                            <small class="mc-input-error"><?php echo isset($errors['telephone']) ? htmlspecialchars($errors['telephone'], ENT_QUOTES, 'UTF-8') : ''; ?></small>
                        </label>
                    </div>

                    <label>Message <span>*</span>
                        <textarea name="message" rows="3" required class="<?php echo isset($errors['message']) ? 'mc-field-error' : ''; ?>"><?php echo htmlspecialchars($formData['message'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <small class="mc-input-error"><?php echo isset($errors['message']) ? htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8') : ''; ?></small>
                    </label>

                    <label class="mc-contact-checkbox">
                        <input type="checkbox" name="marketing_preference" <?php echo $formData['marketing_preference'] ? 'checked' : ''; ?>>
                        <span>
                            Please tick this box if you wish to receive marketing information from us. Please see our
                            <a href="#">Privacy Policy</a> for more information on how we keep your data safe.
                        </span>
                    </label>
                    <p class="mc-contact-recaptcha">
                        This site is protected by reCAPTCHA and the Google <a href="#">Privacy Policy</a> and
                        <a href="#">Terms of Service</a> apply.
                    </p>

                    <div class="mc-contact-actions">
                        <button type="submit">Submit</button>
                        <small><span>*</span> Fields Required</small>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
