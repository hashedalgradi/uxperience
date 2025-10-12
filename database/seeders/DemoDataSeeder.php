<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Service;
use App\Models\SocialLink;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء المستخدم الرئيسي
        $user = User::create([
            'name' => 'أحمد محمد',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'title' => 'مطور ويب ومصمم واجهات',
            'bio' => 'مطور ويب متخصص في تطوير المواقع والتطبيقات باستخدام أحدث التقنيات مثل Laravel و React. أسعى دائماً لتقديم حلول مبتكرة وعملية تلبي احتياجات العملاء وتحقق أهدافهم التجارية.',
            'phone' => '+966501234567',
            'skills' => ['Laravel', 'PHP', 'JavaScript', 'React', 'Vue.js', 'MySQL', 'HTML/CSS', 'Bootstrap', 'Tailwind CSS', 'Git']
        ]);

        // إنشاء المشاريع
        $projects = [
            [
                'title' => 'متجر إلكتروني متكامل',
                'description' => 'متجر إلكتروني شامل مبني بـ Laravel مع لوحة تحكم متقدمة، نظام دفع آمن، وإدارة المخزون. يتضمن واجهة مستخدم حديثة وتجربة تسوق سلسة.',
                'category' => 'تطوير ويب',
                'tools' => ['Laravel', 'MySQL', 'Bootstrap', 'JavaScript', 'PayPal API'],
                'github' => 'https://github.com/example/ecommerce',
                'demo' => 'https://demo-store.example.com',
                'featured' => true
            ],
            [
                'title' => 'نظام إدارة المحتوى',
                'description' => 'نظام إدارة محتوى مخصص يتيح للمستخدمين إنشاء وإدارة المواقع بسهولة. يتضمن محرر نصوص متقدم ونظام صلاحيات مرن.',
                'category' => 'أنظمة إدارة',
                'tools' => ['Laravel', 'Vue.js', 'MySQL', 'TinyMCE'],
                'github' => 'https://github.com/example/cms',
                'demo' => 'https://cms-demo.example.com',
                'featured' => true
            ],
            [
                'title' => 'تطبيق إدارة المهام',
                'description' => 'تطبيق ويب لإدارة المهام والمشاريع مع إمكانية التعاون الجماعي. يتضمن تقويم تفاعلي وتقارير مفصلة.',
                'category' => 'تطبيقات ويب',
                'tools' => ['Laravel', 'React', 'MySQL', 'Chart.js'],
                'github' => 'https://github.com/example/task-manager',
                'demo' => 'https://tasks.example.com',
                'featured' => false
            ],
            [
                'title' => 'موقع شركة تقنية',
                'description' => 'موقع شركة احترافي مع تصميم حديث ومتجاوب. يتضمن صفحات الخدمات، المدونة، ونموذج تواصل متقدم.',
                'category' => 'تصميم مواقع',
                'tools' => ['Laravel', 'Tailwind CSS', 'Alpine.js'],
                'github' => 'https://github.com/example/company-website',
                'demo' => 'https://company.example.com',
                'featured' => true
            ]
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // إنشاء الخدمات
        $services = [
            [
                'title' => 'تطوير مواقع الويب',
                'description' => 'تطوير مواقع ويب احترافية ومتجاوبة باستخدام أحدث التقنيات مثل Laravel و React مع ضمان الأداء والأمان.',
                'icon' => 'fas fa-code'
            ],
            [
                'title' => 'تصميم واجهات المستخدم',
                'description' => 'تصميم واجهات مستخدم جذابة وسهلة الاستخدام مع التركيز على تجربة المستخدم وإمكانية الوصول.',
                'icon' => 'fas fa-paint-brush'
            ],
            [
                'title' => 'تطوير التطبيقات',
                'description' => 'بناء تطبيقات ويب تفاعلية وقواعد بيانات محسنة لتلبية احتياجات عملك الخاصة.',
                'icon' => 'fas fa-mobile-alt'
            ],
            [
                'title' => 'استشارات تقنية',
                'description' => 'تقديم استشارات تقنية متخصصة لمساعدتك في اختيار أفضل الحلول التقنية لمشروعك.',
                'icon' => 'fas fa-lightbulb'
            ],
            [
                'title' => 'صيانة وتطوير',
                'description' => 'خدمات صيانة وتطوير المواقع الحالية مع إضافة ميزات جديدة وتحسين الأداء.',
                'icon' => 'fas fa-tools'
            ],
            [
                'title' => 'تحسين محركات البحث',
                'description' => 'تحسين مواقع الويب لمحركات البحث (SEO) لزيادة الظهور والوصول لجمهور أوسع.',
                'icon' => 'fas fa-search'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // إنشاء الروابط الاجتماعية
        $socialLinks = [
            [
                'platform' => 'LinkedIn',
                'url' => 'https://linkedin.com/in/example'
            ],
            [
                'platform' => 'GitHub',
                'url' => 'https://github.com/example'
            ],
            [
                'platform' => 'WhatsApp',
                'url' => 'https://wa.me/966501234567'
            ],
            [
                'platform' => 'Email',
                'url' => 'mailto:contact@example.com'
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://instagram.com/example'
            ]
        ];

        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }

        // إنشاء الإعدادات
        $settings = [
            ['key' => 'site_name', 'value' => 'الموقع الشخصي'],
            ['key' => 'site_description', 'value' => 'موقع شخصي لمطور ويب محترف'],
            ['key' => 'primary_color', 'value' => '#2563EB'],
            ['key' => 'secondary_color', 'value' => '#F97316'],
            ['key' => 'footer_text', 'value' => 'جميع الحقوق محفوظة']
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
