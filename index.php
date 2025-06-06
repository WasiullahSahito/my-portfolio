<?php 
$con = mysqli_connect("localhost", "root", "", "portfolio");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require './vendor/autoload.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if(empty($name) || empty($email) || empty($message)) {
        echo '<div class="alert alert-danger" role="alert">Please fill in all fields.</div>';
        exit();
    }    
    
    $sql = "INSERT INTO contact (name,email,message) VALUES (?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);
if($stmt->execute()) {
    try{
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'wasi1237585@gmail.com';
        $mail->Password = 'epsy crfw oksi rdld';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($email, $name);
        $mail->addAddress('wasi1237585@gmail.com', 'Wasiullah Sehto');
        $mail->addReplyTo($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
            <h3>New Message from Portfolio Contact Form</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>".nl2br(htmlspecialchars($message))."</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        
        $mail->send();
        echo '<div class="alert alert-success" role="alert">
    <strong>Success!</strong> Your message has been sent.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

    }
    catch(Exception $e){
        echo '<div class="alert alert-danger" role="alert">
    <strong>Error!</strong> '.$e->getMessage().'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

    }
}
}

    




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wasiullah Sehto | Full Stack Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Header Section -->
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-600">Wasiullah Sehto</h1>
            <nav class="hidden md:flex space-x-8">
                <a href="#about" class="hover:text-indigo-600 transition">About</a>
                <a href="#experience" class="hover:text-indigo-600 transition">Experience</a>
                <a href="#projects" class="hover:text-indigo-600 transition">Projects</a>
                <a href="#skills" class="hover:text-indigo-600 transition">Skills</a>
                <a href="#education" class="hover:text-indigo-600 transition">Education</a>
            </nav>
            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden absolute w-full bg-white shadow-lg">
            <div class="px-6 py-4 space-y-4">
                <a href="#about" class="block hover:text-indigo-600">About</a>
                <a href="#experience" class="block hover:text-indigo-600">Experience</a>
                <a href="#projects" class="block hover:text-indigo-600">Projects</a>
                <a href="#skills" class="block hover:text-indigo-600">Skills</a>
                <a href="#education" class="block hover:text-indigo-600">Education</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-12 md:py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">Wasiullah Sehto</h1>
            <h2 class="text-xl md:text-3xl font-semibold mb-6">Full Stack Web Developer</h2>
            <div class="flex flex-col md:flex-row justify-center space-y-2 md:space-y-0 md:space-x-4 mb-8">
                <span class="flex items-center justify-center">
                    <i class="fas fa-map-marker-alt mr-2"></i> Hyderabad, Pakistan
                </span>
                <span class="flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i> wasi1237585@gmail.com
                </span>
                <span class="flex items-center justify-center">
                    <i class="fas fa-phone mr-2"></i> 03334698244
                </span>
            </div>
            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 justify-center">
                <a href="./wasi_cv.pdf" class="bg-white text-indigo-600 px-6 py-2 rounded-full font-medium hover:bg-gray-100 transition" download>Download CV</a>
                <a href="#contact" class="border-2 border-white px-6 py-2 rounded-full font-medium hover:bg-white hover:text-indigo-600 transition">Contact Me</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Professional Summary</h2>
            <div class="max-w-3xl mx-auto text-center">
                <p class="text-lg text-gray-700 leading-relaxed">
                    Creative and detail-oriented Full Stack Web Developer with hands-on experience in PHP, Laravel, MySQL, and the MERN stack (MongoDB, Express.js, React.js, Node.js). Passionate about building responsive and efficient web applications. Proven ability to collaborate in teams to deliver user-focused solutions.
                </p>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Experience</h2>
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-indigo-600">Web Developer</h3>
                        <span class="bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full">2025</span>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">CodePro Software and Web Services</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-indigo-500 mr-2 mt-1">•</span>
                            <span>Contributed to front-end and back-end development projects using PHP, Laravel, and JavaScript</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-500 mr-2 mt-1">•</span>
                            <span>Collaborated with the team to debug, optimize, and enhance web applications</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-500 mr-2 mt-1">•</span>
                            <span>Gained practical experience in agile workflows and project documentation</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Projects</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Project 1 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-indigo-600 mb-2">CRUD Operations</h3>
                        <p class="text-gray-700 mb-4">Developed a robust CRUD application for database management with intuitive user interface.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">PHP</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">HTML</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">CSS</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">JavaScript</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">Bootstrap</span>
                        </div>
                    </div>
                </div>
                
                <!-- Project 2 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-indigo-600 mb-2">Login Authentication System</h3>
                        <p class="text-gray-700 mb-4">Engineered a secure authentication system with password hashing and session management.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">PHP</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">HTML</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">CSS</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">JavaScript</span>
                        </div>
                    </div>
                </div>
                
                <!-- Project 3 -->
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-indigo-600 mb-2">URL Shortener</h3>
                        <p class="text-gray-700 mb-4">Created a scalable URL shortening service with custom short URLs and click analytics.</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">PHP</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">HTML</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full">CSS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Technical Skills</h2>
            <div class="max-w-4xl mx-auto grid md:grid-cols-3 gap-6">
                <!-- Frontend -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600 mb-6 text-center">Frontend</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center">
                            <i class="fab fa-html5 text-4xl text-orange-500 mb-2"></i>
                            <span>HTML5</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fab fa-css3-alt text-4xl text-blue-500 mb-2"></i>
                            <span>CSS3</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fab fa-js-square text-4xl text-yellow-400 mb-2"></i>
                            <span>JavaScript</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fab fa-bootstrap text-4xl text-purple-500 mb-2"></i>
                            <span>Bootstrap</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fab fa-react text-4xl text-blue-400 mb-2"></i>
                            <span>React.js</span>
                        </div>
                    </div>
                </div>
                
                <!-- Backend -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600 mb-6 text-center">Backend</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center">
                            <i class="fab fa-php text-4xl text-indigo-700 mb-2"></i>
                            <span>PHP</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <img src="https://laravel.com/img/logomark.min.svg" class="h-10 w-10 mb-2" alt="Laravel">
                            <span>Laravel</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fab fa-node-js text-4xl text-green-500 mb-2"></i>
                            <span>Node.js</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <img src="https://expressjs.com/images/favicon.png" class="h-10 w-10 mb-2" alt="Express.js">
                            <span>Express.js</span>
                        </div>
                    </div>
                </div>
                
                <!-- Database & Others -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600 mb-6 text-center">Database & Others</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-database text-4xl text-blue-600 mb-2"></i>
                            <span>MySQL</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <img src="https://webimages.mongodb.com/_com_assets/cms/kuyjf3vea2hg34taa-horizontal_default_slate_blue.svg?auto=format%252Ccompress" class="h-10 mb-2" alt="MongoDB">
                            <span>MongoDB</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <i class="fab fa-wordpress text-4xl text-blue-700 mb-2"></i>
                            <span>WordPress</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Education</h2>
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Education 1 -->
                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex flex-col md:flex-row justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-indigo-600">Bachelor's in Computer Science</h3>
                            <span class="bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full mt-2 md:mt-0">2022-2026</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700">Szabist University Hyderabad</h4>
                        <p class="text-gray-600 mt-2">Expected graduation in 2026</p>
                    </div>
                </div>
                
                <!-- Education 2 -->
                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex flex-col md:flex-row justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-indigo-600">Pre-Engineering</h3>
                            <span class="bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full mt-2 md:mt-0">2019-2021</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700">Public School Hyderabad</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Certifications</h2>
            <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-6">
                <!-- Certification 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600 mb-2">Internship Completion Certificate</h3>
                    <p class="text-gray-700 mb-4">CodePro Software and Web Services (2025)</p>
                </div>
                
                <!-- Certification 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-indigo-600 mb-2">Comprehensive Web Development</h3>
                    <p class="text-gray-700 mb-4">HTML, CSS, JavaScript, PHP, MySQL, WordPress</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-indigo-600 text-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Get In Touch</h2>
            <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-4"></i>
                            <span>wasi1237585@gmail.com</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-4"></i>
                            <span>03334698244</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-4"></i>
                            <span>Hyderabad, Pakistan</span>
                        </div>
                    </div>
                </div>
                <div>
                    <form class="space-y-4" method="post">
                        <div>
                            <input type="text" placeholder="Your Name" class="w-full px-4 py-2 rounded bg-indigo-500 bg-opacity-30 border border-indigo-400 focus:outline-none focus:ring-2 focus:ring-white" name="name">
                        </div>
                        <div>
                            <input type="email" placeholder="Your Email" class="w-full px-4 py-2 rounded bg-indigo-500 bg-opacity-30 border border-indigo-400 focus:outline-none focus:ring-2 focus:ring-white" name="email">
                        </div>
                        <div>
                            <textarea placeholder="Your Message" rows="4" class="w-full px-4 py-2 rounded bg-indigo-500 bg-opacity-30 border border-indigo-400 focus:outline-none focus:ring-2 focus:ring-white" name="message"></textarea>
                        </div>
                        <button type="submit" class="bg-white text-indigo-600 px-6 py-2 rounded font-medium hover:bg-gray-100 transition">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>© 2023 Wasiullah Sehto. All rights reserved.</p>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-github fa-lg"></i></a>
                <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-linkedin fa-lg"></i></a>
                <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-twitter fa-lg"></i></a>
            </div>
        </div>
    </footer>

    <script src="./script.js"> </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>
</html>