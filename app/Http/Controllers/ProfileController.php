<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Mail\UserEmail;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
  /**
   * Display the admin's profile form.
   */
  public function editAdmin(Request $request): View
  {
    return view('admin.profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the admin's profile information.
   */
  public function updateAdmin(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile_admin.edit')->with('status', 'profile-updated');
    Mail::to('jhessicapinedo@gamil.com')->send(new UserEmail);
  }

  /**
   * Delete the admin's account.
   */
  public function destroyAdmin(Request $request): RedirectResponse
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }

  /**
   * Display the client's profile form.
   */
  public function editCliente(Request $request): View
  {
    return view('cliente.profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the client's profile information.
   */
  public function updateCliente(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile_cliente.edit')->with('status', 'profile-updated');
    Mail::to('jhessicapinedo@gamil.com')->send(new UserEmail);
  }

  /**
   * Delete the client's account.
   */
  public function destroyCliente(Request $request): RedirectResponse
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }
}
