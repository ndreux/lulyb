<?php
/**
 * Created by PhpStorm.
 * User: ndreux
 * Date: 01/06/2018
 * Time: 14:49
 */

use Bully\Model\Card;
use Bully\Model\Player;

class PlayerTest extends \PHPUnit\Framework\TestCase
{


    public function testConstructor()
    {
        $playerName = 'John Doe';
        $player     = new Player($playerName);

        $this->assertEquals($playerName, $player->__toString());
        $this->assertCount(0, $player->getCards());
    }

    public function testAddCard()
    {
        $player = new Player('John Doe');
        $this->assertCount(0, $player->getCards());

        $player->addCard(new Card('Jack', 'S'));

        $this->assertCount(1, $player->getCards());
        $this->assertEquals('JackS', $this->getCard($player->getCards(), 0)->getKey());

        $player->addCard(new Card('6', 'C'));

        $this->assertCount(2, $player->getCards());
        $this->assertEquals('JackS', $this->getCard($player->getCards(), 0)->getKey());
        $this->assertEquals('6C', $this->getCard($player->getCards(), 1)->getKey());
    }


    private function getCard(array $cards, int $index)
    {
        $firstCard = array_slice($cards, $index, 1);
	
	return array_shift($firstCard);
    }

    /**
     * @dataProvider hasCardsDataProvider
     *
     * @param Player $player
     * @param bool   $expected
     */
    public function testHasCards(Player $player, bool $expected)
    {
        $this->assertEquals($expected, $player->hasCards());
    }

    public function hasCardsDataProvider()
    {
        $player1 = new Player('John Doe');
        $player2 = new Player('Jane Doe');

        $player2->addCard(new Card('3', 'D'));

        return [
            [$player1, false],
            [$player2, true],

        ];
    }

    /**
     * @dataProvider hasMatchingCardDataProvider
     *
     * @param Player $player
     * @param Card   $card
     * @param bool   $hasMatchingCard
     */
    public function testHasMatchingCard(Player $player, Card $card, bool $hasMatchingCard)
    {
        if ($hasMatchingCard) {
            $this->assertInstanceOf('Bully\Model\Card', $player->hasMatchingCard($card));
        } else {
            $this->assertFalse($player->hasMatchingCard($card));
        }
    }

    public function hasMatchingCardDataProvider()
    {

        $player1 = new Player('Player 1');
        $player1->addCard(new Card('7', 'S'));
        $player1->addCard(new Card('9', 'S'));
        $player1->addCard(new Card('Queen', 'C'));

        $player2 = new Player('Player 2');
        $player2->addCard(new Card('8', 'D'));
        $player2->addCard(new Card('King', 'S'));
        $player2->addCard(new Card('Jack', 'D'));
        $player2->addCard(new Card('Queen', 'C'));
        $player2->addCard(new Card('Ace', 'C'));

        $player3 = new Player('Player 3');
        $player3->addCard(new Card('7', 'H'));
        $player3->addCard(new Card('8', 'H'));

        $card1 = new Card('7', 'S');
        $card2 = new Card('7', 'D');
        $card3 = new Card('King', 'C');
        $card4 = new Card('King', 'H');

        return [
            [$player1, $card1, true],
            [$player1, $card2, true],
            [$player1, $card3, true],
            [$player1, $card4, false],
            [$player2, $card1, true],
            [$player2, $card2, true],
            [$player2, $card3, true],
            [$player2, $card4, true],
            [$player3, $card1, true],
            [$player3, $card2, true],
            [$player3, $card3, false],
            [$player3, $card4, true],
        ];


    }
}
