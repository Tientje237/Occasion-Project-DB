<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
<head>
    <style>
       .container {
           margin-top: 20px;
       }

       .error{
           color: red;
       }

       .success{
           color: green;
       }
    </style>
</head>
<body>

<!-- Page content(Register) -->
<main class="flex-shrink-0">
    <div class="container">
        {block name="contentRegister"}{/block}
    </div>
</main>

<!-- Page content(Login) -->
<main class="flex-shrink-0">
    <div class="container2">
        {block name="contentLogin"}{/block}
    </div>
</main>

<!-- Page content(Search) -->
<main class="flex-shrink-0">
    <div class="container3">
        {block name="contentSearch"}{/block}
    </div>
</main>

<!-- Page content(Show Case) -->
<main class="flex-shrink-0">
    <div class="container3">
        {block name="contentShowCase"}{/block}
    </div>
</main>

<!-- Page content(Favorite) -->
<main class="flex-shrink-0">
    <div class="container3">
        {block name="contentFavorite"}{/block}
    </div>
</main>



</body>
</html>
