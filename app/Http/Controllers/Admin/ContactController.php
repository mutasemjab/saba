<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

     public function index(Request $request)
    {
        if (!auth('admin')->user()->can('contacts-index')) {
            abort(403);
        }

        $query = Contact::query();
        
        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('subject', 'like', '%' . $searchTerm . '%')
                  ->orWhere('message', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort column for security
        $allowedSortColumns = ['id', 'name', 'email', 'created_at'];
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->latest();
        }
        
        // Get per_page parameter with default of 25
        $perPage = $request->get('per_page', 25);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 25;
        
        // Paginate results
        $contacts = $query->paginate($perPage);
        
        return view('admin.contactUs.index', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
                         ->with('success', __('messages.contact_deleted_successfully'));
    }

    
   
}