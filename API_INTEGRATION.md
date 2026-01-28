# WildTrace API Integration Guide

## Overview
This document describes the complete API integration between the Laravel backend and Flutter mobile app, ensuring real-time synchronization of user data across both platforms.

## Base Configuration

### Laravel Backend
- **Base URL**: `http://localhost:8000/api`
- **Authentication**: Laravel Sanctum (Bearer Token)

### Flutter App
- **Base URL**: `http://10.0.2.2:8000/api` (Android Emulator)
- **Base URL**: `http://localhost:8000/api` (iOS Simulator)
- **Base URL**: `http://YOUR_IP:8000/api` (Physical Device)

## API Endpoints

### 🔐 Authentication

#### Login
```
POST /api/login
Content-Type: application/json

Request:
{
  "email": "user@example.com",
  "password": "password123"
}

Response (200):
{
  "token": "1|abc123...",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com",
    ...
  }
}
```

#### Register
```
POST /api/register
Content-Type: application/json

Request:
{
  "name": "John Doe",
  "email": "user@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "contact_number": "+1234567890",
  "address": "123 Main St",
  "city": "New York",
  "postal_code": "10001",
  "country": "USA"
}

Response (201):
{
  "message": "User registered successfully",
  "token": "2|xyz789...",
  "user": { ... }
}
```

#### Logout
```
POST /api/logout
Authorization: Bearer {token}

Response (200):
{
  "message": "Logged out successfully"
}
```

### 👤 User Profile

#### Get Profile
```
GET /api/user
Authorization: Bearer {token}

Response (200):
{
  "id": 1,
  "name": "John Doe",
  "email": "user@example.com",
  "contact_number": "+1234567890",
  ...
}
```

#### Update Profile
```
PUT /api/user/profile
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "name": "John Updated",
  "email": "newemail@example.com",
  "contact_number": "+9876543210",
  "address": "456 Oak Ave",
  "city": "Los Angeles",
  "postal_code": "90001",
  "country": "USA"
}

Response (200):
{
  "message": "Profile updated successfully",
  "user": { ... }
}
```

### 📦 Products

#### Get All Products
```
GET /api/products

Response (200):
[
  {
    "id": 1,
    "title": "Wildlife Photo",
    "category": "Wildlife",
    "price": 99.99,
    "image_url": "storage/products/image.jpg",
    "photographer": {
      "id": 1,
      "name": "Jane Photographer",
      ...
    }
  },
  ...
]
```

#### Get Single Product
```
GET /api/products/{id}

Response (200):
{
  "id": 1,
  "title": "Wildlife Photo",
  ...
}
```

### 🛒 Cart Management

#### Get Cart
```
GET /api/cart
Authorization: Bearer {token}

Response (200):
[
  {
    "id": 1,
    "user_id": 1,
    "product_id": 5,
    "quantity": 2,
    "product": {
      "id": 5,
      "title": "Product Name",
      "price": 99.99,
      ...
    }
  },
  ...
]
```

#### Add to Cart
```
POST /api/cart
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "product_id": 5,
  "quantity": 2
}

Response (201):
{
  "message": "Item added to cart",
  "cart_item": { ... }
}
```

#### Update Cart Item
```
PUT /api/cart/{cart_item_id}
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "quantity": 3
}

Response (200):
{
  "message": "Cart updated",
  "cart_item": { ... }
}
```

#### Remove from Cart
```
DELETE /api/cart/{cart_item_id}
Authorization: Bearer {token}

Response (200):
{
  "message": "Item removed from cart"
}
```

#### Clear Cart
```
DELETE /api/cart
Authorization: Bearer {token}

Response (200):
{
  "message": "Cart cleared"
}
```

#### Sync Cart (Mobile to Web)
```
POST /api/cart/sync
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "items": [
    {
      "product_id": 5,
      "quantity": 2
    },
    {
      "product_id": 8,
      "quantity": 1
    }
  ]
}

Response (200):
{
  "message": "Cart synced successfully",
  "cart": [ ... ]
}
```

### ❤️ Favorites

#### Get Favorites
```
GET /api/favorites
Authorization: Bearer {token}

Response (200):
[
  {
    "id": 1,
    "user_id": 1,
    "product_id": 5,
    "product": {
      "id": 5,
      "title": "Product Name",
      ...
    }
  },
  ...
]
```

#### Toggle Favorite
```
POST /api/favorites/toggle
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "product_id": 5
}

Response (200):
{
  "message": "Added to favorites",
  "is_favorite": true,
  "favorite": { ... }
}

OR

{
  "message": "Removed from favorites",
  "is_favorite": false
}
```

#### Check if Product is Favorited
```
GET /api/favorites/check/{product_id}
Authorization: Bearer {token}

Response (200):
{
  "is_favorite": true
}
```

#### Remove Favorite
```
DELETE /api/favorites/{favorite_id}
Authorization: Bearer {token}

Response (200):
{
  "message": "Removed from favorites"
}
```

### 📋 Orders

#### Get All Orders
```
GET /api/orders
Authorization: Bearer {token}

Response (200):
[
  {
    "id": 1,
    "user_id": 1,
    "total_price": 299.97,
    "status": "pending",
    "payment_status": "paid",
    "shipping_address": "123 Main St, New York, NY 10001",
    "created_at": "2026-01-28T10:00:00Z",
    "items": [
      {
        "id": 1,
        "order_id": 1,
        "product_id": 5,
        "quantity": 3,
        "price": 99.99,
        "product": { ... }
      }
    ]
  },
  ...
]
```

