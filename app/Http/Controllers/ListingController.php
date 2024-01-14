<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// Common Resource Routes: naming functions
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

class ListingController extends Controller
{
    // Show All Listing
    public function index()
    {
        return view('listings.index', [
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->get(), Without pagination
            //With Pagination
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(6),
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6),
        ]);
    }

    // Show single Listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    //// Show Create Listing
    public function create(){
        return view('listings.create');
    }
    //// Store Listing
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'email')],
            'tags' => 'required',
            'description' => 'required'

        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing Created Successfully');
    }
}