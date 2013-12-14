<?php
/*
assert_equal(
	$expected_state = array(),
	mutate( $state = array() )
);

assert_equal(
	$expected_state = array( "1,1", "1,2", "2,1", "2,2" ),
	mutate( $state = array( "1,1", "1,2", "2,1", "2,2" ) )
);

assert_equal(
	$expected_state = array( "1,1", "1,2", "2,1", "2,2" ),
	mutate( $state = array( "1,2", "2,1", "2,2" ) )
);
*/

assert_equal(
	$expected_value = array(
		"0,1",
		"0,2",
		"0,3",
		"1,0",
		"1,1",
		"1,2",
		"1,3",
		"2,0",
		"2,1",
		"2,2",
		"2,3",
		"3,0",
		"3,1",
		"3,2",
		"3,3",
	),
	get_cells_with_alive_neighbors( $alive_cells = array( "1,2", "2,1", "2,2" ) )
);

function get_cells_with_alive_neighbors( $alive_cells ) {
	$cells_with_neighbours = array();
$cell
	foreach ( $alive_cells as $cell ) {
		$cell_coordinates = parse_coordinates($cell);
		for ($x_mod = -1; $x_mod <=1; $x_mod++) {
			for ($y_mod = -1; $y_mod <=1; $y_mod++) {
				$new_coordinate = array($cell_coordinates[0] + $x_mod, $cell_coordinates[1] + $y_mod);
				$new_cell = $cell_coordinates[0] . "," . $cell_coordinates[1];
				if ( !in_array( $new_cell, $cells_with_neighbours  )) {
					$cells_with_neighbours[] = $new_cell;
				}
			}
		}
	}

	return $cells_with_neighbours;
}

assert_equal(
	$expected_value = array(3, 4),
	parse_coordinates("3,4")
);

function parse_coordinates( $cell ) {
	return explode( ',', $cell );
}

function mutate( $alive_cells ) {
	$next_generation = array();

	$cells_with_alive_neighbors = get_cells_with_alive_neighbors( $alive_cells );

	foreach ( get_cells_with_alive_neighbors() as $cell ) {
		$num_alive_neighbors = get_num_alive_neighbors( $cell, $alive_cells );
		$cell_is_currently_alive = in_array( $cell, $alive_cells );

		if ( $cell_is_currently_alive && in_array( $num_alive_neighbors, array( 2, 3 ) ) ) {
			$next_generation[] = $cell;
		}

		if ( ! $cell_is_currently_alive && 3 === $num_alive_neighbors ) {
			$next_generation[] = $cell;	
		}
	}

	return $next_generation;
}


function assert_equal( $expected, $actual ) {
	$there_are_no_items_in_expected_that_do_not_exist_in_actual = 0 == count( array_diff( $expected, $actual ) );
	$there_are_no_items_in_actual_that_do_not_exist_in_expected = 0 == count( array_diff( $actual, $expected ) );

	if (
		$there_are_no_items_in_expected_that_do_not_exist_in_actual
		&& $there_are_no_items_in_actual_that_do_not_exist_in_expected
	) {
	} else {
		echo 'Expected: ' . print_r( $expected, true ) . "\nActual: " . print_r( $actual, true ) . "\n";
	}
}
