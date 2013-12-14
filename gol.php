<?php
$the_block = array( new Cell(1, 1), new Cell(1, 2), new Cell( 2, 1 ), new Cell( 2, 2 ) );
$the_beehive = array( new Cell(1, 2), new Cell(1, 3), new Cell(2, 1), new Cell(2, 4), new Cell(3,2), new Cell(3,3) );

$game = start_game( $the_block );

assert_equal(
	$game->pattern(),
	$the_block
);

assert_equal(
	$game->aliveCells(),
	4
);

$game_with_beehive = start_game( $the_beehive );

assert_equal(
	$game_with_beehive->pattern(),
	$the_beehive,
	"The pattern of a game with a beehive is not a beehive"
);

assert_equal(
	$game_with_beehive->aliveCells(),
	6,
	'Beehive does not have 6 alive cells'
);

function start_game($seed_pattern)
{
	$game = new Game($seed_pattern);
	return $game;
}

class Game
{
	private $seed_pattern;

	public function __construct($_seed_pattern)
	{
		$this->seed_pattern = $_seed_pattern;
	}

	function pattern()
	{
		return $this->seed_pattern;
	}
	
	function aliveCells()
	{
		return count($this->seed_pattern);
	}

}

class Cell
{
	private $xCoord;
	private $yCoord;

	public function __construct($_xCoord, $_yCoord)
	{
		$xCoord = $_xCoord;
		$yCoord = $_yCoord;
	}

}

function assert_equal( $actual, $expected, $message = '' ) {
	if ( $actual !== $expected ) {
		echo $message ? $message : 'FAIL' ;
	}
}
