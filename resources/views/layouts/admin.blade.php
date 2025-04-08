<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add your CSS or JS links here -->
</head>
<body>
    <header>
        <!-- Admin Header Content -->
        <nav>
            <!-- Admin navigation links -->
        </nav>
    </header>

    <main>
        <!-- Main Content -->
        {{ $slot }}  <!-- The dynamic content passed from child views -->
    </main>

    <footer>
        <!-- Admin Footer Content -->
    </footer>
</body>
</html>
