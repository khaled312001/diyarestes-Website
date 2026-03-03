import re

with open('barmagly-proposal.html', 'r', encoding='utf-8') as f:
    content = f.read()

with open('screens_html.txt', 'r', encoding='utf-8') as f:
    screens_html = f.read()

# Replace pages 13 through 21
new_content = re.sub(
    r'<!-- ═══════ PAGE 13 — DIYAR HOME SCREENSHOT ═══════ -->.*?<!-- ═══════ PAGE 22 — FRONTEND \+ BACKEND FEATURES ═══════ -->',
    screens_html + '    <!-- ═══════ PAGE 33 — FRONTEND + BACKEND FEATURES ═══════ -->',
    content,
    flags=re.DOTALL
)

# Replace remaining page labels (22 to 24 => 33 to 35)

new_content = new_content.replace('PAGE 22 — FRONTEND + BACKEND FEATURES', 'PAGE 33 — FRONTEND + BACKEND FEATURES')
new_content = new_content.replace('الصفحة ٢٢</div>', 'الصفحة ٣٣</div>')
new_content = new_content.replace('<span class="pnum">٢٢</span>', '<span class="pnum">٣٣</span>')

new_content = new_content.replace('PAGE 23 — PRICING', 'PAGE 34 — PRICING')
new_content = new_content.replace('الصفحة ٢٣</div>', 'الصفحة ٣٤</div>')
new_content = new_content.replace('<span class="pnum">٢٣</span>', '<span class="pnum">٣٤</span>')

new_content = new_content.replace('PAGE 24 — CONTACT', 'PAGE 35 — CONTACT')
new_content = new_content.replace('الصفحة ٢٤</div>', 'الصفحة ٣٥</div>')
new_content = new_content.replace('<span class="pnum">٢٤</span>', '<span class="pnum">٣٥</span>')

# Update CSS for .screen-wrap img
css_old = r'''.screen-wrap img {
            width: 100%;
            display: block;
            object-fit: cover;
            object-position: top center;
        }'''

css_new = '''.screen-wrap img {
            width: 100%;
            display: block;
            height: auto;
            max-height: 240mm;
            object-fit: contain;
            object-position: top center;
        }'''

if css_old in new_content:
    new_content = new_content.replace(css_old, css_new)
else:
    # Try regex
    new_content = re.sub(
        r'\.screen-wrap img\s*\{\s*width:\s*100%;\s*display:\s*block;\s*object-fit:\s*cover;\s*object-position:\s*top center;\s*\}',
        css_new,
        new_content
    )

with open('barmagly-proposal.html', 'w', encoding='utf-8') as f:
    f.write(new_content)

print("Done")
