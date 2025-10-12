/**
 * Scene Configuration - إعدادات المشهد الثلاثي الأبعاد
 * ملف تكوين مركزي لجميع إعدادات المشهد والتأثيرات
 */

window.SceneConfig = {
    // إعدادات الألوان - متوافقة مع هوية الموقع
    colors: {
        primary: 0x6366f1,      // اللون الأساسي للموقع
        secondary: 0xec4899,    // اللون الثانوي
        accent: 0x00ffff,       // لون التمييز
        background: {
            start: '#1a1a2e',   // بداية التدرج
            middle: '#16213e',   // وسط التدرج
            end: '#0f0f23'       // نهاية التدرج
        },
        screen: {
            glow: 0x6366f1,     // توهج الشاشة
            content: '#0f172a',  // خلفية محتوى الشاشة
            text: '#e5e7eb'      // لون النص
        }
    },

    // إعدادات الإضاءة
    lighting: {
        ambient: {
            color: 0x404080,
            intensity: 0.3
        },
        key: {
            color: 0x6366f1,
            intensity: 1.2,
            position: [5, 8, 5],
            shadows: true
        },
        fill: {
            color: 0xec4899,
            intensity: 0.6,
            position: [-3, 4, 3]
        },
        rim: {
            color: 0x00ffff,
            intensity: 0.4,
            position: [0, 2, -5]
        },
        screen: {
            color: 0x6366f1,
            intensity: 0.8,
            distance: 10,
            position: [0, 1, 2]
        }
    },

    // إعدادات الكاميرا
    camera: {
        fov: 75,
        near: 0.1,
        far: 1000,
        position: [0, 2, 8],
        lookAt: [0, 0, 0]
    },

    // إعدادات الكمبيوتر
    computer: {
        laptop: {
            size: [4, 0.3, 2.5],
            position: [0, -0.15, 0],
            material: {
                color: 0x2a2a2a,
                metalness: 0.8,
                roughness: 0.2,
                clearcoat: 0.3,
                clearcoatRoughness: 0.1
            }
        },
        screen: {
            frame: {
                size: [3.8, 2.4, 0.1],
                position: [0, 1.2, -1.2],
                rotation: [-0.1, 0, 0],
                material: {
                    color: 0x1a1a1a,
                    metalness: 0.9,
                    roughness: 0.1
                }
            },
            display: {
                size: [3.4, 2.0],
                position: [0, 1.2, -1.15],
                rotation: [-0.1, 0, 0],
                resolution: [1024, 600]
            },
            glow: {
                size: [3.6, 2.2],
                position: [0, 1.2, -1.1],
                rotation: [-0.1, 0, 0],
                opacity: 0.1
            }
        },
        keyboard: {
            base: {
                size: [3.5, 0.1, 1.2],
                position: [0, 0.05, 0.5],
                material: {
                    color: 0x2a2a2a,
                    metalness: 0.7,
                    roughness: 0.3
                }
            },
            keys: {
                size: [0.12, 0.05, 0.12],
                rows: 4,
                cols: 12,
                spacing: 0.25,
                material: {
                    color: 0x404040,
                    metalness: 0.1,
                    roughness: 0.8
                }
            }
        },
        details: {
            logo: {
                radius: 0.15,
                position: [0, -0.05, -1.2],
                rotation: [-Math.PI / 2, 0, 0],
                color: 0x6366f1,
                emissive: 0x6366f1,
                emissiveIntensity: 0.2
            },
            ports: {
                count: 3,
                size: [0.05, 0.02, 0.15],
                basePosition: [-1.8, 0, -0.5],
                spacing: 0.2,
                material: {
                    color: 0x1a1a1a,
                    metalness: 0.9,
                    roughness: 0.1
                }
            }
        }
    },

    // إعدادات الجسيمات
    particles: {
        count: {
            high: 200,
            medium: 100,
            low: 50,
            mobile: 30
        },
        range: {
            desktop: 20,
            mobile: 15
        },
        size: {
            min: 0.05,
            max: 0.15,
            base: 0.1
        },
        colors: {
            hueStart: 0.6,
            hueRange: 0.2,
            saturation: 0.8,
            lightness: 0.6
        },
        animation: {
            speed: 0.05,
            waveIntensity: 0.001
        }
    },

    // إعدادات التفاعل
    interaction: {
        mouse: {
            sensitivity: {
                x: 0.2,
                y: 0.1
            },
            maxRotation: {
                x: 0.1,
                y: 0.2
            },
            smoothing: 0.05
        },
        scroll: {
            parallax: {
                position: 0.001,
                rotation: 0.0002
            }
        },
        keyboard: {
            enabled: true,
            keys: ['Enter', ' '] // مفاتيح التفاعل
        }
    },

    // إعدادات الحركة والانتقالات
    animation: {
        intro: {
            duration: 2000,
            easing: 0.05,
            initialPosition: [0, -5, 0],
            initialRotation: [0, Math.PI, 0],
            initialScale: [0.1, 0.1, 0.1]
        },
        floating: {
            amplitude: 0.003,
            frequency: 0.8
        },
        rotation: {
            baseSpeed: 0.1,
            waveAmplitude: 0.02,
            waveFrequency: 0.5
        },
        screen: {
            cursorBlinkSpeed: 2, // مرات في الثانية
            contentUpdateInterval: 500 // ميلي ثانية
        }
    },

    // إعدادات الأداء
    performance: {
        quality: {
            auto: true, // تكيف تلقائي
            default: 'high', // high, medium, low
            mobile: 'low'
        },
        fps: {
            target: 60,
            minimum: 30,
            monitoring: true
        },
        rendering: {
            antialias: {
                desktop: true,
                mobile: false
            },
            shadows: {
                enabled: true,
                mapSize: 2048,
                type: 'PCFSoft' // PCF, PCFSoft, VSM
            },
            toneMapping: {
                type: 'ACES', // ACES, Reinhard, Cineon
                exposure: 1.2
            }
        },
        optimization: {
            frustumCulling: true,
            objectPooling: true,
            adaptiveQuality: true,
            pauseOnHidden: true
        }
    },

    // إعدادات التأثيرات
    effects: {
        particles: {
            enabled: true,
            mouse: true,
            dynamic: true
        },
        glow: {
            enabled: true,
            intensity: {
                min: 0.3,
                max: 0.6,
                speed: 0.01
            }
        },
        hologram: {
            enabled: true,
            scanSpeed: 0.5,
            opacity: 0.1
        },
        lighting: {
            dynamic: true,
            speed: {
                light1: 0.01,
                light2: 0.015,
                light3: 0.008
            }
        },
        screen: {
            glow: true,
            flicker: false,
            scanlines: false
        }
    },

    // إعدادات محتوى الشاشة
    screenContent: {
        title: 'UX Experience - Portfolio',
        code: [
            'class Portfolio {',
            '  constructor() {',
            '    this.skills = ["React", "Laravel", "Three.js"];',
            '    this.passion = "Creating Amazing UX";',
            '  }',
            '',
            '  createMagic() {',
            '    return this.skills.map(skill => {',
            '      return new Innovation(skill);',
            '    });',
            '  }',
            '}',
            '',
            'const developer = new Portfolio();',
            'developer.createMagic();'
        ],
        syntax: {
            keywords: '#8b5cf6',
            methods: '#06b6d4',
            strings: '#10b981',
            comments: '#6b7280',
            default: '#e5e7eb'
        },
        cursor: {
            color: '#10b981',
            width: 2,
            height: 20,
            blinkSpeed: 3 // مرات في الثانية
        }
    },

    // إعدادات الاستجابة
    responsive: {
        breakpoints: {
            mobile: 768,
            tablet: 1024,
            desktop: 1200
        },
        adaptations: {
            mobile: {
                particles: false,
                hologram: false,
                shadows: false,
                quality: 'low'
            },
            tablet: {
                particles: true,
                hologram: false,
                shadows: true,
                quality: 'medium'
            },
            desktop: {
                particles: true,
                hologram: true,
                shadows: true,
                quality: 'high'
            }
        }
    },

    // إعدادات الوصولية
    accessibility: {
        reducedMotion: {
            respectPreference: true,
            fallbackMode: 'static'
        },
        keyboard: {
            navigation: true,
            shortcuts: true
        },
        screenReader: {
            descriptions: true,
            announcements: true
        },
        contrast: {
            highContrast: false,
            adaptToSystem: true
        }
    },

    // إعدادات التطوير والتصحيح
    debug: {
        enabled: false, // تفعيل في بيئة التطوير فقط
        showStats: false,
        logPerformance: false,
        showHelpers: false,
        verboseLogging: false
    },

    // رسائل واجهة المستخدم
    ui: {
        loading: 'جاري تحميل المشهد الثلاثي الأبعاد...',
        interaction: 'حرك الماوس للتفاعل مع المشهد',
        error: 'حدث خطأ في تحميل المشهد',
        unsupported: 'متصفحك لا يدعم WebGL'
    }
};

// تصدير الإعدادات للاستخدام العام
if (typeof module !== 'undefined' && module.exports) {
    module.exports = window.SceneConfig;
}