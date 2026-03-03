import re

with open('barmagly-proposal.html', 'r', encoding='utf-8') as f:
    text = f.read()

css_new = '''/* COVER */
        .cover {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 297mm;
            background: #02050B;
            padding: 0;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .cover::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 70%;
            height: 70%;
            background: radial-gradient(circle, rgba(201,168,76,0.15) 0%, transparent 60%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(60px);
        }

        .cover::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 70%;
            height: 70%;
            background: radial-gradient(circle, rgba(10,22,40,0.8) 0%, transparent 60%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(80px);
        }

        .cover-grid {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
        }

        .cover-glass {
            position: relative;
            z-index: 2;
            width: 85%;
            max-width: 800px;
            background: rgba(10, 16, 28, 0.5);
            border: 1px solid rgba(201, 168, 76, 0.2);
            border-radius: 24px;
            padding: 50px 40px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            text-align: center;
        }

        .cover-from {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(90deg, rgba(201,168,76,0.1) 0%, rgba(201,168,76,0.02) 100%);
            border: 1px solid rgba(201, 168, 76, 0.3);
            border-radius: 50px;
            padding: 8px 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .cover-from .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 10px var(--gold);
        }

        .cover-from span {
            font-size: 14px;
            color: var(--gold2);
            letter-spacing: 1px;
            font-weight: 700;
        }

        .barmagly-logo-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 35px;
        }

        .b-icon {
            width: 65px;
            height: 65px;
            border-radius: 16px;
            background: linear-gradient(135deg, #FFDF73 0%, var(--gold) 50%, var(--gold3) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 900;
            color: var(--navy);
            box-shadow: 0 10px 25px rgba(201,168,76,0.3);
            margin-bottom: 16px;
            border: 2px solid rgba(255,255,255,0.4);
        }

        .b-name {
            font-size: 28px;
            font-weight: 900;
            color: var(--white);
            letter-spacing: 4px;
            text-transform: uppercase;
        }

        .b-sub {
            font-size: 10px;
            color: var(--gold2);
            letter-spacing: 5px;
            margin-top: 6px;
            text-transform: uppercase;
        }

        .cover-divider {
            width: 120px;
            height: 2px;
            margin: 0 auto 30px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .cover-presents {
            font-size: 15px;
            color: var(--gray);
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .cover-title {
            font-size: 52px;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 8px;
            color: var(--white);
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .cover-title .gold {
            background: linear-gradient(to right, #FFF4D0, var(--gold), #D4AF37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: var(--gold);
        }

        .cover-sub {
            font-size: 20px;
            font-weight: 400;
            color: var(--gray);
            margin-bottom: 40px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .cover-badges {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .c-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--white);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .c-badge i {
            color: var(--gold);
        }

        .cover-meta {
            display: flex;
            justify-content: center;
            gap: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 25px;
        }

        .c-meta-item {
            text-align: center;
        }

        .c-meta-val {
            font-size: 26px;
            font-weight: 900;
            color: var(--gold);
            text-shadow: 0 4px 10px rgba(201,168,76,0.2);
        }

        .c-meta-lbl {
            font-size: 11px;
            color: var(--gray);
            letter-spacing: 1px;
            margin-top: 4px;
            text-transform: uppercase;
        }

        .cover-footer {
            position: absolute;
            bottom: 30px;
            left: 40px;
            right: 40px;
            padding: 18px 30px;
            background: rgba(10, 16, 28, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--gray);
            z-index: 2;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }
'''

html_new = '''<!-- ═══════ PAGE 1 — COVER ═══════ -->
    <div class="page cover">
        <div class="cover-grid"></div>
        
        <div class="cover-glass">
            <div class="cover-from">
                <div class="dot"></div><span>عرض فني ومالي رسمي – مقدم من </span>
            </div>
            
            <div class="barmagly-logo-box">
                <div class="b-icon">B</div>
                <div class="b-name">Barmagly</div>
                <div class="b-sub">Swiss Precision · Global Innovation</div>
            </div>
            
            <div class="cover-divider"></div>
            
            <p class="cover-presents">تقدم بكل فخر واعتزاز هذا العرض المتكامل لـ</p>
            <h1 class="cover-title">موقع <span class="gold">ديار العقارية</span></h1>
            <p class="cover-sub">DIYAR Estates — International Real Estate</p>
            
            <div class="cover-badges">
                <div class="c-badge"><i class="fas fa-gem"></i> حلول برمجية فاخرة</div>
                <div class="c-badge"><i class="fas fa-mobile-alt"></i> تصميم متجاوب ١٠٠٪</div>
                <div class="c-badge"><i class="fas fa-shield-alt"></i> حماية وأمان عالي</div>
                <div class="c-badge"><i class="fas fa-globe"></i> مصر · أمريكا · تركيا</div>
            </div>
            
            <div class="cover-meta">
                <div class="c-meta-item">
                    <div class="c-meta-val">٢٢</div>
                    <div class="c-meta-lbl">صفحة فاخرة</div>
                </div>
                <div class="c-meta-item">
                    <div class="c-meta-val">١٥٠+</div>
                    <div class="c-meta-lbl">مشروع منجز</div>
                </div>
                <div class="c-meta-item">
                    <div class="c-meta-val">VIP</div>
                    <div class="c-meta-lbl">دعم فني وتطوير</div>
                </div>
            </div>
        </div>

        <div class="cover-footer">
            <span><i class="fas fa-map-marker-alt" style="color:var(--gold);margin-left:8px;"></i>Zürich, Switzerland · CHE-154.312.079</span>
            <span><i class="fas fa-envelope" style="color:var(--gold);margin-left:8px;"></i>info@barmagly.tech | +201010254819</span>
        </div>
    </div>'''

text = re.sub(r'/\* COVER \*/.*?(?=/\* INNER PAGES \*/)', css_new + '\n        ', text, flags=re.DOTALL)
text = re.sub(r'<!-- ═══════ PAGE 1 — COVER ═══════ -->.*?(?=<!-- ═══════ PAGE 2 )', html_new + '\n\n\n    ', text, flags=re.DOTALL)

with open('barmagly-proposal.html', 'w', encoding='utf-8') as f:
    f.write(text)

print('Updated successfully.')
