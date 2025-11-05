# 📰 Laravel Blog System

A full-featured blog system built with **Laravel**, designed with scalability, performance, and user experience in mind.  
It includes user authentication, admin management, caching with Redis, notifications with Pusher, AJAX interactions, and SEO optimization.

---

## 📘 1. ERD Diagram
- **ERD :
🔗[View ERD on ERDPLUS ](https://erdplus.com/diagrams/87934)**
- **Database schema design:  
🔗 [View Schema on DrawSQL](https://drawsql.app/teams/admin-192/diagrams/blog)**

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


The **Admin Module** provides complete management functionality for the system, allowing authorized administrators to control users, posts, comments, categories, roles, and system settings.  
It also includes access control, activity monitoring, error handling, and real-time notifications.

---

## 🧩 Admin Structure

The admin panel is built with modular and secure architecture. Each feature is fully separated and accessible only to verified and active administrators.

### Main Features:
- Manage **Users**, **Posts**, **Comments**, **Categories**, **Admins**, and **Roles**.
- Change **status** (active/inactive) for any record.
- View, create, edit, and delete posts directly from the admin panel.
- Block users and remove inappropriate posts or comments.
- Manage site-wide **settings** and configuration.
- Receive **real-time notifications** for contact messages or user actions.

---

## 🔐 Role & Permission System

Roles are defined manually in a configuration file (`config/roles.php`) to ensure full control without external packages.  
Each role has specific permissions validated using **Laravel Gates**:

| Role | Permissions |
|------|--------------|
| **super_admin** | Full system access, including managing admins and roles. |
| **admin** | Manage users, posts, comments, and categories. |
| **editor** | Manage and edit only their own posts. |
| **moderator** | Manage comments and handle user reports. |

Access control is enforced via **Laravel Gates** to ensure each admin can only perform actions within their defined role.

---

## 🛡️ Admin Authentication & Activity Check

A custom middleware (`CheckAdminActive`) ensures that only **active** admins can access the dashboard.  
If an admin account is deactivated, they are automatically logged out and redirected with an appropriate message.

Inactive or unauthorized users are always redirected to the **admin login page** or shown an appropriate error message.

---

## 🧭 Route Fallback

A route fallback is implemented for admin routes.  
If a non-admin user tries to access an admin route or an invalid admin URL, they are redirected to the admin dashboard (if authenticated) or receive a **404 error** page.

---

## 🧠 Admin Management Modules

### 🧾 Categories
- View, create, edit, delete categories.
- Change category status (active/inactive).
- Used by both the public blog and post management module.

### 👥 Users
- View all registered users.
- Activate/deactivate users.
- Block specific users from accessing the system.
- View user details, posts, and comments.

### 📰 Posts
- View all posts across the system.
- Approve, deactivate, or delete posts.
- Create new posts or edit existing ones.
- Admins can only **edit or delete their own posts**.
- Super Admins can manage all posts.

### 💬 Comments
- View all user comments.
- Approve, hide, or delete inappropriate comments.
- Manage comment visibility status.
- Used for content moderation.

### 🧑‍💼 Admins
- View and manage all admin accounts.
- Activate/deactivate admin accounts.
- Super Admins can create new admins and assign roles.
- Admins **cannot delete or update their own profile** for security reasons.

### 🧱 Roles
- Defined in configuration file (`config/roles.php`).
- Managed entirely through code — no external permission package is used.
- Laravel Gates determine access level dynamically at runtime.

---

## ⚙️ Site Settings Management

Admins can update **global site settings** such as:
- Site title and description.
- Contact email and phone.
- Logo, favicon, and social media links.
- SEO metadata and configurations.

Settings are stored in the database and cached for better performance.

---

## 🧑‍💻 Admin Profile

### Profile Page
Each admin has a dedicated profile page displaying:
- Name, role, and status.
- Email and recent activity.
- Created posts and notifications.

### Profile Update Page
Admins can update personal details (name, password, etc.)  
Super Admins can also update their own access permissions.

> **Security Note:** Admins cannot delete or deactivate themselves.

---

## 📬 Contact Management

Admins can view and respond to messages submitted through the **Contact Us** page.  
Each new message generates a **real-time notification** using **Pusher** and appears instantly in the admin dashboard.

Admins can:
- View all contact messages.
- Mark messages as read/unread.
- Reply to users directly via email or system notifications.

---

## 🔔 Notifications System

The admin panel integrates **real-time notifications** using **Laravel Broadcasting** and **Pusher**.

### Features:
- Instant alerts for new contact messages or user actions.
- Notifications appear dynamically without page reload.
- Admins can:
    - View all notifications.
    - Delete individual notifications.
    - Delete all notifications at once.

---

## 🚫 Error Handling

Custom error pages are implemented for better UX and clarity:

| Error | Description |
|--------|--------------|
| **404 Not Found** | Displayed when an admin visits a non-existent page or route. |
| **403 Forbidden** | Displayed when an admin tries to access an action without permission. |

Both pages are fully styled and integrated into the admin layout.

---

## 💬 Real-Time Features

- **Real-Time Notifications** for new messages and activities.
- **Live Post and Comment Updates** using AJAX requests.
- **Instant Status Changes** (active/inactive) without full page reload.

---

## 🧰 Summary of Admin Capabilities

| Action | Admin | Super Admin |
|--------|--------|--------------|
| Manage Users | ✅ | ✅ |
| Manage Categories | ✅ | ✅ |
| Manage Posts | ✅ (own only) | ✅ (all) |
| Manage Comments | ✅ | ✅ |
| Manage Admins | ❌ | ✅ |
| Manage Roles | ❌ | ✅ |
| Update Settings | ✅ | ✅ |
| Access Notifications | ✅ | ✅ |
| Delete Notifications | ✅ | ✅ |
| Block Users | ✅ | ✅ |
| Delete Comments | ✅ | ✅ |
| Delete Posts | ✅ (own only) | ✅ (all) |

---

**This Admin Module ensures full control, scalability, and security across the entire Laravel blog system, following clean code and best practices.**

---



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
