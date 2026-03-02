# 📁 Struktur Project DINAMIKA Forum

Dokumentasi lengkap struktur folder dan file dalam project.

## 📂 Root Directory

```
dinamika-forum/
├── app/                    # Aplikasi logic
├── bootstrap/              # Bootstrap framework
├── config/                 # Configuration files
├── database/               # Database migrations, seeds, factories
├── public/                 # Public assets (entry point)
├── resources/              # Views, raw assets
├── routes/                 # Application routes
├── storage/                # Logs, cache, uploads
├── tests/                  # Testing files
├── vendor/                 # Composer dependencies
├── .env                    # Environment configuration
├── .env.example            # Environment template
├── .gitignore              # Git ignore rules
├── artisan                 # Artisan CLI
├── composer.json           # PHP dependencies
├── package.json            # Node dependencies
├── vite.config.js          # Vite configuration
├── tailwind.config.js      # TailwindCSS configuration
└── README.md               # Project documentation
```

---

## 🗂️ Detailed Structure

### 📁 `app/`

Core aplikasi Laravel.

```
app/
├── Console/                       # Artisan commands
├── Exceptions/                    # Exception handlers
├── Http/
│   ├── Controllers/               # Controllers
│   │   ├── Auth/                  # Authentication controllers
│   │   │   └── GoogleAuthController.php
│   │   ├── CommentController.php
│   │   ├── DiscussionController.php
│   │   ├── HomeController.php
│   │   ├── ProfileController.php
│   │   └── ReactionController.php
│   ├── Middleware/                # Middlewares
│   └── Requests/                  # Form requests
├── Models/                        # Eloquent models
│   ├── Comment.php
│   ├── Discussion.php
│   ├── Reaction.php
│   ├── Tag.php
│   └── User.php
├── Policies/                      # Authorization policies
│   ├── CommentPolicy.php
│   └── DiscussionPolicy.php
└── Providers/                     # Service providers
    ├── AppServiceProvider.php
    ├── AuthServiceProvider.php
    └── RouteServiceProvider.php
```

**Key Files:**

- **Controllers**: Handle HTTP requests dan business logic
- **Models**: Database ORM models dengan relationships
- **Policies**: Authorization logic untuk CRUD operations
- **Providers**: Service container bindings

---

### 📁 `database/`

Database-related files.

```
database/
├── factories/                     # Model factories untuk testing
│   ├── DiscussionFactory.php
│   └── UserFactory.php
├── migrations/                    # Database migrations
│   ├── 2024_01_01_000001_create_users_table.php
│   ├── 2024_01_01_000002_create_password_reset_tokens_table.php
│   ├── 2024_01_01_000003_create_failed_jobs_table.php
│   ├── 2024_01_01_000004_create_personal_access_tokens_table.php
│   ├── 2024_01_01_100001_create_tags_table.php
│   ├── 2024_01_01_100002_create_discussions_table.php
│   ├── 2024_01_01_100003_create_discussion_tag_table.php
│   ├── 2024_01_01_100004_create_comments_table.php
│   └── 2024_01_01_100005_create_reactions_table.php
└── seeders/                       # Database seeders
    ├── DatabaseSeeder.php
    ├── DiscussionSeeder.php
    ├── TagSeeder.php
    └── UserSeeder.php
```

**Database Tables:**

1. **users** - User accounts
2. **discussions** - Forum discussions
3. **comments** - Comments on discussions
4. **tags** - Discussion tags/categories
5. **discussion_tag** - Pivot table (many-to-many)
6. **reactions** - Likes/upvotes (polymorphic)

---

### 📁 `resources/`

Frontend resources.

```
resources/
├── css/
│   └── app.css                    # Main CSS (TailwindCSS)
├── js/
│   ├── app.js                     # Main JavaScript
│   └── bootstrap.js               # Bootstrap JS (Axios setup)
└── views/                         # Blade templates
    ├── layouts/
    │   └── app.blade.php          # Main layout
    ├── auth/                      # Authentication views (Laravel UI)
    ├── discussions/               # Discussion views
    │   ├── create.blade.php
    │   ├── edit.blade.php
    │   └── show.blade.php
    ├── profile/                   # Profile views
    │   ├── show.blade.php
    │   └── edit.blade.php
    └── home.blade.php             # Homepage
```

---

### 📁 `routes/`

Application routes.

