# 🔐 Leaked Email Checker

A comprehensive web application and REST API for checking if email addresses have been compromised in data breaches. Built with Laravel 12 and integrates with the HaveIBeenPwned API to provide real-time breach detection.

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?logo=php)
![License](https://img.shields.io/badge/License-MIT-green)
![API](https://img.shields.io/badge/API-REST-orange)

## 🎯 Project Overview

The Leaked Email Checker is a security-focused web application that helps users determine if their email addresses have been involved in known data breaches. The application provides both a user-friendly web interface and a professional REST API for programmatic access.

### ✨ Key Features

- **🌐 Web Interface**: Clean, responsive landing page for email breach checking
- **🔌 REST API**: Professional API endpoints for third-party integrations
- **📊 Real-time Data**: Integration with HaveIBeenPwned API for up-to-date breach information
- **🛡️ Rate Limiting**: Built-in protection against API abuse
- **📱 Chrome Extension**: Download button for browser extension
- **🎨 Modern UI**: Professional dark theme with responsive design
- **⚡ Fast Performance**: Optimized codebase with service layer architecture

### ✨ Related Repositories

- **🌐 Chrome Extension**: <a href="https://github.com/ijlik/JD_011-AdiNugroho-LeakedEmailChecker">https://github.com/ijlik/JD_011-AdiNugroho-LeakedEmailChecker</a>
- **🔌 REST API**: <a href="https://github.com/ijlik/JD_011-AdiNugroho-LeakedEmailChecker-Web">https://github.com/ijlik/JD_011-AdiNugroho-LeakedEmailChecker-Web</a>

## 🏗️ Architecture

### Service Layer
- **EmailBreachService**: Centralized service for all breach checking logic
- **Dependency Injection**: Clean architecture following Laravel best practices
- **Code Reusability**: Shared service between web and API controllers

### API Design
- **RESTful Endpoints**: Standard HTTP methods and status codes
- **JSON Responses**: Consistent response formatting
- **Error Handling**: Comprehensive error messages and validation
- **Resource Classes**: Proper API resource formatting

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── LandingController.php      # Web interface controller
│   │   └── Api/
│   │       └── EmailBreachController.php  # REST API controller
│   ├── Requests/
│   │   └── SearchEmailRequest.php     # Email validation
│   └── Resources/
│       └── BreachResource.php         # API response formatting
├── Services/
│   └── EmailBreachService.php         # Core breach checking logic
└── Providers/
    └── EmailBreachServiceProvider.php # Service registration

database/
└── breach.json                        # Local breach database (955KB)

resources/
└── views/
    └── index.blade.php                # Landing page template

routes/
├── web.php                           # Web routes
└── api.php                           # API routes
```

## 🚀 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM (for asset compilation)
- SQLite (default) or MySQL/PostgreSQL

### Local Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/ijlik/JD-AdiNugroho-LeakedEmailChecker-Web.git
   cd JD-AdiNugroho-LeakedEmailChecker-Web
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure environment variables**
   Edit `.env` file with your settings:
   ```env
   APP_URL=http://localhost:8000
   HIBP_API=your_haveibeenpwned_api_key
   CHROME_EXTENSION_URL=https://chrome.google.com/webstore/detail/your-extension
   
   # Database (SQLite is default)
   DB_CONNECTION=sqlite
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

6. **Access the application**
   - Web Interface: http://localhost:8000
   - API Base URL: http://localhost:8000/api

## 🔑 API Documentation

### Authentication
Currently, the API is public. Rate limiting is applied (10 requests per minute per IP).

### Endpoints

#### POST /api/search
Search for email breaches.

**Request:**
```bash
curl -X POST http://localhost:8000/api/search \
  -H "Content-Type: application/json" \
  -d '{"email": "test@example.com"}'
```

**Response (Success):**
```json
{
  "success": true,
  "email": "test@example.com",
  "searched": true,
  "breaches_found": 2,
  "error": null,
  "data": [
    {
      "name": "Adobe",
      "title": "Adobe",
      "domain": "adobe.com",
      "breach_date": "2013-10-04",
      "pwn_count": 152445165,
      "description": "In October 2013, 153 million Adobe accounts were breached...",
      "data_classes": [
        "Email addresses",
        "Password hints",
        "Passwords",
        "Usernames"
      ]
    }
  ]
}
```

**Response (No Breaches):**
```json
{
  "success": true,
  "email": "safe@example.com",
  "searched": true,
  "breaches_found": 0,
  "error": null,
  "data": []
}
```

**Response (Validation Error):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

### Rate Limiting
- **Limit**: 10 requests per minute per IP address
- **Headers**: Rate limit information is included in response headers
- **Status Code**: 429 Too Many Requests when limit exceeded

## 🌐 Web Interface

The web interface provides a user-friendly way to check email addresses for breaches:

- **Search Form**: Simple email input with validation
- **Results Display**: Visual representation of breach data
- **Chrome Extension Button**: Download link for browser extension
- **Responsive Design**: Works on all device sizes
- **Professional UI**: Dark theme with modern styling

## 🔧 Configuration

### Environment Variables

| Variable | Description | Required | Default |
|----------|-------------|----------|---------|
| `HIBP_API` | HaveIBeenPwned API key | Yes | - |
| `CHROME_EXTENSION_URL` | Chrome extension download URL | No | - |
| `APP_URL` | Application base URL | Yes | http://localhost:8000 |

### HaveIBeenPwned API
1. Sign up at [HaveIBeenPwned](https://haveibeenpwned.com/API/Key)
2. Get your API key
3. Add it to your `.env` file as `HIBP_API`

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📦 Deployment

### Production Setup

1. **Install dependencies**
   ```bash
   composer install
   ```

2. **Initial Data**
   ```bash
   php artisan update:dataset
   ```

3. **Web Server Configuration**
   Configure your web server to point to the `public` directory.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- [HaveIBeenPwned](https://haveibeenpwned.com/) for providing the breach data API
- [Laravel](https://laravel.com/) for the excellent framework
- [Bitlion AI](https://bitlionai.com/) for project sponsorship

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact: [Bitlion AI](https://bitlionai.com/)

---

Built with ❤️ by [Bitlion AI](https://bitlionai.com/)
