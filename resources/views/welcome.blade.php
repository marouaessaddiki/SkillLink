<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillLink</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-2xl p-10 text-center max-w-lg w-full">

        <h1 class="text-4xl font-bold text-indigo-600 mb-4">
            SkillLink
        </h1>

        <p class="text-gray-600 mb-8">
            Plateforme d'échange de compétences entre clients et freelances.
        </p>

        <div class="flex justify-center gap-4">

            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-6 py-3 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50">
                Register
            </a>

        </div>

    </div>

</body>
</html>