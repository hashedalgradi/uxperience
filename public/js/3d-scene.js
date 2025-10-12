/**
 * Enhanced 3D Computer Scene - محسّن ومطوّر
 * مشهد كمبيوتر ثلاثي الأبعاد محسّن مع إضاءة واقعية وتفاعل متقدم
 */

class Enhanced3DScene {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        if (!this.container) return;

        // إعدادات أساسية
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.computer = null;
        this.screen = null;
        
        // تفاعل الماوس
        this.mouse = { x: 0, y: 0 };
        this.targetRotation = { x: 0, y: 0 };
        this.currentRotation = { x: 0, y: 0 };
        
        // إعدادات الأداء
        this.isMobile = window.innerWidth < 768;
        this.isTablet = window.innerWidth >= 768 && window.innerWidth < 1024;
        
        // عناصر التحكم
        this.clock = new THREE.Clock();
        this.mixer = null;
        
        this.init();
    }

    init() {
        this.createScene();
        this.createCamera();
        this.createRenderer();
        this.createLights();
        this.createComputer();
        this.createParticles();
        this.setupEventListeners();
        this.animate();
        
        // حركة دخول
        this.playIntroAnimation();
    }

    createScene() {
        this.scene = new THREE.Scene();
        
        // خلفية متوهجة ملونة
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = 1024;
        canvas.height = 1024;
        
        // تدرج غامق مع لمسات ملونة
        const gradient = context.createLinearGradient(0, 0, canvas.width, canvas.height);
        gradient.addColorStop(0, '#0a0f1c');
        gradient.addColorStop(0.5, '#1a1a2e');
        gradient.addColorStop(1, '#16213e');
        
        context.fillStyle = gradient;
        context.fillRect(0, 0, canvas.width, canvas.height);
        
        // جسيمات ملونة واضحة
        const colors = ['rgba(99, 102, 241, 0.8)', 'rgba(236, 72, 153, 0.7)', 'rgba(245, 158, 11, 0.6)'];
        for(let i = 0; i < 150; i++) {
            const x = Math.random() * canvas.width;
            const y = Math.random() * canvas.height;
            const size = Math.random() * 3 + 1;
            context.fillStyle = colors[Math.floor(Math.random() * colors.length)];
            context.beginPath();
            context.arc(x, y, size, 0, Math.PI * 2);
            context.fill();
        }
        
        const texture = new THREE.CanvasTexture(canvas);
        this.scene.background = texture;
        
        // ضباب غامق
        this.scene.fog = new THREE.Fog(0x0a0f1c, 25, 65);
    }

    createCamera() {
        this.camera = new THREE.PerspectiveCamera(
            75,
            this.container.clientWidth / this.container.clientHeight,
            0.1,
            1000
        );
        this.camera.position.set(0, 2, 8);
        this.camera.lookAt(0, 0, 0);
    }

    createRenderer() {
        this.renderer = new THREE.WebGLRenderer({ 
            antialias: !this.isMobile,
            alpha: true,
            powerPreference: this.isMobile ? 'low-power' : 'high-performance'
        });
        
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        
        // إعدادات محسّنة للجودة
        this.renderer.shadowMap.enabled = true;
        this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        this.renderer.toneMapping = THREE.ACESFilmicToneMapping;
        this.renderer.toneMappingExposure = 1.2;
        this.renderer.outputEncoding = THREE.sRGBEncoding;
        
        this.container.appendChild(this.renderer.domElement);
    }

    createLights() {
        // إضاءة محيطة بنفس ألوان الفوتر
        const ambientLight = new THREE.AmbientLight(0x6366f1, 0.2);
        this.scene.add(ambientLight);

        // إضاءة رئيسية أنيقة
        const keyLight = new THREE.DirectionalLight(0x6366f1, 1.5);
        keyLight.position.set(8, 12, 6);
        keyLight.castShadow = true;
        keyLight.shadow.mapSize.width = 2048;
        keyLight.shadow.mapSize.height = 2048;
        keyLight.shadow.camera.near = 0.1;
        keyLight.shadow.camera.far = 100;
        keyLight.shadow.bias = -0.0001;
        this.scene.add(keyLight);

        // إضاءة ملء بنفس لون الفوتر
        const fillLight = new THREE.DirectionalLight(0xec4899, 1.0);
        fillLight.position.set(-6, 8, 4);
        this.scene.add(fillLight);

        // إضاءة خلفية أنيقة
        const rimLight = new THREE.DirectionalLight(0xf59e0b, 0.6);
        rimLight.position.set(0, 4, -8);
        this.scene.add(rimLight);

        // إضاءة الشاشة
        this.screenLight = new THREE.PointLight(0x6366f1, 1.8, 15);
        this.screenLight.position.set(0, 1.5, 3);
        this.scene.add(this.screenLight);
        
        // أضواء متحركة بألوان الفوتر
        this.colorLights = [];
        const colors = [0x6366f1, 0xec4899, 0xf59e0b];
        for(let i = 0; i < 3; i++) {
            const light = new THREE.PointLight(colors[i], 0.3, 20);
            const angle = (i / 3) * Math.PI * 2;
            light.position.set(
                Math.cos(angle) * 15,
                Math.sin(angle * 0.5) * 5 + 6,
                Math.sin(angle) * 15
            );
            this.colorLights.push(light);
            this.scene.add(light);
        }
    }

    createComputer() {
        this.computer = new THREE.Group();

        // قاعدة الكمبيوتر بتفاصيل واقعية
        const laptopGeometry = new THREE.BoxGeometry(4.2, 0.3, 2.8);
        const laptopMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x2d3748,
            metalness: 0.95,
            roughness: 0.05,
            clearcoat: 1,
            clearcoatRoughness: 0.02,
            envMapIntensity: 2
        });
        
        const laptop = new THREE.Mesh(laptopGeometry, laptopMaterial);
        laptop.position.y = -0.15;
        laptop.castShadow = true;
        laptop.receiveShadow = true;
        this.computer.add(laptop);
        
        // حواف مستديرة للقاعدة
        const edgeGeometry = new THREE.TorusGeometry(0.15, 0.05, 8, 16);
        const edgeMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x1a202c,
            metalness: 0.9,
            roughness: 0.1
        });
        
        const edges = [
            {x: 1.9, z: 1.2}, {x: -1.9, z: 1.2},
            {x: 1.9, z: -1.2}, {x: -1.9, z: -1.2}
        ];
        
        edges.forEach(pos => {
            const edge = new THREE.Mesh(edgeGeometry, edgeMaterial);
            edge.position.set(pos.x, -0.15, pos.z);
            edge.rotation.x = Math.PI / 2;
            edge.scale.set(0.5, 0.5, 0.5);
            this.computer.add(edge);
        });

        // الشاشة المحسّنة
        this.createEnhancedScreen();
        
        // لوحة المفاتيح
        this.createKeyboard();
        
        // تفاصيل إضافية
        this.createDetails();

        this.scene.add(this.computer);
    }

    createEnhancedScreen() {
        // إطار الشاشة الرئيسي
        const screenFrameGeometry = new THREE.BoxGeometry(4.0, 2.6, 0.12);
        const screenFrameMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x1a202c,
            metalness: 0.98,
            roughness: 0.02,
            clearcoat: 1,
            clearcoatRoughness: 0.01
        });
        
        const screenFrame = new THREE.Mesh(screenFrameGeometry, screenFrameMaterial);
        screenFrame.position.set(0, 1.2, -1.2);
        screenFrame.rotation.x = -0.1;
        screenFrame.castShadow = true;
        this.computer.add(screenFrame);
        
        // إطار داخلي للشاشة
        const innerFrameGeometry = new THREE.BoxGeometry(3.5, 2.1, 0.05);
        const innerFrameMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x000000,
            metalness: 0.5,
            roughness: 0.8
        });
        
        const innerFrame = new THREE.Mesh(innerFrameGeometry, innerFrameMaterial);
        innerFrame.position.set(0, 1.2, -1.14);
        innerFrame.rotation.x = -0.1;
        this.computer.add(innerFrame);

        // الشاشة الفعلية
        const screenGeometry = new THREE.PlaneGeometry(3.4, 2.0);
        
        // إنشاء محتوى الشاشة
        this.createScreenContent();
        
        const screenMaterial = new THREE.MeshLambertMaterial({
            map: this.screenTexture
        });
        
        this.screen = new THREE.Mesh(screenGeometry, screenMaterial);
        this.screen.position.set(0, 1.2, -1.15);
        this.screen.rotation.x = -0.1;
        this.computer.add(this.screen);

        // توهج الشاشة الناعم
        const glowGeometry = new THREE.PlaneGeometry(3.6, 2.2);
        const glowMaterial = new THREE.MeshBasicMaterial({
            color: 0x60a5fa,
            transparent: true,
            opacity: 0.2,
            side: THREE.DoubleSide,
            blending: THREE.AdditiveBlending
        });
        
        const screenGlow = new THREE.Mesh(glowGeometry, glowMaterial);
        screenGlow.position.set(0, 1.2, -1.13);
        screenGlow.rotation.x = -0.1;
        this.computer.add(screenGlow);
        
        // كاميرا ويب
        const cameraGeometry = new THREE.SphereGeometry(0.03, 16, 16);
        const cameraMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x000000,
            metalness: 0.9,
            roughness: 0.1,
            emissive: 0x00ff00,
            emissiveIntensity: 0.5
        });
        
        const camera = new THREE.Mesh(cameraGeometry, cameraMaterial);
        camera.position.set(0, 2.3, -1.18);
        this.computer.add(camera);
    }

    createScreenContent() {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 1024;
        canvas.height = 600;

        // خلفية الشاشة المحسنة
        const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
        gradient.addColorStop(0, '#1e3a8a');
        gradient.addColorStop(0.5, '#3730a3');
        gradient.addColorStop(1, '#581c87');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // اسم Hashed_7 في الخلفية
        ctx.save();
        ctx.font = 'bold 160px "Courier New", monospace';
        ctx.fillStyle = 'rgba(255, 255, 255, 0.15)';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('Hashed_7', canvas.width / 2, canvas.height / 2);
        ctx.restore();

        // شريط علوي محسن
        const headerGradient = ctx.createLinearGradient(0, 0, canvas.width, 60);
        headerGradient.addColorStop(0, '#4f46e5');
        headerGradient.addColorStop(1, '#7c3aed');
        ctx.fillStyle = headerGradient;
        ctx.fillRect(0, 0, canvas.width, 60);

        // أيقونات الشريط العلوي
        ctx.fillStyle = '#ef4444';
        ctx.beginPath();
        ctx.arc(30, 30, 8, 0, Math.PI * 2);
        ctx.fill();

        ctx.fillStyle = '#f59e0b';
        ctx.beginPath();
        ctx.arc(60, 30, 8, 0, Math.PI * 2);
        ctx.fill();

        ctx.fillStyle = '#10b981';
        ctx.beginPath();
        ctx.arc(90, 30, 8, 0, Math.PI * 2);
        ctx.fill();

        // عنوان النافذة
        ctx.fillStyle = '#e5e7eb';
        ctx.font = 'bold 20px Arial';
        ctx.textAlign = 'center';
        ctx.fillText('Hashed_7 - Portfolio', canvas.width / 2, 38);

        // محتوى الكود
        const codeLines = [
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
        ];

        ctx.font = '16px "Courier New", monospace';
        ctx.textAlign = 'left';
        
        codeLines.forEach((line, index) => {
            const y = 120 + (index * 25);
            
            // تلوين الكود
            if (line.includes('class') || line.includes('constructor') || line.includes('return')) {
                ctx.fillStyle = '#8b5cf6';
            } else if (line.includes('this.') || line.includes('new ')) {
                ctx.fillStyle = '#06b6d4';
            } else if (line.includes('"') || line.includes("'")) {
                ctx.fillStyle = '#10b981';
            } else if (line.includes('//')) {
                ctx.fillStyle = '#6b7280';
            } else {
                ctx.fillStyle = '#e5e7eb';
            }
            
            ctx.fillText(line, 50, y);
        });

        // مؤشر الكتابة
        this.cursorVisible = true;
        ctx.fillStyle = '#10b981';
        ctx.fillRect(280, 470, 2, 20);

        this.screenTexture = new THREE.CanvasTexture(canvas);
        this.screenCanvas = canvas;
        this.screenContext = ctx;
    }

    createKeyboard() {
        const keyboardGroup = new THREE.Group();
        
        // قاعدة لوحة المفاتيح
        const keyboardBase = new THREE.BoxGeometry(3.5, 0.08, 1.2);
        const keyboardMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x1a1a1a,
            metalness: 0.8,
            roughness: 0.2
        });
        
        const keyboard = new THREE.Mesh(keyboardBase, keyboardMaterial);
        keyboard.position.set(0, 0.04, 0.5);
        keyboard.castShadow = true;
        keyboardGroup.add(keyboard);

        // مفاتيح فردية محسّنة
        const keyGeometry = new THREE.BoxGeometry(0.11, 0.04, 0.11);
        const keyMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x3a3a3a,
            metalness: 0.2,
            roughness: 0.7,
            clearcoat: 0.3
        });

        for (let row = 0; row < 4; row++) {
            for (let col = 0; col < 13; col++) {
                const key = new THREE.Mesh(keyGeometry, keyMaterial);
                key.position.set(
                    -1.5 + (col * 0.24),
                    0.1,
                    0.15 + (row * 0.22)
                );
                key.castShadow = true;
                keyboardGroup.add(key);
            }
        }
        
        // تراكباد
        const trackpadGeometry = new THREE.BoxGeometry(1.2, 0.02, 0.8);
        const trackpadMaterial = new THREE.MeshPhysicalMaterial({
            color: 0x2a2a2a,
            metalness: 0.3,
            roughness: 0.5
        });
        
        const trackpad = new THREE.Mesh(trackpadGeometry, trackpadMaterial);
        trackpad.position.set(0, 0.05, 1.1);
        keyboardGroup.add(trackpad);

        this.computer.add(keyboardGroup);
    }

    createDetails() {
        // اسم الشركة منحوت على ظهر الشاشة
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 512;
        canvas.height = 128;
        
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold 70px "Courier New", monospace';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('Hashed_7', canvas.width / 2, canvas.height / 2);
        
        const texture = new THREE.CanvasTexture(canvas);
        const textGeometry = new THREE.PlaneGeometry(2.5, 0.6);
        const textMaterial = new THREE.MeshBasicMaterial({
            map: texture,
            transparent: true,
            side: THREE.DoubleSide
        });
        
        const textMesh = new THREE.Mesh(textGeometry, textMaterial);
        textMesh.position.set(0, 1.5, -1.32);
        textMesh.rotation.x = 0.1;
        textMesh.rotation.y = Math.PI;
        this.computer.add(textMesh);
        
        // شعار الشركة
        const logoGeometry = new THREE.CircleGeometry(0.15, 32);
        const logoMaterial = new THREE.MeshLambertMaterial({
            color: 0x6366f1
        });
        
        const logo = new THREE.Mesh(logoGeometry, logoMaterial);
        logo.position.set(0, 0.8, -1.32);
        logo.rotation.x = 0.1;
        this.computer.add(logo);

        // منافذ USB
        for (let i = 0; i < 3; i++) {
            const portGeometry = new THREE.BoxGeometry(0.05, 0.02, 0.15);
            const portMaterial = new THREE.MeshPhysicalMaterial({
                color: 0x1a1a1a,
                metalness: 0.9,
                roughness: 0.1
            });
            
            const port = new THREE.Mesh(portGeometry, portMaterial);
            port.position.set(-1.8, 0, -0.5 + (i * 0.2));
            this.computer.add(port);
        }
    }

    createParticles() {
        // أيقونات برمجية متناثرة
        this.createProgrammingIcons();
        
        // إضافة رموز البرمجة والتصميم
        this.createFloatingSymbols();
    }
    
    createProgrammingIcons() {
        this.programmingIcons = [];
        
        // أيقونات برمجية بـ Unicode
        const icons = [
            { symbol: '⚛️', name: 'React' },
            { symbol: '🔧', name: 'Tools' },
            { symbol: '💻', name: 'Code' },
            { symbol: '🎨', name: 'Design' },
            { symbol: '📱', name: 'Mobile' },
            { symbol: '🌐', name: 'Web' },
            { symbol: '⚡', name: 'Fast' },
            { symbol: '🚀', name: 'Deploy' },
            { symbol: '💡', name: 'Ideas' },
            { symbol: '🔥', name: 'Hot' },
            { symbol: '✨', name: 'Magic' },
            { symbol: '🎯', name: 'Target' },
            { symbol: '📊', name: 'Data' },
            { symbol: '🔒', name: 'Security' },
            { symbol: '🎪', name: 'Fun' }
        ];
        
        const iconCount = this.isMobile ? 20 : 35;
        
        for(let i = 0; i < iconCount; i++) {
            const iconData = icons[Math.floor(Math.random() * icons.length)];
            
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = 120;
            canvas.height = 120;
            
            // ألوان متنوعة
            const colors = ['#6366f1', '#ec4899', '#f59e0b', '#10b981', '#8b5cf6', '#ef4444'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            
            // خلفية دائرية متوهجة
            const gradient = context.createRadialGradient(60, 60, 0, 60, 60, 50);
            gradient.addColorStop(0, color + '40');
            gradient.addColorStop(1, 'transparent');
            context.fillStyle = gradient;
            context.fillRect(0, 0, canvas.width, canvas.height);
            
            // الأيقونة
            context.font = '48px Arial';
            context.textAlign = 'center';
            context.textBaseline = 'middle';
            context.fillText(iconData.symbol, 60, 60);
            
            const texture = new THREE.CanvasTexture(canvas);
            const material = new THREE.SpriteMaterial({ 
                map: texture,
                transparent: true,
                opacity: 0.8
            });
            
            const sprite = new THREE.Sprite(material);
            
            // مواضع عشوائية حول المشهد
            sprite.position.set(
                (Math.random() - 0.5) * 25,
                Math.random() * 12 - 6,
                (Math.random() - 0.5) * 25
            );
            
            sprite.scale.set(1.2, 1.2, 1);
            
            this.scene.add(sprite);
            
            this.programmingIcons.push({
                sprite: sprite,
                velocity: {
                    x: (Math.random() - 0.5) * 0.02,
                    y: (Math.random() - 0.5) * 0.01,
                    z: (Math.random() - 0.5) * 0.02
                },
                rotationSpeed: (Math.random() - 0.5) * 0.02,
                icon: iconData
            });
        }
    }
    
    createFloatingSymbols() {
        this.floatingSymbols = [];
        
        // رموز البرمجة والتصميم المتخصصة
        const symbols = [
            'React', 'Vue', 'Angular', 'Laravel', 'PHP', 'Node.js',
            'HTML5', 'CSS3', 'JavaScript', 'TypeScript', 'Python',
            'Figma', 'Adobe XD', 'Photoshop', 'Illustrator',
            'UI/UX', 'Design', 'Responsive', 'Mobile First',
            'API', 'REST', 'GraphQL', 'JSON', 'MySQL', 'MongoDB',
            'Git', 'GitHub', 'npm', 'Webpack', 'Sass', 'Bootstrap'
        ];
        
        const symbolCount = this.isMobile ? 15 : 25;
        
        for(let i = 0; i < symbolCount; i++) {
            const symbol = symbols[Math.floor(Math.random() * symbols.length)];
            
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = 200;
            canvas.height = 80;
            
            // ألوان الفوتر الأنيقة
            const colors = ['#6366f1', '#ec4899', '#f59e0b'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            
            const gradient = context.createRadialGradient(100, 40, 0, 100, 40, 60);
            gradient.addColorStop(0, color + '66');
            gradient.addColorStop(1, 'transparent');
            context.fillStyle = gradient;
            context.fillRect(0, 0, canvas.width, canvas.height);
            
            context.fillStyle = color;
            context.font = 'bold 28px "Segoe UI", Arial, sans-serif';
            context.textAlign = 'center';
            context.textBaseline = 'middle';
            context.fillText(symbol, 100, 40);
            
            const texture = new THREE.CanvasTexture(canvas);
            const material = new THREE.SpriteMaterial({ 
                map: texture,
                transparent: true,
                opacity: 0.8
            });
            
            const sprite = new THREE.Sprite(material);
            
            const orbitRadius = 8 + Math.random() * 4;
            const angle = (i / symbolCount) * Math.PI * 2;
            const height = (Math.random() - 0.5) * 6;
            
            sprite.position.set(
                Math.cos(angle) * orbitRadius,
                height,
                Math.sin(angle) * orbitRadius
            );
            
            sprite.scale.set(1.5, 0.8, 1);
            
            this.scene.add(sprite);
            
            this.floatingSymbols.push({
                sprite: sprite,
                angle: angle,
                orbitRadius: orbitRadius,
                height: height,
                speed: 0.2 + Math.random() * 0.3,
                symbol: symbol
            });
        }
    }

    setupEventListeners() {
        // تفاعل الماوس
        if (!this.isMobile) {
            this.container.addEventListener('mousemove', (event) => {
                const rect = this.container.getBoundingClientRect();
                this.mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
                this.mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;

                this.targetRotation.x = this.mouse.y * 0.1;
                this.targetRotation.y = this.mouse.x * 0.2;
            });

            this.container.addEventListener('mouseleave', () => {
                this.targetRotation.x = 0;
                this.targetRotation.y = 0;
            });
        }

        // تأثير التمرير
        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;
            if (this.computer) {
                this.computer.position.y = -scrollY * 0.001;
                this.computer.rotation.z = scrollY * 0.0002;
            }
        });

        // تغيير حجم النافذة
        window.addEventListener('resize', () => this.onWindowResize());
    }

    playIntroAnimation() {
        if (!this.computer) return;

        // حركة دخول باستخدام GSAP (إذا كان متوفراً) أو CSS
        this.computer.position.y = -5;
        this.computer.rotation.y = Math.PI;
        this.computer.scale.set(0.1, 0.1, 0.1);

        // تحريك تدريجي
        const animate = () => {
            this.computer.position.y += (0 - this.computer.position.y) * 0.05;
            this.computer.rotation.y += (0 - this.computer.rotation.y) * 0.05;
            this.computer.scale.x += (1 - this.computer.scale.x) * 0.05;
            this.computer.scale.y += (1 - this.computer.scale.y) * 0.05;
            this.computer.scale.z += (1 - this.computer.scale.z) * 0.05;

            if (Math.abs(this.computer.position.y) > 0.01 || 
                Math.abs(this.computer.rotation.y) > 0.01 || 
                Math.abs(this.computer.scale.x - 1) > 0.01) {
                requestAnimationFrame(animate);
            }
        };
        animate();
    }

    updateScreenContent() {
        if (!this.screenContext) return;

        // تحديث مؤشر الكتابة
        this.cursorVisible = !this.cursorVisible;
        
        // مسح المؤشر السابق
        this.screenContext.fillStyle = '#0f172a';
        this.screenContext.fillRect(278, 470, 6, 24);
        
        // رسم المؤشر الجديد
        if (this.cursorVisible) {
            this.screenContext.fillStyle = '#10b981';
            this.screenContext.fillRect(280, 470, 2, 20);
        }

        this.screenTexture.needsUpdate = true;
    }

    onWindowResize() {
        this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
    }

    animate() {
        requestAnimationFrame(() => this.animate());

        const time = this.clock.getElapsedTime();

        // تحديث دوران الكمبيوتر
        this.currentRotation.x += (this.targetRotation.x - this.currentRotation.x) * 0.05;
        this.currentRotation.y += (this.targetRotation.y - this.currentRotation.y) * 0.05;

        if (this.computer) {
            this.computer.rotation.x = this.currentRotation.x + Math.sin(time * 0.5) * 0.02;
            this.computer.rotation.y = this.currentRotation.y + time * 0.1;
            
            // حركة عائمة
            this.computer.position.y += Math.sin(time * 0.8) * 0.003;
        }

        // تحديث الأيقونات البرمجية المتناثرة
        if (this.programmingIcons) {
            this.programmingIcons.forEach((iconObj) => {
                const { sprite, velocity, rotationSpeed } = iconObj;
                
                // حركة مستمرة لطيفة
                sprite.position.x += velocity.x;
                sprite.position.y += velocity.y;
                sprite.position.z += velocity.z;
                
                // دوران لطيف
                sprite.material.rotation += rotationSpeed;
                
                // تأثير تنفس
                const breathe = 0.6 + Math.sin(time * 0.8 + sprite.position.x) * 0.2;
                sprite.material.opacity = breathe;
                
                // إعادة تدوير الأيقونات
                if (sprite.position.x > 20) sprite.position.x = -20;
                if (sprite.position.x < -20) sprite.position.x = 20;
                if (sprite.position.y > 10) sprite.position.y = -10;
                if (sprite.position.y < -10) sprite.position.y = 10;
                if (sprite.position.z > 20) sprite.position.z = -20;
                if (sprite.position.z < -20) sprite.position.z = 20;
            });
        }
        
        // تحديث الرموز المتناثرة بحركة ثابتة ومحسّنة
        if (this.floatingSymbols) {
            this.floatingSymbols.forEach((symbolObj, index) => {
                const { sprite, angle, orbitRadius, height, speed } = symbolObj;
                
                // مواضع ثابتة مع حركة خفيفة فقط
                const baseAngle = angle + time * speed * 0.1; // حركة أبطأ
                const fixedRadius = orbitRadius; // نصف قطر ثابت
                
                sprite.position.x = Math.cos(baseAngle) * fixedRadius;
                sprite.position.z = Math.sin(baseAngle) * fixedRadius;
                sprite.position.y = height + Math.sin(time * 0.2 + index * 0.5) * 0.3; // حركة عمودية أقل
                
                // دوران خفيف
                sprite.material.rotation = time * 0.05;
                
                // شفافية ثابتة مع تنفس خفيف
                const breathe = 0.7 + Math.sin(time * 0.5 + index * 0.3) * 0.1;
                sprite.material.opacity = breathe;
                
                // حجم ثابت
                sprite.scale.set(1.5, 0.8, 1);
            });
        }
        
        // تحديث الأضواء الملونة بثبات أكبر
        if (this.colorLights) {
            this.colorLights.forEach((light, index) => {
                const angle = time * 0.05 + (index / this.colorLights.length) * Math.PI * 2; // حركة أبطأ
                light.position.x = Math.cos(angle) * 15;
                light.position.z = Math.sin(angle) * 15;
                light.position.y = 5 + Math.sin(time * 0.2 + index) * 1; // حركة عمودية أقل
                light.intensity = 0.6 + Math.sin(time * 0.3 + index) * 0.2; // تغيير أقل في الشدة
            });
        }

        // تحديث إضاءة الشاشة
        if (this.screenLight) {
            this.screenLight.intensity = 2.5 + Math.sin(time * 2) * 0.5;
        }

        // تحديث محتوى الشاشة كل ثانية
        if (Math.floor(time * 2) % 2 === 0) {
            this.updateScreenContent();
        }

        this.renderer.render(this.scene, this.camera);
    }

    destroy() {
        if (this.renderer) {
            this.container.removeChild(this.renderer.domElement);
            this.renderer.dispose();
        }
    }
}

// تهيئة المشهد عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('three-container');
    if (container) {
        // تحميل Three.js
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
        script.onload = () => {
            window.enhanced3DScene = new Enhanced3DScene('three-container');
        };
        document.head.appendChild(script);
    }
});

// تصدير للاستخدام كوحدة
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Enhanced3DScene;
}