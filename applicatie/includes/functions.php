<?php
function addToBasket(string $productName, int $amount): void
{
    if ($amount <= 0) {
        return;
    }

    if (isset($_SESSION['basket'][$productName])) {
        $_SESSION['basket'][$productName]['amount'] += $amount;
    } else {
        $_SESSION['basket'][$productName] = [
            'amount' => $amount
        ];
    }
}

function updateBasket(string $productName, int $amount): void
{
    if ($amount <= 0) {
        removeFromBasket($productName);
        return;
    }

    $_SESSION['basket'][$productName]['amount'] = $amount;
}

function removeFromBasket(string $productName): void
{
    unset($_SESSION['basket'][$productName]);
}

function clearBasket(): void
{
    $_SESSION['basket'] = [];
}

function isLoggedIn(): bool
{
    return $_SESSION['user'] !== null;
}

function isPersonnel(): bool
{
    return isLoggedIn() && $_SESSION['user']['role'] === 'personnel';
}

function logout(): void
{
    $_SESSION['user'] = null;
}