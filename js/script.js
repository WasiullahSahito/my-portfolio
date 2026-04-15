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
        { name: "React", color: 0x61dafb },
        { name: "Laravel", color: 0xff2d20 },
        { name: "Node", color: 0x68a063 },
        { name: "PHP", color: 0x777bb3 },
        { name: "Python", color: 0x3776ab },
        { name: "PostgreSQL", color: 0x336791 },
        { name: "MySQL", color: 0x00758f },
        { name: "Git", color: 0xf05033 },
        { name: "MongoDB", color: 0x4db33d },
        { name: "Tailwind", color: 0x06b6d4 }
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

    // Enhanced Mobile menu toggle (closes menu on link click)
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    const navItems = document.querySelectorAll('.nav-links a');

    mobileMenuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        mobileMenuBtn.innerHTML = navLinks.classList.contains('active') ?
            '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
    });

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            navLinks.classList.remove('active');
            mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
        });
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
        scrollTrigger: { trigger: '.section-title', start: 'top 80%' },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    gsap.from('.experience-item', {
        scrollTrigger: { trigger: '#experience', start: 'top 80%' },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    gsap.from('.project-card', {
        scrollTrigger: { trigger: '#projects', start: 'top 80%' },
        duration: 0.8,
        y: 30,
        opacity: 0,
        stagger: 0.2
    });

    gsap.from('.ai-card', {
        scrollTrigger: { trigger: '#ai-skills', start: 'top 80%' },
        duration: 0.8,
        y: 40,
        opacity: 0,
        stagger: 0.15,
        ease: 'power2.out'
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

    // Form submission handling with Web3Forms
    const contactForm = document.getElementById('contactForm');
    const successMessage = document.getElementById('successMessage');
    const submitBtn = document.getElementById('submitBtn');

    contactForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        // 1. Change button state to show it's loading
        const originalBtnText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        submitBtn.style.opacity = '0.7';
        submitBtn.disabled = true;

        // 2. Gather the form data
        const formData = new FormData(contactForm);
        const object = Object.fromEntries(formData);
        const json = JSON.stringify(object);

        try {
            // 3. Send data to Web3Forms API
            const response = await fetch('https://api.web3forms.com/submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: json
            });

            const result = await response.json();

            if (response.status === 200) {
                // 4. Success! Show your success message
                successMessage.style.display = 'block';
                contactForm.reset();

                // Hide success message after 4 seconds
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 4000);
            } else {
                // API returned an error
                console.log(result);
                alert("Sorry, something went wrong. Please try again or email me directly.");
            }
        } catch (error) {
            // Network error
            console.log(error);
            alert("Network error. Please check your internet connection and try again.");
        } finally {
            // 5. Restore the button to its original state
            submitBtn.innerHTML = originalBtnText;
            submitBtn.style.opacity = '1';
            submitBtn.disabled = false;
        }
    });
});