<?php namespace Controllers\Admin;

use AdminController;
use Config;
use Input;
use Lang;
use Redirect;
use Comment;
use Validator;
use View;
use Post;
use user;

class CommentsController extends AdminController {

	/**
	 * Show a list of all the comments.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the comments
		$comments = Comment::all();

		// Show the page
		return View::make('backend/comments/index', compact('comments'));
	}

	/**
	 * comment create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Get all the users
		$users = User::all();
		//Get all the Posts
		$posts = Post::all();
		//Get all the CommentsId
		$comments = Comment::all();

		// Show the page
		return View::make('backend/comments/create', compact('users', 'posts', 'comments'));
	}

	/**
	 * Group create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'parent_id' => 'required',
			'post_id' => 'required',
			'user_id' => 'required',
			'content' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try
		{

			// Get the inputs, with some exceptions
			$inputs = Input::except('_token');
			$comment = new Comment;
			$comment->parent_id = $inputs['parent_id'];
			$comment->post_id = $inputs['post_id'];
			$comment->user_id = $inputs['user_id'];
			$comment->content = $inputs['content'];

			// Was the comment created?
			if ($comment->save())
			{
				// Redirect to the new comment page
				return Redirect::route('update/comments', $comment->id)->with('success', Lang::get('backend/comments/messages.success.created'));
			}

			// Redirect to the new comment page
			return Redirect::route('create/comments')->with('error', Lang::get('backend/comments/messages.error.created'));
		}
		catch (NameRequiredException $e)
		{
			$error = 'erreur, vérifier les champs requis';
		}

		// Redirect to the comment create page
		return Redirect::route('create/comments')->withInput()->with('error', Lang::get('backend/comments/messages.'.$error));
	}

	/**
	 * Group update.
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getEdit($id = null)
	{	//get the comment to be edited
		$comment= Comment::findOrFail($id);
		// Get all the users
		$users = User::all();
		//Get all the Posts
		$posts = Post::all();
		//Get all the CommentsId
		$comments = Comment::all();

		// Show the page
		return View::make('backend/comments/edit', compact('comments', 'posts', 'users', 'comment'));
	}

	/**
	 * Group update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id = null)
	{
		//get the comment to be edited
		$comment= Comment::findOrFail($id);
		// Declare the rules for the form validation
		$rules = array(
			'parent_id' => 'required',
			'post_id' => 'required',
			'user_id' => 'required',
			'content' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
		
		try
		{
			// Get the inputs, with some exceptions
			$inputs = Input::except('_token');
			$comment->parent_id = $inputs['parent_id'];
			$comment->post_id = $inputs['post_id'];
			$comment->user_id = $inputs['user_id'];
			$comment->content = $inputs['content'];
			
			// Was the comment created?
			if ($comment->save())
			{
				// Redirect to the new comment page
				return Redirect::route('update/comments', $comment->id)->with('success', Lang::get('backend/comments/messages.success.created'));
			}
			
			
				// Redirect to the new comment page
				return Redirect::route('update/comments')->with('error', Lang::get('backend/comments/messages.error.created'));
			
		}
		catch (NameRequiredException $e)
		{
			$error = Lang::get('backend/groups/messages.group_name_required');
		}

		// Redirect to the group page
		return Redirect::route('update/comments', $id)>withInput()->with('error', Lang::get('backend/comments/messages.'.$error));
	}

	/**
	 * Delete the given comment.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getDelete($id = null)
	{
		try
		{
			// Get comment information
			$comment= Comment::findOrFail($id);

			// Delete the comment
			$comment->delete();

			// Redirect to the comment management page
			return Redirect::route('comments')->with('success', Lang::get('backend/comments/messages.success.deleted'));
		}
		catch (GroupNotFoundException $e)
		{
			// Redirect to the comment management page
			return Redirect::route('comments')->with('error', Lang::get('backend/comments/messages.group_not_found', compact('id')));
		}
	}

}
