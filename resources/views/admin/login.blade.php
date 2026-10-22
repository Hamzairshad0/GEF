<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Sign in · GEF Admin</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500..700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="grid min-h-screen lg:grid-cols-2">
    <div class="relative hidden overflow-hidden bg-ink-950 lg:block">
        <img src="/uploads/2024/02/orphan-neddy.jpg" alt="" class="absolute inset-0 size-full object-cover opacity-70">
        <div class="absolute inset-0 bg-gradient-to-t from-brand-900/90 to-transparent"></div>
        <p class="absolute bottom-12 left-12 max-w-md font-display text-4xl leading-tight font-semibold text-white">“{{ config('ghazali.vision') }}”</p>
    </div>
    <div class="flex items-center justify-center p-6">
        <form method="POST" action="{{ route('admin.login') }}" class="w-full max-w-sm">
            @csrf
            <img src="/images/logo.png" alt="{{ config('ghazali.name') }}" class="h-14 w-auto">
            <h1 class="mt-10 font-display text-3xl font-semibold">Admin sign in</h1>
            <p class="mt-2 text-sm text-ink-500">Manage content, donations and messages.</p>
            <div class="mt-8 grid gap-4">
                <label><span class="field-label">Email</span><input type="email" name="email" value="{{ old('email') }}" required autofocus class="field" autocomplete="username"></label>
                <label><span class="field-label">Password</span><input type="password" name="password" required class="field" autocomplete="current-password"></label>
                <label class="flex items-center gap-2 text-sm text-ink-600"><input type="checkbox" name="remember" class="size-4 rounded accent-brand-600"> Remember me</label>
                @include('partials.form-errors')
                <button class="btn-primary py-3.5">Sign in</button>
            </div>
            <a href="{{ route('home') }}" class="mt-8 inline-flex items-center gap-2 text-sm text-ink-500 hover:text-brand-600"><x-icon name="arrow-left" class="size-4" /> Back to website</a>
        </form>
    </div>
</body>
</html>
