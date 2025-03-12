<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/like_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Story Page</title>
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f8f8f8;
            color: #333;
        }

        section.blog-post {
            padding: 20px;
            background-color: #f8f8f8;
        }

        .blog-post-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .blog-post-img img {
            width: 100%;
            max-width: 800px; 
            height: auto;
            object-fit: cover;
            border-radius: 10px 10px 0 0; 
        }

        .blog-post-content {
            background-color: #fff;
            border-radius: 0 0 10px 10px; 
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden; 
            margin-top: -10px; 
        }

        .blog-post-title {
            font-size: 32px; 
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            padding: 20px; 
        }

        .blog-post-meta {
            color: #777;
            margin-bottom: 20px;
            padding: 0 20px; 
        }

        .blog-post-description {
            color: #555;
            line-height: 1.8; 
            margin-bottom: 20px;
            font-size: 18px; 
            padding: 0 20px; 
        }

        .shop-now-btn {
            display: inline-block;
            padding: 12px 24px; 
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px; 
            transition: background-color 0.3s ease;
            margin: 20px; /
        }

        .shop-now-btn:hover {
            background-color: #2980b9;
        }

        .additional-pictures {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            padding: 0 20px; /*  */
        }

        .additional-picture img {
            width: 48%; /* */
            border-radius: 8px;
            margin-bottom: 10px;
        }

        /* New Story Placeholder */
        .new-story {
            margin-top: 40px;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .new-story-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .new-story-description {
            color: #555;
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <section class="blog-post">
        <div class="blog-post-container">
            <!--  Post Con-->
            <div class="blog-post-img">
            <img src="images/fh.jpeg" alt="Hemp Products from Nepal">
            </div>
            <div class="blog-post-content">
                <h1 class="blog-post-title">Beauty of Nepali Hemp Products</h1>
                <p class="blog-post-meta">Published on June 12, 2023 by Himalayan Hemp Co.</p>
                <p class="blog-post-description">
                Hemp has been cultivated in Nepal for centuries, and the plant is deeply ingrained in the country’s culture and economy. 
                Hemp, also known as industrial hemp, is a strain of the cannabis plant that is grown specifically for industrial use.
                 It has a low THC content and is used for a wide range of applications, 
                including textiles, paper, construction materials, and biofuels.
                One of the most promising applications of hemp in Nepal is in the textile industry. The country has a long history of producing high-quality textiles, 
                and hemp is an excellent fiber for weaving. Hemp textiles are strong, durable, and resistant to mold and mildew, making them ideal for Nepal’s humid climate.
                History of Hemp in Nepal

                </p>
                <p class="blog-post-description">
                Hemp, also known as industrial hemp, has a long and rich history in Nepal. 
                This versatile plant has been used for various purposes, including fiber, medicine, and food, for thousands of years.
                 Historically, hemp has been an integral part of Nepalese culture and economy. 
                 The plant was first cultivated in the Himalayan region around 2,800 BC. 
                 Nepalese farmers have been growing hemp for centuries, and the plant has been used for various purposes, such as making clothing, rope, and paper.
                 </p>
                 <p class="blog-post-description">
                 <b> How Hemp Fiber Become raw material?</b>  </p>
                 <p class="blog-post-description">
                 Hemp fabric is made from the long strands of fiber that make up the stalk of the plant. 
                 These fibers are separated from the bark through a process called “retting.” 
                 These fibers are then spun together to produce a continuous thread that can be woven into a fabric.
                 </p>
                 <pre><p class="blog-post-description"><b> What are the Benefits of Hemp fiber?</b>   </p><p class="blog-post-description">• Naturally pest-resistant so can be grown pesticide-free.
• Durable and long lasting.
• 4x the durability of other natural fibers.
• Sustainable and renewable, high-yield crop.
• All-natural fiber.
• Absorbent.
• Eco-friendly & Bio degradable.
                </p></pre>
                <p class="blog-post-description">
               <b> Hemp Clothing in Nepal</b> </p>
                <p class="blog-post-description">
   Hemp clothing is becoming increasingly popular worldwide due to its eco-friendliness and durability. 
   Nepal, a country known for its rich cultural heritage and stunning natural landscapes, 
   is one of the leading producers of hemp clothing.
Hemp, a strain of the cannabis plant, is a sustainable and fast-growing 
crop that requires less water and pesticides compared to cotton. 
Hemp fibers are durable and become softer with each wash, making it an ideal choice for clothing.
 In Nepal, hemp clothing has been woven and worn for centuries. 
Clothing in Nepal is a leading hemp manufacturer & exporter for all kind of hemp products.
                </p>

                <div class="additional-pictures">
                    <div class="additional-picture">
                        <img src="images/hemp-travel-bag-1.jpg" alt="Additional Image 1">
                    </div>
                    <div class="additional-picture">
                        <img src="images/hemp_hat_40.jpg" alt="Additional Image 2">
                    </div>
                </div>

                <a href="shop.php" class="shop-now-btn">Shop Now</a>
            </div>
        </div>
    </section>

    <!-- New Story Placeholder -->
    <section class="blog-post">
        <div class="blog-post-container">
            <!-- Blog Post Content -->
            <div class="blog-post-img">
                <img src="images/800px_COLOURBOX18583720.jpg">
            </div>
            <div class="blog-post-content">
                <h1 class="blog-post-title">Keeping the Tradition Alive</h1>
                <p class="blog-post-meta">Published on June 12, 2023</p>
                <p class="blog-post-description">
                One of the things that Nepal can really be proud about is its traditional art of woodcarving. 
                You can stumble upon beautiful pieces of wood-carved art literally at any corner of Kathmandu. Struts, pillars and beams of the temples,
                 doors and windows of the common houses and office buildings, photo- and mirror frames, furniture - 
                 everything that is wooden is decorated either with finely carved figures or with intricate patterns.
The tradition of woodcarving in Nepal goes back to the 12 century. 
Since then, the carvers have achieved great skill by passing secrets from generation to 
generation and acquiring and sharing new techniques. 
In the Newar community, to which wood carvers mostly belong to, 
medieval texts are still kept - instructions and rules for wood carving, which are used in practice until now. 
For example, the masters still do not use any nails or glue to create their works.
                </p>
                <p class="blog-post-description">
                Whatever the reason thanks to it numerous wood carved erotic scenes decorate many temples in the Kathmandu valley. 
                They depict people in different positions, from ordinary to acrobatic, couples and trios, solo or with animals. 
                Sometimes one can see a carved scene that is impossible in real life, as for example, elephants in a human's position.
For those who is interested in woodcarving or simply admire this form of art and wish to take a piece home as a souvenir 
there are many incredibly beautiful examples on sale, from affordable to expensive.
                </p>

                <div class="additional-pictures">
                    <div class="additional-picture">
                        <img src="images/basantapur kumari ghar (6)a.jpg" >
                    </div>
                    <div class="additional-picture">
                        <img src="images/ppppp.jpg" >
                    </div>
                </div>

                <a href="shop.php" class="shop-now-btn">Shop Now</a>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>