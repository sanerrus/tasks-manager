<?php
/**
 * Исключение выбрасываемое при не корректном аргументе
 * PHP version 7.4.1.
 *
 * @category Application
 *
 * @author  sanerrus <username@example.com>
 * @license MIT http://www.example.com/License.tx
 *
 * @see http://www.example.com/Document.tx
 */
declare(strict_types=1);

namespace App\Exceptions;

class InvalidArgumentException extends AppException
{
    /**
     * InvalidArgumentException constructor.
     *
     * @param string $message - сообщение о проблеме
     * @param int    $code    - код ошибки
     */
    public function __construct(string $message, int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
