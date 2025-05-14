<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.dashboard', compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

        Admin::create($request->all());
        return redirect()->route('admin.index')->with('success', 'Modul berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        return redirect()->route('admin.index')->with('success', 'Modul berhasil diupdate!');
    }

    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->route('admin.index')->with('success', 'Modul berhasil dihapus!');
    }
}