#### Get Single Order
```
GET /api/orders/{id}
Authorization: Bearer {token}

Response (200):
{
  "id": 1,
  "user_id": 1,
  "total_price": 299.97,
  ...
}
```

#### Create Order
```
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "items": [
    {
      "product_id": 5,
      "product_name": "Wildlife Photo",
      "product_image": "storage/products/image.jpg",
      "quantity": 2,
      "price": 99.99
    }
  ],
  "total_price": 199.98,
  "shipping_address": "123 Main St, New York, NY 10001",
  "payment_status": "paid",
  "session_id": "stripe_session_123"
}

Response (201):
{
  "message": "Order placed successfully",
  "order": {
    "id": 1,
    "user_id": 1,
    "total_price": 199.98,
    "status": "pending",
    "items": [ ... ]
  }
}
```

#### Update Order Status
```
PUT /api/orders/{id}/status
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "status": "shipped",
  "payment_status": "paid"
}

Response (200):
{
  "message": "Order updated successfully",
  "order": { ... }
}
```

## Real-Time Sync Features

### How Sync Works

1. **User Login**: When a user logs in from either web or mobile, they receive the same authentication token
2. **Cart Sync**: Cart items are stored in the database and automatically synced across devices
3. **Favorites Sync**: Favorites are stored per user and accessible from any device
4. **Order History**: All orders are linked to the user account and visible everywhere
5. **Profile Updates**: Profile changes are immediately reflected across all platforms

### Sync Scenarios

#### Scenario 1: User adds item to cart on mobile
1. Mobile app calls `POST /api/cart` with product_id and quantity
2. Laravel stores cart item in database linked to user_id
3. When user opens website, cart is loaded from `GET /api/cart`
4. Same cart items appear on both platforms

#### Scenario 2: User favorites a product on website
1. Website calls `POST /api/favorites/toggle` with product_id
2. Laravel creates favorite record in database
3. When user opens mobile app, favorites are loaded from `GET /api/favorites`
4. Same favorites appear on both platforms

#### Scenario 3: User places order on mobile
1. Mobile app calls `POST /api/orders` with order details
2. Laravel creates order and clears cart
3. Order appears in order history on both web and mobile
4. Cart is empty on both platforms

## Flutter Integration

### AuthProvider Updates
```dart
// Login and store token
final response = await _apiService.login(email, password);
final token = response['token'];
await _storage.write(key: 'auth_token', value: token);

// Logout
await _apiService.logout(token);
await _storage.delete(key: 'auth_token');
```

### CartProvider Updates
```dart
// Fetch cart from API
Future<void> loadCart() async {
  final token = await _storage.read(key: 'auth_token');
  if (token != null) {
    final cartItems = await _apiService.fetchCart(token);
    // Update local state
  }
}

// Add to cart
Future<void> addToCart(String productId, int quantity) async {
  final token = await _storage.read(key: 'auth_token');
  if (token != null) {
    await _apiService.addToCart(productId, quantity, token);
    await loadCart(); // Refresh cart
  }
}
```

### FavoritesProvider Updates
```dart
// Toggle favorite
Future<void> toggleFavorite(String productId) async {
  final token = await _storage.read(key: 'auth_token');
  if (token != null) {
    final result = await _apiService.toggleFavorite(productId, token);
    await loadFavorites(); // Refresh favorites
  }
}
```

### OrdersProvider Updates
```dart
// Place order
Future<void> placeOrder(Map<String, dynamic> orderData) async {
  final token = await _storage.read(key: 'auth_token');
  if (token != null) {
    await _apiService.placeOrder(orderData, token);
    await loadOrders(); // Refresh order history
  }
}
```

## Testing the Integration

### 1. Test Authentication
```bash
# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password"}'
```

### 2. Test Cart Sync
```bash
# Add to cart (use token from login)
curl -X POST http://localhost:8000/api/cart \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{"product_id":1,"quantity":2}'

# Get cart
curl -X GET http://localhost:8000/api/cart \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### 3. Test Favorites
```bash
# Toggle favorite
curl -X POST http://localhost:8000/api/favorites/toggle \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{"product_id":1}'
```

### 4. Test Orders
```bash
# Get orders
curl -X GET http://localhost:8000/api/orders \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## Common Issues & Solutions

### Issue: CORS errors
**Solution**: Ensure CORS is configured in `config/cors.php`

### Issue: 401 Unauthorized
**Solution**: Check that token is being sent in Authorization header

### Issue: Images not loading
**Solution**: Verify storage link exists: `php artisan storage:link`

### Issue: Cart not syncing
**Solution**: Ensure user is authenticated and token is valid

## Security Best Practices

1. **Always use HTTPS in production**
2. **Store tokens securely** (flutter_secure_storage)
3. **Implement token expiration** and refresh logic
4. **Validate all inputs** on the backend
5. **Use rate limiting** to prevent abuse
6. **Sanitize user data** before storage

## Next Steps

1. ✅ API endpoints created
2. ✅ Flutter ApiService updated
3. ⏳ Update Flutter Providers to use API
4. ⏳ Test complete sync flow
5. ⏳ Deploy to production
