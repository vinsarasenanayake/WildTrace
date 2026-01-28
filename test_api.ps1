# WildTrace API Test Script
# This script tests all API endpoints to ensure they work correctly

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "WildTrace API Integration Test" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$baseUrl = "http://localhost:8000/api"
$token = ""

# Test 1: Get Products (Public)
Write-Host "Test 1: Fetching Products..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/products" -Method Get
    Write-Host "✓ Products fetched successfully" -ForegroundColor Green
    Write-Host "  Found $($response.Count) products" -ForegroundColor Gray
} catch {
    Write-Host "✗ Failed to fetch products: $_" -ForegroundColor Red
}
Write-Host ""

# Test 2: Login
Write-Host "Test 2: Testing Login..." -ForegroundColor Yellow
$loginData = @{
    email = "test@example.com"
    password = "password"
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/login" -Method Post -Body $loginData -ContentType "application/json"
    $token = $response.token
    Write-Host "✓ Login successful" -ForegroundColor Green
    Write-Host "  User: $($response.user.name)" -ForegroundColor Gray
    Write-Host "  Token: $($token.Substring(0, 20))..." -ForegroundColor Gray
} catch {
    Write-Host "✗ Login failed: $_" -ForegroundColor Red
    Write-Host "  Note: Make sure you have a test user with email 'test@example.com' and password 'password'" -ForegroundColor Yellow
}
Write-Host ""

if ($token) {
    $headers = @{
        "Authorization" = "Bearer $token"
        "Accept" = "application/json"
        "Content-Type" = "application/json"
    }

    # Test 3: Get User Profile
    Write-Host "Test 3: Fetching User Profile..." -ForegroundColor Yellow
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/user" -Method Get -Headers $headers
        Write-Host "✓ Profile fetched successfully" -ForegroundColor Green
        Write-Host "  Name: $($response.name)" -ForegroundColor Gray
        Write-Host "  Email: $($response.email)" -ForegroundColor Gray
    } catch {
        Write-Host "✗ Failed to fetch profile: $_" -ForegroundColor Red
    }
    Write-Host ""

    # Test 4: Get Cart
    Write-Host "Test 4: Fetching Cart..." -ForegroundColor Yellow
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/cart" -Method Get -Headers $headers
        Write-Host "✓ Cart fetched successfully" -ForegroundColor Green
        if ($response.Count -gt 0) {
            Write-Host "  Cart has $($response.Count) items" -ForegroundColor Gray
        } else {
            Write-Host "  Cart is empty" -ForegroundColor Gray
        }
    } catch {
        Write-Host "✗ Failed to fetch cart: $_" -ForegroundColor Red
    }
    Write-Host ""

    # Test 5: Add to Cart
    Write-Host "Test 5: Adding Product to Cart..." -ForegroundColor Yellow
    $cartData = @{
        product_id = 1
        quantity = 2
    } | ConvertTo-Json

    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/cart" -Method Post -Body $cartData -Headers $headers
        Write-Host "✓ Product added to cart successfully" -ForegroundColor Green
    } catch {
        Write-Host "✗ Failed to add to cart: $_" -ForegroundColor Red
    }
    Write-Host ""

    # Test 6: Get Favorites
    Write-Host "Test 6: Fetching Favorites..." -ForegroundColor Yellow
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/favorites" -Method Get -Headers $headers
        Write-Host "✓ Favorites fetched successfully" -ForegroundColor Green
        if ($response.Count -gt 0) {
            Write-Host "  Found $($response.Count) favorites" -ForegroundColor Gray
        } else {
            Write-Host "  No favorites yet" -ForegroundColor Gray
        }
    } catch {
        Write-Host "✗ Failed to fetch favorites: $_" -ForegroundColor Red
    }
    Write-Host ""

    # Test 7: Toggle Favorite
    Write-Host "Test 7: Toggling Favorite..." -ForegroundColor Yellow
    $favData = @{
        product_id = 1
    } | ConvertTo-Json

    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/favorites/toggle" -Method Post -Body $favData -Headers $headers
        Write-Host "✓ Favorite toggled successfully" -ForegroundColor Green
        Write-Host "  Status: $($response.message)" -ForegroundColor Gray
    } catch {
        Write-Host "✗ Failed to toggle favorite: $_" -ForegroundColor Red
    }
    Write-Host ""

    # Test 8: Get Orders
    Write-Host "Test 8: Fetching Orders..." -ForegroundColor Yellow
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/orders" -Method Get -Headers $headers
        Write-Host "✓ Orders fetched successfully" -ForegroundColor Green
        if ($response.Count -gt 0) {
            Write-Host "  Found $($response.Count) orders" -ForegroundColor Gray
        } else {
            Write-Host "  No orders yet" -ForegroundColor Gray
        }
    } catch {
        Write-Host "✗ Failed to fetch orders: $_" -ForegroundColor Red
    }
    Write-Host ""

    # Test 9: Logout
    Write-Host "Test 9: Testing Logout..." -ForegroundColor Yellow
    try {
        $response = Invoke-RestMethod -Uri "$baseUrl/logout" -Method Post -Headers $headers
        Write-Host "✓ Logout successful" -ForegroundColor Green
    } catch {
        Write-Host "✗ Failed to logout: $_" -ForegroundColor Red
    }
    Write-Host ""
}

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "API Test Complete!" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
