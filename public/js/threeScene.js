/**
 * Interactive 3D Scene with Three.js
 * Professional 3D scene for Laravel portfolio website
 */

class ThreeScene {
    constructor(containerId) {
        this.container = document.getElementById(containerId);
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.mesh = null;
        this.mouse = { x: 0, y: 0 };
        this.targetRotation = { x: 0, y: 0 };
        this.currentRotation = { x: 0, y: 0 };
        this.isMobile = window.innerWidth < 768 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        this.isTablet = window.innerWidth >= 768 && window.innerWidth < 1024;
        this.mouseTrail = [];
        this.isMouseMoving = false;
        this.lastMouseMove = 0;
        
        this.init();
    }

    init() {
        if (!this.container) return;
        
        this.createScene();
        this.createCamera();
        this.createRenderer();
        this.createLights();
        this.createMesh();
        this.setupEventListeners();
        this.animate();
    }

    createScene() {
        this.scene = new THREE.Scene();
        
        // Optimized background for mobile
        if (this.isMobile) {
            this.scene.background = new THREE.Color(0x0f0f23);
        } else {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = this.isMobile ? 256 : 512;
            canvas.height = this.isMobile ? 256 : 512;
            
            const gradient = context.createLinearGradient(0, 0, 0, canvas.height);
            gradient.addColorStop(0, '#1a1a2e');
            gradient.addColorStop(0.5, '#16213e');
            gradient.addColorStop(1, '#0f0f23');
            
            context.fillStyle = gradient;
            context.fillRect(0, 0, canvas.width, canvas.height);
            
            const texture = new THREE.CanvasTexture(canvas);
            this.scene.background = texture;
        }
    }

    createCamera() {
        this.camera = new THREE.PerspectiveCamera(
            75,
            this.container.clientWidth / this.container.clientHeight,
            0.1,
            1000
        );
        this.camera.position.z = 5;
    }

    createRenderer() {
        this.renderer = new THREE.WebGLRenderer({ 
            antialias: !this.isMobile,
            alpha: true,
            powerPreference: this.isMobile ? 'low-power' : 'high-performance'
        });
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
        this.renderer.setPixelRatio(this.isMobile ? 1 : Math.min(window.devicePixelRatio, 2));
        
        if (!this.isMobile) {
            this.renderer.shadowMap.enabled = true;
            this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        }
        
        this.container.appendChild(this.renderer.domElement);
    }

