<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'CarSelect')</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Styles (inline or link to your CSS file) -->
  <style>
    /* ===== Reset & Global Styles ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      /* Removed height: 100% from * */
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      line-height: 1.6;
      background-color: #f8f9fa;
      color: #222;

      display: flex;
      flex-direction: column;
      min-height: 100vh; /* full viewport height */
    }

    main {
      flex: 1; /* takes remaining space to push footer down */
    }

    img {
      max-width: 100%;
      display: block;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: auto;
    }

    /* ===== Header ===== */
    .header {
      background-color: #1a1a1a;
      color: #fff;
      padding: 1rem 0;
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: #ff5722;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 1.5rem;
    }

    .nav-links a {
      color: #fff;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #ff5722;
    }

    /* ===== Hero ===== */
   .hero {
  background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.2)),
              url('https://unsplash.com/photos/red-chevrolet-camaro-on-road-during-daytime-SWt1dHle1eA') center/cover no-repeat;
  color: #fff;
  text-align: center;
  padding: 5rem 1rem;

  /* Add or adjust height */
  height: 90vh;       /* or try 50vh, 70vh depending on your need */
  display: flex;
  flex-direction: column;
  justify-content: center; /* vertically centers text */
         }

  .hero h2 {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 2rem;
    }

    .search-bar {
      display: flex;
      justify-content: center;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .search-bar input {
      padding: 0.75rem 1rem;
      border: none;
      border-radius: 4px;
      width: 250px;
    }

    .search-bar button {
      padding: 0.75rem 1.2rem;
      background: #ff5722;
      border: none;
      border-radius: 4px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .search-bar button:hover {
      background: #e64a19;
    }

    /* ===== Features Section ===== */
    .features {
      padding: 4rem 1rem;
      background: #fff;
      text-align: center;
    }

    .features h3 {
      font-size: 2rem;
      margin-bottom: 2rem;
    }

    .feature-grid {
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .feature-item {
      background: #f1f1f1;
      padding: 2rem;
      border-radius: 8px;
      width: 300px;
      transition: transform 0.3s ease;
    }

    .feature-item:hover {
      transform: translateY(-5px);
    }

    .feature-item h4 {
      margin-bottom: 0.75rem;
      font-weight: 600;
    }

    /* ===== Cars Section ===== */
    .cars {
      padding: 4rem 1rem;
      background: #f4f4f4;
      text-align: center;
    }

    .cars h3 {
      font-size: 2rem;
      margin-bottom: 2rem;
    }

    .car-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
    }

    .car-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
      
      width: 300px;
    }
    
    .car-card img {
     width: 100%;
     height: 180px;
     object-fit: cover;
    }


    .car-card:hover {
      transform: translateY(-5px);
    }

    .car-card h4 {
      margin: 1rem;
    }

    .car-card p {
      color: #666;
      margin-bottom: 1rem;
    }

    /* ===== CTA Section ===== */
    .cta {
      background: #1a1a1a;
      color: #fff;
      text-align: center;
      padding: 3rem 1rem;
    }

    .cta h3 {
      font-size: 2rem;
    }

    .cta-button {
      margin-top: 1rem;
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background: #ff5722;
      color: white;
      border-radius: 4px;
      font-weight: 600;
      transition: background 0.3s ease;
    }

    .cta-button:hover {
      background: #e64a19;
    }
        
       /*pagination for cars*/
    /* .pagination {
     display: flex;
    justify-content: center;
    margin-top: 20px;
    } */


    /* ===== Footer ===== */
    .footer {
      background: #111;
      color: #ccc;
      text-align: center;
      padding: 1rem;
      font-size: 0.9rem;
    }

    .footer a {
      color: #ff5722;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
      .nav-links {
        flex-direction: column;
        gap: 1rem;
        align-items: center;
      }

      .feature-grid, .car-grid {
        flex-direction: column;
        align-items: center;
      }

      .hero h2 {
        font-size: 2rem;
      }

      .hero p {
        font-size: 1rem;
      }

      .search-bar {
        flex-direction: column;
      }
      
    }

               
      /*contact page*/
     .contact-form {
        max-width: 500px;
        margin: 40px auto;
        padding: 30px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
    }

    .contact-form h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .contact-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .contact-form button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    .contact-form button:hover {
        background-color: #0056b3;
    }

    .success-message {
        color: green;
        text-align: center;
        margin-bottom: 20px;
    } 
  </style>
</head>
<body>

  {{-- Include Header Partial --}}
  @include('PartialsHF.header')

  {{-- Main content wrapped in <main> for flexbox layout --}}
  <main>
    @yield('content')
  </main>

  {{-- Include Footer Partial --}}
  @include('PartialsHF.footer')

</body>
</html>
