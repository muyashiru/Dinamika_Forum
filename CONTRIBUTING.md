# 🤝 Contributing to DINAMIKA Forum

Terima kasih telah tertarik untuk berkontribusi pada DINAMIKA Forum! Kami sangat menghargai kontribusi dari komunitas.

## 📋 Code of Conduct

Dengan berpartisipasi dalam project ini, Anda diharapkan untuk menjaga lingkungan yang ramah dan profesional.

## 🚀 Cara Berkontribusi

### 1. Fork Repository

Fork repository ini ke akun GitHub Anda.

### 2. Clone Repository

```bash
git clone https://github.com/muyashiru/dinamika-forum.git
cd dinamika-forum
```

### 3. Buat Branch Baru

Gunakan nama branch yang descriptive:

```bash
# Untuk fitur baru
git checkout -b feature/nama-fitur

# Untuk bug fix
git checkout -b fix/nama-bug

# Untuk dokumentasi
git checkout -b docs/nama-dokumentasi
```

**Contoh:**
```bash
git checkout -b feature/add-notification-system
git checkout -b fix/discussion-pagination-bug
git checkout -b docs/update-installation-guide
```

### 4. Setup Development Environment

Ikuti panduan di [INSTALLATION.md](INSTALLATION.md) untuk setup project.

### 5. Buat Perubahan

- Tulis kode yang clean dan readable
- Follow Laravel coding standards
- Tambahkan comments jika diperlukan
- Test perubahan Anda

### 6. Commit Changes

Gunakan commit message yang jelas dan descriptive:

```bash
git add .
git commit -m "feat: add email notification for new comments"
```

**Format Commit Message:**
- `feat:` - Fitur baru
- `fix:` - Bug fix
- `docs:` - Dokumentasi
- `style:` - Formatting, missing semi colons, dll (no code change)
- `refactor:` - Refactoring code
- `test:` - Adding tests
- `chore:` - Maintenance tasks

**Contoh:**
```bash
git commit -m "feat: implement user profile editing"
git commit -m "fix: resolve discussion pagination issue"
git commit -m "docs: update README with deployment guide"
git commit -m "refactor: optimize database queries in DiscussionController"
```

### 7. Push ke GitHub

```bash
git push origin feature/nama-fitur
```

### 8. Buat Pull Request

1. Buka repository GitHub Anda
2. Click **Pull Request**
3. Pilih branch yang ingin di-merge
4. Berikan deskripsi yang jelas tentang perubahan
5. Submit Pull Request

## 📝 Pull Request Guidelines

### Judul Pull Request

Format: `[Type] Short description`

**Contoh:**
- `[Feature] Add email notification system`
- `[Fix] Resolve pagination bug on discussions`
- `[Docs] Update installation guide`

### Deskripsi Pull Request

Gunakan template berikut:

```markdown
## 📋 Deskripsi

Jelaskan perubahan yang Anda buat dengan detail.

## 🎯 Tujuan

Mengapa perubahan ini diperlukan? Problem apa yang diselesaikan?

## 🔄 Perubahan Yang Dilakukan

- [ ] Perubahan 1
- [ ] Perubahan 2
- [ ] Perubahan 3

## 🧪 Testing

Bagaimana Anda test perubahan ini?

- [ ] Test manual
- [ ] Unit tests
- [ ] Integration tests

## 📸 Screenshots (jika ada)

Tambahkan screenshot jika perubahan UI.

## ✅ Checklist

- [ ] Code follows project style guidelines
- [ ] Self-review dilakukan
- [ ] Comments ditambahkan untuk kode yang kompleks
- [ ] Dokumentasi diupdate (jika diperlukan)
- [ ] Tests ditambahkan/diupdate
- [ ] Semua tests pass
- [ ] No breaking changes (atau dijelaskan)
```

## 🎨 Coding Standards

### PHP (Laravel)

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- Use type hints
- Write descriptive variable names
- Keep methods short and focused
- Add PHPDoc blocks untuk methods

**Contoh:**

```php
<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    /**
     * Display a listing of discussions.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $discussions = Discussion::with(['user', 'tags'])
            ->latest()
            ->paginate(15);

        return view('discussions.index', compact('discussions'));
    }
}
```

### JavaScript

- Use ES6+ syntax
- Prefer `const` and `let` over `var`
- Use meaningful variable names
- Add comments for complex logic

**Contoh:**

```javascript
// Good
const fetchDiscussions = async () => {
    try {
        const response = await axios.get('/api/discussions');
        return response.data;
    } catch (error) {
        console.error('Error fetching discussions:', error);
    }
};

// Bad
var x = async () => {
    let y = await axios.get('/api/discussions');
    return y.data;
};
```

### Blade Templates

- Keep logic minimal
- Use components untuk reusable elements
- Proper indentation

**Contoh:**

```blade
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        
        @forelse($discussions as $discussion)
            <x-discussion-card :discussion="$discussion" />
        @empty
            <p>No discussions found.</p>
        @endforelse
    </div>
@endsection
```

### CSS (TailwindCSS)

- Use Tailwind utility classes
- Create custom components di `app.css` jika diperlukan
- Avoid inline styles

## 🧪 Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter DiscussionTest

# With coverage
php artisan test --coverage
```

### Writing Tests

```php
<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Discussion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiscussionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_discussion()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/discussions', [
            'title' => 'Test Discussion',
            'content' => 'Test content',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('discussions', [
            'title' => 'Test Discussion',
        ]);
    }
}
```

## 📖 Dokumentasi

Jika perubahan Anda mempengaruhi:

- **API**: Update API documentation
- **Configuration**: Update configuration guide
- **Features**: Update README atau buat guide baru
- **Installation**: Update INSTALLATION.md

## 🐛 Melaporkan Bug

### Before Reporting

1. Cek apakah bug sudah dilaporkan di Issues
2. Pastikan menggunakan versi terbaru
3. Collect informasi tentang bug

### Bug Report Template

```markdown
## 🐛 Deskripsi Bug

Deskripsi singkat tentang bug.

## 📋 Steps to Reproduce

1. Go to '...'
2. Click on '...'
3. Scroll down to '...'
4. See error

## ✅ Expected Behavior

Apa yang seharusnya terjadi.

## ❌ Actual Behavior

Apa yang benar-benar terjadi.

## 📸 Screenshots

Jika applicable, tambahkan screenshots.

## 🖥️ Environment

- OS: [e.g. Windows 11]
- Browser: [e.g. Chrome 120]
- PHP Version: [e.g. 8.1]
- Laravel Version: [e.g. 10.0]

## 📝 Additional Context

Tambahkan context lain tentang problem.
```

## 💡 Request Fitur

### Feature Request Template

```markdown
## 🚀 Feature Request

Deskripsi singkat fitur yang diinginkan.

## 🎯 Problem/Motivation

Problem apa yang diselesaikan oleh fitur ini?

## 💡 Proposed Solution

Bagaimana fitur ini seharusnya bekerja?

## 🔄 Alternatives Considered

Alternative solutions yang sudah dipertimbangkan.

## 📝 Additional Context

Screenshots, mockups, atau context tambahan.
```

## ❓ Ada Pertanyaan?

Jika ada pertanyaan tentang contributing:

1. Check existing GitHub Issues
2. Create new Issue dengan label `question`
3. Atau hubungi maintainers

## 🙏 Terima Kasih!

Kontribusi Anda sangat berarti untuk DINAMIKA Forum! 

---

**Happy Coding! 🎉**
