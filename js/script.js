// Enhanced Three.js 3D Background with Tech Logos
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Three.js scene
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({
        canvas: document.getElementById('three-canvas'),
        alpha: true,
        antialias: true
    });

    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);

    // Add lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0x4cc9f0, 1);
    directionalLight.position.set(1, 1, 1);
    scene.add(directionalLight);

    // Create floating tech logos
    const techLogos = [];
    const techIcons = [
        { name: "HTML", color: 0xe44d26 },
        { name: "CSS", color: 0x264de4 },
        { name: "JS", color: 0xf0db4f },
        { name: "React", color: 0x61dafb },
        { name: "Node", color: 0x68a063 },
        { name: "PHP", color: 0x777bb3 },
        { name: "MySQL", color: 0x00758f },
        { name: "WordPress", color: 0x21759b },
        { name: "Git", color: 0xf05033 },
        { name: "Bootstrap", color: 0x563d7c },
        { name: "MongoDB", color: 0x4db33d },
        { name: "Python", color: 0x3776ab }
    ];

    // Create a sphere for each tech logo
    techIcons.forEach((tech, index) => {
        const geometry = new THREE.SphereGeometry(0.3, 16, 16);
        const material = new THREE.MeshPhongMaterial({
            color: tech.color,
            emissive: tech.color,
            emissiveIntensity: 0.2,
            shininess: 80,
            specular: 0xffffff
        });

        const sphere = new THREE.Mesh(geometry, material);

        // Position in a spherical pattern
        const phi = Math.acos(-1 + (2 * index) / techIcons.length);
        const theta = Math.sqrt(techIcons.length * Math.PI) * phi;

        sphere.position.setFromSphericalCoords(5, phi, theta);

        // Add some random offset for natural look
        sphere.position.x += (Math.random() - 0.5) * 2;
        sphere.position.y += (Math.random() - 0.5) * 2;
        sphere.position.z += (Math.random() - 0.5) * 2;

        // Store initial position for animation
        sphere.userData = {
            initialPosition: sphere.position.clone(),
            velocity: new THREE.Vector3(
                (Math.random() - 0.5) * 0.005,
                (Math.random() - 0.5) * 0.005,
                (Math.random() - 0.5) * 0.005
            )
        };

        scene.add(sphere);
        techLogos.push(sphere);
    });

    // Add connecting lines between tech logos
    const lines = [];
    for (let i = 0; i < techLogos.length; i++) {
        for (let j = i + 1; j < techLogos.length; j++) {
            if (Math.random() > 0.7) {
                const geometry = new THREE.BufferGeometry().setFromPoints([
                    techLogos[i].position,
                    techLogos[j].position
                ]);

                const material = new THREE.LineBasicMaterial({
                    color: 0x4cc9f0,
                    transparent: true,
                    opacity: 0.3
                });

                const line = new THREE.Line(geometry, material);
                scene.add(line);
                lines.push(line);
            }
        }
    }

    camera.position.z = 8;

    // Animation function
    function animate() {
        requestAnimationFrame(animate);

        // Animate tech logos
        techLogos.forEach(logo => {
            // Float around initial position
            logo.position.x += logo.userData.velocity.x;
            logo.position.y += logo.userData.velocity.y;
            logo.position.z += logo.userData.velocity.z;

            // Boundary check with elasticity
            const dist = logo.position.distanceTo(logo.userData.initialPosition);
            if (dist > 1.5) {
                logo.userData.velocity.multiplyScalar(-0.8);
            }

            // Rotate slowly
            logo.rotation.x += 0.005;
            logo.rotation.y += 0.005;
        });

        // Rotate the entire scene for dynamic effect
        scene.rotation.y += 0.001;

        renderer.render(scene, camera);
    }

    animate();

    // Handle window resize
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });

    // Header scroll effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    mobileMenuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        mobileMenuBtn.innerHTML = navLinks.classList.contains('active') ?
            '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
    });

    // GSAP animations for elements
    gsap.registerPlugin(ScrollTrigger);

    gsap.from('.hero-content', {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: 'power3.out'
    });

    gsap.from('.section-title', {
        scrollTrigger: {
            trigger: '.section-title',
            start: 'top 80%'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    gsap.from('.experience-item', {
        scrollTrigger: {
            trigger: '.experience-item',
            start: 'top 90%'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    gsap.from('.project-card', {
        scrollTrigger: {
            trigger: '.project-card',
            start: 'top 90%'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    gsap.from('.testimonial-card', {
        scrollTrigger: {
            trigger: '#testimonials',
            start: 'top 80%'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    gsap.from('.blog-card', {
        scrollTrigger: {
            trigger: '#insights',
            start: 'top 80%'
        },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    // Add scroll-to-top functionality
    const scrollToTopBtn = document.querySelector('.scroll-to-top');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Form submission handling
    const contactForm = document.getElementById('contactForm');
    const successMessage = document.getElementById('successMessage');

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Show success message
        successMessage.style.display = 'block';

        // Reset form after 3 seconds
        setTimeout(() => {
            contactForm.reset();
            successMessage.style.display = 'none';
        }, 3000);
    });
});