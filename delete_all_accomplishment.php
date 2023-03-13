<?php
	ob_start();
	require_once 'core/init.php';
		$accom = DB:: getInstance()->query("DELETE FROM accomplishment");
		Session::flash('Deleted', 'Deleted');
		Redirect::to('index.php?action=accomplishments');
	ob_end_flush();