<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Mobile App</title>
    <style>
        /* CSS Variables and Base Styles */
        :root {
            --primary: #1a73e8;
            --primary-light: #e8f0fe;
            --primary-dark: #1967d2;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            --white: #ffffff;
            --dark: #202124;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.05);
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --transition: all 0.2s ease;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }
        
        html, body {
            height: 100%;
            background-color: var(--gray-100);
            color: var(--gray-900);
            line-height: 1.5;
        }
        
        /* App Container */
        .app-container {
            max-width: 480px;
            margin: 0 auto;
            background-color: var(--white);
            height: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        
        /* App Header */
        .app-header {
            background-color: var(--white);
            color: var(--dark);
            padding: 0.5rem 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--gray-200);
        }
        
        .app-header h1 {
            font-size: 1.125rem;
            font-weight: 600;
        }
        
        .icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .icon-btn:hover {
            background-color: var(--gray-200);
        }
        
        /* Content Area */
        .app-content {
            padding: 1.5rem 1rem;
            margin-bottom: 80px;
            overflow-y: auto;
            height: calc(100% - 145px);
        }
        
        /* Search Component */
        .search-container {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .search-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: none;
            border-radius: var(--radius-md);
            background-color: var(--gray-200);
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .search-input:focus {
            outline: none;
            background-color: var(--white);
            box-shadow: 0 0 0 2px var(--primary-light), 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            pointer-events: none;
        }
        
        /* Card Components */
        .card {
            background-color: var(--white);
            border-radius: var(--radius-lg);
            margin-bottom: 1.25rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid var(--gray-200);
        }
        
        .card:active {
            transform: scale(0.98);
        }
        
        .card-header {
            position: relative;
            height: 140px;
            background-color: var(--primary-light);
            display: flex;
            align-items: flex-end;
            padding: 1.25rem;
        }
        
        .card-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .card-subtitle {
            font-size: 0.875rem;
            color: var(--gray-600);
            margin-bottom: 1rem;
        }
        
        .card-content {
            font-size: 1rem;
            color: var(--gray-700);
            margin-bottom: 1.25rem;
            line-height: 1.6;
        }
        
        .card-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: var(--shadow-md);
            border: 3px solid var(--white);
            margin-right: 1rem;
        }
        
        /* Stats */
        .card-stats {
            display: flex;
            align-items: center;
            color: var(--gray-600);
            font-size: 0.875rem;
        }
        
        .stat {
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }
        
        .stat-icon {
            margin-right: 0.25rem;
        }
        
        /* Buttons */
        .btn {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        .btn:active {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
        }
        
        .btn-icon {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-outline:hover {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            box-shadow: none;
        }
        
        /* Tags */
        .tags {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        
        .tag {
            background-color: var(--primary-light);
            color: var(--primary);
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        /* Bottom Navigation */
        .nav-bar {
            position: fixed;
            bottom: 0;
            width: 100%;
            max-width: 480px;
            background-color: var(--white);
            z-index: 100;
            box-shadow: 0 -4px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .nav-items-container {
            display: flex;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
        }
        
        .nav-page {
            display: flex;
            justify-content: space-around;
            min-width: 100%;
            flex-shrink: 0;
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.75rem 0.5rem;
            position: relative;
            color: var(--gray-600);
            transition: var(--transition);
            cursor: pointer;
            border-radius: var(--radius-md);
            width: 20%;
        }
        
        .nav-item:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }
        
        .nav-item.active {
            color: var(--primary);
        }
        
        .nav-icon {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }
        
        .nav-label {
            font-size: 0.7rem;
            font-weight: 500;
        }
        
        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            cursor: pointer;
            transition: var(--transition);
            z-index: 99;
            font-size: 1.5rem;
        }
        
        .fab:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        /* Ripple animation */
        @keyframes ripple {
            to {
                transform: scale(100);
                opacity: 0;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --primary: #8ab4f8;
                --primary-light: #1a2e42;
                --primary-dark: #aecbfa;
                --dark: #e8eaed;
                --white: #202124;
                --gray-100: #1a1a1a;
                --gray-200: #2a2a2a;
                --gray-300: #3a3a3a;
                --gray-400: #4a4a4a;
                --gray-600: #8a8a8a;
                --gray-700: #aaaaaa;
                --gray-800: #c8c8c8;
                --gray-900: #e8e8e8;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <div class="icon-btn">≡</div>
            <h1>Explore</h1>
            <div class="icon-btn">🔔</div>
        </header>
        
        <main class="app-content">
            <div class="search-container">
                <div class="search-icon">🔍</div>
                <input type="text" class="search-input" placeholder="Search...">
            </div>
            
            <div class="card">
                <div class="card-header">
                    <img src="/api/placeholder/480/140" alt="Cover image" class="card-image">
                </div>
                <div class="card-body">
                    <div class="card-title">Featured Collection</div>
                    <div class="card-subtitle">Updated 2 hours ago</div>
                    
                    <div class="tags">
                        <div class="tag">Trending</div>
                        <div class="tag">Design</div>
                        <div class="tag">Popular</div>
                    </div>
                    
                    <div class="card-content">
                        Discover our curated selection of premium content made especially for you. Explore the newest trends and top picks.
                    </div>
                    
                    <button class="btn">
                        <span class="btn-icon">👁️</span>
                        Explore Now
                    </button>
                </div>
                <div class="card-footer">
                    <div class="card-stats">
                        <div class="stat">
                            <span class="stat-icon">👁️</span>
                            <span>4.2k</span>
                        </div>
                        <div class="stat">
                            <span class="stat-icon">💬</span>
                            <span>142</span>
                        </div>
                    </div>
                    <button class="btn btn-outline">Share</button>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Premium Access</div>
                    <div class="card-subtitle">Unlock all features</div>
                    
                    <div class="card-content">
                        Get unlimited access to all premium content, advanced features, and exclusive benefits.
                    </div>
                    
                    <button class="btn">
                        <span class="btn-icon">⭐</span>
                        Upgrade Now
                    </button>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <div class="avatar">JD</div>
                        <div>
                            <div class="card-title" style="margin-bottom: 0.25rem;">John Doe</div>
                            <div class="card-subtitle" style="margin-bottom: 0;">Product Designer</div>
                        </div>
                    </div>
                    
                    <div class="card-content">
                        "This app has completely transformed how I work. The intuitive design and powerful features make it a must-have tool for professionals."
                    </div>
                    
                    <div class="tags">
                        <div class="tag">Testimonial</div>
                        <div class="tag">Featured</div>
                    </div>
                </div>
            </div>
        </main>
        
        <div class="fab">+</div>

        <nav class="nav-bar">
            <div class="nav-items-container">
                <div class="nav-page">
                    <div class="nav-item active">
                        <div class="nav-icon">🏠</div>
                        <div class="nav-label">Home</div>
                    </div>
                    <div class="nav-item">
                        <div class="nav-icon">🔍</div>
                        <div class="nav-label">Discover</div>
                    </div>
                    <div class="nav-item">
                        <div class="nav-icon">📊</div>
                        <div class="nav-label">Activity</div>
                    </div>
                    <div class="nav-item">
                        <div class="nav-icon">💬</div>
                        <div class="nav-label">Messages</div>
                    </div>
                    <div class="nav-item">
                        <div class="nav-icon">👤</div>
                        <div class="nav-label">Profile</div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</body>
</html>