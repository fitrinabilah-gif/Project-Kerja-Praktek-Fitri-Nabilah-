# CARA MEMBUAT GAMBAR HERO BACKGROUND FULL
## Website PERISAI - Sudah Diperbaiki! ✅

### ✅ YANG SUDAH SAYA PERBAIKI

File CSS sudah diupdate dengan perubahan berikut:

#### 1. Grid Layout (Proporsi Text vs Image)
```css
/* SEBELUM: 50% - 50% */
grid-template-columns: 1fr 1fr;

/* SESUDAH: 45% - 55% (Gambar lebih besar!) */
grid-template-columns: 45% 55%;
```

#### 2. Ukuran Gambar
```css
/* SEBELUM: Dibatasi 700px */
.hero-image img {
    max-width: 700px;
}

/* SESUDAH: Full size tanpa batas! */
.hero-image img {
    width: 100%;
    max-width: 100%;
    object-fit: contain;
}
```

#### 3. Hero Section Height
```css
/* SEBELUM */
min-height: 600px;

/* SESUDAH */
min-height: 650px;
padding: 6rem 5% 4rem;  /* Lebih lega */
```

### 🎯 HASIL AKHIR

✅ Gambar sekarang mengisi **55% dari lebar halaman**
✅ Tidak ada batasan max-width
✅ Tampilan lebih besar dan penuh
✅ Drop shadow untuk efek depth
✅ Responsive di semua ukuran layar

### 🚀 CARA MENGGUNAKANNYA

1. **Download file ZIP terbaru** yang saya berikan
2. **Extract** ke C:\xampp\htdocs\perisai-website\
3. **Refresh browser** dengan Ctrl+F5
4. **Lihat hasilnya** - gambar sekarang FULL! 🎉

### 📱 RESPONSIVE

**Desktop (lebar >1024px):**
- Text: 45% kiri
- Gambar: 55% kanan (BESAR!)

**Tablet (768-1024px):**
- Gambar di atas (max 600px)
- Text di bawah
- Centered

**Mobile (<768px):**
- Gambar di atas (100% width)
- Text di bawah (centered)
- Order dibalik otomatis

### 💡 TIPS MEMBUAT LEBIH BESAR LAGI

Jika masih ingin gambar LEBIH BESAR, edit `css/style.css`:

**Option 1: Ubah Proporsi Grid**
```css
.hero-content {
    grid-template-columns: 40% 60%;  /* 60% untuk gambar */
}
```

**Option 2: Gambar Keluar Container**
```css
.hero-image img {
    width: 120%;  /* Gambar 120% dari container */
    margin-left: -10%;
}
```

**Option 3: Full Width Container**
```css
.hero-content {
    max-width: 100%;  /* Hapus batasan width */
    padding: 0 2%;
}
```

### 🖼️ REKOMENDASI UKURAN GAMBAR

Untuk hasil optimal:
- **Ukuran:** 1200px × 800px
- **Format:** PNG (background transparan)
- **Resolusi:** 150 DPI
- **File size:** < 500KB
- **Tool optimize:** TinyPNG.com

### 🎨 BONUS: Enhancement Tambahan

#### 1. Zoom on Hover
Tambahkan di CSS:
```css
.hero-image img {
    transition: transform 0.3s ease;
}
.hero-image:hover img {
    transform: scale(1.05);
}
```

#### 2. Parallax Effect
Tambahkan di JavaScript:
```javascript
window.addEventListener('scroll', function() {
    const heroImg = document.querySelector('.hero-image img');
    heroImg.style.transform = `translateY(${window.pageYOffset * 0.3}px)`;
});
```

#### 3. Gradient Overlay
```css
.hero-image::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.1));
}
```

### 🔍 PERBANDINGAN

| Aspek | Versi Lama | Versi Baru |
|-------|-----------|-----------|
| Lebar Gambar | 50% (700px max) | 55% (no limit) |
| Height Section | 600px | 650px |
| Padding | 4rem | 6rem top |
| Visual Impact | ⭐⭐⭐ | ⭐⭐⭐⭐⭐ |

### ✅ TESTING CHECKLIST

Setelah update:
- [ ] Refresh dengan Ctrl+F5
- [ ] Cek di desktop - gambar lebih besar?
- [ ] Cek di tablet (resize browser)
- [ ] Cek di mobile (F12 > mobile view)
- [ ] Text masih readable?
- [ ] No horizontal scroll?

### 🐛 TROUBLESHOOTING

**Q: Gambar masih kecil setelah update?**
A: 
1. Clear browser cache
2. Hard refresh (Ctrl+Shift+R)
3. Pastikan file css/style.css sudah ter-replace

**Q: Layout pecah di mobile?**
A: Sudah dihandle di responsive CSS, tapi bisa tambahkan:
```css
@media (max-width: 768px) {
    .hero-content {
        grid-template-columns: 1fr !important;
    }
}
```

**Q: Mau gambar SANGAT BESAR (fullscreen)?**
A: Ubah menjadi:
```css
.hero-section {
    min-height: 100vh;
}
.hero-image img {
    width: 150%;
    max-width: none;
}
```

### 📞 BUTUH BANTUAN?

Jika masih ada yang tidak jelas:
1. Cek file QUICK_START.txt
2. Cek file INSTALL.md
3. Email: info@perisai-bpjs.go.id

---

**CATATAN PENTING:**
File CSS yang saya berikan SUDAH TERUPDATE dengan semua perbaikan ini.
Anda tinggal download, extract, dan refresh browser! 🚀

© 2024 BPJS Ketenagakerjaan - Program PERISAI
Update: Hero Background Enhanced - 16 Feb 2024