    createLights() {
        // Ambient light
        const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
        this.scene.add(ambientLight);

        // Point light 1
        const pointLight1 = new THREE.PointLight(0x6366f1, 1, 100);
        pointLight1.position.set(10, 10, 10);
        pointLight1.castShadow = true;
        this.scene.add(pointLight1);

        // Point light 2
        const pointLight2 = new THREE.PointLight(0xec4899, 0.8, 100);
        pointLight2.position.set(-10, -10, 5);
        this.scene.add(pointLight2);

        // Directional light
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.5);
        directionalLight.position.set(0, 10, 5);
        directionalLight.castShadow = true;
        this.scene.add(directionalLight);
    }

    createMesh() {
        this.meshGroup = new THREE.Group();
        
        // Enhanced laptop base with rounded edges
        const laptopShape = new THREE.Shape();
        laptopShape.moveTo(-1.2, -0.7);
        laptopShape.lineTo(1.2, -0.7);
        laptopShape.quadraticCurveTo(1.25, -0.7, 1.25, -0.65);
        laptopShape.lineTo(1.25, 0.65);
        laptopShape.quadraticCurveTo(1.25, 0.7, 1.2, 0.7);
        laptopShape.lineTo(-1.2, 0.7);
        laptopShape.quadraticCurveTo(-1.25, 0.7, -1.25, 0.65);
        laptopShape.lineTo(-1.25, -0.65);
        laptopShape.quadraticCurveTo(-1.25, -0.7, -1.2, -0.7);
        
        const laptopGeometry = new THREE.ExtrudeGeometry(laptopShape, {
            depth: 0.08,
            bevelEnabled: true,
            bevelThickness: 0.02,
            bevelSize: 0.02
        });
        
        const laptopMaterial = new THREE.MeshPhongMaterial({
            color: 0x2d3748,
            shininess: 150,
            specular: 0x444444
        });
        
        const laptop = new THREE.Mesh(laptopGeometry, laptopMaterial);
        laptop.position.set(0, 0.2, 0);
        laptop.rotation.x = -0.1;
        
        // Enhanced screen with bezel
        const screenGeometry = new THREE.BoxGeometry(2.0, 1.1, 0.03);
        const screenMaterial = new THREE.MeshPhongMaterial({
            color: 0x0a0a0a,
            emissive: 0x001122,
            emissiveIntensity: 0.2
        });
        const screen = new THREE.Mesh(screenGeometry, screenMaterial);
        screen.position.set(0, 0.2, 0.06);
        
        // Screen glow effect
        const glowGeometry = new THREE.BoxGeometry(1.9, 1.0, 0.01);
        const glowMaterial = new THREE.MeshBasicMaterial({
            color: 0x6366f1,
            transparent: true,
            opacity: 0.3
        });
        const screenGlow = new THREE.Mesh(glowGeometry, glowMaterial);
        screenGlow.position.set(0, 0.2, 0.07);
        
        // Code display on screen
        this.createEnhancedCodeDisplay(screen);
        
        // Keyboard with individual keys
        this.createKeyboard();
        
        // Floating holographic elements
        this.createHolographicElements();
        
        this.meshGroup.add(laptop, screen, screenGlow);
        this.scene.add(this.meshGroup);
        this.mesh = this.meshGroup;
        
        // Enhanced particle system
        this.createEnhancedParticles();
    }
    
    createEnhancedCodeDisplay(screen) {
        const codeGroup = new THREE.Group();
        
        // Create realistic code lines with syntax highlighting
        const codeSnippets = [
            { text: 'function createWebsite() {', color: 0x569cd6, indent: 0 },
            { text: '  const design = new Design();', color: 0xdcdcaa, indent: 1 },
            { text: '  const code = write(design);', color: 0xdcdcaa, indent: 1 },
            { text: '  return deploy(code);', color: 0xc586c0, indent: 1 },
            { text: '}', color: 0x569cd6, indent: 0 },
            { text: '', color: 0x000000, indent: 0 },
            { text: '// Building dreams...', color: 0x6a9955, indent: 0 },
            { text: 'createWebsite();', color: 0x4ec9b0, indent: 0 }
        ];
        
        codeSnippets.forEach((snippet, i) => {
            if (snippet.text) {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.width = 512;
                canvas.height = 32;
                
                context.fillStyle = `#${snippet.color.toString(16).padStart(6, '0')}`;
                context.font = '16px "Courier New", monospace';
                context.fillText('  '.repeat(snippet.indent) + snippet.text, 10, 20);
                
                const texture = new THREE.CanvasTexture(canvas);
                const material = new THREE.MeshBasicMaterial({
                    map: texture,
                    transparent: true,
                    opacity: 0.9
                });
                
                const geometry = new THREE.PlaneGeometry(1.6, 0.08);
                const line = new THREE.Mesh(geometry, material);
                line.position.set(0, 0.4 - (i * 0.1), 0.01);
                codeGroup.add(line);
            }
        });
        
        // Cursor blink effect
        const cursorGeometry = new THREE.PlaneGeometry(0.02, 0.08);
        const cursorMaterial = new THREE.MeshBasicMaterial({
            color: 0x00ff00,
            transparent: true,
            opacity: 1
        });
        const cursor = new THREE.Mesh(cursorGeometry, cursorMaterial);
        cursor.position.set(0.6, -0.4, 0.01);
        codeGroup.add(cursor);
        this.cursor = cursor;
        
        screen.add(codeGroup);
        this.codeLines = codeGroup;
    }
    
    createKeyboard() {
        const keyboardGroup = new THREE.Group();
        
        // Keyboard base
        const baseGeometry = new THREE.BoxGeometry(2.4, 0.7, 0.08);
        const baseMaterial = new THREE.MeshPhongMaterial({
            color: 0x3a3a3a,
            shininess: 50
        });
        const base = new THREE.Mesh(baseGeometry, baseMaterial);
        base.position.y = -0.6;
        
        // Individual keys
        for(let row = 0; row < 4; row++) {
            for(let col = 0; col < 12; col++) {
                const keyGeometry = new THREE.BoxGeometry(0.15, 0.12, 0.04);
                const keyMaterial = new THREE.MeshPhongMaterial({
                    color: 0x555555,
                    shininess: 100
                });
                const key = new THREE.Mesh(keyGeometry, keyMaterial);
                key.position.set(
                    -1.0 + (col * 0.18),
                    -0.55 + (row * 0.14),
                    0.06
                );
                keyboardGroup.add(key);
            }
        }
        
        keyboardGroup.add(base);
        this.meshGroup.add(keyboardGroup);
        this.keyboard = keyboardGroup;
    }
    
    createHolographicElements() {
        this.holoElements = [];
        const symbols = this.isMobile ? ['{ }', '< />', '( )', '[ ]'] : ['{ }', '< />', '( )', '[ ]', '===', '=>', '&&', '||'];
        
        symbols.forEach((symbol, index) => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = this.isMobile ? 64 : 128;
            canvas.height = this.isMobile ? 32 : 64;
            
            // Simplified effect for mobile
            if (this.isMobile) {
                context.fillStyle = '#6366f1';
            } else {
                const gradient = context.createLinearGradient(0, 0, canvas.width, canvas.height);
                gradient.addColorStop(0, '#00ffff');
                gradient.addColorStop(0.5, '#6366f1');
                gradient.addColorStop(1, '#ec4899');
                context.fillStyle = gradient;
            }
            
            context.font = `bold ${this.isMobile ? '12px' : '24px'} monospace`;
            context.textAlign = 'center';
            context.fillText(symbol, canvas.width / 2, canvas.height / 2 + 5);
            
            const texture = new THREE.CanvasTexture(canvas);
            const material = new THREE.SpriteMaterial({ 
                map: texture,
                transparent: true,
                opacity: this.isMobile ? 0.4 : 0.6
            });
            const sprite = new THREE.Sprite(material);
            
            const angle = (index / symbols.length) * Math.PI * 2;
            const radius = this.isMobile ? 2.5 : 3.5;
            sprite.position.set(
                Math.cos(angle) * radius,
                Math.sin(angle) * (this.isMobile ? 1 : 1.5),
                Math.sin(angle) * (this.isMobile ? 1 : 1.5)
            );
            
            const scale = this.isMobile ? 0.4 : 0.8;
            sprite.scale.set(scale, scale * 0.5, scale * 0.5);
            
            this.scene.add(sprite);
            this.holoElements.push({
                sprite,
                originalPosition: sprite.position.clone(),
                angle: angle,
                rotationSpeed: 0.5 + Math.random() * 0.5
            });
        });
    }
    
    createEnhancedParticles() {
        // Optimized particle count for mobile
        const particleCount = this.isMobile ? 50 : this.isTablet ? 100 : 150;
        const geometry = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);
        const colors = new Float32Array(particleCount * 3);
        const sizes = new Float32Array(particleCount);
        
        for(let i = 0; i < particleCount; i++) {
            const range = this.isMobile ? 8 : 15;
            positions[i * 3] = (Math.random() - 0.5) * range;
            positions[i * 3 + 1] = (Math.random() - 0.5) * range;
            positions[i * 3 + 2] = (Math.random() - 0.5) * range;
            
            const color = new THREE.Color();
            color.setHSL(0.6 + Math.random() * 0.3, 0.9, 0.6);
            colors[i * 3] = color.r;
            colors[i * 3 + 1] = color.g;
            colors[i * 3 + 2] = color.b;
            
            sizes[i] = Math.random() * 0.1 + 0.05;
        }
        
        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
        geometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
        
        const material = new THREE.PointsMaterial({
            size: this.isMobile ? 0.15 : 0.1,
            vertexColors: true,
            transparent: true,
            opacity: this.isMobile ? 0.6 : 0.8,
            sizeAttenuation: true
        });
        
        this.particles = new THREE.Points(geometry, material);
        this.scene.add(this.particles);
    }
    
    createFloatingSymbols() {
        this.floatingSymbols = [];
        const symbols = ['<', '>', '{', '}', '(', ')', ';', '='];
        
        symbols.forEach((symbol, index) => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = 64;
            canvas.height = 64;
            
            context.fillStyle = '#6366f1';
            context.font = 'bold 40px monospace';
            context.textAlign = 'center';
            context.fillText(symbol, 32, 45);
            
            const texture = new THREE.CanvasTexture(canvas);
            const material = new THREE.SpriteMaterial({ 
                map: texture,
                transparent: true,
                opacity: 0.7
            });
            const sprite = new THREE.Sprite(material);
            
            const angle = (index / symbols.length) * Math.PI * 2;
            sprite.position.set(
                Math.cos(angle) * 4,
                Math.sin(angle) * 2,
                Math.sin(angle) * 2
            );
            sprite.scale.set(0.5, 0.5, 0.5);
            
            this.scene.add(sprite);
            this.floatingSymbols.push({
                sprite,
                originalPosition: sprite.position.clone(),
                angle: angle
            });
        });
    }
    
    createCodeParticles() {
        const particleCount = 100;
        const geometry = new THREE.BufferGeometry();
        const positions = new Float32Array(particleCount * 3);
        const colors = new Float32Array(particleCount * 3);
        
        for(let i = 0; i < particleCount; i++) {
            positions[i * 3] = (Math.random() - 0.5) * 20;
            positions[i * 3 + 1] = (Math.random() - 0.5) * 20;
            positions[i * 3 + 2] = (Math.random() - 0.5) * 20;
            
            const color = new THREE.Color();
            color.setHSL(0.6 + Math.random() * 0.2, 0.8, 0.5);
            colors[i * 3] = color.r;
            colors[i * 3 + 1] = color.g;
            colors[i * 3 + 2] = color.b;
        }
        
        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
        
        const material = new THREE.PointsMaterial({
            size: 0.05,
            vertexColors: true,
            transparent: true,
            opacity: 0.6
        });
        
        this.particles = new THREE.Points(geometry, material);
        this.scene.add(this.particles);
    }

    setupEventListeners() {
        this.scrollY = 0;
        this.mouseInfluence = { x: 0, y: 0 };
        
        // Mouse move event with enhanced effects
        if (!this.isMobile) {
            this.container.addEventListener('mousemove', (event) => {
                const rect = this.container.getBoundingClientRect();
                this.mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
                this.mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
                
                // Enhanced mouse influence
                this.mouseInfluence.x = this.mouse.x * 0.5;
                this.mouseInfluence.y = this.mouse.y * 0.3;
                
                this.targetRotation.x = this.mouse.y * 0.4;
                this.targetRotation.y = this.mouse.x * 0.6;
                
                // Mouse trail effect
                this.addMouseTrail(event.clientX - rect.left, event.clientY - rect.top);
                
                // Track mouse movement
                this.isMouseMoving = true;
                this.lastMouseMove = Date.now();
                
                // Animate floating symbols based on mouse
                this.animateSymbolsWithMouse();
                
                // Create ripple effect
                this.createRippleEffect();
            });

            this.container.addEventListener('mouseleave', () => {
                this.targetRotation.x = 0;
                this.targetRotation.y = 0;
                this.mouseInfluence.x = 0;
                this.mouseInfluence.y = 0;
            });
        }

        // Enhanced scroll event
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    this.scrollY = window.pageYOffset;
                    this.onScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Resize event
        window.addEventListener('resize', () => this.onWindowResize());
    }
    
    animateSymbolsWithMouse() {
        if (!this.floatingSymbols) return;
        
        this.floatingSymbols.forEach((symbolObj, index) => {
            const { sprite, originalPosition } = symbolObj;
            const mouseEffect = 2 + Math.sin(Date.now() * 0.001 + index) * 0.5;
            
            sprite.position.x = originalPosition.x + this.mouse.x * mouseEffect;
            sprite.position.y = originalPosition.y + this.mouse.y * mouseEffect * 0.5;
            
            // Enhanced rotation with mouse influence
            sprite.material.rotation = this.mouse.x * 0.5 + Date.now() * 0.001 + index * 0.2;
            
            // Scale effect based on mouse distance
            const distance = Math.sqrt(this.mouse.x * this.mouse.x + this.mouse.y * this.mouse.y);
            sprite.scale.setScalar(0.3 + distance * 0.3);
        });
    }
    
    addMouseTrail(x, y) {
        this.mouseTrail.push({ x, y, time: Date.now() });
        if (this.mouseTrail.length > 10) {
            this.mouseTrail.shift();
        }
    }
    
    createRippleEffect() {
        if (!this.mesh) return;
        
        // Create temporary ripple geometry
        const rippleGeometry = new THREE.RingGeometry(0.1, 0.5, 16);
        const rippleMaterial = new THREE.MeshBasicMaterial({
            color: 0x6366f1,
            transparent: true,
            opacity: 0.5,
            side: THREE.DoubleSide
        });
        
        const ripple = new THREE.Mesh(rippleGeometry, rippleMaterial);
        ripple.position.copy(this.mesh.position);
        ripple.position.z += 2;
        this.scene.add(ripple);
        
        // Animate ripple
        const startTime = Date.now();
        const animateRipple = () => {
            const elapsed = Date.now() - startTime;
            const progress = elapsed / 1000;
            
            if (progress < 1) {
                ripple.scale.setScalar(1 + progress * 3);
                ripple.material.opacity = 0.5 * (1 - progress);
                requestAnimationFrame(animateRipple);
            } else {
                this.scene.remove(ripple);
                ripple.geometry.dispose();
                ripple.material.dispose();
            }
        };
        animateRipple();
    }
    
    onScroll() {
        // Enhanced scroll effects
        if (this.mesh) {
            // Parallax effect for main mesh
            this.mesh.position.z = -this.scrollY * 0.001;
            
            // Rotate particles based on scroll
            if (this.particles) {
                this.particles.rotation.z = this.scrollY * 0.0005;
            }
        }
        
        // Update floating symbols based on scroll
        if (this.floatingSymbols) {
            this.floatingSymbols.forEach((symbolObj, index) => {
                const { sprite } = symbolObj;
                sprite.position.z = Math.sin(this.scrollY * 0.01 + index) * 2;
            });
        }
    }

    onWindowResize() {
        this.camera.aspect = this.container.clientWidth / this.container.clientHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(this.container.clientWidth, this.container.clientHeight);
    }

    animate() {
        requestAnimationFrame(() => this.animate());
        
        const time = Date.now() * 0.001;

        // Ultra-smooth rotation interpolation
        this.currentRotation.x += (this.targetRotation.x - this.currentRotation.x) * (this.isMobile ? 0.08 : 0.03);
        this.currentRotation.y += (this.targetRotation.y - this.currentRotation.y) * (this.isMobile ? 0.08 : 0.03);

        // Enhanced smooth and logical rotations
        if (this.mesh) {
            const scrollRotation = this.scrollY * 0.0008;
            const baseRotationSpeed = this.isMobile ? 0.08 : 0.12;
            
            // Natural rotation with enhanced easing
            this.mesh.rotation.x = this.currentRotation.x + Math.sin(time * baseRotationSpeed) * 0.08 + scrollRotation;
            this.mesh.rotation.y = this.currentRotation.y + time * baseRotationSpeed - scrollRotation * 0.2;
            this.mesh.rotation.z = Math.sin(time * 0.25) * 0.03 + this.mouseInfluence.x * 0.08;
            
            // Enhanced floating with multiple wave patterns
            const floatY = Math.sin(time * 0.4) * 0.12 + Math.sin(time * 0.7) * 0.04;
            const floatX = Math.cos(time * 0.35) * 0.03 + Math.cos(time * 0.8) * 0.015;
            const floatZ = Math.sin(time * 0.5) * 0.08 + Math.cos(time * 0.6) * 0.02;
            
            this.mesh.position.y = floatY + this.mouseInfluence.y * (this.isMobile ? 0.2 : 0.25);
            this.mesh.position.x = floatX + this.mouseInfluence.x * (this.isMobile ? 0.15 : 0.18);
            this.mesh.position.z = floatZ;
        }
        
        // Animate code display
        if (this.codeLines) {
            this.codeLines.children.forEach((line, index) => {
                if (line.material && line.material.opacity !== undefined) {
                    line.material.opacity = 0.7 + Math.sin(time * 1.5 + index * 0.3) * 0.2;
                }
            });
        }
        
        // Cursor blink
        if (this.cursor) {
            this.cursor.material.opacity = Math.sin(time * 3) > 0 ? 1 : 0;
        }
        
        // Enhanced holographic elements animation
        if (this.holoElements) {
            this.holoElements.forEach((holoObj, index) => {
                const { sprite, originalPosition, angle, rotationSpeed } = holoObj;
                const baseRadius = this.isMobile ? 2.8 : 3.2;
                const orbitRadius = baseRadius + Math.sin(time * 0.6 + index * 0.3) * 0.25;
                const orbitSpeed = time * (this.isMobile ? 0.15 : 0.18) + this.scrollY * 0.0003;
                
                if (!this.isMouseMoving || this.isMobile) {
                    // Smooth orbital motion with layered waves
                    const x = Math.cos(angle + orbitSpeed) * orbitRadius;
                    const y = Math.sin(angle + orbitSpeed) * (this.isMobile ? 1.0 : 1.2) + Math.sin(time * 0.5 + index * 0.4) * 0.15;
                    const z = Math.sin(angle + orbitSpeed) * (this.isMobile ? 1.2 : 1.5) + Math.cos(time * 0.4 + index * 0.2) * 0.1;
                    
                    sprite.position.x += (x - sprite.position.x) * 0.05;
                    sprite.position.y += (y - sprite.position.y) * 0.05;
                    sprite.position.z += (z - sprite.position.z) * 0.05;
                } else {
                    // Enhanced mouse response
                    const targetX = originalPosition.x + this.mouseInfluence.x * 1.8;
                    const targetY = originalPosition.y + this.mouseInfluence.y * 1.2;
                    
                    sprite.position.x += (targetX - sprite.position.x) * 0.04;
                    sprite.position.y += (targetY - sprite.position.y) * 0.04;
                }
                
                // Enhanced opacity and rotation effects
                const opacityBase = this.isMobile ? 0.4 : 0.5;
                sprite.material.opacity = opacityBase + Math.sin(time * 1.0 + index * 0.6) * 0.15;
                sprite.material.rotation = time * rotationSpeed + Math.sin(time * 0.8 + index) * 0.2;
                
                // Dynamic scaling with breathing effect
                const scaleBase = this.isMobile ? 0.5 : 0.6;
                const scalePulse = Math.sin(time * 0.6 + index * 0.4) * 0.08;
                const scale = scaleBase + scalePulse;
                sprite.scale.set(scale, scale * 0.5, scale * 0.5);
            });
        }
        
        // Ultra-smooth particle animation
        if (this.particles) {
            const rotationSpeed = this.isMobile ? 0.03 : 0.04;
            this.particles.rotation.y = time * rotationSpeed;
            this.particles.rotation.x = Math.sin(time * 0.15) * 0.08;
            this.particles.rotation.z = Math.cos(time * 0.12) * 0.05;
            
            const positions = this.particles.geometry.attributes.position.array;
            const colors = this.particles.geometry.attributes.color.array;
            
            for(let i = 0; i < positions.length; i += 3) {
                // Enhanced flowing data stream with multiple wave patterns
                const waveX = Math.sin(time * 0.4 + i * 0.01) * 0.004 + Math.sin(time * 0.8 + i * 0.005) * 0.002;
                const waveY = Math.cos(time * 0.25 + i * 0.008) * 0.003 + Math.cos(time * 0.6 + i * 0.003) * 0.0015;
                const waveZ = Math.sin(time * 0.35 + i * 0.006) * 0.0035 + Math.sin(time * 0.7 + i * 0.004) * 0.001;
                
                positions[i] += waveX;
                positions[i + 1] += waveY;
                positions[i + 2] += waveZ;
                
                // Enhanced color pulsing with smooth transitions
                const pulse1 = Math.sin(time * 1.5 + i * 0.08) * 0.08 + 0.92;
                const pulse2 = Math.cos(time * 1.2 + i * 0.06) * 0.05 + 0.95;
                const pulse3 = Math.sin(time * 1.8 + i * 0.04) * 0.06 + 0.94;
                
                colors[i] *= pulse1;
                colors[i + 1] *= pulse2;
                colors[i + 2] *= pulse3;
                
                // Smooth boundary reset
                const boundary = this.isMobile ? 6 : 8;
                if (Math.abs(positions[i]) > boundary) positions[i] *= -0.9;
                if (Math.abs(positions[i + 1]) > boundary) positions[i + 1] *= -0.9;
                if (Math.abs(positions[i + 2]) > boundary) positions[i + 2] *= -0.9;
            }
            
            this.particles.geometry.attributes.position.needsUpdate = true;
            this.particles.geometry.attributes.color.needsUpdate = true;
        }
        
        // Enhanced camera movement for all devices
        if (!this.isMobile) {
            // Check if mouse stopped moving
            if (Date.now() - this.lastMouseMove > 2500) {
                this.isMouseMoving = false;
            }
            
            // Smooth camera sway when mouse is not moving
            if (!this.isMouseMoving) {
                const swayX = Math.sin(time * 0.4) * 0.008 + Math.sin(time * 0.7) * 0.003;
                const swayY = Math.cos(time * 0.25) * 0.006 + Math.cos(time * 0.6) * 0.002;
                
                this.camera.position.x += swayX;
                this.camera.position.y += swayY;
            } else {
                // Ultra-smooth mouse following
                this.camera.position.x += (this.mouseInfluence.x * 0.6 - this.camera.position.x) * 0.03;
                this.camera.position.y += (this.mouseInfluence.y * 0.4 - this.camera.position.y) * 0.03;
            }
            
            // Enhanced dynamic camera distance
            const baseDistance = 5;
            const scrollEffect = Math.sin(this.scrollY * 0.0008) * 0.8;
            const breathingEffect = Math.sin(time * 0.3) * 0.1;
            
            this.camera.position.z = baseDistance + scrollEffect + breathingEffect;
            this.camera.lookAt(this.scene.position);
        } else {
            // Mobile camera gentle movement
            const mobileSwayX = Math.sin(time * 0.3) * 0.005;
            const mobileSwayY = Math.cos(time * 0.2) * 0.003;
            const mobileDistance = 5.5 + Math.sin(time * 0.25) * 0.2;
            
            this.camera.position.x = mobileSwayX;
            this.camera.position.y = mobileSwayY;
            this.camera.position.z = mobileDistance;
        }
        
        // Mouse trail effect
        this.updateMouseTrail();

        this.renderer.render(this.scene, this.camera);
    }
    
    updateMouseTrail() {
        const now = Date.now();
        this.mouseTrail = this.mouseTrail.filter(point => now - point.time < 1000);
        
        // Create trailing effect on particles
        if (this.particles && this.mouseTrail.length > 0) {
            const positions = this.particles.geometry.attributes.position.array;
            const colors = this.particles.geometry.attributes.color.array;
            
            // Influence particles near mouse trail
            for(let i = 0; i < positions.length; i += 3) {
                this.mouseTrail.forEach(point => {
                    const screenPos = this.worldToScreen(positions[i], positions[i + 1], positions[i + 2]);
                    const distance = Math.sqrt(
                        Math.pow(screenPos.x - point.x, 2) + 
                        Math.pow(screenPos.y - point.y, 2)
                    );
                    
                    if (distance < 100) {
                        const influence = 1 - (distance / 100);
                        colors[i] = Math.min(1, colors[i] + influence * 0.1); // Red
                        colors[i + 1] = Math.min(1, colors[i + 1] + influence * 0.05); // Green
                        colors[i + 2] = Math.min(1, colors[i + 2] + influence * 0.2); // Blue
                    }
                });
            }
            
            this.particles.geometry.attributes.color.needsUpdate = true;
        }
    }
    
    worldToScreen(x, y, z) {
        const vector = new THREE.Vector3(x, y, z);
        vector.project(this.camera);
        
        return {
            x: (vector.x + 1) * this.container.clientWidth / 2,
            y: (-vector.y + 1) * this.container.clientHeight / 2
        };
    }

    // Methods for future admin panel integration
    updateMeshGeometry(type = 'icosahedron') {
        if (!this.mesh) return;
        
        this.scene.remove(this.mesh);
        this.scene.remove(this.wireframeMesh);
        
        let geometry;
        switch(type) {
            case 'cube':
                geometry = new THREE.BoxGeometry(2, 2, 2);
                break;
            case 'sphere':
                geometry = new THREE.SphereGeometry(1.5, 32, 32);
                break;
            case 'torus':
                geometry = new THREE.TorusGeometry(1.2, 0.4, 16, 100);
                break;
            default:
                geometry = new THREE.IcosahedronGeometry(1.5, 1);
        }
        
        this.mesh.geometry = geometry;
        this.wireframeMesh.geometry = geometry;
        this.scene.add(this.mesh);
        this.scene.add(this.wireframeMesh);
    }

    updateColors(primaryColor = 0x6366f1, secondaryColor = 0xec4899) {
        if (this.mesh) {
            this.mesh.material.color.setHex(primaryColor);
        }
        if (this.wireframeMesh) {
            this.wireframeMesh.material.color.setHex(secondaryColor);
        }
    }

    destroy() {
        if (this.renderer) {
            this.container.removeChild(this.renderer.domElement);
            this.renderer.dispose();
        }
    }
}

// Initialize scene when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('three-container');
    if (container) {
        // Load Three.js from CDN
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js';
        script.onload = () => {
            window.portfolioScene = new ThreeScene('three-container');
        };
        document.head.appendChild(script);
    }
});

// Export for potential module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ThreeScene;
}