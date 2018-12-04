<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 15:04
 */

namespace KeyboardInputCorrection;

/**
 * Class Transliterator
 * Based on https://ru.wikipedia.org/wiki/ISO_9
 * @package KeyboardInputCorrection
 */
abstract class Transliterator extends InputCorrection {

    const TRANSLITERATE_FORWARD = 0;// to en
    const TRANSLITERATE_REVERSE = 1;// from en
    const STANDARD_ISO_9_1995_SYSTEM_B = 0;

    /**
     * Transliteration
     * @param string $input
     * @param int $direction
     * @param int $targetLanguage
     * @param int $standard
     * @param string $encode
     * @return string
     * @throws \InvalidArgumentException
     */
    abstract public function translit(string $input, int $direction = self::TRANSLITERATE_FORWARD, int $targetLanguage = self::LANGUAGE_RU, int $standard = self::STANDARD_ISO_9_1995_SYSTEM_B, string $encode = self::DEFAULT_ENCODE): string;
}