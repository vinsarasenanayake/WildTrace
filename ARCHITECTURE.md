# WildTrace System Architecture

## Real-Time Sync Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         USER EXPERIENCE                          │
└─────────────────────────────────────────────────────────────────┘
                                 │
                    ┌────────────┴────────────┐
                    │                         │
                    ▼                         ▼
        ┌───────────────────┐     ┌───────────────────┐
        │   FLUTTER APP     │     │   LARAVEL WEBSITE │
        │   (Mobile)        │     │   (Web Browser)   │
        └───────────────────┘     └───────────────────┘
                    │                         │
                    │   HTTP/JSON API         │
                    │   (Bearer Token Auth)   │
                    │                         │
                    └────────────┬────────────┘
                                 │
                                 ▼
                    ┌─────────────────────┐
                    │   LARAVEL API       │
                    │   routes/api.php    │
                    │                     │
                    │   Authentication:   │
                    │   Laravel Sanctum   │
                    └─────────────────────┘
                                 │
                    ┌────────────┴────────────┐
                    │                         │
                    ▼                         ▼
        ┌───────────────────┐     ┌───────────────────┐
        │  API CONTROLLERS  │     │   MIDDLEWARE      │
        │                   │     │                   │
        │  • AuthController │     │  • auth:sanctum   │
        │  • CartController │     │  • CORS           │
        │  • FavoriteCtrl   │     │  • Validation     │
        │  • OrderController│     └───────────────────┘
        │  • ProductCtrl    │
        └───────────────────┘
                    │
                    ▼
        ┌───────────────────┐
        │   ELOQUENT ORM    │
        │   (Models)        │
        │                   │
        │  • User           │
        │  • Product        │
        │  • Cart           │
        │  • Favorite       │
        │  • Order          │
        │  • OrderItem      │
        └───────────────────┘
                    │
                    ▼
        ┌───────────────────┐
        │   MySQL DATABASE  │
        │                   │
        │  Tables:          │
        │  • users          │
        │  • products       │
        │  • carts          │
        │  • favorites      │
        │  • orders         │
        │  • order_items    │
        └───────────────────┘
```

## Data Flow Examples

### Example 1: User Adds Product to Cart on Mobile

```
┌──────────────┐
│ Flutter App  │
│ (Mobile)     │
└──────┬───────┘
       │
       │ 1. User taps "Add to Cart"
       │
       ▼
┌──────────────────────────────────┐
│ CartProvider.addToCart()         │
│ • Updates local state            │
│ • Calls ApiService.addToCart()   │
└──────┬───────────────────────────┘
       │
       │ 2. POST /api/cart
       │    {product_id: 1, quantity: 2}
       │    Authorization: Bearer token
       │
       ▼
┌──────────────────────────────────┐
│ Laravel API                      │
│ CartController@store             │
│ • Validates request              │
│ • Checks authentication          │
│ • Saves to database              │
└──────┬───────────────────────────┘
       │
       │ 3. INSERT INTO carts
       │
       ▼
┌──────────────────────────────────┐
│ MySQL Database                   │
│ carts table                      │
│ id | user_id | product_id | qty  │
│ 1  |    5    |     1      |  2   │
└──────────────────────────────────┘
       │
       │ 4. Returns success
       │
       ▼
┌──────────────┐
│ Flutter App  │
│ Shows success│
└──────────────┘

LATER...

┌──────────────┐
│ Website      │
│ (Browser)    │
└──────┬───────┘
       │
       │ 5. User opens website
       │    GET /api/cart
       │
       ▼
┌──────────────────────────────────┐
│ Laravel API                      │
│ CartController@index             │
│ • Checks authentication          │
│ • Queries database               │
└──────┬───────────────────────────┘
       │
       │ 6. SELECT * FROM carts
       │    WHERE user_id = 5
       │
       ▼
┌──────────────────────────────────┐
│ MySQL Database                   │
│ Returns cart items               │
└──────┬───────────────────────────┘
       │
       │ 7. Returns cart data
       │
       ▼
┌──────────────┐
│ Website      │
│ Shows same   │
│ cart items!  │
└──────────────┘
```

### Example 2: User Favorites Product on Website

```
┌──────────────┐
│ Website      │
└──────┬───────┘
       │
       │ 1. User clicks heart icon
       │    POST /api/favorites/toggle
       │
       ▼
┌──────────────────────────────────┐
│ Laravel API                      │
│ FavoriteController@toggle        │
│ • Checks if already favorited    │
│ • Creates or deletes record      │
└──────┬───────────────────────────┘
       │
       │ 2. INSERT INTO favorites
       │
       ▼
┌──────────────────────────────────┐
│ MySQL Database                   │
│ favorites table                  │
│ id | user_id | product_id        │
│ 1  |    5    |     3             │
└──────────────────────────────────┘

LATER...

┌──────────────┐
│ Flutter App  │
└──────┬───────┘
       │
       │ 3. User opens favorites
       │    GET /api/favorites
       │
       ▼
┌──────────────────────────────────┐
│ Laravel API                      │
│ FavoriteController@index         │
└──────┬───────────────────────────┘
       │
       │ 4. SELECT * FROM favorites
       │    WHERE user_id = 5
       │
       ▼
