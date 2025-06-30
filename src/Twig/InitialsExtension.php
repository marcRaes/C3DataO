<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class InitialsExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('initials', [$this, 'getInitials']),
        ];
    }

    public function getInitials(string $fullName): string
    {
        $fullName = trim($fullName);
        $fullName = trim($fullName);

        // Cas spéciaux : noms entièrement en tirets, ex: "R2-D2", "C-3PO"
        if (!str_contains($fullName, ' ') && str_contains($fullName, '-')) {
            $segments = explode('-', $fullName);
            $initials = implode('', array_map(
                fn(string $seg) => mb_substr(trim($seg), 0, 1),
                $segments
            ));
            return mb_strtoupper($initials);
        }

        // Cas composés type "Obi-Wan Kenobi"
        $words = preg_split('/\s+/', $fullName);
        if (count($words) >= 2) {
            $firstWord = $words[0];
            $lastWord = end($words);

            // Si le prénom est composé ("Obi-Wan"), on le considère comme un bloc → O
            $firstInitial = mb_substr($firstWord, 0, 1);
            $lastInitial = mb_substr($lastWord, 0, 1);

            return mb_strtoupper($firstInitial . $lastInitial);
        }

        // Cas simple : un seul mot, on prend les 2 premières lettres
        return mb_strtoupper(mb_substr($fullName, 0, 2));
    }
}
