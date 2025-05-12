<?php
include "connect.php";
session_start();

if (isset($_POST["add"])) {
    try {
        // Prepare an insert statement
        $stmt = $conn->prepare("INSERT INTO `order` (name, city, state_id, phone_number, address, amount) VALUES (:name, :city, :state_id, :phone_number, :address, :amount)");

        // Bind parameters
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':city', $_POST['city']);
        $stmt->bindParam(':state_id', $_POST['state_id']);
        $stmt->bindParam(':phone_number', $_POST['phone_number']);
        $stmt->bindParam(':address', $_POST['address']);
        $stmt->bindParam(':amount', $_POST['amount']);

        // Attempt to execute the statement
        if ($stmt->execute()) {
            echo '<div class="alert alert-success alert-pink" role="alert">Order placed successfully</div>';
        } else {
            echo '<div class="alert alert-danger alert-pink" role="alert">Error updating order</div>';
        }
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lash me </title>
    <link rel="icon" type="image/x-icon" href="/images/logo.png">

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=PT+Serif:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    .alert-pink {
        background-color: #ff7eb9;
        /* Pink background */
        border-color: #ff7eb9;
        /* Pink border */
        color: white;
        /* White text */
    }
</style>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid sticky-top px-0">
        <div class="container-fluid topbar d-none d-lg-block">
            <div class="container px-0">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <img src="images/logo.png" alt="logo" style="width: 50px; height: 50px;">
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex align-items-center justify-content-end">
                            <a class="me-4 text-light"><i class="fas fa-phone-alt text-primary me-2"></i>0751 169 6440</a>
                            <a href="https://www.facebook.com/share/4NDkevMAEXE7tnRG/?mibextid=WC7FNe" class="me-3 btn-square border rounded-circle nav-fill"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://wa.me/9647511696440" class="me-3 btn-square border rounded-circle nav-fill"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://www.instagram.com/llashes2023?igsh=djhmNjhtYzY3ZXEy&utm_source=qr" class="me-3 btn-square border rounded-circle nav-fill"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/@lash.me.up.lash.m?_t=8l2Pv7mKG29&_r=1" class="me-3 btn-square border rounded-circle nav-fill"><i class="fab fa-tiktok"></i></a>
                            <a href="https://t.snapchat.com/639u9z99" class="btn-square border rounded-circle nav-fill"><i class="fab fa-snapchat"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-light">
            <div class="container px-0">
                <nav class="navbar navbar-light navbar-expand-xl">
                    <!-- Navbar content -->
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->







    <!-- Carousel Start -->
    <div class="container-fluid carousel-header px-0" style="background-color: pink;">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">

                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-primary text-uppercase mb-3">Benifts</h4>
                            <h1 class="display-1 text-capitalize text-dark mb-3">Biotin</h1>
                            <p class="mx-md-5 fs-4 px-4 mb-5 text-dark">It helps strengthen eyelashes and stimulate
                                their growth.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-primary text-uppercase mb-3">Benifts</h4>
                            <h1 class="display-2 text-capitalize text-dark mb-3">Panthenol (Vitamin B5)</h1>
                            <p class="mx-md-5 fs-4 px-5 mb-5 text-dark">Helps moisturize and strengthen eyelashes.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-primary text-uppercase mb-3">Benifts</h4>
                            <h1 class="display-3 text-capitalize text-dark">Omegas and collagen</h1>
                            <p class="mx-md-5 fs-4 px-5 mb-5 text-dark">It is considered a nutritional supplement that
                                helps promote hair growth, including eyelashes.</p>
                        </div>
                    </div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->




    <!-- how to use Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="video">
                        <img src="images/about-1.jpg" class="img-fluid rounded" alt="">
                        <div class="position-absolute rounded border-5 border-top border-start border-white" style="bottom: 0; right: 0;;">
                            <img src="img/about-2.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h2 style="text-align: center; font-size: 18px; color: #ff7eb9; border-color: pink;">
                        The German Lash Me processor 🇩🇪 contains combined ingredients aimed at promoting the growth and health of eyelashes and strengthening them with their germination to increase density and lengthen them in a short time . You can use it for eyebrows as well. It will give amazing results in a short time. some of it

                    </h2>
                    <p class="fs-4 text-uppercase text-primary">How to use</p>
                    <p class="mb-4">Apply an appropriate amount of treatment on the entire eyelashes, from the lash line
                        to the tip. Use it once a day. To get a faster result, use it twice a day. It can be applied
                        half an hour before applying mascara to keep the eyelashes from drying out
                    </p>

                    <p class="my-4">During the first 20 days, it is preferable not to use mascara
                        For the first 10 days, use it once
                        The amount used is very small because it is concentrated
                        Please focus on the eyelid when applying the treatment.
                    </p>
                    <p class="mb-4">The most important area that the treatment should reach is the eyelid and the lash
                        line
                        Use at night
                        It is preferable not to be exposed to the sun while using it
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="far fa-eye fa-3x text-primary"></i>
                            <div class="ms-4">
                                <h5 class="mb-2">Vitamins and minerals</h5>
                                <p class="mb-0">They can help improve the color of eyelashes and make them look more
                                    natural.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">

                            <div class="ms-4">
                                <h5 class="mb-2">Special </h5>
                                <p class="mb-0">Natural oils and rose and pearl extracts, which are used to moisturize,
                                    strengthen and curl eyelashes</p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <br>
            <hr>
            <p style="text-align: center;">Remember to always read the portions of emerging products that are suitable
                for the skin and do not include any disease or contributor. The ingredients of eyelash extension
                products may vary from product to end, so it is always best to know what the products contain for
                healthy results ❤️</p>
        </div>

    </div>
    <!-- About End -->

    <!-- Appointment Start -->
    <div class="container-fluid appointment py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="appointment-form p-5">
                        <h3 style="color: #DCCAF2; text-align: center;">Made in Germany
                            Online shipping all over Iraq</h3>
                        <p class="fs-4 text-uppercase " style="color: #eb9bc7;">Make an order</p>
                        <h3 style="color: #DCCAF2;">Product price 25 thousand dinar
                            <h4 style="color: #DCCAF2;">Shipping price 2 thousand Baghdad </h4>
                            <h5 style="color: #DCCAF2;">3 thousand other cities </h5>
                        </h3>
                        <h1 class="display-4 mb-4 text-white">Order informations</h1>
                        <form method="post">
                            <div class="row gy-3 gx-4">
                                <div class="col-lg-6">
                                    <input name="name" type="text" class="form-control py-3 border-white bg-transparent text-white" placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input name="city" type="text" class="form-control py-3 border-white bg-transparent text-white" placeholder="City" required>
                                </div>

                                <div class="col-lg-6">
                                    <select id="state_id" name="state_id" class="form-select py-3 border-white bg-transparent" aria-label="Default select example">
                                        <?php
                                        $sql = "SELECT id, state_name , delivery_cost FROM state";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['state_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <input name="phone_number" type="text" class="form-control py-3 border-white bg-transparent text-white" placeholder="Phone Number" required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="form-control border-white bg-transparent text-white" name="address" id="area-text" cols="30" rows="5" placeholder="Address" required></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <input id="amount" min="0" name="amount" type="number" class="form-control py-3 border-white bg-transparent text-white" placeholder="Amount" required>
                                </div>
                                <div class="col-lg-6">
                                    <input id="total" min="0" type="number" class="form-control py-3 border-white bg-transparent text-white" placeholder="Total" disabled>
                                </div>
                                <div class="col-lg-12">
                                    <button name="add" class="btn  btn-primary-outline-0 w-100 py-3 px-5" style="background-color:#eb9bc7 ;">SUBMIT NOW</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Counter Start -->
    <div class="container-fluid counter-section">
        <div class="container py-5">
            <div class="row g-5 justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="counter-item p-5">
                        <div class="counter-content bg-white p-4">
                            <i class="fas fa-globe fa-5x text-primary mb-3"></i>
                            <h5 class="text-primary">Worldwide Clients</h5>
                            <div class="svg-img">
                                <svg width="100" height="50">
                                    <polygon points="55, 10 85, 55 25, 55 25," style="fill: #DCCAF2;" />
                                </svg>
                            </div>
                        </div>
                        <div class="counter-quantity">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">379</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="counter-item p-5">
                        <div class="counter-content bg-white p-4">
                            <i class="fas fa-spa fa-5x text-primary mb-3"></i>
                            <h5 class="text-primary">Approved Feedbacks</h5>
                            <div class="svg-img">
                                <svg width="100" height="50">
                                    <polygon points="55, 10 85, 55 25, 55 25," style="fill: #DCCAF2;" />
                                </svg>
                            </div>
                        </div>
                        <div class="counter-quantity">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">829</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="counter-item p-5">
                        <div class="counter-content bg-white p-4">
                            <i class="fas fa-users fa-5x text-primary mb-3"></i>
                            <h5 class="text-primary">Happy Customers</h5>
                            <div class="svg-img">
                                <svg width="100" height="50">
                                    <polygon points="55, 10 85, 55 25, 55 25," style="fill: #DCCAF2;" />
                                </svg>
                            </div>
                        </div>
                        <div class="counter-quantity">
                            <span class="text-white fs-2 fw-bold" data-toggle="counter-up">713</span>
                            <span class="h1 fw-bold text-white">+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter End -->



    <!-- Gallery Start -->
    <div class="container-fluid gallery py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <p class="fs-4 text-uppercase text-primary">Our Gallery</p>
                <h1 class="display-4 mb-4">Let's See Our Gallery</h1>
            </div>
            <div class="tab-class text-center">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-1.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-1.jpg" data-lightbox="Gallary-1" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-2.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-2.jpg" data-lightbox="Gallary-2" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-3.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-3.jpg" data-lightbox="Gallary-3" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-4.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-4.jpg" data-lightbox="Gallary-4" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-5.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-5.jpg" data-lightbox="Gallary-5" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-6.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-6.jpg" data-lightbox="Gallary-6" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-7.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-7.jpg" data-lightbox="Gallary-7" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="gallery-img">
                                            <img class="img-fluid rounded w-100" style="height: 40rem;" src="images/gallary-8.jpg" alt="">
                                            <div class="gallery-overlay p-4">
                                                <h4 class="text-secondary">Lash me</h4>
                                            </div>
                                            <div class="search-icon">
                                                <a href="images/gallary-8.jpg" data-lightbox="Gallary-8" class="my-auto"><i class="fas fa-search-plus btn-primary btn-primary-outline-0 rounded-circle p-3"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- gallery End -->







    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <p class="fs-4 text-uppercase text-primary">Testimonial</p>
                <h1 class="display-4 mb-4 text-white">What Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item rounded p-4">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex flex-column mx-auto">

                                <div class="text-center" style="margin-top: 100px;">
                                    <h4 class="mb-2 text-primary">Maria Ahmed</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="position-absolute" style="top: 20px; right: 25px;">
                                <i class="fa fa-quote-right fa-2x text-secondary"></i>
                            </div>
                            <div class="testimonial-content">
                                <div class="d-flex mb-4">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                                <p class="fs-5 mb-0 text-white">I've been using this eyelash serum for a few weeks now,
                                    and I can already see a noticeable difference in the length and thickness of my
                                    lashes. They look fuller and more defined than ever before. I'm really impressed
                                    with the results
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item rounded p-4">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex flex-column mx-auto">

                                <div class="text-center" style="margin-top: 100px;">
                                    <h4 class="mb-2 text-primary">Fatima Jubouri</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="position-absolute" style="top: 20px; right: 25px;">
                                <i class="fa fa-quote-right fa-2x text-secondary"></i>
                            </div>
                            <div class="testimonial-content">
                                <div class="d-flex mb-4">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="fs-5 mb-0 text-white">I was skeptical at first, but after using this mascara
                                    for a while, I'm hooked! It not only adds volume and length to my lashes but also
                                    lasts all day without smudging or flaking. Plus, it's easy to remove at the end of
                                    the day. Highly recommend!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item rounded p-4">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex flex-column mx-auto">
                                <div class="text-center" style="margin-top: 100px;">
                                    <h4 class="mb-2 text-primary">Leila farouk</h4>

                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="position-absolute" style="top: 20px; right: 25px;">
                                <i class="fa fa-quote-right fa-2x text-secondary"></i>
                            </div>
                            <div class="testimonial-content">
                                <div class="d-flex mb-4">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                                <p class="fs-5 mb-0 text-white">This false eyelash set is a game-changer! The lashes are
                                    so lightweight and comfortable to wear, yet they make such a dramatic difference to
                                    my overall look. Whether it's for a special occasion or just everyday wear, these
                                    lashes give me that extra boost of confidence. Love them!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-12">
                    <div class="row g-4">



                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center p-4 rounded-bottom" style="background-color: #eb9bc7;">
                        <h4 class="text-white fw-bold">Follow Us</h4>
                        
                        <div class="d-flex align-items-center justify-content-center" style="margin-bottom:15px;">
                            <a href="https://www.facebook.com/share/4NDkevMAEXE7tnRG/?mibextid=WC7FNe" class="btn btn-light btn-light-outline-0 btn-square rounded-circle me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://wa.me/9647511696440" class="btn btn-light btn-light-outline-0 btn-square rounded-circle me-3"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://www.instagram.com/llashes2023?igsh=djhmNjhtYzY3ZXEy&utm_source=qr" class="btn btn-light btn-light-outline-0 btn-square rounded-circle me-3"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/@lash.me.up.lash.m?_t=8l2Pv7mKG29&_r=1" class="btn btn-light btn-light-outline-0 btn-square rounded-circle"><i class="fab fa-tiktok"></i></a>
                            <a href="https://t.snapchat.com/639u9z99" class="btn btn-light btn-light-outline-0 btn-square rounded-circle" style="margin-left: 10px;"><i class="fab fa-snapchat"></i></a>

                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="login.php" class="btn btn-light btn-light-outline-0 btn-square rounded-circle position-relative">
                                <img src="images/logo.png" alt="logo" style="width: 40px; height: 40px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Contact End -->










    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        document.getElementById('amount').addEventListener('input', calculateTotal);
        document.getElementById('state_id').addEventListener('change', calculateTotal);

        function calculateTotal() {
            // Get the state ID and amount entered by the user
            var state_id = document.getElementById('state_id').value;
            var amount = document.getElementById('amount').value;

            // Create an AJAX object
            var xhttp = new XMLHttpRequest();

            // Define the function to handle the AJAX response
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse the delivery cost from the response
                    var deliveryCost = parseFloat(this.responseText);

                    // Calculate the total cost
                    var total = parseFloat(amount) * 25000 + deliveryCost;

                    // Update the total input field with the calculated total cost
                    document.getElementById('total').value = total;
                }
            };

            // Open a POST request to cost.php
            xhttp.open("POST", "cost.php", true);

            // Set the content type header
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Send the AJAX request with the state ID and amount as parameters
            xhttp.send("state_id=" + state_id + "&amount=" + amount);
        }






        document.getElementById('amount').addEventListener('keyup', total);

        function total() {
            var amount = document.getElementById('amount').value;
            var cost = document.getElementById('cost').value;
            document.getElementById('total').value = amount * 25000 + cost;
        }
    </script>

</body>

</html>