┌──────────────┐
│ Flutter App  │
│ Shows same   │
│ favorites!   │
└──────────────┘
```

## API Endpoint Structure

```
/api
├── /login (POST)
├── /register (POST)
├── /logout (POST) [Auth Required]
│
├── /user (GET) [Auth Required]
├── /user/profile (PUT) [Auth Required]
│
├── /products (GET)
├── /products/{id} (GET)
│
├── /cart [Auth Required]
│   ├── GET - Fetch cart
│   ├── POST - Add to cart
│   ├── PUT /{id} - Update quantity
│   ├── DELETE /{id} - Remove item
│   ├── DELETE - Clear cart
│   └── POST /sync - Sync cart
│
├── /favorites [Auth Required]
│   ├── GET - Fetch favorites
│   ├── POST /toggle - Toggle favorite
│   ├── GET /check/{id} - Check status
│   └── DELETE /{id} - Remove favorite
│
└── /orders [Auth Required]
    ├── GET - Fetch all orders
    ├── POST - Create order
    ├── GET /{id} - Fetch single order
    └── PUT /{id}/status - Update status
```

## Authentication Flow

```
┌──────────────┐
│ User enters  │
│ credentials  │
└──────┬───────┘
       │
       ▼
┌──────────────────────────────────┐
│ POST /api/login                  │
│ {email, password}                │
└──────┬───────────────────────────┘
       │
       ▼
┌──────────────────────────────────┐
│ Laravel Sanctum                  │
│ • Validates credentials          │
│ • Creates token                  │
└──────┬───────────────────────────┘
       │
       │ Returns:
       │ {
       │   token: "1|abc123...",
       │   user: {...}
       │ }
       │
       ▼
┌──────────────────────────────────┐
│ Client stores token              │
│ • Mobile: flutter_secure_storage │
│ • Web: Session/LocalStorage      │
└──────┬───────────────────────────┘
       │
       │ All subsequent requests:
       │ Authorization: Bearer token
       │
       ▼
┌──────────────────────────────────┐
│ Laravel validates token          │
│ • Checks personal_access_tokens  │
│ • Returns user data              │
└──────────────────────────────────┘
```

## Technology Stack

```
┌─────────────────────────────────────────┐
│           FRONTEND                      │
├─────────────────────────────────────────┤
│ Flutter (Mobile)                        │
│ • Dart                                  │
│ • Provider (State Management)           │
│ • flutter_secure_storage                │
│ • http package                          │
├─────────────────────────────────────────┤
│ Laravel Blade (Web)                     │
│ • HTML/CSS/JavaScript                   │
│ • Livewire                              │
│ • Alpine.js                             │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│           BACKEND                       │
├─────────────────────────────────────────┤
│ Laravel 11                              │
│ • PHP 8.2+                              │
│ • Laravel Sanctum (Auth)                │
│ • Eloquent ORM                          │
│ • API Resources                         │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│           DATABASE                      │
├─────────────────────────────────────────┤
│ MySQL                                   │
│ • Users                                 │
│ • Products                              │
│ • Carts                                 │
│ • Favorites                             │
│ • Orders                                │
│ • Order Items                           │
└─────────────────────────────────────────┘
```

## Security Layers

```
┌─────────────────────────────────────────┐
│ 1. HTTPS (Production)                   │
│    • Encrypted communication            │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│ 2. Laravel Sanctum                      │
│    • Token-based authentication         │
│    • Token expiration                   │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│ 3. Middleware                           │
│    • auth:sanctum                       │
│    • CORS configuration                 │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│ 4. Input Validation                     │
│    • Request validation                 │
│    • Data sanitization                  │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│ 5. Database Security                    │
│    • Password hashing (bcrypt)          │
│    • SQL injection prevention (ORM)     │
└─────────────────────────────────────────┘
```

## Deployment Architecture (Production)

```
┌─────────────────────────────────────────┐
│           USERS                         │
└─────────────────────────────────────────┘
                    │
        ┌───────────┴───────────┐
        │                       │
        ▼                       ▼
┌───────────────┐     ┌───────────────┐
│ Mobile App    │     │ Web Browser   │
│ (iOS/Android) │     │               │
└───────────────┘     └───────────────┘
        │                       │
        │       HTTPS           │
        │                       │
        └───────────┬───────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │   Load Balancer       │
        │   (Nginx/Apache)      │
        └───────────────────────┘
                    │
        ┌───────────┴───────────┐
        │                       │
        ▼                       ▼
┌───────────────┐     ┌───────────────┐
│ Laravel App   │     │ Laravel App   │
│ Instance 1    │     │ Instance 2    │
└───────────────┘     └───────────────┘
        │                       │
        └───────────┬───────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │   MySQL Database      │
        │   (Master/Replica)    │
        └───────────────────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │   Redis Cache         │
        │   (Session/Queue)     │
        └───────────────────────┘
```

---

**This architecture ensures:**
- ✅ Real-time data synchronization
- ✅ Scalable and maintainable code
- ✅ Secure authentication
- ✅ Consistent user experience
- ✅ Production-ready deployment
