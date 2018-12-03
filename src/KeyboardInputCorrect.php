<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 03.12.2018
 * Time: 14:43
 */

namespace KeyboardInputCorrection;

use KeyboardInputCorrection\correctors\WrongLayoutCorrector;
use KeyboardInputCorrection\exceptions\CorrectorException;

/**
 * Class KeyboardInputCorrect
 * @package KeyboardInputCorrection
 * @link     https://github.com/TrueGameover/php-keyboard-input-correction
 * @license  Mit
 */
class KeyboardInputCorrect {

    const WRONG_LAYOUT = 0;// wrong keyboard layout algorithm
    private $corrector;

    public function __construct(int $algorithm = self::WRONG_LAYOUT) {

        switch($algorithm) {

            case self::WRONG_LAYOUT:
                $this->corrector = new WrongLayoutCorrector();
                break;
        }
    }

    /**
     * @param string $input
     * @return string
     */
    public function correct(string $input): string {

        try {

            return $this->corrector->correct($input);

        } catch(\InvalidArgumentException $e) {

        } catch(CorrectorException $e) {

        }

        return $input;
    }
}