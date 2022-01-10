<?php
    if(!isset($_SESSION['user'])){
        $user = [
            'username' => '',
        ];
    } else {
        if(is_null($_SESSION["user"]) ) {
            $user = [
                'username' => '',
            ];
        } else {
            $user = $_SESSION['user'];
        }
    }

?>

<nav class="navbar navbar-expand-lg sticky-top navbar-light" style="background: #B9CAB9;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="src/img/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <span class="text-black-50" style="letter-spacing: 0.1rem; font-family: 'Josefin Sans', sans-serif; font-weight: 600;">BAGRICULTUR</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Discounts</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="cart.php" type="button" class="btn bg-transparent btn-md">
                        <span class="iconify text-black-50" data-icon="ph:shopping-cart-light" data-width="23" data-height="23"></span></span>
                    </a>
                    <a href="#" type="button" class="btn bg-transparent btn-md">
                        <span class="iconify text-black-50" data-icon="ph:chats-light" data-width="23" data-height="23">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $user['username'] ? $user['username'] : '' ?>
                            <span class="iconify text-black-50" data-icon="ph:user-circle-light" data-width="23" data-height="23"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <?php if(isset($_SESSION['login'])) : ?>
                                <li><a class="dropdown-item" href="./logout.php">Sign Out</a></li>
                            <?php else : ?>
                                <li><a class="dropdown-item" href="./login.php">Sign In</a></li>
                            <?php endif; ?>
                        </ul>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
