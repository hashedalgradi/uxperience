/**
 * 3D Scene Controller for Admin Panel
 * Allows real-time updates to the 3D scene
 */

class SceneController {
    constructor() {
        this.scene = null;
        this.init();
    }

    init() {
        // Wait for scene to be initialized
        const checkScene = setInterval(() => {
            if (window.portfolioScene) {
                this.scene = window.portfolioScene;
                clearInterval(checkScene);
                this.loadSettings();
            }
        }, 100);
    }

    async loadSettings() {
        try {
            const response = await fetch('/admin/scene/settings');
            const settings = await response.json();
            this.applySettings(settings);
        } catch (error) {
            console.log('Using default scene settings');
        }
    }

    applySettings(settings) {
        if (!this.scene) return;

        // Update geometry
        if (settings.geometry) {
            this.scene.updateMeshGeometry(settings.geometry);
        }

        // Update colors
        if (settings.primaryColor && settings.secondaryColor) {
            const primaryColor = parseInt(settings.primaryColor.replace('#', '0x'));
            const secondaryColor = parseInt(settings.secondaryColor.replace('#', '0x'));
            this.scene.updateColors(primaryColor, secondaryColor);
        }

        // Update animation speed (future implementation)
        if (settings.animationSpeed) {
            this.scene.animationSpeed = settings.animationSpeed;
        }
    }

    // Methods for real-time updates from admin panel
    updateGeometry(type) {
        if (this.scene) {
            this.scene.updateMeshGeometry(type);
        }
    }

    updateColors(primary, secondary) {
        if (this.scene) {
            const primaryColor = parseInt(primary.replace('#', '0x'));
            const secondaryColor = parseInt(secondary.replace('#', '0x'));
            this.scene.updateColors(primaryColor, secondaryColor);
        }
    }
}

// Initialize controller when scene is ready
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('three-container')) {
        window.sceneController = new SceneController();
    }
});