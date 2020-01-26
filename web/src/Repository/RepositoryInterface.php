<?php

/**
 * Интерфейс недостающих методов в репозитории
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.tx
 *
 * @see http://www.example.com/Document.tx
 */

namespace App\Repository;

use App\Entity\EntityInterface;

interface RepositoryInterface
{
    /**
     * Возвращать массив с ключами по указанному полю.
     *
     * @param string $key - поле которое будет ключем возвращаемого массива
     *
     * @return array <int|string, EntityInterface>
     */
    public function getAllWithSpecifiedKey(string $key = 'id'): array;
}
