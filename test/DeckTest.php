<?php
/**
 * Created by PhpStorm.
 * User: ndreux
 * Date: 01/06/2018
 * Time: 11:40
 */

use Bully\Model\Deck;

class DeckTest extends \PHPUnit\Framework\TestCase
{
    /**
     *
     */
    public function testBuildDeck()
    {
        $deck = new Deck();
        $this->assertCount(52, $deck->getCards());
    }

    public function testShuffleDeck()
    {

        $deck      = new Deck();
        $firstCard = $deck->getCards()[0];
        $lastCard  = $deck->getCards()[51];
        $deck->shuffle();

        $this->assertNotEquals($firstCard->__toString(), $deck->getCards()[0]);
        $this->assertNotEquals($lastCard->__toString(), $deck->getCards()[51]);
    }

    public function testShiftCard()
    {
        $deck       = new Deck();
        $firstCard  = $deck->getCards()[0];
        $secondCard = $deck->getCards()[1];

        $shiftedCard = $deck->shiftCard();

        $this->assertEquals($shiftedCard->__toString(), $firstCard->__toString());
        $this->assertEquals($deck->getCards()[0]->__toString(), $secondCard->__toString());
        $this->assertCount(51, $deck->getCards());

    }
}
