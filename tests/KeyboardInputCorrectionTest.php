<?php
/**
 * Created by IntelliJ IDEA.
 * User: Алексей
 * Date: 03.12.2018
 * Time: 16:48
 */

declare(strict_types=1);

class KeyboardInputCorrectionTest extends \PHPUnit\Framework\TestCase {

    /**
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     */
    public function testSimple() {

        $corrector = new \KeyboardInputCorrection\KeyboardInputCorrect();

        $this->assertEquals('привет', $corrector->correct('ghbdtn'));
        $this->assertEquals('йцукенгшщзхъфывапролджэячсмитьбю.', $corrector->correct('qwertyuiop[]asdfghjkl;\'zxcvbnm,./'));
        $this->assertEquals('Ё!"№;%:?*()_+', $corrector->correct('~!@#$%^&*()_+'));
    }
}