This Translation Management System is a scalable, high-performance API-driven service built with Laravel (Backend) and Vue.js (Frontend). It enables translation storage, management, and export with support for multiple languages, tag-based filtering, and efficient JSON exports.


✅ CRUD operations for translations
✅ Multi-language support with dynamic locale additions
✅ Tag-based filtering & search (web, mobile, etc.)
✅ Fast JSON export for frontend applications
✅ Authentication & Authorization using Laravel Sanctum
✅ Optimized for handling large datasets (100k+ records)
✅ Docker support for simplified deployment
✅ Swagger API Documentation

⚡ Installation & Setup
🔹 Using Docker (Recommended)
bash
Copy
Edit
docker compose build
docker compose up -d
docker exec -it app php artisan migrate --seed

🔹 Manual Installation
bash
Copy
Edit
git clone https://github.com/your-repo.git
cd translation-management-service-api
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve


📦 Database Seeding
To populate translations for scalability testing (100k+ records):

bash
Copy
Edit
php artisan seed:translations --count=100000
🔑 Authentication (Laravel Sanctum)
Login to obtain an access token:

bash
Copy
Edit
POST /api/login
Content-Type: application/json
{
   "email": "admin@example.com",
   "password": "password"
}

📖 API Documentation
Swagger API Docs are available at:
🔗 http://localhost:8000/api/documentation

To generate Swagger documentation, run:

bash
Copy
Edit
php artisan l5-swagger:generate
🛠 Testing
Run all test cases:

bash
Copy
Edit
php artisan test
Run only TranslationController tests:

bash
Copy
Edit
php artisan test --filter=TranslationControllerTest
🚀 Performance Considerations
Database indexing for faster queries
Eager loading to minimize database calls
Streaming JSON export using cursor() for efficient large dataset handling
Optimized query execution to keep API response times under 200ms
👨‍💻 Contributors
Umair Khalil
