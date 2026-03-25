<?php

namespace App\Http\Controllers;

use App\Models\BlcUploadFrn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlcUploadFrnController extends Controller
{
   public function index(Request $request)
{
    $search = $request->get('search');

    $data = BlcUploadFrn::with('user')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('kp', 'like', "%{$search}%")
                  ->orWhere('style', 'like', "%{$search}%")
                  ->orWhere('item', 'like', "%{$search}%")
                  ->orWhere('color', 'like', "%{$search}%")
                  ->orWhere('relax', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('kendala', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

    return view('blc-upload-frns.index', compact('data', 'search'));
}

    public function create()
    {
        return view('blc-upload-frns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kp'          => 'required|string|max:255',
            'style'       => 'required|string|max:255',
            'country'     => 'required|string|max:100',
            'item'        => 'required|string|max:255',
            'color'       => 'required|string|max:100',
            'relax'       => 'required|string|max:100',     
            'qty_request' => 'required|integer|min:0',
            'blc'         => 'required|numeric',
            'podo'        => 'nullable|date',               
            'kendala'     => 'nullable|string|max:255',
            'keterangan'  => 'nullable|string|max:500',
        ]);

        BlcUploadFrn::create([
            'kp'          => $request->kp,
            'user_id'     => Auth::id(),
            'style'       => $request->style,
            'country'     => $request->country,
            'item'        => $request->item,
            'color'       => $request->color,
            'relax'       => $request->relax,               
            'qty_request' => $request->qty_request,
            'blc'         => $request->blc,
            'podo'        => $request->podo,                
            'kendala'     => $request->kendala,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()->route('blc-upload-frns.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(BlcUploadFrn $blc_upload_frn)
    {
        return view('blc-upload-frns.show', compact('blc_upload_frn'));
    }

    public function edit(BlcUploadFrn $blc_upload_frn)
    {
        return view('blc-upload-frns.edit', compact('blc_upload_frn'));
    }

    public function update(Request $request, BlcUploadFrn $blc_upload_frn)
    {
        $request->validate([
            'kp'          => 'required|string|max:255',
            'style'       => 'required|string|max:255',
            'country'     => 'required|string|max:100',
            'item'        => 'required|string|max:255',
            'color'       => 'required|string|max:100',
            'relax'       => 'required|string|max:100',     
            'qty_request' => 'required|integer|min:0',
            'blc'         => 'required|numeric',
            'podo'        => 'nullable|date',              
            'kendala'     => 'nullable|string|max:255',
            'keterangan'  => 'nullable|string|max:500',
        ]);

        $blc_upload_frn->update([
            'kp'          => $request->kp,
            'style'       => $request->style,
            'country'     => $request->country,
            'item'        => $request->item,
            'color'       => $request->color,
            'relax'       => $request->relax,
            'qty_request' => $request->qty_request,
            'blc'         => $request->blc,
            'podo'        => $request->podo,
            'kendala'     => $request->kendala,
            'keterangan'  => $request->keterangan,
            'user_id'     => Auth::id()
        ]);

        return redirect()->route('blc-upload-frns.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(BlcUploadFrn $blc_upload_frn)
    {
        $blc_upload_frn->delete();

        return redirect()->route('blc-upload-frns.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function updateBlc(Request $request, BlcUploadFrn $blc_upload_frn)
    {
        $request->validate([
            'blc' => 'required|numeric'
        ]);

        $blc_upload_frn->update([
            'blc' => $request->blc,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'BLC berhasil diupdate');
    }

    public function copy(BlcUploadFrn $blc_upload_frn)
    {
        $newData = $blc_upload_frn->replicate();           
        $newData->kp = $blc_upload_frn->kp . ' (Copy)';    
        $newData->blc = 0;                                 
        $newData->user_id = Auth::id();                    
        $newData->save();

        return redirect()->route('blc-upload-frns.edit', $newData)
            ->with('success', 'Data berhasil di-copy. Silakan edit warna / item yang diperlukan.');
    }
}