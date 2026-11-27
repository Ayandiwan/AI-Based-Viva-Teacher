# AI Based Viva Teacher

**AI Based Viva Teacher** is a web-based AI-powered viva practice and evaluation system developed using **Laravel Framework (PHP)** with **MySQL** as the backend database.

The system provides a platform where students can practice viva examinations for different subjects. It uses Artificial Intelligence (AI) to evaluate student answers based on questions and expected answers. Students can submit answers using text or voice input and receive instant marks, feedback, and performance reports.

The system also provides a teacher and administrator panel to manage subjects, questions, students, and viva results.

## ✅ Features

- Student Registration & Login
- Admin Login & Dashboard
- Teacher Dashboard
- Student Profile Management
- Subject Management
- Question Management
- Expected Answer Management
- AI-Based Viva Examination
- Text-Based Answer Submission
- Voice-Based Answer Submission
- Automatic Question Reading using Text-to-Speech
- Speech Recognition for Voice Answers
- Automatic Viva Timer
- AI-Based Answer Evaluation
- Semantic Answer Comparison
- Partial Marks Evaluation
- Instant Marks and Feedback
- Multiple AI Provider Integration:
  - Groq AI
  - OpenRouter AI
  - Cloudflare Workers AI
- Student Performance Tracking
- Subject-Wise Performance Analysis
- Viva Result History
- Overall Average Score Calculation
- Download Viva Result Reports in PDF
- Admin Panel for:
  - Managing Students
  - Managing Teachers
  - Managing Subjects
  - Managing Questions
  - Managing Expected Answers
  - Managing Viva Results
  - Viewing Student Performance

## 🛠 Technologies Used

- Laravel Framework 12
- PHP
- MySQL
- HTML5
- CSS3
- Bootstrap
- JavaScript
- Blade Template Engine
- Groq AI API
- OpenRouter API
- Cloudflare Workers AI API
- Web Speech API
- Chart.js
- DOMPDF (PDF Generation)

## ▶ How to Run the Project

1. Download or clone the project from GitHub.
2. Open the project folder in Visual Studio Code.
3. Install the required dependencies:

   ```bash
   composer install
   ```

4. Create the `.env` file:

   ```bash
   cp .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Create a MySQL database named `viva_teacher`.
7. Update database credentials in the `.env` file.
8. Configure AI API credentials in the `.env` file.
9. Run database migrations:

   ```bash
   php artisan migrate
   ```

10. Install frontend dependencies if required:

   ```bash
   npm install
   npm run build
   ```

11. Start the Laravel development server:

   ```bash
   php artisan serve
   ```

12. Open the application in your browser:

   ```text
   http://127.0.0.1:8000
   ```

## 🗂 Project Structure

- **app/Http/Controllers/** – Application controllers and business logic
- **app/Models/** – Database models
- **routes/web.php** – Web application routes
- **resources/views/** – Blade templates and user interfaces
- **public/** – CSS, JavaScript, images, and public assets
- **database/migrations/** – Database table structures
- **database/seeders/** – Sample database records
- **config/** – Application configuration
- **.env** – Environment and API configuration

## 🤖 AI Evaluation System

The system uses multiple AI providers to evaluate student answers.

- **Groq AI:** Evaluates answers and generates marks and feedback.
- **OpenRouter AI:** Provides additional AI-based answer evaluation.
- **Cloudflare Workers AI:** Provides another AI evaluation service.

The system compares student answers with expected answers based on meaning and relevance rather than checking only exact words.

It supports:
- Correct answers
- Partially correct answers
- Incorrect or missing answers
- Decimal-based marks
- Automatic feedback generation

## 👥 User Roles

- **Admin:** Manages students, teachers, subjects, questions, and overall system activities.
- **Teacher:** Manages academic content and monitors student viva performance.
- **Student:** Practices viva examinations, submits text or voice answers, and views results and performance reports.

## 👤 Author

**Ayan Diwan**

**🏫 College:** Anand Agricultural University

**🎓 Branch:** B.Tech Agricultural Information Technology

**📧 Email:** [ayandiwan8769@gmail.com](mailto:ayandiwan8769@gmail.com)

## 📄 License

This project is developed for educational purposes.
