# 🚀 Quick Start Guide - WildTrace Real-Time Sync

## ⚡ Get Started in 5 Minutes!

### Step 1: Start Laravel Server (30 seconds)

Open terminal in WildTrace folder:

```bash
cd c:\Users\ASUS\Desktop\WildTrace
php artisan serve
```

✅ You should see: `Laravel development server started: http://127.0.0.1:8000`

---

### Step 2: Test the Website (1 minute)

1. Open browser: `http://localhost:8000`
2. Click "Register" or "Login"
3. Browse products
4. Add some products to cart
5. Add some products to favorites

---

### Step 3: Run Flutter App (2 minutes)

Open NEW terminal in wild_trace folder:

```bash
cd c:\Users\ASUS\Desktop\WildTrace\wild_trace
flutter run
```

Wait for app to build and launch...

---

### Step 4: Test the Sync! (1 minute)

In the Flutter app:

1. **Login with SAME credentials** you used on website
2. Go to Cart screen
   - ✨ **Magic!** Same items from website appear!
3. Go to Favorites screen
   - ✨ **Magic!** Same favorites from website appear!
4. Add a NEW product to cart in the app
5. Go back to website and refresh
   - ✨ **Magic!** New item appears on website!

---

## 🎯 That's It!

Your app is now fully synced! Everything you do on mobile appears on web and vice versa!

---

## 🔧 Troubleshooting

### Problem: "Cannot connect to server"

**Solution:**
```bash
# Make sure Laravel is running
php artisan serve
```

### Problem: "No products showing"

**Solution:**
```bash
# Seed the database with products
php artisan db:seed
```

### Problem: "Login not working"

**Solution:**
```bash
# Create a test user
php artisan tinker
>>> \App\Models\User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password')
]);
```

---

## 📱 Testing on Physical Device

### Find Your Computer's IP:

```bash
ipconfig
# Look for IPv4 Address, e.g., 192.168.1.100
```

### Update Flutter App:

Edit `wild_trace/lib/services/api_service.dart`:

```dart
// Change this line:
static const String baseUrl = 'http://10.0.2.2:8000/api';

// To this (use YOUR IP):
static const String baseUrl = 'http://192.168.1.100:8000/api';
```

### Start Laravel on Network:

```bash
php artisan serve --host=0.0.0.0
```

Now you can test on your phone!

---

## ✅ Quick Test Checklist

- [ ] Laravel server running
- [ ] Website accessible at localhost:8000
- [ ] Can login on website
- [ ] Can add to cart on website
- [ ] Flutter app running
- [ ] Can login on app (same credentials)
- [ ] Cart shows same items
- [ ] Favorites show same items
- [ ] Adding on app shows on website
- [ ] Adding on website shows on app

---

## 🎉 Success!

If all checkboxes are ✅, your real-time sync is working perfectly!

---

## 📚 More Information

- **Full API Documentation**: See `API_INTEGRATION.md`
- **Architecture Details**: See `ARCHITECTURE.md`
- **Complete Guide**: See `README_SYNC.md`
- **Technical Summary**: See `SYNC_IMPLEMENTATION_SUMMARY.md`

---

## 💡 Pro Tips

1. **Keep Laravel running** - Don't close the terminal
2. **Use same credentials** - Login with same email/password on both platforms
3. **Refresh to see changes** - Pull to refresh in app, F5 in browser
4. **Check console** - Look for errors in terminal and Flutter console

---

## 🆘 Need Help?

1. Check Laravel is running: `http://localhost:8000`
2. Check API is working: `http://localhost:8000/api/products`
3. Check Flutter console for errors
4. Check Laravel logs in `storage/logs/laravel.log`

---

**Happy Testing! 🚀**
