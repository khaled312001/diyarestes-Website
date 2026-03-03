
pages = [
    ('13', 'home', 'الرئيسية — DIYAR Estates', 'screenshots/home.png', 'www.diyarestes.com — الرئيسية', 'Home Page', 'fas fa-home'),
    ('14', 'about', 'من نحن — About DIYAR Estates', 'screenshots/about.png', 'www.diyarestes.com/about — من نحن', 'رؤية الشركة وقيمها', 'fas fa-users'),
    ('15', 'investors', 'بوابة المستثمرين — Investors Portal', 'screenshots/investors.png', 'www.diyarestes.com/investors — المستثمرون', 'فرص الاستثمار وعوائد الربح', 'fas fa-chart-line'),
    ('16', 'contact', 'تواصل معنا — Contact Page', 'screenshots/contact.png', 'www.diyarestes.com/contact — تواصل معنا', 'نموذج تواصل وخريطة', 'fas fa-envelope'),
    
    ('17', 'projects-egypt', 'مشاريع ديار في مصر', 'screenshots/projects-egypt.png', 'www.diyarestes.com/projects/egypt', 'قائمة المشاريع الفندقية والزراعية', 'fas fa-flag'),
    ('18', 'projects-usa', 'مشاريع ديار في أمريكا', 'screenshots/projects-usa.png', 'www.diyarestes.com/projects/usa', 'ديار للإقامة الفاخرة', 'fas fa-flag'),
    ('19', 'projects-turkey', 'مشاريع ديار في تركيا', 'screenshots/projects-turkey.png', 'www.diyarestes.com/projects/turkey', 'بوسفور ريزيدنسز', 'fas fa-flag'),
    
    ('20', 'candle-hotel', 'كاندل هوتيل دندرة — Candle Hotel', 'screenshots/project-candle-hotel.png', 'www.diyarestes.com/projects/candle-hotel', 'مشروع فندقي ٥ نجوم', 'fas fa-hotel'),
    ('21', 'al-reef', 'الريف القنوي — Al Reef Al Qenawi', 'screenshots/project-al-reef.png', 'www.diyarestes.com/projects/al-reef-al-qenawi', 'مشروع زراعي ٤٠٠٠ فدان', 'fas fa-seedling'),
    ('22', '160-feddan', 'مزرعة ١٦٠ فدان — 160 Feddan Farm', 'screenshots/project-feddan-160.png', 'www.diyarestes.com/projects/feddan-farm-160', 'مزرعة تشغيلية', 'fas fa-seedling'),
    ('23', 'usa-residences', 'ديار للإقامة الفاخرة — USA Residences', 'screenshots/project-usa-residences.png', 'www.diyarestes.com/projects/usa-project-1', 'مجتمع مسور حصري', 'fas fa-home'),
    ('24', 'bosphorus', 'بوسفور ريزيدنسز — Bosphorus', 'screenshots/project-bosphorus.png', 'www.diyarestes.com/projects/turkey-project-1', 'إطلالة بانورامية', 'fas fa-building'),
    
    ('25', 'admin-dashboard', 'لوحة التحكم — Dashboard', 'screenshots/Admin/Dashboard.png', 'admin.diyarestes.com/dashboard', 'لوحة التحكم الرئيسية', 'fas fa-tachometer-alt'),
    ('26', 'admin-analytics', 'إحصائيات النظام — Analytics', 'screenshots/Admin/Analytics.png', 'admin.diyarestes.com/analytics', 'تحليلات الموقع والزوار', 'fas fa-chart-pie'),
    ('27', 'admin-projects', 'إدارة المشاريع — Projects', 'screenshots/Admin/Projects.png', 'admin.diyarestes.com/projects', 'إضافة وتعديل المشاريع', 'fas fa-city'),
    ('28', 'admin-inquiries', 'الاستفسارات — Inquiries', 'screenshots/Admin/Inquiries.png', 'admin.diyarestes.com/inquiries', 'رسائل العملاء والمستثمرين', 'fas fa-inbox'),
    ('29', 'admin-investors', 'المستثمرون — Investors', 'screenshots/Admin/Investors.png', 'admin.diyarestes.com/investors', 'قاعدة بيانات المستثمرين', 'fas fa-users-cog'),
    ('30', 'admin-pages', 'إدارة الصفحات — Pages', 'screenshots/Admin/Pages.png', 'admin.diyarestes.com/pages', 'محتوى صفحات الموقع', 'fas fa-file-alt'),
    ('31', 'admin-media', 'مكتبة الوسائط — Media Library', 'screenshots/Admin/Media Library.png', 'admin.diyarestes.com/media', 'ملفات الصور والفيديو', 'fas fa-images'),
    ('32', 'admin-settings', 'إعدادات النظام — Settings', 'screenshots/Admin/Settings.png', 'admin.diyarestes.com/settings', 'إعدادات الموقع العامة', 'fas fa-cog'),
]

arabic_nums = {'0': '٠', '1': '١', '2': '٢', '3': '٣', '4': '٤', '5': '٥', '6': '٦', '7': '٧', '8': '٨', '9': '٩'}

html = ""
for p in pages:
    num_ar = ''.join(arabic_nums[c] for c in p[0])
    icon = p[6]
    html += f"""    <!-- ═══════ PAGE {p[0]} — {p[1].upper()} ═══════ -->
    <div class="page screen-page">
        <div class="ph">
            <div class="ph-left">
                <div class="ph-icon"><i class="{icon}"></i></div>
                <div>
                    <div class="ph-title">{p[2]}</div>
                    <div class="ph-sub">{p[5]}</div>
                </div>
            </div>
            <div class="ph-badge">الصفحة {num_ar}</div>
        </div>
        <div class="screen-wrap">
            <div class="screen-browser">
                <div class="sb-dots">
                    <div class="sb-dot r"></div>
                    <div class="sb-dot y"></div>
                    <div class="sb-dot g"></div>
                </div>
                <div class="sb-bar">🔒 {p[4]}</div>
            </div>
            <img src="{p[3]}" alt="{p[2]}">
        </div>
        <div class="pf"><span>Barmagly · info@barmagly.tech · +201010254819</span><span class="pnum">{num_ar}</span></div>
    </div>\n
"""

with open('screens_html.txt', 'w', encoding='utf-8') as f:
    f.write(html)
