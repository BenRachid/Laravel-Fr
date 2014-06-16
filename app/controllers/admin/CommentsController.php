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
	{
		try
		{
			// Get the group information
			$group = Sentry::getGroupProvider()->findById($id);

			// Get all the available permissions
			$permissions = Config::get('permissions');
			$this->encodeAllPermissions($permissions, true);

			// Get this group permissions
			$groupPermissions = $group->getPermissions();
			$this->encodePermissions($groupPermissions);
			$groupPermissions = array_merge($groupPermissions, Input::old('permissions', array()));
		}
		catch (GroupNotFoundException $e)
		{
			// Redirect to the groups management page
			return Redirect::route('groups')->with('error', Lang::get('backend/groups/messages.group_not_found', compact('id')));
		}

		// Show the page
		return View::make('backend/groups/edit', compact('group', 'permissions', 'groupPermissions'));
	}

	/**
	 * Group update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id = null)
	{
		// We need to reverse the UI specific logic for our
		// permissions here before we update the group.
		$permissions = Input::get('permissions', array());
		$this->decodePermissions($permissions);
		app('request')->request->set('permissions', $permissions);

		try
		{
			// Get the group information
			$group = Sentry::getGroupProvider()->findById($id);
		}
		catch (GroupNotFoundException $e)
		{
			// Redirect to the groups management page
			return Rediret::route('groups')->with('error', Lang::get('backend/groups/messages.group_not_found', compact('id')));
		}

		// Declare the rules for the form validation
		$rules = array(
			'name' => 'required',
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
			// Update the group data
			$group->name        = Input::get('name');
			$group->permissions = Input::get('permissions');

			// Was the group updated?
			if ($group->save())
			{
				// Redirect to the group page
				return Redirect::route('update/group', $id)->with('success', Lang::get('backend/groups/messages.success.updated'));
			}
			else
			{
				// Redirect to the group page
				return Redirect::route('update/group', $id)->with('error', Lang::get('backend/groups/messages.error.updated'));
			}
		}
		catch (NameRequiredException $e)
		{
			$error = Lang::get('backend/groups/messages.group_name_required');
		}

		// Redirect to the group page
		return Redirect::route('update/group', $id)->withInput()->with('error', $error);
	}

	/**
	 * Delete the given group.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getDelete($id = null)
	{
		try
		{
			// Get group information
			$group = Sentry::getGroupProvider()->findById($id);

			// Delete the group
			$group->delete();

			// Redirect to the group management page
			return Redirect::route('groups')->with('success', Lang::get('backend/groups/messages.success.deleted'));
		}
		catch (GroupNotFoundException $e)
		{
			// Redirect to the group management page
			return Redirect::route('groups')->with('error', Lang::get('backend/groups/messages.group_not_found', compact('id')));
		}
	}

}
