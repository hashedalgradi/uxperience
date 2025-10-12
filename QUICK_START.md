# 🚀 دليل التشغيل السريع

## خطوات التشغيل (5 دقائق)

### 1. تشغيل الـ Migrations والبيانات التجريبية
```bash
php artisan migrate
php artisan db:seed --class=DemoDataSeeder
```

### 2. إنشاء رابط التخزين
```bash
php artisan storage:link
```

### 3. تشغيل الخادم
```bash
php artisan serve
```

## 🔗 الروابط المهمة

- **الموقع الرئيسي**: http://localhost:8000
- **تسجيل الدخول**: http://localhost:8000/login
- **لوحة التحكم**: http://localhost:8000/admin

## 🔐 بيانات الدخول

- **البريد**: admin@example.com
- **كلمة المرور**: password

## 📱 صفحات الموقع

### الواجهة الأمامية
- `/` - الصفحة الرئيسية
- `/about` - من أنا
- `/projects` - المشاريع
- `/services` - الخدمات
- `/contact` - التواصل

### لوحة التحكم
- `/admin` - الرئيسية
- `/login` - تسجيل الدخول

## 🎨 التخصيص السريع

### تغيير المعلومات الشخصية
1. سجل دخول للوحة التحكم
2. أو عدل مباشرة في قاعدة البيانات جدول `users`

### إضافة مشروع جديد
```php
Project::create([
    'title' => 'اسم المشروع',
    'description' => 'وصف المشروع',
    'category' => 'تطوير ويب',
    'tools' => ['Laravel', 'Vue.js'],
    'featured' => true
]);
```

### إضافة خدمة جديدة
```php
Service::create([
    'title' => 'تطوير المواقع',
    'description' => 'وصف الخدمة',
    'icon' => 'fas fa-code'
]);
```

## 🛠️ حل المشاكل الشائعة

### مشكلة Vite manifest
الحل موجود - نستخدم Tailwind CDN بدلاً من Vite

### مشكلة الصور
تأكد من تشغيل:
```bash
php artisan storage:link
```

### مشكلة قاعدة البيانات
```bash
php artisan migrate:fresh --seed
```

## 📞 الدعم

للمساعدة أو الاستفسارات، راجع ملف `PORTFOLIO_README.md` للتفاصيل الكاملة.

---
**جاهز للاستخدام! 🎉**