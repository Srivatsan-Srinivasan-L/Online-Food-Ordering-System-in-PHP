<?php
include "../../admin/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation</title>

    <!-- Tempus Dominus DateTime Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.2.7/dist/css/tempus-dominus.min.css"/>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
</head>
<body>

<!-- Reservation Start -->
<div class="container py-5">
    <div class="text-center mb-4">
        <h2>Book A Table Online</h2>
    </div>
    <form method="post" >
        <div class="alert alert-danger" id="errmsg" style="display: none;">❌ Invalid - try again later</div>
        <div class="alert alert-success" id="success" style="display: none;">✅ Booked successfully!</div>

        <div class="row g-3" id="contact">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    <label>Your Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    <label>Your Email</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating" id="datetimepicker">
                    <input type="text" name="date_time" class="form-control" id="datetime" placeholder="Date & Time" required>
                    <label for="datetime">Date & Time</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" name="people" required>
                        <option value="1">People 1</option>
                        <option value="2">People 2</option>
                        <option value="3">People 3</option>
                    </select>
                    <label>No of People</label>
                </div>
            </div>
              <div class="col-12">
                <div class="form-floating">
                    <input type="text" name="contact_no" class="form-control" placeholder="Your Contact" required>
                    <label>Your Contact No</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" name="message" placeholder="Special Request" style="height: 100px"></textarea>
                    <label>Special Request</label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100 py-3" type="submit" name="contact">Book Now</button>
            </div>
        </div>
    </form>
</div>
<!-- Reservation End -->

<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon@3/build/global/luxon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.2.7/dist/js/tempus-dominus.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        new tempusDominus.TempusDominus(document.getElementById('datetime'), {
            display: {
                components: {
                    calendar: true,
                    clock: true
                }
            },
            localization: {
                format: 'yyyy-MM-dd HH:mm:ss'
            }
        });
    });
</script>

</body>
</html>

<?php
if (isset($_POST["contact"])) {
    $date_raw = $_POST['date_time'];
    $date_mysql = date("Y-m-d H:i:s", strtotime($date_raw));

    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $people = intval($_POST['people']);
    $contact= mysqli_real_escape_string($link, $_POST['contact_no']);
    $message = mysqli_real_escape_string($link, $_POST['message']);

    // Insert reservation
    $insert = mysqli_query($link, "INSERT INTO contacts_usform(name, email, date_time, no_of_people, contact_no,message)
                                   VALUES ('$name', '$email', '$date_mysql', $people, $contact,'$message')");

    if ($insert) {
        echo "<script>document.getElementById('success').style.display = 'block';</script>";
        echo "<script>setTimeout(() => { window.location='#contact'; }, 2000);</script>";
    } else {
        echo "<script>document.getElementById('errmsg').style.display = 'block';</script>";
    }
}
?>
