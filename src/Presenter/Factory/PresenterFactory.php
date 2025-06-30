<?php

namespace App\Presenter\Factory;

use App\Presenter\Contracts\PresenterInterface;
use InvalidArgumentException;

readonly class PresenterFactory implements PresenterFactoryInterface
{
    /**
     * @param iterable<PresenterInterface> $presenters
     */
    public function __construct(private iterable $presenters) {}

    public function getPresenter(string $entity): PresenterInterface
    {
        foreach ($this->presenters as $presenter) {
            if (method_exists($presenter, 'supports') && $presenter->supports($entity)) {
                return $presenter;
            }
        }

        throw new InvalidArgumentException(sprintf('Aucun Presenter trouvé pour l’entité "%s".', $entity));
    }
}
