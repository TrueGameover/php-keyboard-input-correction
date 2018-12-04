<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 04.12.2018
 * Time: 15:07
 */

namespace KeyboardInputCorrection;

abstract class InputCorrection {

    const DEFAULT_ENCODE = 'utf-8';

    /**
     * Convert $input to utf8
     * @param string $input
     * @param string $sourceEncode
     * @return string source encode
     */
    protected function prepare(string $input, string $sourceEncode = self::DEFAULT_ENCODE): string {

        return mb_convert_encoding($input, 'utf-8', $sourceEncode);
    }

    /**
     * Convert $input to $sourceEncode encode
     * @param string $input
     * @param string $sourceEncode
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function finish(string $input, string $sourceEncode): string {

        if( empty($sourceEncode) ) {

            throw new \InvalidArgumentException('source encode is empty');
        }

        return mb_convert_encoding($input, $sourceEncode, 'utf-8');
    }

    public function isEncodeSupported(string $encode): bool {

        $encodes = array_filter(mb_list_encodings(), function($item) use ($encode) {

            return mb_convert_case($item, MB_CASE_LOWER) === $encode || mb_convert_case($item, MB_CASE_UPPER);
        });

        return \count($encodes) > 0;
    }
}