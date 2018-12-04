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
use KeyboardInputCorrection\transliterators\ExcludeBigToLowTransliterator;

/**
 * Class KeyboardInputCorrect
 * @package KeyboardInputCorrection
 * @link     https://github.com/TrueGameover/php-keyboard-input-correction
 * @license  Mit
 */
class KeyboardInputCorrect {

    const WRONG_LAYOUT = 0;// wrong keyboard layout algorithm
    const TRANSLITERATOR_BIG_TO_LOW_EXCLUDE = 0;
    private $corrector;
    private $transliterator;

    public function __construct(int $correctorAlgorithm = self::WRONG_LAYOUT, int $transliteratorAlhorithm = self::TRANSLITERATOR_BIG_TO_LOW_EXCLUDE) {

        switch($correctorAlgorithm) {

            case self::WRONG_LAYOUT:
                $this->corrector = new WrongLayoutCorrector();
                break;
        }

        switch($transliteratorAlhorithm) {

            case self::TRANSLITERATOR_BIG_TO_LOW_EXCLUDE:
                $this->transliterator = new ExcludeBigToLowTransliterator();
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

    public function transliterateForward(string $input, int $targetLanguage = InputCorrection::LANGUAGE_RU): string {

        try {

            return $this->transliterator->translit($input, Transliterator::TRANSLITERATE_FORWARD, $targetLanguage);

        } catch(\InvalidArgumentException $e) {

        }

        return $input;
    }

    public function transliterateReverse(string $input, int $targetLanguage = InputCorrection::LANGUAGE_RU): string {

        try {

            return $this->transliterator->translit($input, Transliterator::TRANSLITERATE_REVERSE, $targetLanguage);

        } catch(\InvalidArgumentException $e) {

        }

        return $input;
    }
}