```
routes/
├── web.php                        # Web routes (frontend)
├── api.php                        # API routes
├── console.php                    # Console commands
└── channels.php                   # Broadcasting channels
```

**Main Routes (web.php):**

- `GET /` - Homepage
- `GET /discussions` - List discussions
- `GET /discussions/create` - Create form
- `POST /discussions` - Store discussion
- `GET /discussions/{slug}` - Show discussion
- `GET /discussions/{slug}/edit` - Edit form
- `PUT /discussions/{id}` - Update discussion
- `DELETE /discussions/{id}` - Delete discussion
- `POST /discussions/{id}/comments` - Add comment
- `GET /@{username}` - User profile
- Authentication routes (login, register, etc.)

---

### 📁 `config/`

Configuration files.

```
config/
├── app.php                        # Application config
├── auth.php                       # Authentication config
├── database.php                   # Database config
├── services.php                   # Third-party services (Google OAuth)
├── mail.php                       # Email config
└── ...                            # Other configs
```

---

### 📁 `public/`

Public directory (web root).

```
public/
├── build/                         # Compiled assets (Vite)
├── storage/                       # Symlink to storage/app/public
│   └── avatars/                   # User avatars
├── index.php                      # Entry point
├── favicon.ico
└── robots.txt
```

---

### 📁 `storage/`

Storage directory.

```
storage/
├── app/
│   ├── public/                    # Publicly accessible files
│   │   └── avatars/               # User uploaded avatars
│   └── private/                   # Private files
├── framework/                     # Framework generated files
│   ├── cache/
│   ├── sessions/
│   └── views/
└── logs/                          # Application logs
    └── laravel.log
```

---

## 🔑 Important Files

### Configuration Files

| File | Description |
|------|-------------|
| `.env` | Environment variables (database, API keys) |
| `.env.example` | Template untuk .env |
| `composer.json` | PHP dependencies |
| `package.json` | JavaScript dependencies |
| `vite.config.js` | Vite build tool configuration |
| `tailwind.config.js` | TailwindCSS configuration |
| `postcss.config.js` | PostCSS configuration |

### Entry Points

| File | Description |
|------|-------------|
| `public/index.php` | Application entry point |
| `artisan` | CLI tool |
| `resources/js/app.js` | JavaScript entry point |
| `resources/css/app.css` | CSS entry point |

---

## 🗃️ Database Schema

### Entity Relationship

```
Users
  ├─ hasMany Discussions
  ├─ hasMany Comments
  └─ hasMany Reactions

Discussions
  ├─ belongsTo User
  ├─ belongsToMany Tags
  ├─ hasMany Comments
  ├─ morphMany Reactions
  └─ belongsTo Comment (best_answer)

Comments
  ├─ belongsTo User
  ├─ belongsTo Discussion
  ├─ belongsTo Comment (parent)
  ├─ hasMany Comments (replies)
  └─ morphMany Reactions

Tags
  └─ belongsToMany Discussions

Reactions (Polymorphic)
  ├─ belongsTo User
  └─ morphTo Reactionable (Discussion or Comment)
```

---

## 📝 Naming Conventions

### Files

- **Controllers**: PascalCase + `Controller` suffix
  - Example: `DiscussionController.php`
  
- **Models**: PascalCase, singular
  - Example: `Discussion.php`
  
- **Migrations**: snake_case with timestamp
  - Example: `2024_01_01_100002_create_discussions_table.php`
  
- **Views**: snake_case
  - Example: `discussion_show.blade.php`

### Code

- **Variables**: camelCase
  - Example: `$discussionCount`
  
- **Constants**: UPPER_SNAKE_CASE
  - Example: `MAX_UPLOAD_SIZE`
  
- **Methods**: camelCase
  - Example: `getDicussions()`
  
- **Classes**: PascalCase
  - Example: `DiscussionController`

---

## 🎯 Best Practices

1. **Controllers**: Keep thin, delegate to services
2. **Models**: Business logic dan relationships
3. **Views**: Presentation only, no business logic
4. **Routes**: RESTful naming
5. **Migrations**: Always rollbackable
6. **Seeders**: Use factories for dummy data

---

## 📚 References

- Laravel Documentation: https://laravel.com/docs
- TailwindCSS: https://tailwindcss.com/docs
- Alpine.js: https://alpinejs.dev

---

**Last Updated:** March 2026
