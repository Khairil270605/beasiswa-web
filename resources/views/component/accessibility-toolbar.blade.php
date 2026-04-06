{{-- resources/views/components/accessibility-toolbar.blade.php --}}
<div id="accessibility-toolbar" class="accessibility-toolbar" role="region" aria-label="Pengaturan Aksesibilitas">
    <!-- Toggle Button -->
    <button id="accessibility-toggle" 
            class="accessibility-toggle" 
            aria-label="Buka Panel Aksesibilitas"
            aria-expanded="false"
            aria-controls="accessibility-panel">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <circle cx="12" cy="12" r="4"></circle>
            <line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line>
            <line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line>
            <line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line>
            <line x1="14.83" y1="9.17" x2="18.36" y2="5.64"></line>
            <line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line>
        </svg>
    </button>

    <!-- Accessibility Panel -->
    <div id="accessibility-panel" class="accessibility-panel" hidden>
        <div class="accessibility-header">
            <h2 id="accessibility-title">Pengaturan Aksesibilitas</h2>
            <button id="accessibility-close" class="accessibility-close" aria-label="Tutup Panel">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="accessibility-content">
            <!-- Font Size -->
            <div class="accessibility-group">
                <label for="font-size-select">
                    <strong>Ukuran Teks</strong>
                </label>
                <select id="font-size-select" class="accessibility-select" aria-describedby="font-size-desc">
                    <option value="small">Kecil</option>
                    <option value="medium" selected>Sedang (Default)</option>
                    <option value="large">Besar</option>
                    <option value="extra-large">Sangat Besar</option>
                </select>
                <p id="font-size-desc" class="accessibility-desc">Sesuaikan ukuran teks untuk kenyamanan membaca</p>
            </div>

            <!-- Contrast Mode -->
            <div class="accessibility-group">
                <label for="contrast-select">
                    <strong>Mode Kontras</strong>
                </label>
                <select id="contrast-select" class="accessibility-select" aria-describedby="contrast-desc">
                    <option value="normal" selected>Normal</option>
                    <option value="high">Kontras Tinggi</option>
                    <option value="dark">Mode Gelap</option>
                </select>
                <p id="contrast-desc" class="accessibility-desc">Pilih skema warna yang nyaman untuk mata</p>
            </div>

            <!-- Dyslexia Font -->
            <div class="accessibility-group">
                <label class="accessibility-checkbox">
                    <input type="checkbox" id="dyslexia-font" aria-describedby="dyslexia-desc">
                    <span><strong>Font Ramah Disleksia</strong></span>
                </label>
                <p id="dyslexia-desc" class="accessibility-desc">Gunakan font yang lebih mudah dibaca untuk penderita disleksia</p>
            </div>

            <!-- Screen Reader Mode -->
            <div class="accessibility-group">
                <label class="accessibility-checkbox">
                    <input type="checkbox" id="screen-reader-mode" aria-describedby="screen-reader-desc">
                    <span><strong>Mode Pembaca Layar</strong></span>
                </label>
                <p id="screen-reader-desc" class="accessibility-desc">Optimasi untuk pengguna pembaca layar</p>
            </div>

            <!-- Keyboard Navigation -->
            <div class="accessibility-group">
                <label class="accessibility-checkbox">
                    <input type="checkbox" id="keyboard-navigation" checked aria-describedby="keyboard-desc">
                    <span><strong>Navigasi Keyboard</strong></span>
                </label>
                <p id="keyboard-desc" class="accessibility-desc">Aktifkan navigasi menggunakan keyboard</p>
            </div>

            <!-- Actions -->
            <div class="accessibility-actions">
                <button id="save-accessibility" class="btn-primary">Simpan Pengaturan</button>
                <button id="reset-accessibility" class="btn-secondary">Reset ke Default</button>
            </div>
        </div>
    </div>
</div>

<!-- Skip to Content Link -->
<a href="#main-content" class="skip-link">Lewati ke Konten Utama</a>

<style>
/* Accessibility Toolbar Styles */
.accessibility-toolbar {
    position: fixed !important;
    bottom: 90px !important;
    left: 20px !important;
    z-index: 99999 !important;
}

.accessibility-toggle {
    width: 56px !important;
    height: 56px !important;
    border-radius: 50% !important;
    background: #4F46E5 !important;
    color: white !important;
    border: none !important;
    cursor: pointer !important;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s ease !important;
}

