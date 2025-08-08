# Laravel Blog System

A modern, feature-rich blog management system built with Laravel 12.x. This application provides a complete blogging platform with user management, content creation, and administration features.

## Features

### 🚀 Core Features
- **Post Management**: Create, edit, and manage blog posts with rich content
- **Category System**: Organize posts with hierarchical categories
- **Comment System**: Interactive commenting with moderation capabilities
- **User Management**: Multi-role user system (Users, Admins)
- **Contact System**: Contact form for visitor inquiries
- **Image Management**: Upload and manage images for posts
- **SEO Friendly**: Automatic slug generation for posts and categories
- **Responsive Design**: Mobile-friendly frontend interface

### 📝 Content Management
- **Rich Text Editing**: Full-featured content creation
- **Draft System**: Save and publish posts when ready
- **Comment Moderation**: Approve/reject comments with IP tracking
- **Category Management**: Organize content with categories
- **Image Galleries**: Multiple images per post support

### 👥 User Roles
- **Administrators**: Full system access and management
- **Regular Users**: Create posts and interact with content
- **Guest Users**: Browse content and submit contact forms

### 🎨 Frontend Features
- **Modern UI**: Clean, responsive design
- **Navigation**: Intuitive top navigation and branding
- **Contact Page**: Dedicated contact form for inquiries
- **Mobile Responsive**: Optimized for all device sizes

## Tech Stack

- **Framework**: Laravel 12.x
- **PHP Version**: 8.2+
- **Database**: MySQL/PostgreSQL/SQLite support
- **Frontend**: Blade Templates with modern CSS/JS
- **Authentication**: Laravel's built-in authentication
- **Slugs**: Eloquent Sluggable for SEO-friendly URLs
- **Testing**: Pest PHP for modern testing

## Database Schema

The application includes the following main entities:

- **Posts**: Blog articles with title, content, slug, and status
- **Categories**: Content organization and classification
- **Comments**: User feedback and discussions
- **Users**: Registered user accounts
- **Admins**: Administrative user accounts
- **Images**: Media management for posts
- **Contacts**: Visitor inquiry management
- **Settings**: Application configuration

## Installation

1. **Clone the repository**
   ```bash
   git clone <your-repository-url>
   cd blog
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   # Configure your database settings in .env
   php artisan migrate
   php artisan db:seed
   ```

5. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

6. **Start the application**
   ```bash
   php artisan serve
   ```

## Development

### Running the application
```bash
# Start all services (server, queue, and vite)
composer run dev
```

### Testing
```bash
composer run test
```

### Code Style
The project uses Laravel Pint for code formatting:
```bash
./vendor/bin/pint
```

## Project Structure

```
blog/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/            # Database seeders
│   └── factories/          # Model factories
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
└── routes/
    └── web.php             # Web routes
```

## Key Models

- **Post**: Blog articles with categories, comments, and images
- **Category**: Content classification system
- **Comment**: User-generated discussions
- **User**: Registered users and authors
- **Admin**: Administrative users
- **Contact**: Visitor inquiries
- **Image**: Media management

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## Security

If you discover any security-related issues, please email the maintainer instead of using the issue tracker.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
