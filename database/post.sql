-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Aug 10, 2025 at 11:01 AM
-- Server version: 9.4.0
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `created_at`) VALUES
(UUID(), 'Getting Started with Web Development', 'Web development is an exciting field that combines creativity with technical skills. From HTML and CSS to JavaScript frameworks, there is always something new to learn. The journey begins with understanding the fundamentals and gradually building up your expertise.', NOW()),
(UUID(), 'Database Design Best Practices', 'When designing databases, normalization is key to reducing redundancy and ensuring data integrity. Consider your relationships carefully, index your queries appropriately, and always think about scalability from the beginning.', NOW()),
(UUID(), 'The Art of Clean Code', 'Writing clean, maintainable code is more art than science. Focus on clear naming conventions, small functions, and comprehensive documentation. Your future self will thank you for the extra effort put into code quality.', NOW()),
(UUID(), 'Modern PHP Development', 'PHP has evolved significantly over the years. With features like type declarations, anonymous functions, and improved performance, modern PHP is a powerful language for web development. Frameworks like Laravel and Symfony make development even more enjoyable.', NOW()),
(UUID(), 'Understanding Docker Containers', 'Docker revolutionizes application deployment by packaging applications with their dependencies. Containers ensure consistency across environments and make scaling applications much simpler. Learn the basics of Dockerfiles and docker-compose for effective containerization.', NOW()),
(UUID(), 'API Design Principles', 'RESTful APIs should be intuitive, consistent, and well-documented. Use proper HTTP methods, status codes, and provide clear error messages. Version your APIs and always consider backward compatibility when making changes.', NOW()),
(UUID(), 'Frontend vs Backend Development', 'The choice between frontend and backend development often comes down to personal preference. Frontend focuses on user experience and visual design, while backend deals with server logic, databases, and system architecture. Full-stack developers bridge both worlds.', NOW()),
(UUID(), 'Testing Your Applications', 'Automated testing is crucial for maintaining code quality. Unit tests, integration tests, and end-to-end tests each serve different purposes. Invest time in setting up proper testing infrastructure early in your project lifecycle.', NOW()),
(UUID(), 'Version Control with Git', 'Git is an essential tool for any developer. Master the basics of commits, branches, and merges. Learn about Git workflows like GitFlow or GitHub Flow to collaborate effectively with teams. Remember to write meaningful commit messages.', NOW()),
(UUID(), 'Introduction to Machine Learning', 'Machine learning is transforming every industry. From recommendation systems to computer vision, understanding the fundamentals of ML can open new career opportunities. Start with supervised learning, explore unsupervised methods, and gradually dive into deep learning frameworks.', NOW()),
(UUID(), 'Cybersecurity Fundamentals', 'In today\'s digital world, cybersecurity is everyone\'s responsibility. Learn about common vulnerabilities like SQL injection, XSS, and CSRF. Implement proper authentication, use HTTPS, and always validate user input. Security should be built in, not bolted on.', NOW()),
(UUID(), 'Cloud Computing Essentials', 'Cloud platforms like AWS, Azure, and Google Cloud have revolutionized how we deploy and scale applications. Understanding Infrastructure as a Service, Platform as a Service, and Software as a Service models is crucial for modern development.', NOW()),
(UUID(), 'Mobile App Development Trends', 'Mobile development continues to evolve with cross-platform frameworks like React Native and Flutter. Native development still has its place, but the ability to write once and deploy everywhere is increasingly attractive for businesses and developers alike.', NOW()),
(UUID(), 'DevOps Culture and Practices', 'DevOps is more than just tools—it\'s a culture that breaks down silos between development and operations teams. Continuous integration, continuous deployment, and infrastructure as code are foundational practices that improve software delivery speed and reliability.', NOW()),
(UUID(), 'JavaScript Frameworks Comparison', 'The JavaScript ecosystem offers many choices: React for component-based UIs, Vue for progressive enhancement, Angular for enterprise applications, and Svelte for performance. Each has its strengths and ideal use cases. Choose based on your project requirements.', NOW()),
(UUID(), 'Microservices Architecture', 'Microservices break monolithic applications into smaller, independent services. While they offer benefits like scalability and technology diversity, they also introduce complexity in areas like distributed systems, data consistency, and service communication.', NOW()),
(UUID(), 'Performance Optimization Techniques', 'Website performance directly impacts user experience and business metrics. Optimize images, minimize HTTP requests, use CDNs, implement caching strategies, and monitor Core Web Vitals. Every millisecond counts in the digital world.', NOW()),
(UUID(), 'Agile Development Methodologies', 'Agile methodologies like Scrum and Kanban emphasize iterative development, customer collaboration, and responding to change. Daily standups, sprint planning, and retrospectives help teams deliver value continuously while adapting to changing requirements.', NOW()),
(UUID(), 'The Future of Web Development', 'Web development continues to evolve with technologies like WebAssembly, Progressive Web Apps, and serverless computing. The line between web and native applications is blurring, creating new possibilities for developers and better experiences for users.', NOW()),
(UUID(), 'Exploring GraphQL', 'GraphQL offers a powerful alternative to REST APIs by allowing clients to request exactly the data they need. This reduces over-fetching and under-fetching issues common in traditional APIs. Learn about schemas, resolvers, and how to implement GraphQL in your applications.', NOW());

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
