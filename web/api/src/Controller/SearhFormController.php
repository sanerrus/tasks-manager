<?php

namespace App\Controller;

use App\Services\ServiceInterface;

/**
 * Class SearhFormController.
 */
class SearhFormController extends AbstractController
{
    /**
     * Сервис работы с комментариями к задаче.
     *
     * @var ServiceInterface
     *
     * @Inject service
     */
    protected ServiceInterface $service;

    public function getSearchForm(): iterable
    {
        return $this->service->getResponseSearchForm()->toIterable();
    }
}
