<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 15:43
 */

namespace KeyboardInputCorrection\transliterators;

use KeyboardInputCorrection\dictionaries\Dictionary;
use KeyboardInputCorrection\dictionaries\TransliterationDictionary;
use KeyboardInputCorrection\Transliterator;

class ExcludeBigToLowTransliterator extends Transliterator {

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
    public function translit(string $input, int $direction = self::TRANSLITERATE_FORWARD, int $targetLanguage = self::LANGUAGE_RU, int $standard = self::STANDARD_ISO_9_1995_SYSTEM_B, string $encode = self::DEFAULT_ENCODE): string {

        if( $encode !== self::DEFAULT_ENCODE && !$this->isEncodeSupported($encode) ) {

            throw new \InvalidArgumentException($encode . ' unknown');
        }

        $result = $this->prepare($input, $encode);
        $table = $this->getTranslitTable($targetLanguage, $direction, $standard);

        foreach( $table as $key => $value ) {

            $modified = mb_eregi_replace($key, $value, $result);

            if( $modified !== false ) {

                $result = $modified;
            }
        }

        return $this->finish($result, $encode);
    }

    protected function getTranslitTable(int $language, int $direction, int $standard) {

        switch($language) {

            case self::LANGUAGE_RU:
                switch($direction) {

                    case self::TRANSLITERATE_FORWARD:
                        switch($standard) {
                            case self::STANDARD_ISO_9_1995_SYSTEM_B:
                                return TransliterationDictionary::transliteration_ru_en_iso_9_1995_system_b();
                        }
                        break;

                    case self::TRANSLITERATE_REVERSE:
                        switch($standard) {
                            case self::STANDARD_ISO_9_1995_SYSTEM_B:
                                return TransliterationDictionary::transliteration_en_ru_iso_9_1995_system_b();
                        }
                        break;
                }
                break;
        }

        return [];
    }
}