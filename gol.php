<?php
// Underpopulation: Any alive cell with fewer than two live neighbors dies.
assert_the_cell_will_die(
	$an_alive_cell = new Cell( $is_dead = false, $num_alive_neighbors = 1 )
);

// Any live cell with two or three live neighbors lives on
assert_the_cell_will_live_on(
	$a_live_cell = new Cell( $is_dead = false, $num_alive_neighbors = 2 )
);
assert_the_cell_will_live_on(
	$a_live_cell = new Cell( $is_dead = false, $num_alive_neighbors = 3 )
);

// Overcrowding: Any live cell with more than three live neighbors dies
assert_the_cell_will_die(
	$a_live_cell_with_more_than_three_live_neighbors = new Cell( $is_dead = false, $num_alive_neighbors = 4 )
);

// Reproduction: Any dead cell with exactly 3 live neighbors becomes a live cell
assert_the_cell_will_live_on(
	$a_dead_cell_with_exactly_3_live_neighbors = new Cell( $is_dead = true, $num_alive_neighbors = 3 )
);
assert_the_cell_will_die(
	$a_dead_cell_with_2_live_neighbors = new Cell( $is_dead = true, $num_alive_neighbors = 2 )
);

class Cell {
	
	private $num_alive_neighbors;
	private $is_dead;

	public function __construct( $is_dead, $num_alive_neighbors ) {
		$this->num_alive_neighbors = $num_alive_neighbors;
		$this->is_dead = $is_dead;
	}

	public function is_dead() {
		return $this->is_dead;
	}

	public function whats_next() {
		$this_is_a_dead_cell_with_not_exactly_three_alive_neighbors = true === $this->is_dead && 3 !== $this->num_alive_neighbors;
		$this_is_a_live_cell_with_other_than_2_or_3_live_neighbors = false === $this->is_dead && ! in_array( $this->num_alive_neighbors, array( 2, 3 ) );

		$is_dead =
			$this_is_a_dead_cell_with_not_exactly_three_alive_neighbors
			|| $this_is_a_live_cell_with_other_than_2_or_3_live_neighbors
		;
		return new Cell( $is_dead, $this->num_alive_neighbors );
	}
}

function assert_the_cell_will_die( $cell ) {
	return assert_the_cell_will( true, $cell, "did not die" );
}

function assert_the_cell_will_live_on( $cell ) {
	return assert_the_cell_will( false, $cell, "did not live on" );
}

function assert_the_cell_will( $what_will_it_do, $cell, $message ) {
	$cell_in_next_iteration = $cell->whats_next();
	if ( $what_will_it_do !== $cell_in_next_iteration->is_dead() ) {
		echo $message;
	}
}