.accessibility-toggle:hover,
.accessibility-toggle:focus {
    background: #4338CA !important;
    transform: scale(1.1);
}

.accessibility-toggle:focus {
    outline: 3px solid #FCD34D;
    outline-offset: 2px;
}

.accessibility-panel {
    position: fixed;
    bottom: 160px;
    left: 20px;
    width: 350px;
    max-height: 80vh;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    z-index: 99998;
}

.accessibility-panel[hidden] {
    display: none;
}

.accessibility-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: #4F46E5;
    color: white;
}

.accessibility-header h2 {
    margin: 0;
    font-size: 18px;
}

.accessibility-close {
    background: transparent;
    border: none;
    color: white;
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
}

.accessibility-close:hover,
.accessibility-close:focus {
    background: rgba(255,255,255,0.2);
}

.accessibility-close:focus {
    outline: 2px solid #FCD34D;
}

.accessibility-content {
    padding: 20px;
    overflow-y: auto;
}

.accessibility-group {
    margin-bottom: 24px;
}

.accessibility-group label {
    display: block;
    margin-bottom: 8px;
}

.accessibility-select {
    width: 100%;
    padding: 10px;
    border: 2px solid #E5E7EB;
    border-radius: 6px;
    font-size: 14px;
    background: white;
}

.accessibility-select:focus {
    outline: none;
    border-color: #4F46E5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.accessibility-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.accessibility-checkbox input[type="checkbox"] {
    width: 20px;
    height: 20px;
    margin-right: 10px;
    cursor: pointer;
}

.accessibility-checkbox input[type="checkbox"]:focus {
    outline: 2px solid #4F46E5;
    outline-offset: 2px;
}

.accessibility-desc {
    margin: 8px 0 0 0;
    font-size: 13px;
    color: #6B7280;
    line-height: 1.4;
}

.accessibility-actions {
    display: flex;
    gap: 10px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #E5E7EB;
}

