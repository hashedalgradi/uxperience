# 🌟 الموقع الشخصي - Laravel Portfolio

موقع شخصي احترافي مبني بـ Laravel مع لوحة تحكم متكاملة لإدارة المحتوى.

## ✨ المميزات

### 🎯 الواجهة الأمامية
- **تصميم حديث ومتجاوب** باستخدام Tailwind CSS
- **صفحة رئيسية جذابة** مع عرض المشاريع المميزة
- **صفحة من أنا** مع عرض المهارات والخبرات
- **معرض المشاريع** مع تفاصيل كاملة لكل مشروع
- **صفحة الخدمات** مع وصف شامل
- **صفحة التواصل** مع الروابط الاجتماعية
- **دعم كامل للغة العربية** مع RTL

### 🛠️ لوحة التحكم
- **لوحة تحكم شاملة** لإدارة جميع المحتويات
- **إدارة الملف الشخصي** (الاسم، الصورة، السيرة، المهارات)
- **إدارة المشاريع** (إضافة، تعديل، حذف، رفع صور)
- **إدارة الخدمات** مع الأيقونات
- **إدارة الروابط الاجتماعية**
- **الإعدادات العامة** للموقع

### 🔧 التقنيات المستخدمة
- **Laravel 11+** - إطار العمل الأساسي
- **MySQL/SQLite** - قاعدة البيانات
- **Tailwind CSS** - التصميم والتنسيق
- **Font Awesome** - الأيقونات
- **Cairo Font** - الخط العربي

## 🚀 التثبيت والتشغيل

### المتطلبات
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL أو SQLite

### خطوات التثبيت

1. **استنساخ المشروع**
```bash
git clone [repository-url]
cd ux_perience
```

2. **تثبيت التبعيات**
```bash
composer install
npm install
```

3. **إعداد البيئة**
```bash
cp .env.example .env
php artisan key:generate
```

4. **إعداد قاعدة البيانات**
```bash
# في ملف .env قم بتعديل إعدادات قاعدة البيانات
DB_CONNECTION=sqlite
# أو
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

5. **تشغيل الـ Migrations والـ Seeders**
```bash
php artisan migrate
php artisan db:seed --class=DemoDataSeeder
```

6. **إنشاء رابط التخزين**
```bash
php artisan storage:link
```

7. **تشغيل الخادم**
```bash
php artisan serve
```

الموقع سيكون متاح على: `http://localhost:8000`

## 🔐 بيانات تسجيل الدخول

للوصول إلى لوحة التحكم:
- **الرابط**: `http://localhost:8000/login`
- **البريد الإلكتروني**: `admin@example.com`
- **كلمة المرور**: `password`

## 📁 هيكل المشروع

```
app/
├── Http/Controllers/
│   ├── Front/           # متحكمات الواجهة الأمامية
│   └── Admin/           # متحكمات لوحة التحكم
├── Models/              # النماذج
│   ├── User.php
│   ├── Project.php
│   ├── Service.php
│   ├── SocialLink.php
│   └── Setting.php

resources/views/
├── layouts/
│   ├── app.blade.php    # تخطيط الواجهة الأمامية
│   └── admin.blade.php  # تخطيط لوحة التحكم
├── front/               # صفحات الواجهة الأمامية
├── admin/               # صفحات لوحة التحكم
└── auth/                # صفحات المصادقة

database/
├── migrations/          # ملفات قاعدة البيانات
└── seeders/            # البيانات التجريبية
```

## 🎨 التخصيص

### الألوان
يمكنك تغيير الألوان الأساسية في:
- `resources/views/layouts/app.blade.php` (Tailwind config)
- `public/css/custom.css`

### الخطوط
الخط الحالي: **Cairo** للعربية
يمكن تغييره من الـ layout الأساسي.

### المحتوى
جميع المحتويات قابلة للتعديل من لوحة التحكم أو مباشرة من قاعدة البيانات.

## 📊 قاعدة البيانات

### الجداول الرئيسية
- `users` - بيانات المستخدم والملف الشخصي
- `projects` - المشاريع مع الصور والتفاصيل
- `services` - الخدمات المقدمة
- `social_links` - روابط التواصل الاجتماعي
- `settings` - إعدادات الموقع العامة

## 🔧 الصيانة والتطوير

### إضافة مشروع جديد
```php
Project::create([
    'title' => 'اسم المشروع',
    'description' => 'وصف المشروع',
    'category' => 'نوع المشروع',
    'tools' => ['Laravel', 'Vue.js'],
    'featured' => true
]);
```

### إضافة خدمة جديدة
```php
Service::create([
    'title' => 'اسم الخدمة',
    'description' => 'وصف الخدمة',
    'icon' => 'fas fa-code'
]);
```

## 🚀 النشر على الإنتاج

1. **رفع الملفات** على الخادم
2. **تثبيت التبعيات**
```bash
composer install --optimize-autoloader --no-dev
```
3. **إعداد البيئة**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
4. **إعداد صلاحيات المجلدات**
```bash
chmod -R 755 storage bootstrap/cache
```

## 📞 الدعم والمساعدة

للحصول على المساعدة أو الإبلاغ عن مشاكل:
- إنشاء Issue في GitHub
- التواصل عبر البريد الإلكتروني

## 📄 الترخيص

هذا المشروع مرخص تحت رخصة MIT - راجع ملف [LICENSE](LICENSE) للتفاصيل.

---

**تم التطوير بـ ❤️ باستخدام Laravel**