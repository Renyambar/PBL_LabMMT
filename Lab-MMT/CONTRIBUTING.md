# 🤝 Contributing to Portal Showcase Lab MMT

Terima kasih atas minat Anda untuk berkontribusi! Dokumen ini berisi panduan untuk berkontribusi pada project Portal Showcase Lab MMT.

## 📋 Table of Contents
- [Code of Conduct](#code-of-conduct)
- [Getting Started](#getting-started)
- [Development Workflow](#development-workflow)
- [Coding Standards](#coding-standards)
- [Commit Messages](#commit-messages)
- [Pull Request Process](#pull-request-process)

---

## 🌟 Code of Conduct

### Our Pledge
- Bersikap ramah dan profesional
- Menghormati pendapat dan pengalaman berbeda
- Memberikan dan menerima kritik konstruktif
- Fokus pada yang terbaik untuk komunitas

---

## 🚀 Getting Started

### 1. Fork Repository

```bash
# Fork via GitHub UI
# Kemudian clone fork Anda
git clone https://github.com/YOUR_USERNAME/Lab-MMT.git
cd Lab-MMT
```

### 2. Setup Development Environment

```bash
# Install dependencies (jika ada)
composer install  # jika menggunakan composer

# Setup database
psql -U postgres -d lab_mmt -f database.sql

# Configure app
cp config/config.example.php config/config.php
# Edit config.php sesuai kebutuhan
```

### 3. Create Branch

```bash
# Create branch untuk fitur baru
git checkout -b feature/nama-fitur

# Atau untuk bugfix
git checkout -b fix/nama-bug
```

---

## 💻 Development Workflow

### Project Structure

```
Lab-MMT/
├── app/
│   ├── controllers/  # Business logic
│   ├── models/       # Data layer
│   ├── views/        # Presentation layer
│   └── core/         # Core MVC system
├── public/           # Public assets & entry point
└── config/           # Configuration files
```

### Workflow Steps

1. **Create Issue** - Buat issue untuk fitur/bug
2. **Create Branch** - Branch dari `main`
3. **Develop** - Kode dengan mengikuti standards
4. **Test** - Test manual & otomatis
5. **Commit** - Commit dengan pesan yang jelas
6. **Push** - Push ke fork Anda
7. **Pull Request** - Buat PR ke repository utama

---

## 📝 Coding Standards

### PHP Code Style

**PSR-12 Compliance:**

```php
<?php

namespace App\Controllers;

class ExampleController extends Controller
{
    private $model;
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model('Example');
    }
    
    public function index()
    {
        $data = [
            'title' => 'Example Page',
            'items' => $this->model->getAll()
        ];
        
        $this->view('example/index', $data);
    }
}
```

**Best Practices:**

- ✅ Use meaningful variable names
- ✅ Add comments for complex logic
- ✅ Keep functions small and focused
- ✅ Use type hints where possible
- ✅ Handle errors properly
- ✅ Sanitize input, escape output

**Naming Conventions:**

```php
// Classes: PascalCase
class UserController {}

// Methods & Functions: camelCase
public function getUserById() {}

// Variables: camelCase
$userName = 'John';

// Constants: UPPER_CASE
define('BASE_URL', 'http://localhost');

// Database tables: snake_case
// users, project_categories, article_tags
```

### SQL Standards

```sql
-- Use meaningful table & column names
-- Add comments for complex queries
-- Use prepared statements (PDO)
-- Normalize database structure

-- Example:
SELECT 
    p.id,
    p.title,
    p.slug,
    u.name as author_name
FROM projects p
LEFT JOIN users u ON p.author_id = u.id
WHERE p.status = 'published'
ORDER BY p.created_at DESC;
```

### HTML/CSS Standards

```html
<!-- Use semantic HTML -->
<article class="project-card">
    <header class="project-header">
        <h2>Project Title</h2>
    </header>
    <section class="project-content">
        <!-- Content here -->
    </section>
</article>

<!-- TailwindCSS - Use utility classes -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-bold mb-4">Title</h3>
    <p class="text-gray-600">Content</p>
</div>
```

### JavaScript Standards

```javascript
// Use modern ES6+ syntax
// Use const/let, avoid var
// Add JSDoc comments

/**
 * Show notification to user
 * @param {string} message - The message to display
 * @param {string} type - Type: success, error, info
 */
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
}
```

---

## 📨 Commit Messages

### Commit Message Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

### Types:
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation only
- `style`: Formatting, missing semi colons, etc
- `refactor`: Code refactoring
- `test`: Adding tests
- `chore`: Maintenance tasks

### Examples:

```bash
# Good commits
git commit -m "feat(project): add category filter to project list"
git commit -m "fix(auth): resolve login redirect issue"
git commit -m "docs(readme): update installation instructions"
git commit -m "style(css): improve mobile responsiveness"

# Bad commits (avoid these)
git commit -m "fix bug"
git commit -m "update"
git commit -m "changes"
```

### Detailed Example:

```
feat(article): add rich text editor for articles

- Integrate TinyMCE editor
- Add image upload capability
- Configure toolbar options
- Update article model to handle HTML content

Closes #123
```

---

## 🔄 Pull Request Process

### Before Creating PR

1. **Update from main:**
   ```bash
   git checkout main
   git pull upstream main
   git checkout your-branch
   git rebase main
   ```

2. **Test thoroughly:**
   - Manual testing
   - Check for errors
   - Test on different browsers
   - Test responsive design

3. **Update documentation:**
   - Update README if needed
   - Add comments to code
   - Update CHANGELOG

### Creating Pull Request

1. **Push to your fork:**
   ```bash
   git push origin your-branch
   ```

2. **Create PR via GitHub:**
   - Clear title describing the change
   - Detailed description
   - Reference related issues
   - Add screenshots if UI changes

### PR Template:

```markdown
## Description
Brief description of changes

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Breaking change
- [ ] Documentation update

## Changes Made
- Change 1
- Change 2
- Change 3

## Screenshots (if applicable)
[Add screenshots here]

## Testing Done
- [ ] Tested on Chrome
- [ ] Tested on Firefox
- [ ] Tested on mobile
- [ ] No console errors

## Related Issues
Closes #123
Related to #456

## Checklist
- [ ] Code follows project standards
- [ ] Comments added where needed
- [ ] Documentation updated
- [ ] No breaking changes (or documented)
```

---

## 🧪 Testing Guidelines

### Manual Testing

Test semua fitur yang terpengaruh:

```bash
# Test checklist untuk fitur project
- [ ] Create project
- [ ] Edit project
- [ ] Delete project
- [ ] View project list
- [ ] View project detail
- [ ] Filter by category
- [ ] Search projects
- [ ] Upload thumbnail
```

### Browser Testing

Test di multiple browsers:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

### Responsive Testing

Test di berbagai ukuran layar:
- Mobile (320px - 480px)
- Tablet (768px - 1024px)
- Desktop (1280px+)

---

## 🐛 Bug Reports

### Bug Report Template:

```markdown
**Describe the bug**
A clear description of the bug

**To Reproduce**
Steps to reproduce:
1. Go to '...'
2. Click on '...'
3. Scroll down to '...'
4. See error

**Expected behavior**
What you expected to happen

**Screenshots**
Add screenshots if applicable

**Environment:**
- OS: [e.g. Windows 10]
- Browser: [e.g. Chrome 96]
- PHP Version: [e.g. 8.0]
- PostgreSQL Version: [e.g. 13.5]

**Additional context**
Any other information
```

---

## 💡 Feature Requests

### Feature Request Template:

```markdown
**Is your feature request related to a problem?**
Description of the problem

**Describe the solution you'd like**
Clear description of what you want

**Describe alternatives you've considered**
Other solutions you've thought about

**Additional context**
Screenshots, mockups, etc.
```

---

## 🎯 Areas for Contribution

### High Priority
- [ ] Rich text editor integration
- [ ] Image optimization on upload
- [ ] Pagination system
- [ ] Advanced search filters
- [ ] Email notifications

### Medium Priority
- [ ] Comment system
- [ ] User profile pages
- [ ] Activity logs
- [ ] Data export functionality
- [ ] API endpoints

### Low Priority
- [ ] Dark mode
- [ ] Multi-language support
- [ ] Social media integration
- [ ] Analytics dashboard
- [ ] Mobile app

---

## 📚 Resources

### Documentation
- [PHP Manual](https://www.php.net/manual/en/)
- [PostgreSQL Docs](https://www.postgresql.org/docs/)
- [TailwindCSS Docs](https://tailwindcss.com/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)

### Tools
- [pgAdmin](https://www.pgadmin.org/) - PostgreSQL GUI
- [Postman](https://www.postman.com/) - API testing
- [VS Code](https://code.visualstudio.com/) - Code editor

---

## 🙏 Thank You!

Terima kasih telah berkontribusi pada Portal Showcase Lab MMT! Setiap kontribusi, sekecil apapun, sangat berarti untuk project ini.

**Questions?** Feel free to:
- Open an issue
- Join discussions
- Contact maintainers

Happy coding! 🚀

---

*Last Updated: November 11, 2025*
