<?php
// if I seed it with a block
// in the next iteration the block pattern is still there

given( the_game_of_life_is_seeded_with( a_block ) );
when( the_next_iteration_is_calculated() );
then( it_has( a_block ) );

$gol = new GoL( BLOCK );
assert_true( $gol->next_iteration()->has( BLOCK ), "Block does not evolve into a block" );

// Distinguishing between patterns
$gol = new GoL( BEEHIVE );
$next_iteration = $gol->next_iteration();
assert_true( $next_iteration->has( BEEHIVE ), "Beehive does not evolve into a beehive" );
assert_false( $next_iteration->has( BLOCK ), "Beehive evolves into a block" );

class GoL {
	private $contained_patterns;

	public function __construct( $seed_pattern ) {
		$this->contained_patterns = array( $seed_pattern );
	}

	public function next_iteration() {
		return $this;
	}

	public function has( $pattern ) {
		return in_array( $pattern, $this->contained_patterns );
	}
}

function assert_true ( $value, $message ) {
	assert_they_are_equal( true, $value, $message );
}

function assert_false( $value, $message ) {
	assert_they_are_equal( false, $value, $message );
}

function assert_they_are_equal( $expected, $actual, $message ) {
	if ( $expected !== $actual ) {
		echo "FAIL: " . $message;
	}
}



















/*
$seed_pattern = array( "1,1", "1,2", "2,1", "2,2" );

$expected_set_of_states = $seed_pattern;

$gol = new GoL( $seed_pattern );

$set_of_states = $gol->getStates();
*/
