# 📰 Laravel Blog System

A full-featured blog system built with **Laravel**, designed with scalability, performance, and user experience in mind.  
It includes user authentication, admin management, caching with Redis, notifications with Pusher, AJAX interactions, and SEO optimization.

---

## 📘 1. ERD Diagram
Database schema design:  
🔗 [View ERD on DrawSQL](https://drawsql.app/teams/admin-192/diagrams/blog)

---

## 🗄️ 2. Database Design
All relationships between posts, users, comments, categories, and tags are defined in the ERD above.

- **Users** have many **Posts**
- **Posts** belong to one **User**
- **Posts** belong to one **Category**
- **Posts** have many **Comments**
- **Posts** have many **Tags** (Many-to-Many)
- **Users** have many **Comments**
- **Admins** manage **Posts**, **Categories**, and **Users**

---

## ⚙️ 3. Laravel Setup

### Generate migrations and models:
```bash
php artisan make:model Post -mfs
php artisan make:model Comment -mfs
php artisan make:model Category -mfs
php artisan make:model Tag -mfs
php artisan make:model Admin -mfs
```

### Example Relationships

**Post Model**
```php
public function user() {
    return $this->belongsTo(User::class);
}

public function category() {
    return $this->belongsTo(Category::class);
}

public function comments() {
    return $this->hasMany(Comment::class);
}

public function tags() {
    return $this->belongsToMany(Tag::class);
}
```

**User Model**
```php
public function posts() {
    return $this->hasMany(Post::class);
}

public function comments() {
    return $this->hasMany(Comment::class);
}
```

---

## 🧰 4. Factories & Seeders
Use Laravel factories to seed fake data:
```bash
php artisan db:seed
```

Each factory generates realistic dummy data for testing.

---

## 🎨 5. Blade Templates
All Blade files are organized inside `/resources/views`.

- `home.blade.php` → Home page
- `contact.blade.php` → Contact page
- `posts/index.blade.php` → All posts with pagination
- `posts/show.blade.php` → Single post + comments (AJAX)
- `profile.blade.php` → User profile with posts and comments

---

## 🧠 6. Controllers and Routes

### Public Routes:
- `/` → Home page (latest posts)
- `/contact` → Contact page
- `/category/{slug}` → Posts by category
- `/post/{slug}` → Single post + comments
- `/search` → Search posts

### User Routes:
- `/profile` → Show user posts & comments
- `/posts/create` → Add new post
- `/posts/{id}/edit` → Update post
- `/posts/{id}/delete` → Delete post

### Admin Routes:
- `/admin/login` → Login page
- `/admin/home` → Dashboard
- `/admin/categories` → Manage categories

---

## 🔁 7. Redis Caching
Install Redis for caching:
```bash
composer require predis/predis
```

Used for:
- Caching posts list
- Caching categories
- Speeding up search queries

---

## 📧 8. Email Subscription
Users can subscribe to receive new post updates.

- Laravel `Mail` system handles the sending.
- Subscription emails stored in database.
- Sends notification when new post published.

---

## 🏷️ 9. Categories, Tags & Pagination
Each category and tag page displays all related posts with pagination:
```php
$posts = Category::whereSlug($slug)->first()->posts()->paginate(10);
```

---

## 💬 10. Comments System (AJAX)
Users can:
- View comments (loaded via AJAX)
- Add comments without reloading page
- Delete or edit their comments

Laravel controllers handle comment CRUD via AJAX requests.

---

## 🔍 11. Post Search
A simple search using:
```php
Post::where('title', 'like', "%{$query}%")->orWhere('content', 'like', "%{$query}%");
```

---

## 🔐 12. Authentication (UI Package)
Install Laravel UI for auth scaffolding:
```bash
composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev
```

Features:
- Login, Register, Reset Password
- **Remember Me** using Laravel’s `attempt()` method:
  ```php
  Auth::attempt(['email' => $email, 'password' => $password], $remember);
  ```
    - If `$remember` is `true`, Laravel saves a new `remember_token` in DB  
      and creates a secure cookie with user ID and token.
    - On next login, it verifies the token and regenerates a new one for security.

---

## 🖼️ 13. File Uploads
Each post can have images uploaded and saved to:
```
/storage/app/public/posts/
```

---

## 👤 14. User Profile
- Show user’s posts
- Show comments via AJAX
- Update or delete posts/images/comments

---

## 🔔 15. Notifications System
- Users get notified on new comments via Laravel Notifications.
- Notifications page handled via AJAX.
- Real-time updates powered by **Pusher**.

---

## 📡 16. Pusher Integration
```bash
composer require pusher/pusher-php-server
```

Configure your `.env`:
```
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

---

## 🌐 17. SEO Optimization
Each post includes:
- `<meta name="robots" content="index, follow">`
- `<meta name="description" content="{{ $post->description }}">`
- `<link rel="canonical" href="{{ url()->current() }}">`
- `<meta name="keywords" content="{{ implode(',', $post->tags->pluck('name')->toArray()) }}">`

---

## 🧑‍💼 18. Admin Panel
- Admin login with “remember me” support
- OTP system for password reset
- Notifications with **PHP Flasher (Noty)**
- Manage users, posts, comments, categories

> **Remember Me Logic for Admin:**
> - `Auth::attempt($credentials, $remember)` stores `remember_token` in DB.
> - Token and user ID saved in cookie.
> - On return, Laravel checks cookie token against DB.
> - If valid → logs in and regenerates token.
> - On logout → creates new token and invalidates old one.

---

## 🧾 19. Tools Used
- Laravel 11+
- MySQL
- Redis
- Bootstrap
- Pusher
- PHP Flasher (Noty , flash)
- AJAX / jQuery
- Laravel UI (for auth)

---

## 🚀 20. Installation Steps
```bash
git clone https://github.com/yourusername/blog.git
cd blog
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 💬 Summary
A complete blog platform built for both **users** and **admins**,  
focusing on performance, real-time interactions, and SEO-friendly structure.
