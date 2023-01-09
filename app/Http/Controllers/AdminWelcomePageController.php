<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WelcomePage;
use Illuminate\Validation\Rules\File;

class AdminWelcomePageController extends Controller
{
    public function index()
    {
        $welcomePage = WelcomePage::all();
        return view('admin_welcome_page.welcome', ['welcomePage' => $welcomePage]);
    }

    public function create()
    {
        return view('admin_welcome_page.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required', 'string', 'max:255',
            'description' => 'required', 'string',
            'image' => 'required', File::types(['gif', 'GIF', 'jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG']),
        ]);

        $image = request()->file('image')->store('welcome_images');

        WelcomePage::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $image
        ]);

        return redirect()->route('welcome.index');
    }

    public function edit($id)
    {
        $welcomePage = WelcomePage::find($id);
        return view('admin_welcome_page.edit', compact('welcomePage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required', 'string', 'max:255',
            'description' => 'required', 'string',
            'image' => 'required', File::types(['gif', 'GIF', 'jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG']),
        ]);

        $image = request()->file('image')->store('welcome_images');

        $welcomePage = WelcomePage::find($id);
        $welcomePage->title = $request->get('title');
        $welcomePage->description = $request->get('description');
        $welcomePage->image = $image;

        $welcomePage->save();

        return redirect()->route('welcome.index');
    }

    public function destroy($id)
    {
        $welcomePage = WelcomePage::find($id);
        $welcomePage->delete();
        return redirect()->route('welcome.index');
    }
}
