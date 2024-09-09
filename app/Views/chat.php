<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with AI Julio</title>
    <style>
        :root {
            --background-color: #f4f4f4;
            --text-color: #333;
            --container-bg-color: #fff;
            --input-bg-color: #fff;
            --input-border-color: #ccc;
            --button-bg-color: #007bff;
            --button-hover-color: #0056b3;
            --toggle-bg-color: #ddd;
            --toggle-hover-color: #bbb;
            --toggle-text-color: #333;
        }

        [data-theme="dark"] {
            --background-color: #333;
            --text-color: #f4f4f4;
            --container-bg-color: #444;
            --input-bg-color: #555;
            --input-border-color: #666;
            --button-bg-color: #28a745;
            --button-hover-color: #218838;
            --toggle-bg-color: #555;
            --toggle-hover-color: #444;
            --toggle-text-color: #f4f4f4;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .container {
            background-color: var(--container-bg-color);
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 400px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        h1 {
            margin-bottom: 20px;
            position: relative;
        }

        form {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            background-color: var(--input-bg-color);
            border: 1px solid var(--input-border-color);
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        input[type="submit"] {
            background-color: var(--button-bg-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--button-hover-color);
        }

        .response-container {
            margin-top: 20px;
            text-align: left;
        }

        .response-container h2 {
            color: var(--text-color);
        }

        .response-container p {
            background-color: var(--input-bg-color);
            padding: 10px;
            border-radius: 4px;
            border: 1px solid var(--input-border-color);
            font-size: 16px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid var(--input-border-color);
            border-radius: 4px;
            font-size: 16px;
            background-color: var(--input-bg-color);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .search-bar input[type="submit"] {
            background-color: var(--button-bg-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .search-bar input[type="submit"]:hover {
            background-color: var(--button-hover-color);
        }

        .theme-toggle-button {
            background-color: var(--toggle-bg-color);
            color: var(--toggle-text-color);
            padding: 8px 16px;
            border: 2px solid var(--input-border-color);
            border-radius: 30px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .theme-toggle-button:hover {
            background-color: var(--toggle-hover-color);
        }

        .theme-toggle-button span {
            margin-left: 10px;
            font-weight: bold;
        }

        .theme-toggle-button i {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chat with AI Julio</h1>

        <button class="theme-toggle-button" onclick="toggleTheme()">
            <i id="theme-icon">🌙</i><span id="theme-text">Dark Mode</span>
        </button>

        <!-- <div class="search-bar">
            <input type="text" placeholder="Search...">
            <input type="submit" value="Search">
        </div> -->
      <!--   <form action="<?= base_url('home/chat') ?>" method="post">
            <textarea name="user_input" rows="4" cols="50" placeholder="Type your message..."></textarea><br>
            <input type="submit" value="Send">
        </form>
 -->
        <div class="response-container">
            <h2>Response:</h2>
            <p><?= htmlspecialchars($responseContent) ?></p>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const body = document.body;
            const themeText = document.getElementById('theme-text');
            const themeIcon = document.getElementById('theme-icon');
            const currentTheme = body.getAttribute('data-theme');

            if (currentTheme === 'dark') {
                body.setAttribute('data-theme', 'light');
                themeText.textContent = 'Dark Mode';
                themeIcon.textContent = '🌙';
            } else {
                body.setAttribute('data-theme', 'dark');
                themeText.textContent = 'Light Mode';
                themeIcon.textContent = '☀️';
            }
        }

        // Set default theme based on user preference or system preference
        const userPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (userPrefersDark) {
            document.body.setAttribute('data-theme', 'dark');
            document.getElementById('theme-text').textContent = 'Light Mode';
            document.getElementById('theme-icon').textContent = '☀️';
        } else {
            document.body.setAttribute('data-theme', 'light');
            document.getElementById('theme-text').textContent = 'Dark Mode';
            document.getElementById('theme-icon').textContent = '🌙';
        }
    </script>
</body>
</html>
