<?php namespace Controllers\Admin;

use AdminController;
use Config;
use Input;
use Lang;
use Redirect;
use Validator;
use View;
use user;
use post;

class PostsController extends AdminController {

	/**
	 * Show a list of all the groups.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the posts
		$posts = Post::all();

		// Show the page
		return View::make('backend/posts/index', compact('posts'));
	}

	/**
	 * Group create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Get all the users
		$users = User::all();

		// Show the page
		return View::make('backend/posts/create', compact('users'));
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
			'user_id' => 'required',
			'title' => 'required',
			'content' => 'required',
		);
		$destinationPath = '';
            $filename        = '';

           if (Input::hasFile('Photo')) {
                $file            = Input::file('Photo');
                $destinationPath = public_path().'/imgages/logos/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
            }

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
			$post = new Post;
			$post->user_id = $inputs['user_id'];
			$post->title = $inputs['title'];
			$post->slug = $inputs['slug'];
			$post->content = $inputs['content'];
			$post->Photo =  'imgages/logos/' . $filename; 
			$post->meta_title = $inputs['meta_title'];
			$post->meta_description = $inputs['meta_description'];
			$post->meta_keywords = $inputs['meta_keywords'];

			// Was the post created?
			if ($post->save())
			{
				// Redirect to the new post page
				return Redirect::route('update/posts', $post->id)->with('success', Lang::get('backend/posts/messages.success.created'));
			}

			// Redirect to the new post page
			return Redirect::route('create/posts')->with('error', Lang::get('backend/posts/messages.error.created'));
		}
		catch (NameRequiredException $e)
		{
			$error = 'erreur, vérifier les champs requis';
		}

		// Redirect to the group create page
		return Redirect::route('create/posts')->withInput()->with('error', Lang::get('backend/posts/messages.'.$error));
	}

	/**
	 * Group update.
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getEdit($id = null)
	{
		//get the post to be edited
		$post= Post::findOrFail($id);
		// Get all the users
		$users = User::all();
		//Get all the Posts
		$posts = Post::all();

		// Show the page
		return View::make('backend/posts/edit', compact('post', 'users', 'posts'));
	}

	/**
	 * Group update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id = null)
	{
		//get the post to be edited
		$post= Post::findOrFail($id);
		// Declare the rules for the form validation
		$rules = array(
			'user_id' => 'required',
			'title' => 'required',
			'content' => 'required',
		);

				$destinationPath = '';
				$filename        = '';
           if (Input::hasFile('Photo')) {
                $file            = Input::file('Photo');
                $destinationPath = public_path().'/imgages/logos/';
                $filename        = str_random(6) . '_' . $file->getClientOriginalName();
                $uploadSuccess   = $file->move($destinationPath, $filename);
            }
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
			$post->user_id = $inputs['user_id'];
			$post->title = $inputs['title'];
			$post->slug = $inputs['slug'];
			$post->content = $inputs['content'];
			$post->Photo =  'imgages/logos/' . $filename; 
			$post->meta_title = $inputs['meta_title'];
			$post->meta_description = $inputs['meta_description'];
			$post->meta_keywords = $inputs['meta_keywords'];

			// Was the post created?
			if ($post->save())
			{
				// Redirect to the new post page
				return Redirect::route('update/posts', $post->id)->with('success', Lang::get('backend/posts/messages.success.created'));
			}

			// Redirect to the new post page
			return Redirect::route('update/posts')->with('error', Lang::get('backend/posts/messages.error.created'));
		}
		catch (NameRequiredException $e)
		{
			$error = Lang::get('backend/posts/messages.group_name_required');
		}
		// Redirect to the post page
		return Redirect::route('update/posts', $id)->withInput()->with('error', $error);
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
			//get the post to be edited
			$post= Post::findOrFail($id);

			// Delete the group
			$post->delete();

			// Redirect to the group management page
			return Redirect::route('posts')->with('success', Lang::get('backend/posts/messages.success.deleted'));
		}
		catch (PostNotFoundException $e)
		{
			// Redirect to the group management page
			return Redirect::route('posts')->with('error', Lang::get('backend/posts/messages.post_not_found', compact('id')));
		}
	}

}
