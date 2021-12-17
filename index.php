<?php
require_once __DIR__."/inc/bootstrap.php";
require __DIR__.'/inc/FormValidator.php';
require __DIR__.'/inc/FormSubmission.php';

$errors = [];
$success_messages = [];
if (isset($_POST['submit'])) {
    $formData['first_name'] = trim(filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING));
    $formData['last_name'] = trim(filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING));
    $formData['email'] = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $formData['subject'] = trim(filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING));
    $formData['message'] = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING));

    $validation = new FormValidator($formData);
    $errors = $validation->validateForm();
    if (!$errors) {
        $submission = new FormSubmission($formData);
        $submission->store();
        flash('success', 'Thank you, Your message has been sent!');
        header("Location: index.php");
        exit;
    }
}
$cards = file_get_contents(__DIR__ . "/data/cards.json");
$cardsArray = json_decode($cards);

?>
<!DOCTYPE html>
<html lang="en">
    <?php include __DIR__.'/inc/sections/head.php'; ?>
  <body>
    <div class="nav-container">
        <?php include __DIR__.'/inc/sections/mobile_menu.php'; ?>
    </div>
    <div class="flex">
        <?php include __DIR__.'/inc/sections/menu.php'; ?>
      <main>
        <div id="menu-btn" class="menu">
          <span class="bar"></span>
        </div>
        <div class="header mb-12">
          <div class="overlay inset">
            <div class="container content text-center">
              <h1 class="text-lg md-text-xl md-text-2xl xl-text-3xl">
                My Name is Scott Hellings

              </h1>
              <div class=" text-base md-text-md md-text-lg">
                <div class="typewriter-box">
                  <span class=" text-base md-text-lg">&nbsp;</span>
                  <p class="typewriter text-base md-text-lg" id="typewriter"
                     data-msg="I Love To Code, I Love To Solve Problems, I Am A Web Developer"></p>
                </div>
              </div>
              <a href="#projects"
              ><span class="scroll-down">Scroll down</span></a
              >
            </div>
          </div>
        </div>

        <section id="projects" class="projects">
          <div class="container mb-16">
            <h2 class="heading text-xl ml-6 my-14">Projects</h2>
            <div class="row">
                <?php
                foreach ($cardsArray as $item) {
                    foreach ($item as $card) {
                        $title = $card->title;
                        $description = $card->description;
                        $link = $card->link;
                        $image = $card->image;
                       echo renderCard($title, $description, $link, $image);
                    }
                }
                ?>
            </div>
          </div>
        </section>

        <section id="contact" class="contact">
          <div class="container">
            <div class="row">
              <div class="col-12 md-col-8 ml-6 mb-10">
                <h2 class="text-xl my-14">Get in Touch</h2>
                <p class="contact-intro mb-8">
                  You can contact me in the following ways: <br /><br />
                  E-mail:
                  <a
                    class="link"
                    href="mailto:scott.hellings@netmatters-scs.com"
                  >scott.hellings@netmatters-scs.com
                  </a
                  >
                  <br /><br />
                  You can also use the following contact form, I will get back
                  to you in 2-3 days, however it may take longer if your message
                  was sent on a weekend or bank holiday.
                </p>

                  <?php
                  global $session;
                  $success_messages = $session->getFlashBag()->get('success');
                  foreach ($success_messages as $success) {
                      echo " <p class='success'>".$success." </p>";
                  }
                  ?>

              </div>
            </div>
            <div class="error-messages ml-6 mb-12">
              <ul class="error-messages-list">

              </ul>
            </div>


            <form id="contactForm" class="row"
                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'#contactForm'; ?>"
                  method="post">
              <div class="col-12 md-col-6 mb-15 md-mb-12">

                <label class="custom-field">
                  <input id="first_name"
                         type="text"
                         name="first_name"
                         placeholder="&nbsp;"
                         class=" <?php
                         if (isset($errors['first_name'])) {
                             echo "error";
                         }
                         ?>"
                         value="<?php
                         if (isset($_POST['first_name'])) {
                             echo htmlspecialchars($_POST['first_name']);
                         }
                         ?>"

                  />
                  <span class="placeholder">First Name</span>
                    <?php
                    if (isset($errors['first_name'])) {
                        echo "<small class='error-input'>${errors['first_name']}</small>";
                    }
                    ?>

                </label>
              </div>
              <div class="col-12 md-col-6 mb-15 md-mb-12">
                <label class="custom-field">
                  <input id="last_name"
                         name="last_name"
                         type="text"
                         placeholder="&nbsp;"
                         class=" <?php
                         if (isset($errors['last_name'])) {
                             echo "error";
                         }
                         ?>"
                         value="<?php
                         if (isset($_POST['last_name'])) {
                             echo htmlspecialchars($_POST['last_name']);
                         }
                         ?>"
                  />
                  <span class="placeholder">Last Name</span>
                    <?php
                    if (isset($errors['last_name'])) {
                        echo "<small class='error-input'>${errors['last_name']}</small>";
                    }
                    ?>

                </label>
              </div>
              <div class="col-12 md-col-6 mb-15 md-mb-12">
                <label class="custom-field">
                  <input id="email"
                         name="email"
                         type="text"
                         placeholder="&nbsp;"
                         class=" <?php
                         if (isset($errors['email'])) {
                             echo "error";
                         }
                         ?>"
                         value="<?php
                         if (isset($_POST['email'])) {
                             echo htmlspecialchars($_POST['email']);
                         }
                         ?>"
                  />
                  <span class="placeholder">Email</span>
                    <?php
                    if (isset($errors['email'])) {
                        echo "<small class='error-input'>${errors['email']}</small>";
                    }
                    ?>

                </label>
              </div>
              <div class="col-12 md-col-6 mb-15 md-mb-12">
                <label class="custom-field">
                  <input id="subject"
                         name="subject"
                         type="text"
                         placeholder="&nbsp;"
                         class=" <?php
                         if (isset($errors['subject'])) {
                             echo "error";
                         }
                         ?>"
                         value="<?php
                         if (isset($_POST['subject'])) {
                             echo htmlspecialchars($_POST['subject']);
                         }
                         ?>"
                  />
                  <span class="placeholder">Subject</span>
                    <?php
                    if (isset($errors['subject'])) {
                        echo "<small class='error-input'>${errors['subject']}</small>";
                    }
                    ?>

                </label>
              </div>
              <div class="col-12 mb-15">
                <label class="custom-field">
                  <textarea
                    name="message"
                    placeholder="Message..."
                    id="message"
                    rows="10"
                    class=" <?php
                    if (isset($errors['message'])) {
                        echo "error";
                    }
                    ?>"
                  ><?php
                      if (isset($_POST['message'])) {
                          echo htmlspecialchars($_POST['message']);
                      }
                      ?></textarea>
                    <?php
                    if (isset($errors['message'])) {
                        echo "<small class='error-input'>${errors['message']}</small>";
                    }
                    ?>

                </label>
              </div>
              <button
                type="submit"
                name="submit"
                class="button ml-6 px-10 text-md py-5 inline-block mb-14"
              >
                Submit
              </button>
            </form>
          </div>
          <div class="scroll-to-top">
            <a href="#"><span class="scroll-up">Scroll up</span></a>
          </div>
        </section>
      </main>
    </div>
          <?php include __DIR__. '/inc/sections/scripts.php'; ?>
  </body>
</html>
