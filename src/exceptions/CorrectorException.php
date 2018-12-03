<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 03.12.2018
 * Time: 15:00
 */

namespace KeyboardInputCorrection\exceptions;

use Throwable;

class CorrectorException extends \Exception {

    public function __construct(string $message = '', int $code = 0, Throwable $previous = null) {

        parent::__construct($message, $code, $previous);
    }
}