.btn-primary, .btn-secondary {
    flex: 1;
    padding: 12px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-primary {
    background: #4F46E5;
    color: white;
}

.btn-primary:hover {
    background: #4338CA;
}

.btn-primary:focus {
    outline: 3px solid #FCD34D;
    outline-offset: 2px;
}

.btn-secondary {
    background: #F3F4F6;
    color: #374151;
}

.btn-secondary:hover {
    background: #E5E7EB;
}

.btn-secondary:focus {
    outline: 3px solid #4F46E5;
    outline-offset: 2px;
}

/* Skip Link */
.skip-link {
    position: absolute;
    top: -40px;
    left: 0;
    background: #000;
    color: #fff;
    padding: 8px 16px;
    text-decoration: none;
    z-index: 100000;
}

.skip-link:focus {
    top: 0;
}

/* Accessibility Classes */
body.font-small {
    font-size: 14px;
}

body.font-medium {
    font-size: 16px;
}

body.font-large {
    font-size: 18px;
}

body.font-extra-large {
    font-size: 20px;
}

body.contrast-high {
    filter: contrast(1.5);
}

body.contrast-dark {
    background: #1F2937 !important;
    color: #F9FAFB !important;
}

body.contrast-dark .accessibility-panel {
    background: #374151;
    color: #F9FAFB;
}

body.dyslexia-font * {
    font-family: 'OpenDyslexic', 'Comic Sans MS', sans-serif !important;
}

/* Focus visible for keyboard navigation */
body.keyboard-nav *:focus {
    outline: 3px solid #FCD34D !important;
    outline-offset: 2px !important;
}

@media (max-width: 768px) {
    .accessibility-panel {
        width: calc(100vw - 40px);
        left: 20px;
    }
    
    .accessibility-toolbar {
        left: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('accessibility-toggle');
    const panel = document.getElementById('accessibility-panel');
    const closeBtn = document.getElementById('accessibility-close');
    const saveBtn = document.getElementById('save-accessibility');
    const resetBtn = document.getElementById('reset-accessibility');
    
    const fontSizeSelect = document.getElementById('font-size-select');
    const contrastSelect = document.getElementById('contrast-select');
    const dyslexiaCheck = document.getElementById('dyslexia-font');
    const screenReaderCheck = document.getElementById('screen-reader-mode');
    const keyboardCheck = document.getElementById('keyboard-navigation');

    // Toggle panel
    toggle.addEventListener('click', function() {
        const isHidden = panel.hasAttribute('hidden');
        if (isHidden) {
            panel.removeAttribute('hidden');
            toggle.setAttribute('aria-expanded', 'true');
        } else {
            panel.setAttribute('hidden', '');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });

    closeBtn.addEventListener('click', function() {
        panel.setAttribute('hidden', '');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.focus();
    });

    // Load saved settings on page load (auto-apply hanya jika user sudah pernah save)
    loadSettings();

    // Save settings
    saveBtn.addEventListener('click', async function() {
        const settings = {
            font_size: fontSizeSelect.value,
            contrast_mode: contrastSelect.value,
            dyslexia_font: dyslexiaCheck.checked ? 1 : 0,
            screen_reader_mode: screenReaderCheck.checked ? 1 : 0,
            keyboard_navigation: keyboardCheck.checked ? 1 : 0,
        };

        try {
            const response = await fetch('/accessibility/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(settings)
            });

            const data = await response.json();
            
            if (data.success) {
                applySettings(settings);
                alert('Pengaturan aksesibilitas berhasil disimpan!');
                // Tutup panel setelah save
                panel.setAttribute('hidden', '');
                toggle.setAttribute('aria-expanded', 'false');
            }
        } catch (error) {
            console.error('Error saving settings:', error);
            alert('Gagal menyimpan pengaturan');
        }
    });

    // Reset settings
    resetBtn.addEventListener('click', async function() {
        if (!confirm('Yakin ingin mereset pengaturan ke default?')) return;

        try {
            const response = await fetch('/accessibility/reset', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();
            
            if (data.success) {
                resetToDefaults();
                alert('Pengaturan direset ke default');
            }
        } catch (error) {
            console.error('Error resetting settings:', error);
        }
    });

    // Load settings dan apply HANYA jika user sudah pernah save sebelumnya
    async function loadSettings() {
        try {
            const response = await fetch('/accessibility/get');
            const settings = await response.json();
            
            // Cek apakah user sudah punya custom settings (bukan default)
            const hasCustomSettings = settings.font_size !== 'medium' || 
                                     settings.contrast_mode !== 'normal' || 
                                     settings.dyslexia_font || 
                                     settings.screen_reader_mode;
            
            // Isi form dengan settings yang tersimpan
            fontSizeSelect.value = settings.font_size || 'medium';
            contrastSelect.value = settings.contrast_mode || 'normal';
            dyslexiaCheck.checked = settings.dyslexia_font || false;
            screenReaderCheck.checked = settings.screen_reader_mode || false;
            keyboardCheck.checked = settings.keyboard_navigation !== false;
            
            // HANYA apply ke halaman jika user sudah pernah save custom settings
            if (hasCustomSettings) {
                applySettings(settings);
            }
        } catch (error) {
            console.error('Error loading settings:', error);
            // Jika error (misal user belum pernah save), tidak apa-apa, biarkan default
        }
    }

    function applySettings(settings) {
        // Font size
        document.body.className = document.body.className.replace(/font-\w+/g, '');
        document.body.classList.add('font-' + settings.font_size);
        
        // Contrast mode
        document.body.className = document.body.className.replace(/contrast-\w+/g, '');
        if (settings.contrast_mode !== 'normal') {
            document.body.classList.add('contrast-' + settings.contrast_mode);
        }
        
        // Dyslexia font
        document.body.classList.toggle('dyslexia-font', settings.dyslexia_font);
        
        // Keyboard navigation
        document.body.classList.toggle('keyboard-nav', settings.keyboard_navigation);
    }

    function resetToDefaults() {
        fontSizeSelect.value = 'medium';
        contrastSelect.value = 'normal';
        dyslexiaCheck.checked = false;
        screenReaderCheck.checked = false;
        keyboardCheck.checked = true;
        
        // Remove all accessibility classes
        document.body.className = document.body.className
            .replace(/font-\w+/g, '')
            .replace(/contrast-\w+/g, '')
            .replace(/dyslexia-font/g, '')
            .replace(/keyboard-nav/g, '');
        
        // Apply default classes
        document.body.classList.add('font-medium');
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Alt + A to open accessibility panel
        if (e.altKey && e.key === 'a') {
            e.preventDefault();
            toggle.click();
        }
        
        // ESC to close panel
        if (e.key === 'Escape' && !panel.hasAttribute('hidden')) {
            closeBtn.click();
        }
    });
});
</script>