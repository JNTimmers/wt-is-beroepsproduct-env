<?php

function getStatuses(): array
{
    return [
        1 => 'Nieuw',
        2 => 'In behandeling',
        3 => 'Onderweg',
        4 => 'Voltooid',
        5 => 'Geannuleerd'
    ];
}

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
    return isLoggedIn() && $_SESSION['user']['role'] === 'Personnel';
}

function logout(): void
{
    $_SESSION['user'] = null;
}