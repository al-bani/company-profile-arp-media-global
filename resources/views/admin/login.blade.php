<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="stylesheet" href="/css/login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <div class="container">
    <div class="login-box">
      <!-- Logo Kanan / Atas Saat Mobile -->
      <div class="login-right">
        <img src="/images/logo.png" alt="ARP Logo" class="login-logo" />
      </div>

      <!-- Form Kiri / Bawah Saat Mobile -->
      <div class="login-left">
        <form class="login-form">
          <h2>ARP GLOBAL MEDIA</h2>
          <p class="subtitle">Login to your account</p>

          <div class="input-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-envelope icon"></i>
              <input type="email" id="email" name="email" placeholder="ARP@example.com" required />
            </div>
          </div>

          <div class="input-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
              <i class="fa-solid fa-lock icon"></i>
              <input type="password" id="password" name="password" placeholder="••••••••" required />
            </div>
          </div>

          <button type="submit" class="login-button">Sign In</button>

          <div class="links">
            <a href="#" class="forgot">Forgot password?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
