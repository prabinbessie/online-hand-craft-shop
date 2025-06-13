# Online Hand Craft Shop 🛍️

Hello there! This is my college project for 4th semester - an online shop for traditional Nepali handicrafts. I built this as **Project 1** and honestly learned a ton while making it. It's not perfect, but I'm pretty proud of how it turned out!

## What's This About? 

So basically, I wanted to create a platform where people can buy authentic Nepali handicrafts online. You know how hard it is to find genuine handmade stuff these days? This site is supposed to solve that problem.

## What Can You Do Here? 

### If You're Shopping:
- Browse through different handicraft categories
- Search for specific items (the search actually works!)
- Add stuff to your cart and wishlist
- Pay using eSewa or just go with Cash on Delivery
- Check your order history
- Update your profile info

### If You're Admin:
- See how many sales you've made (feels good when numbers go up!)
- Add new products with pictures
- Manage orders and update payment status
- Handle customer messages and feedback
- Manage user accounts

## Tech Stack 

**Frontend Stuff:**
- HTML, CSS, JavaScript (the holy trinity!)
- Used Swiper.js for those cool image sliders
- Font Awesome for icons (because I can't draw to save my life)
- Made it responsive so it works on phones too

**Backend Magic:**
- PHP 
- MySQL for database 
- PDO for database connections 
- Sessions for keeping users logged in

**Security Features:**
- Password hashing with SHA1 
- Input sanitization
- Session management
- Basic role-based access

## How to Run This Thing 

### What You'll Need:
- A web server (I used MAMPP during development)
- PHP 7.4 or newer
- MySQL database

### Setup Steps:
1. **Clone or download** this repo
   ```bash
   git clone https://github.com/prabinbessie/online-hand-craft-shop.git
   ```

2. **Create a database** called `handcraft_shop` in your MySQL

3. **Import the database schema** (I should probably include this file, oops!)

4. **Update database connection** in `components/connect.php`:
   ```php
   $db_name = 'mysql:host=localhost;dbname=handcraft_shop';
   $user_name = 'root'; // or whatever your username is
   $user_password = ''; // your password here
   ```

5. **Make sure the uploaded_img folder has write permissions** 

6. **Open your browser** and go to `http://localhost/your-folder-name/home.php`

### Default Admin Login:
- Username: `admin`
- Password: `admin123`

(Please change this if you're actually using it somewhere!)

## File Structure 

```
online-hand-craft-shop/
├── admin/
│   ├── admin_accounts.php
│   ├── admin_login.php
│   ├── addproducts.php
│   ├── dashboard.php
│   ├── messages.php
│   ├── placed_orders.php
│   ├── products.php
│   ├── register_admin.php
│   ├── update_product.php
│   └── update_profile.php
├── components/
│   ├── connect.php
│   ├── admin_header.php
│   ├── user_header.php
│   ├── footer.php
│   ├── like_cart.php
│   └── admin_logout.php
├── css/
│   ├── style.css
│   └── admin_style.css
├── js/
│   ├── admin_script.js
│   ├── script.js
│   └── logic.js
├── images/
├── uploaded_img/
├── cart.php
├── home.php
├── shop.php
├── quick_view.php
├── checkout.php
├── payment.php
├── orders.php
├── like.php
├── contact.php
├── update_user.php
├── search_page.php
└── forgotp.php
```

## Database Structure 

I kept it pretty simple:

- **users** - Customer accounts
- **admins** - Admin accounts
- **products** - All the handicraft items
- **cart** - Shopping cart items
- **wishlist** - Saved items
- **orders** - Order details
- **messages** - Customer feedback

## Features 

1. **Dummy Payment  Integration** - Took me ages to get this working but it's pretty cool
2. **Image Upload System** - Users can upload product images and they actually show up!
3. **Responsive Design** - Works on Various Screen Ratios
4. **Search Functionality** - You can actually find products by name or category
5. **Admin Dashboard** - Has some basic analytics that look fancy

## Things I Learned 

- PHP isn't as scary as I thought (at first)
- SQL injection is a real thing and input sanitization is important
- File uploads can be tricky
- Making things responsive takes time but it's worth it
- User experience matters more than fancy features


## Screenshots 📸

*(I should probably add some screenshots here but I keep forgetting to take them)*

## Future Improvements 

If I had more time (and if this wasn't just a semester project), I'd love to add:
- Better security measures
- Email notifications
- Real payment options
- Product reviews and ratings
- Better admin analytics
- Mobile app maybe?

## Thanks 🙏



## License

This is just a college project, so feel free to use it however you want. Just don't blame me if something breaks! 😅

---

**Made with ❤️ (and lots of coffee) during my 4th semester Project-1**

*P.S. - If you're also a student working on something similar, feel free to reach out if you need help. We're all in this together!*
=======
# online-hand-craft-shop
e-commerce website  for my 4 th semester project 
>>>>>>> 7fe5a90a824eb9a4fe32bebaa8e2717ecc4fcc64
