      // Mobile Menu Toggle
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');

      mobileMenuButton.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
      });

      // Close menu when clicking outside
      document.addEventListener('click', (e) => {
          if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
              mobileMenu.classList.add('hidden');
          }
      });

      // Smooth scrolling for all navigation links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function (e) {
              e.preventDefault();
              document.querySelector(this.getAttribute('href')).scrollIntoView({
                  behavior: 'smooth'
              });
              mobileMenu.classList.add('hidden');
          });
      });