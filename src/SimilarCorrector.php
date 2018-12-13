<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 19:26
 */

namespace KeyboardInputCorrection;

use KeyboardInputCorrection\dictionaries\SimilarDictionary;

/**
 * Correct similar chars between languages
 * Class SimilarCorrector
 * @package KeyboardInputCorrection
 */
class SimilarCorrector extends InputCorrection {

    /**
     * Transliteration
     * @param string $input
     * @param int $targetLanguage
     * @param string $encode
     * @return string
     * @throws \InvalidArgumentException
     */
    public function correct(string $input, int $targetLanguage = self::LANGUAGE_RU, string $encode = self::DEFAULT_ENCODE): string {

        if( $encode !== self::DEFAULT_ENCODE && !$this->isEncodeSupported($encode) ) {

            throw new \InvalidArgumentException($encode . ' unknown');
        }

        $input = $this->prepare($input, $encode);

        $table = $this->getSimilarTable($targetLanguage);

        foreach( $table as $key => $value ) {

            $modified = mb_ereg_replace($key, $value, $input);

            if( $modified !== false ) {

                $input = (string)$modified;
            }
        }

        return $this->finish($input, $encode);
    }

    protected function getSimilarTable(int $language): array {

        switch($language) {

            case self::LANGUAGE_RU:
                return SimilarDictionary::for_ru();

            case self::LANGUAGE_EN:
                return SimilarDictionary::for_en();
        }

        return [];
    }
}