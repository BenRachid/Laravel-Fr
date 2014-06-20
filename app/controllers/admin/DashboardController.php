<?php namespace Controllers\Admin;

use AdminController;
use View;
use Comment;

class DashboardController extends AdminController {

	/**
	 * Show the administration dashboard page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Show the page
		$comments = Comment::take(5)->get();
		return View::make('backend/dashboard/index', compact('comments'));
	}

}
