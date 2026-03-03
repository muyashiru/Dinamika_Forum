# PROMPT LENGKAP: Redesign UI/UX DINAMIKA Forum

## 📋 Project Overview

Saya memiliki project **DINAMIKA Forum** (Dinasti Mahasiswa Teknik Informatika) - sebuah platform forum diskusi untuk mahasiswa Teknik Informatika. Saat ini project sudah berjalan dengan fitur lengkap, dan saya ingin Anda membuat redesign UI/UX yang lebih modern, clean, dan user-friendly.

**Tech Stack:**
- Backend: Laravel 10
- Frontend: TailwindCSS 3 + Alpine.js
- Database: MySQL
- Build Tool: Vite

**Design Requirements:**
- Modern & Clean Design
- Responsive (Mobile-first)
- Accessible (WCAG 2.1 Level AA)
- Smooth animations & transitions
- Color scheme: Blue (#3B82F6) sebagai primary color
- Typography: Inter font family

---

## 🎨 Design System Requirements

### Color Palette
- **Primary:** Blue (#3B82F6, #2563EB, #1D4ED8)
- **Secondary:** Indigo (#6366F1, #4F46E5)
- **Success:** Green (#10B981)
- **Warning:** Yellow (#F59E0B)
- **Danger:** Red (#EF4444)
- **Neutral:** Gray scale (#111827 to #F9FAFB)

### Typography
- **Font Family:** Inter (weights: 400, 500, 600, 700)
- **Headings:** Bold, clear hierarchy
- **Body Text:** 16px base size, 1.5 line-height
- **Code Blocks:** Monospace font dengan syntax highlighting

### Components Style
- **Border Radius:** Medium to Large (8px - 16px)
- **Shadows:** Subtle, layered shadows
- **Spacing:** Consistent 8px grid system
- **Buttons:** Rounded, clear states (hover, active, disabled)
- **Cards:** White background, subtle border/shadow
- **Icons:** Outline style, consistent size

---

## 📄 Halaman dan Fitur Lengkap

### 1. **Homepage / Beranda** (`/`)

**Header Section:**
- Logo DINAMIKA (icon semicolon biru dengan rounded corners)
- Navigation: "Diskusi" dan "Anggota"
- Search bar (prominent)
- Button "Buat Diskusi" (untuk user login)
- Button "Masuk" dan "Daftar" (untuk guest)
- User avatar dropdown (untuk user login)

**Hero Section:**
- Gradient background (blue to indigo to purple)
- Judul besar "DINAMIKA"
- Subtitle "DINASTI MAHASISWA TEKNIK INFORMATIKA"
- Tagline menarik
- CTA Button: "Bergabung Sekarang" atau "Buat Diskusi Baru"
- Ilustrasi SVG modern (orang-orang diskusi/kolaborasi)

**Statistics Cards:**
- Total Diskusi (dengan icon)
- Total Anggota (dengan icon)
- Diskusi Terjawab (dengan icon)
- Layout: 3 kolom di desktop, stack di mobile
- Animasi counter saat scroll

**Filter Section:**
- Tabs/Pills style: Terbaru, Populer, Belum Terjawab, Terjawab
- Sticky saat scroll (opsional)
- Active state yang jelas
- Smooth transition saat ganti filter (AJAX, no reload)

**Discussion List:**
- Card-based design
- Setiap card memiliki:
  - Avatar user (bulat, 48x48px)
  - Judul diskusi (bold, clickable)
  - Badge "✓ Terjawab" (hijau) jika solved
  - Preview konten (2 baris max)
  - Meta info: nama user, waktu relatif (e.g., "3 hours ago"), views, jumlah komentar
  - Tags (colored pills dengan background transparan)
- Hover effect pada card
- Loading skeleton saat fetch data

**Sidebar:**
- "Tag Populer" widget
- Daftar tag dengan jumlah diskusi
- Clickable untuk filter by tag
- Sticky positioning

**Footer:**
- Nama forum "DINAMIKA Forum"
- Subtitle
- Copyright
- Simple & clean

---

### 2. **Halaman Login** (`/login`)

**Layout:**
- Split screen atau centered card
- Ilustrasi/gambar menarik di sisi kiri (opsional)
- Form di tengah/kanan

**Form Elements:**
- Input Email (dengan icon envelope)
- Input Password (dengan icon lock dan toggle show/hide)
- Checkbox "Remember Me"
- Link "Lupa Password?"
- Button "Masuk" (full width, primary color)
- Divider "atau"
- Button "Login dengan Google" (dengan icon Google)
- Link "Belum punya akun? Daftar"

**Error Messages:**
- Display di atas form atau inline
- Red color dengan icon

---

### 3. **Halaman Register** (`/register`)

**Layout:**
- Similar dengan login page
- Centered card atau split screen

**Form Elements:**
- Input Nama Lengkap
- Input Username (dengan validation feedback real-time)
- Input Email
- Input Password (dengan strength indicator)
- Input Konfirmasi Password
- Checkbox "Setuju dengan Terms & Conditions"
- Button "Daftar" (full width, primary color)
- Divider "atau"
- Button "Daftar dengan Google"
- Link "Sudah punya akun? Masuk"

**Password Strength Indicator:**
- Bar indicator (weak/medium/strong)
- Color coded (red/yellow/green)
- Requirements checklist:
  - Minimal 8 karakter
  - Mengandung huruf besar
  - Mengandung huruf kecil
  - Mengandung angka

---

### 4. **Halaman Detail Diskusi** (`/discussions/{slug}`)

**Header Diskusi:**
- Avatar user (large, 64x64px)
- Nama user & username
- Waktu posting (relatif dan absolute)
- Badge "✓ Terjawab" jika solved
- Tags diskusi

**Judul Diskusi:**
- Large, bold typography
- Clear hierarchy

**Konten Diskusi:**
- Markdown rendered dengan styling bagus
- Code blocks dengan syntax highlighting
- Images responsive
- Lists, blockquotes, tables styled

**Action Buttons:**
- Upvote/Like dengan counter (icon heart atau thumbs up)
- Share button
- Bookmark button
- Edit button (jika owner)
- Delete button (jika owner)
- "Tandai Terjawab" button (jika owner)

**Comments Section:**
- Nested comments (indented untuk replies)
- Setiap comment memiliki:
  - Avatar user (40x40px)
  - Nama user & waktu
  - Konten comment (markdown support)
  - Upvote/downvote buttons dengan counter
  - Reply button
  - Edit/Delete button (jika owner)
  - Badge "✓ Best Answer" (hijau) jika dipilih

**Comment Form:**
- Textarea dengan toolbar (bold, italic, code, link)
- Markdown preview tab
- "Kirim Komentar" button
- "Batalkan" button (untuk reply mode)

**Sidebar:**
- Author card (avatar, nama, bio, join date)
- Related discussions
- Popular tags

---

### 5. **Halaman Buat Diskusi** (`/discussions/create`)

**Form Layout:**
- Clean, focused layout
- Progress indicator (opsional)

**Form Elements:**
- Input Judul (large, prominent)
  - Character counter (max 255)
- Textarea Konten (expandable)
  - Markdown editor dengan toolbar
  - Preview tab
  - Full-screen mode toggle
  - Drag & drop upload image
- Tags Selector
  - Multi-select dropdown atau tag input
  - Show popular tags
  - Create new tag (jika allowed)
- Button "Publikasikan" (primary, large)
- Button "Simpan Draft" (secondary)
- Button "Batalkan"

**Markdown Toolbar:**
- Bold, Italic, Strikethrough
- Heading (H1-H6)
- Code block
- Bulleted list, Numbered list
- Link
- Image upload
- Blockquote
- Help/Guide button

---

### 6. **Halaman Edit Diskusi** (`/discussions/{id}/edit`)

**Layout:**
- Similar dengan create page
- Pre-filled dengan data existing
- Warning banner: "You are editing a discussion"
- Show last edited timestamp

**Additional Elements:**
- Button "Update" (bukan "Publikasikan")
- Confirmation dialog saat leave page dengan unsaved changes

---

### 7. **Halaman Profil User** (`/@{username}`)

**Profile Header:**
- Cover photo (gradient atau solid color)
- Avatar (large, 120x120px)
- Nama user (large)
- Username @username
- Bio/About
- Join date
- Button "Edit Profil" (jika own profile)
- Button "Follow" (jika user lain - future feature)

**Statistics Bar:**
- Total Diskusi
- Total Komentar
- Total Upvotes Received
- Layout: horizontal cards atau pills

**Tabs Navigation:**
- Diskusi (default active)
- Komentar
- Tentang

**Tab Content:**

**Tab Diskusi:**
- List diskusi yang dibuat user
- Similar design dengan homepage discussion list
- Filter: Semua, Terjawab, Belum Terjawab

**Tab Komentar:**
- List komentar user dengan context
- Show parent discussion title
- Clickable untuk ke discussion

**Tab Tentang:**
- Bio lengkap
- Social links
- Skills/Interests (tags)
- Join date
- Last active

---

### 8. **Halaman Edit Profil** (`/profile/edit`)

**Sections:**

**1. Profil Dasar:**
- Upload Avatar (dengan crop tool)
- Input Nama Lengkap
- Input Username (dengan availability check)
- Textarea Bio (max 500 chars)

**2. Akun:**
- Display Email (disabled)
- Button "Ganti Email"
- Button "Ganti Password"

**3. Password (expandable section):**
- Input Password Lama
- Input Password Baru
- Input Konfirmasi Password Baru
- Password strength indicator

**4. Hapus Akun:**
- Danger zone section (red border)
- Warning text
- Button "Hapus Akun" (red, outline)
- Confirmation modal dengan password input

**Action Buttons:**
- "Simpan Perubahan" (primary)
- "Batalkan" (secondary)

---

### 9. **Halaman Anggota** (`/members` atau `/anggota`)

**Header:**
- Title "Anggota DINAMIKA"
- Search bar (search by name/username)
- Total members count
- Filter/Sort dropdown: Terbaru, Paling Aktif, Alfabetis

**Members Grid:**
- Card-based layout
- Grid: 3-4 kolom di desktop, 1-2 di mobile
- Setiap card:
  - Avatar (large)
  - Nama user
  - Username @username
  - Bio (2 baris max)
  - Stats: Diskusi, Komentar
  - Badge jika user aktif/admin
  - Hover effect

**Pagination:**
- Clean pagination component
- Show current page, total pages
- Previous/Next buttons
- Page numbers (with ellipsis untuk banyak pages)

---

### 10. **Halaman 404 Not Found**

**Design:**
- Centered content
- Large 404 text (creative typography)
- Ilustrasi atau icon (lost/confused)
- Message: "Halaman tidak ditemukan"
- Subtext: "Halaman yang Anda cari tidak ada atau telah dipindahkan"
- Button "Kembali ke Beranda"
- Search bar (opsional)

---

### 11. **Halaman 500 Server Error**

**Design:**
- Similar dengan 404
- Large 500 text
- Ilustrasi (broken/error)
- Message: "Terjadi kesalahan server"
- Subtext: "Kami sedang memperbaikinya. Silakan coba lagi nanti."
- Button "Refresh Halaman"
- Button "Kembali ke Beranda"

---

## 🎯 Component Requirements

### Navbar (Global)
- Sticky top
- Backdrop blur effect saat scroll
- Smooth shadow transition
- Mobile: Hamburger menu dengan slide-in drawer
- User dropdown: Smooth animation, proper z-index
- Search: Expandable di mobile, inline di desktop

### Footer (Global)
- Simple, tidak terlalu prominent
- Links: About, Terms, Privacy, Contact
- Social media icons (opsional)
- Copyright text

### Modal/Dialog
- Overlay dengan backdrop opacity
- Smooth fade-in animation
- Close button (X)
- Close on overlay click (opsional)
- Escape key to close
- Prevent body scroll when open

### Toast/Notification
- Position: Top right atau bottom center
- Auto-dismiss (3-5 seconds)
- Types: Success, Error, Warning, Info
- Icon + Message
- Progress bar (opsional)
- Dismissable

### Buttons
- **Primary:** Blue background, white text, shadow
- **Secondary:** White background, blue text, border
- **Danger:** Red background, white text
- **Ghost:** Transparent, hover effect
- **Sizes:** Small, Medium, Large
- **States:** Default, Hover, Active, Disabled, Loading

### Forms
- **Input Fields:**
  - Clear labels
  - Placeholder text
  - Focus state (blue ring)
  - Error state (red border + message)
  - Success state (green border + checkmark)
  - Disabled state (gray, reduced opacity)
  
- **Textarea:**
  - Auto-expand (opsional)
  - Character counter
  - Resize handle

- **Select/Dropdown:**
  - Custom styled (tidak native)
  - Search functionality (untuk banyak options)
  - Multi-select support
  
- **Checkbox & Radio:**
  - Custom styled
  - Clear checked state
  - Smooth animation

### Cards
- White background
- Subtle border atau shadow
- Rounded corners (8-12px)
- Hover effect (shadow lift)
- Padding konsisten

### Tags/Badges
- Pill shape (fully rounded)
- Colored background (10-20% opacity)
- Colored text (matching background)
- Small size (px-2 py-1)
- Hover effect untuk clickable tags

### Avatar
- Circular
- Border (opsional)
- Fallback: Initials dengan colored background
- Sizes: Small (32px), Medium (48px), Large (64px), XLarge (120px)
- Status indicator (online/offline) - future feature

### Loading States
- **Spinner:** Circle spinner untuk buttons
- **Skeleton:** Gray animated skeleton untuk content loading
- **Progress Bar:** Thin bar di top untuk page transitions
- **Pulse:** Subtle pulse animation untuk loading cards

### Empty States
- Centered content
- Icon atau illustration
- Heading text
- Descriptive text
- CTA button (jika applicable)

---

## 📱 Responsive Design Requirements

### Breakpoints
- Mobile: < 640px
- Tablet: 640px - 1024px  
- Desktop: > 1024px

### Mobile Considerations
- Touch-friendly (min 44x44px tap targets)
- Hamburger menu
- Bottom navigation (opsional)
- Swipe gestures (opsional)
- Full-width cards
- Stack layouts vertically
- Collapsible sections

### Tablet Considerations
- 2 column layouts
- Sidebar dapat di-collapse
- Optimized for both portrait & landscape

### Desktop Considerations
- Multi-column layouts (2-3 columns)
- Sidebar sticky
- Hover states prominent
- Keyboard navigation support

---

## ♿ Accessibility Requirements

- **Keyboard Navigation:**
  - Tab order logical
  - Focus indicators visible
  - Skip to main content link
  
- **Screen Readers:**
  - Proper ARIA labels
  - Alt text untuk images
  - Descriptive link text
  
- **Color Contrast:**
  - WCAG AA compliant (4.5:1 for normal text)
  - Don't rely on color alone
  
- **Text:**
  - Resizable text support
  - Clear typography hierarchy

---

## 🎬 Animation & Interaction

### Micro-interactions
- Button hover/click effects
- Link hover underlines
- Card hover lift
- Input focus rings
- Smooth color transitions

### Page Transitions
- Fade in content on load
- Smooth scroll behavior
- Page transition effects (opsional)

### Loading Animations
- Smooth skeleton loading
- Fade in when content ready
- Progressive image loading

### Form Interactions
- Real-time validation feedback
- Success animations
- Error shake animation
- Auto-save indicators

---

## 🚀 Performance & Best Practices

- Lazy load images
- Optimize images (WebP format)
- Minimize animations on low-end devices
- Preload critical resources
- Use CSS Grid & Flexbox
- Mobile-first approach
- Progressive enhancement
- Graceful degradation

---

## 📦 Deliverables yang Diharapkan

1. **Design Mockups (Figma/Adobe XD):**
   - All pages (mobile & desktop)
   - Component library
   - Design system documentation
   
2. **HTML/Blade Templates:**
   - Semua halaman yang disebutkan di atas
   - Reusable components
   - Clean, semantic HTML
   
3. **TailwindCSS Styling:**
   - Custom theme configuration
   - Component classes
   - Utility classes usage
   
4. **Alpine.js Interactions:**
   - Interactive components
   - Form validations
   - Modal/dropdown behaviors
   
5. **Assets:**
   - Icons (SVG)
   - Illustrations
   - Logo variations

---

## 💡 Inspiration & References

**Style References:**
- GitHub Discussions
- Stack Overflow
- Reddit (new design)
- Discourse Forum
- Hacker News (but more modern)

**Key Principles:**
- Clean & Minimalist
- Content-first
- Easy to scan
- Clear visual hierarchy
- Consistent spacing & typography
- Subtle but delightful interactions

---

## ❓ Questions to Consider

1. Apakah ingin dark mode support?
2. Apakah ingin PWA (Progressive Web App) features?
3. Apakah ingin real-time notifications?
4. Apakah ingin gamification (badges, points)?
5. Apakah ingin social features (follow users, DM)?

---

## 📝 Notes

- Design harus konsisten di semua halaman
- Prioritaskan usability over fancy effects
- Test di berbagai devices & browsers
- Maintain current functionality (jangan hilangkan fitur existing)
- Backwards compatible dengan Laravel Blade & Alpine.js

---

**Harap buat redesign yang modern, clean, dan user-friendly dengan mempertimbangkan semua halaman dan komponen yang telah disebutkan di atas. Fokus pada user experience dan accessibility, sambil tetap mempertahankan fungsionalitas existing.**
