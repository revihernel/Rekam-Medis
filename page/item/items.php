<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Responsive Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    </body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #4a4a4a;
            --secondary-color: #007bff;
            --background-color: #f4f7f6;
            --text-color: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            line-height: 1.6;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-weight: 700;
            text-decoration: none;
            color: var(--text-color);
            font-size: 1.5rem;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 10px;
        }

        .navbar-menu>li {
            position: relative;
            margin-right: 25px;
        }

        .navbar-menu>li>a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 400;
            font-size: 1rem;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 10px 0;
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            color: var(--primary-color);
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        .navbar-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .navbar-toggle .bar {
            width: 25px;
            height: 3px;
            background-color: var(--text-color);
            margin: 3px 0;
            transition: 0.4s;
        }
    </style>
</head>

<body>
    <script>
        function toggleMenu() {
            const menu = document.querySelector('.navbar-menu');
            const dropdowns = document.querySelectorAll('.dropdown');

            menu.classList.toggle('active');

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function(e) {
                    if (e.target.classList.contains('dropdown-toggle')) {
                        this.classList.toggle('active');
                    }
                });
            });
        }
    </script>