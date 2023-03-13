<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'attendance' )
	->fields(
		Field::inst( 'employee_id' )
			->validator( Validate::notEmpty( ValidateOptions::inst()
				->message( 'Employee ID is required' )	
			) ),
		Field::inst( 'am_in' ),
		Field::inst( 'am_out' ),
		Field::inst( 'pm_in' ),
		Field::inst( 'pm_out' ),
		Field::inst( 'status_am' ),
		Field::inst( 'status_pm' ),
		Field::inst( 'mins_late' ),
		Field::inst( 'attendance_date' ),
	)
	->debug(true)
	->process( $_POST )
	->json();
