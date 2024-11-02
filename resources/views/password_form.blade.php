<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Введите пароль</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-[100vh]">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">Введите пароль</h2>
        <p class="text-xl">Сайт находится в разработке. Для доступа введите пароль</p>
        <form method="POST" action="{{ route('password.check') }}" class="space-y-4">
            @csrf
            <div>
                <label for="password" class="sr-only">Пароль</label>
                <input type="password" name="password" id="password" 
                       class="tw-input"
                       placeholder="Пароль" required>
            </div>

            @error('password')
                <div class="text-red-500 text-sm text-center">{{ $message }}</div>
            @enderror

            <div class="text-center">
                <button type="submit" 
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                    Подтвердить
                </button>
            </div>
        </form>
    </div>
</body>
</html>
