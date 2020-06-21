<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../../../public/css/main.css"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title><?= $title ?></title>
</head>
<body>
<header class="py-2 header">
    <div class="container">
        <div class="container mx-auto d-flex align-items-center justify-content-between py-4">
            <a href="/" class="d-flex align-items-center">
                <img
                    src="/images/logo.svg"
                    alt="Blog"
                    width="50"
                >
                <h3 style="margin-left: 10px; color: black">MY BLOG</h3>
            </a>
            <?php if ($_SERVER['REQUEST_URI'] !== '/register' && $_SERVER['REQUEST_URI'] !== '/login'): ?>
                <div class="links">
                    <a href="/"
                       class="py-3 px-3 <?php if ($_SERVER['REQUEST_URI'] == '/') echo 'active'; ?>">
                        Home
                    </a>
                    <a href="/post/create"
                       class="py-3 px-3 <?php if ($_SERVER['REQUEST_URI'] == '/post/create') echo 'active'; ?>">
                        Create Post
                    </a>
                    <a href="/logout" class="py-3 px-3">
                        Logout
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="container">
    <?= $content ?>
</div>
<footer class="footer d-flex justify-content-center">
    Made with <a href="https://www.facebook.com/vadbondarenko" class="px-1"> &#10084; </a> by Vadim Bondarenko
</footer>
<script src="/js/jquery.min.js"></script>
<script src="/js/main.js"></script>
<script src="/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>