<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = contact::with('category')->get();
        $categories = Category::all();
        return view('index', compact('contact', 'categories'));
    }
    public function create(ContactRequest $request)
    {
        $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');
        $contact = ['tel' => $tel];
        return view('confirm',  compact('contact'));
    }


    public function confirm(ContactRequest $request)
    {

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'content', 'detail']);
        return view('confirm',  compact('contact'));
    }


    public function store(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail']);
        contact::create($contact);
        return view('thanks');
    }
}
