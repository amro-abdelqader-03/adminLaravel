<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sellers = Seller::latest()->paginate(5);
        
        return view('sellers.index', compact('sellers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::whereDoesntHave('seller')->get();
        return view('sellers.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'user_id' => 'required'
        ]);

        $input = $request->all();
        Seller::create($input);
        return redirect()->route('sellers.index')
            ->with('success', 'Seller created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller)
    {
        //
        return view('sellers.show', compact('seller'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller)
    {
        //
        return view('sellers.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255'
        ]);

        $seller->update([
            'name' => $request->name,
            'location' => $request->location
        ]);

        return redirect()->route('sellers.index')
            ->with('success', 'Seller updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        //
        $seller->delete();
        return redirect()->route('sellers.index')
            ->with('success', 'Seller deleted successfully');
    }
}
