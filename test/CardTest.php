<?php

use Bully\Model\Card;

/**
 * Created by PhpStorm.
 * User: ndreux
 * Date: 01/06/2018
 * Time: 10:02
 */
class CardTest extends PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider isSameColorDataProvider
     */
    public function testIsSameColor(Card $card, string $color, bool $expected)
    {
        $result = $card->isSameColor($color);
        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider isSameValueDataProvider
     */
    public function testIsSameValue(Card $card, string $value, bool $expected)
    {
        $result = $card->isSameValue($value);
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException \LogicException
     */
    public function testConstructNonValidCard() {
        new Card('33', 'P');
    }

    /**
     * @param Card $card
     *
     * @dataProvider toStringDataProvider
     */
    public function testToString(Card $card, string $expected)
    {
        $this->assertEquals($expected, $card->getKey());
    }

    public function toStringDataProvider()
    {
        return [
            [new Card('Jack', 'H'), 'JackH'],
            [new Card('Queen', 'D'), 'QueenD'],
            [new Card('Ace', 'C'), 'AceC'],
            [new Card('7', 'S'), '7S'],
        ];
    }

    public function isSameColorDataProvider()
    {
        return [
            [new Card('Jack', 'H'), 'H', true],
            [new Card('Jack', 'H'), 'D', true],
            [new Card('Jack', 'H'), 'S', false],
            [new Card('Jack', 'H'), 'C', false],
            [new Card('Jack', 'D'), 'D', true],
            [new Card('Jack', 'D'), 'H', true],
            [new Card('Jack', 'D'), 'S', false],
            [new Card('Jack', 'D'), 'C', false],
            [new Card('Jack', 'C'), 'C', true],
            [new Card('Jack', 'C'), 'S', true],
            [new Card('Jack', 'C'), 'D', false],
            [new Card('Jack', 'C'), 'H', false],
            [new Card('Jack', 'S'), 'H', false],
            [new Card('Jack', 'S'), 'D', false],
            [new Card('Jack', 'S'), 'C', true],
            [new Card('Jack', 'S'), 'S', true],
        ];
    }

    public function isSameValueDataProvider()
    {
        return [
            [new Card('Ace', 'H'), 'Ace', true],
            [new Card('Ace', 'H'), 'Queen', false],
            [new Card('Ace', 'H'), '3', false],
            [new Card('4', 'H'), 'Ace', false],
            [new Card('4', 'H'), '4', true],
            [new Card('4', 'H'), '3', false],
        ];
    }
}
