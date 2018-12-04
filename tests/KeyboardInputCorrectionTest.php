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

    public function testValidation() {

        $corrector = new \KeyboardInputCorrection\correctors\WrongLayoutCorrector();

        $this->assertTrue($corrector->validate('привет', \KeyboardInputCorrection\Corrector::LANGUAGE_RU));
    }

    public function testReverseTransliteration() {

        $transliterator = new \KeyboardInputCorrection\transliterators\ExcludeBigToLowTransliterator();

        $this->assertEquals('привет, я с марса', $transliterator->translit('privet, ya s marsa', Transliterator::REVERSE));
        $this->assertEquals('оценивается', $transliterator->translit('ocenivaetsya', Transliterator::REVERSE));
        $this->assertEquals('песков: транзит газа через украину может продолжиться после ввода "северного потока - 2"', $transliterator->translit('Peskov: tranzit gaza cherez Ukrainu mozhet prodolzhit`sya posle vvoda "Severnogo potoka - 2"', Transliterator::REVERSE));
        $this->assertEquals('проект "северный поток - 2" предполагает строительство двух ниток газопровода общей мощностью 55 млрд куб. м газа в год от побережья россии через балтийское море до германии. стоимость строительства оценивается в €9,5 млрд, запуск газопровода ожидается до конца 2019 года.', $transliterator->translit('Proekt "Severny`j potok - 2" predpolagaet stroitel`stvo dvux nitok gazoprovoda obshhej moshhnost`yu 55 mlrd kub. m gaza v god ot poberezh`ya Rossii cherez Baltijskoe more do Germanii. Stoimost` stroitel`stva ocenivaetsya v €9,5 mlrd, zapusk gazoprovoda ozhidaetsya do koncza 2019 goda.', Transliterator::REVERSE));
    }

    public function testTransliteration() {

        $transliterator = new \KeyboardInputCorrection\transliterators\ExcludeBigToLowTransliterator();

        $this->assertEquals('ranee Reuters so ssy`lkoj na istochniki soobshhil, chto czb obsuzhdal s krupnejshimi igrokami, rabotayushhimi na valyutnom ry`nke, sozdanie "kanala kommunikacii" dlya svoevremennogo informirovaniya regulyatora o krupny`x klientskix porucheniyax, kotory`e mogut sushhestvenno povliyat` na kurs rublya.', $transliterator->translit('Ранее Reuters со ссылкой на источники сообщил, что ЦБ обсуждал с крупнейшими игроками, работающими на валютном рынке, создание "канала коммуникации" для своевременного информирования регулятора о крупных клиентских поручениях, которые могут существенно повлиять на курс рубля.'));
        $this->assertEquals('"novaciya v tom, chto poyavilsya opredelenny`j vid sdelok, kotory`e czb xochet otslezhivat`. oni poka nazvany` "krupny`mi sdelkami". my` poluchili informaciyu czb i ponimaem, chto nichego iz togo, chto mozhet navredit` klientam, tam, nadeemsya, ne budet. to est` dazhe esli krupnaya sdelka, kotoraya v silu velichiny` interesuet regulyatora, budet otslezhivat`sya, to e`to ne oznachaet, chto budut prepyatstviya dlya ee provedeniya, - otmetila zlatkis. - poka my` dumaem, chto rech` idet o lyubom ry`nke, no my` ne uvereny` v e`tom".', $transliterator->translit('"Новация в том, что появился определенный вид сделок, которые ЦБ хочет отслеживать. Они пока названы "крупными сделками". Мы получили информацию ЦБ и понимаем, что ничего из того, что может навредить клиентам, там, надеемся, не будет. То есть даже если крупная сделка, которая в силу величины интересует регулятора, будет отслеживаться, то это не означает, что будут препятствия для ее проведения, - отметила Златкис. - Пока мы думаем, что речь идет о любом рынке, но мы не уверены в этом".'));
    }

    public function testRecursiveTransliteration() {

        $transliterator = new \KeyboardInputCorrection\transliterators\ExcludeBigToLowTransliterator();

        $this->assertEquals('привет, я с марса', $transliterator->translit($transliterator->translit('привет, я с марса'), Transliterator::REVERSE));
        $this->assertEquals('как рассказала макаду, полет для нее стал "воплощением мечты" благодаря неограниченному количеству свободных кресел и угощений. летевшая к своим родственникам на самуи американка запечатлела полет на видео и сфотографировалась со стюардессами, которые обслуживали только ее одну.', $transliterator->translit($transliterator->translit('Как рассказала Макаду, полет для нее стал "воплощением мечты" благодаря неограниченному количеству свободных кресел и угощений. Летевшая к своим родственникам на Самуи американка запечатлела полет на видео и сфотографировалась со стюардессами, которые обслуживали только ее одну.'), Transliterator::REVERSE));
    }
}